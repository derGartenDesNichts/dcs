<?php

class PreviewTextCuter
{
    public static function cut($longText)
    {
        $text = explode("<br /><br />",$longText);

        if(isset($text) && !empty($text))
        {
            if(count($text)>1)  return array_shift($text)."<br ><br />".array_shift($text)."<br ><br />";
            else return $longText;
        }

    }
}
