<?php

namespace ntsalikis\harbour;

class SubRouter
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';

    private $handlers = [];

    public function assign_handler($path, $method, $middleware, $handler)
    {
        array_push($this->handlers, [
            'path' => $path,
            'method' => $method,
            'middleware' => $middleware,
            'handler' => $handler
        ]);
    }

    public function contains_handler_for_path($request_path, $request_method)
    {
        foreach($this->handlers as $handler)
        {
            if($handler['path'] == $request_path && $handler['method'] == $request_method)
            {
                return true;
            }
        }

        return false;
    }

    public function route($request_path, $request_method, $request_params)
    {
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
}
