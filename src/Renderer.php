<?php

namespace ntsalikis\harbour;

class Renderer
{
    private const HTML_START_PATH = __DIR__ . '/html_structure/html_start.php';
    private const HTML_END_PATH = __DIR__ . '/html_structure/html_end.php';

    private $template_metadata = [];
    private $template_data = [];

    public function load_data_from_json($json_file_path)
    {
        $loaded_data = json_decode(file_get_contents($json_file_path), true);

        $this->template_metadata = array_merge($this->template_metadata, $loaded_data['metadata']);
        $this->template_data = array_merge($this->template_data, $loaded_data['data']);
    }

    public function add_template_metadata($key, $value)
    {
        $new_metadata = [ $key => $value];

        $this->template_metadata = array_merge($this->template_metadata, $new_metadata);
    }

    public function add_template_data($key, $value)
    {
        $new_data = [ $key => $value ];

        $this->template_data = array_merge($this->template_data, $new_data);
    }

    public function render_template($template_file_path, $use_html_structure = true)
    {
        
        $template_metadata = $this->template_metadata;
        $template_data = $this->template_data;

        if($use_html_structure)
        {
            include Renderer::HTML_START_PATH;
            echo PHP_EOL;
        }

        include $template_file_path;

        if($use_html_structure)
        {
            echo PHP_EOL;
            include Renderer::HTML_END_PATH;
        }
    }
}
