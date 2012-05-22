<?php

class WikiParser_Plugins_NoWiki implements WikiParser_Library_PreParsing, WikiParser_Library_PostParsingInterface
{
    const remove_content_regular_expression = '/<nowiki>([\s\S]+?)<\/nowiki>/i';
    const replace_content_regular_expression = '/<nowiki><\/nowiki>/i';

    private $no_wiki_items = null;
    
    public function __construct()
    {
        $this->no_wiki_items = array();
    }
    
    public function preParsing($file_content)  
    {
        return preg_replace_callback(WikiParser_Plugins_NoWiki::remove_content_regular_expression,array($this,'remove_content'),$file_content);
    }

    private function remove_content($matches)
    {
        array_push($this->no_wiki_items,$matches[1]);
        return "<nowiki></nowiki>";        
    }
    
    public function postParsing($file_content) 
    {
        return preg_replace_callback(WikiParser_Plugins_NoWiki::replace_content_regular_expression,array($this,'replace_content'),$file_content);
    }

    private function replace_content($matches)
    {
        return array_shift($this->no_wiki_items);        
    }

}
