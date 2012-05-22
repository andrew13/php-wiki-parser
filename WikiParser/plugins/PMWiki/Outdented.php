<?php

class WikiParser_Plugins_PMWiki_Outdented implements WikiParser_Library_StartOfLineInterface, WikiParser_Library_EndOfLineInterface
{
    const regular_expression = '/^-\</i';
    private $enabled = false;
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line)
    {
        return preg_replace_callback(WikiParser_Plugins_PMWiki_Outdented::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        $this->enabled = true;
        return "<div class=\"outdent\">" . substr($matches[0],2);
    }
    
    public function endOfLine($line_of_text) 
    {
        if($this->enabled)
        {
            $this->enabled = false;
            return $line_of_text . "</div>";
        }
        else
        {
            return $line_of_text;
        }
    }
        
}
