<?php

class WikiParser_Plugins_HorizontalRule implements WikiParser_Library_StartOfLineInterface
{
    const regular_expression = '/^----(\s*)$/';
        
    public function __construct()
    {
        
    }
    
    public function startOfLine($line)
    {
        return preg_replace_callback(WikiParser_Plugins_HorizontalRule::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        return '<hr/>';
    }
    
}

