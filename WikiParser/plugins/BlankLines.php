<?php

class WikiParser_Plugins_BlankLines implements WikiParser_Library_StartOfLineInterface
{
    public function start($line)
    {
        if(trim($line) === "")
        {
            return "<br />";
        }
        else
        {
            return $line;
        }
    }

    public function startOfLine($line)
    {
        if(trim($line) === "")
        {
            return "<br />";
        }
        else
        {
            return $line;
        }
    }
}