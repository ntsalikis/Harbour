<?php

namespace core;

use ntsalikis\harbour;

class Router
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';
    
    private $sub_routers = [];

    private $handlers = [];

    private $not_found_handler;

    public function assign_sub_router($path, $sub_router)
    {
        array_push($this->sub_routers, [
            'path' => $path,
            'sub_router' => $sub_router
        ]);
    }

    public function assign_handler($path, $method, $middleware, $handler)
    {
        array_push($this->handlers, [
            'path' => $path,
            'method' => $method,
            'middleware' => $middleware,
            'handler' => $handler
        ]);
    }

    public function assign_not_found_handler($handler)
    {
        $this->not_found_handler = $handler;
    }

    public function route()
    {
        $request_path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_params = [
            'query' => $_GET,
            'form' => $_POST,
            'body' => file_get_contents('php://input')
        ];

        $handler = $this->retrieve_handler($request_path, $request_method);

        if($handler)
        {
            if($handler['middleware'])
            {
                foreach($handler['middleware'] as $middleware)
                {
                    $params = call_user_func_array($middleware, [$request_params]);
                }
            }
            return call_user_func_array($handler['handler'], [$request_params]);
        }

        $sub_router = $this->retrieve_sub_router($request_path);

        if($sub_router)
        {
            $sub_router_request_path = $this->prepare_sub_router_request_path($request_path, $sub_router['path']);
            
            if($sub_router['sub_router']->contains_handler_for_path($sub_router_request_path, $request_method))
            {
                return $sub_router['sub_router']->route($sub_router_request_path, $request_method, $request_params);
            }
        }

        header('HTTP/1.0 404 Not Found');
        if($this->not_found_handler)
        {
            return call_user_func_array($this->not_found_handler, [$request_params]);
        }
    }

    private function retrieve_sub_router($request_path)
    {  
        foreach($this->sub_routers as $sub_router)
        {
            if(strpos($request_path, $sub_router['path']))
            {
                return $sub_router;
            }
        }

        return NULL;
    }

    private function retrieve_handler($request_path, $request_method)
    {
        foreach($this->handlers as $handler)
        {
            if($handler['path'] == $request_path && $handler['method'] == $request_method)
            {
                return $handler;
            }
        }

        return NULL;
    }

    private function prepare_sub_router_request_path($request_path, $sub_router_path)
    {
        return substr($request_path, strpos($request_path, $sub_router_path) + strlen($sub_router_path));
    }
}
