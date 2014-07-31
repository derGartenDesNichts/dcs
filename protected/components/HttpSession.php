<?php

class HttpSession extends CHttpSession
{
    public function regenerateID($deleteOldSession=false)
    {
        @session_regenerate_id($deleteOldSession);
    }

}