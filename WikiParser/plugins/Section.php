<?php

class WikiParser_Plugins_Section implements WikiParser_Library_StartOfLineInterface
{
    const regular_expression = '/(={1,6})(.*?)(={1,6})|(\[.*((={1,6})(.*?)(={1,6})).*\])|^[\|\!\{](.*)(={1,6})(.*?)(={1,6})(.*)/i';
    private $sections = null;
        
    public function __construct()
    {
        $this->sections = array();
    }
    
    public function startOfLine($line)
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(WikiParser_Plugins_Section::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        if(count($matches) == 4)
        {
            return '<h' . strlen($matches[1]) . '>' . $matches[2] . '</h' . strlen($matches[1]) . '>';
        }
        else
        {
            return $matches[0];
        }
    }
    
}
