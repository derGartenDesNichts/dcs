<?php

class DateFormatHelper
{
    public static function setCustomDate($date)
    {
        return date('j F Y H:i', strtotime($date));
    }
}