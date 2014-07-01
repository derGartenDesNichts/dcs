<?php

class DateFormatHelper
{
    public static function setCustomDate($date)
    {
        return date('j.m.Y H:i', strtotime($date));
    }
}