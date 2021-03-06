<?php

require_once(dirname(__FILE__) . '/../interface/WikiParser_Library_StartOfLine.interface.php');

/*
 * Supporting Docs
 * http://www.pmwiki.org/wiki/PmWiki/MarkupMasterIndex
 */
class WikiParser_Plugins_PMWiki_CF_bigger implements WikiParser_Library_StartOfLineInterface
{
    const regular_expression = '/\[\+\+.*?\+\+\]/i'; ///(\[\+\+.*?\+\+\]|\[\+.*?\+\]|\[--.*?--\]|\[-.*?-\]|@@.*?@@)
        
    public function __construct()
    {

    }
    
    public function startOfLine($line)
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(pmwiki_cF_bigger::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        return '<span style="font-size:144%">' . substr($matches[0],3,-3) . '</span>';
    }
    
}

?>