<?php

/**
 * Dummy class to use default Yii preload feature
 */
class Shortcodes extends CApplicationComponent
{}

function tt($str)
{
    return Yii::t('trans', $str);
}

