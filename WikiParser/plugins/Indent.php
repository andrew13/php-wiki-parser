<?php

class WikiParser_Plugins_Indent implements WikiParser_Library_StartOfLineInterface, WikiParser_Library_EndOfLineInterface
{
    const regular_expression = '/^:+/i';
    private $indent = 0;
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line)
    {
        return preg_replace_callback(indent::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        $i = 0;
        $this->indent = strlen($matches[0]);
        $indent_html = "";
        
        for($i = 0;$i < $this->indent;$i++)
        {
            $indent_html .= "<div class=\"indent\">";
        }

        return $indent_html;
    }
    
    public function endOfLine($line_of_text) 
    {
        $i = 0;
        $indent_html = "";
        
        for($i = 0;$i < $this->indent;$i++)
        {
            $indent_html .= "</div>";
        }

        $this->indent = 0;
        return $line_of_text . $indent_html;
    }
        
}

?>