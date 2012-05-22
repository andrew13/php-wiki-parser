<?php

/*
 * Supporting Docs
 * http://www.pmwiki.org/wiki/PmWiki/MarkupMasterIndex
 */
class WikiParser_Plugins_PMWiki_CF_Strong implements WikiParser_Library_StartOfLineInterface
{
    const regular_expression = '/\'\'\'.*?\'\'\'/i'; //'/(\[\+\+.*?\+\+\]|\[\+.*?\+\]|\[--.*?--\]|\[-.*?-\]|@@.*?@@)/i';
        
    public function __construct()
    {

    }
    
    public function startOfLine($line)
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(WikiParser_Plugins_PMWiki_CF_Strong::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        return '<strong>' . substr($matches[0],3,-3) . '</strong>';
    }
    
}
