<?php

/*
 * Supporting DOCS
 * http://www.pmwiki.org/wiki/PmWiki/WikiStyles
 */
class WikiParser_Plugins_PMWiki_WikiStyles implements WikiParser_Library_StartOfLineInterface, WikiParser_Library_EndOfLineInterface
{
    const regular_expression = '/%(.*?)%([.^%]*?)/i';
    private $open_styles = null;
        
    public function __construct()
    {
        $this->open_styles = array();
    }
    
    public function startOfLine($line)
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(WikiParser_Plugins_PMWiki_WikiStyles::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        switch(strtolower($matches[1]))
        {
            case "red":
            case "blue":
            case "black":
            case "green":
            case "purple":
                $this->open_styles[] = "</span>";
                return "<span style=\"color: " . $matches[1] . "\">" . $matches[2];                
            break;    
        }
        
        return $matches[0];
    }
    
    public function endOfLine($line_of_text) 
    {
        $closure = "";
        
        while(($item = array_pop($this->open_styles)) !== null)
        {            
            $closure .= $item;
        }
        return $line_of_text . $closure;
    }
    
    
}