<?php

class WikiParser_Plugins_PMWiki_LineBreaks implements WikiParser_Library_StartOfLineInterface, WikiParser_Library_EndOfLineInterface
{
    const regular_expression = '/^[^\!](.*?)(\\{1,3}|)$/i';
    
    private $paragraph_open = false;
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line)
    {
        if(preg_match(WikiParser_Plugins_PMWiki_LineBreaks::regular_expression, trim(strip_tags($line)),$matches) && trim($line) != "" && !$this->paragraph_open)
        {
            $this->paragraph_open = true;
            return "<p>" . $line;
        }
        
        return $line;
    }

    public function endOfLine($line)
    {
        if(preg_match(WikiParser_Plugins_PMWiki_LineBreaks::regular_expression, $line,$matches) && $this->paragraph_open)
        {
            $this->paragraph_open = false;
            return $line . "</p>";
        }
        
        return $line;
    }
    
}
