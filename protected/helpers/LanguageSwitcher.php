<?php
class LanguageSwitcher
{
    public static function get()
    {
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $links = '';
        foreach (DMultilangHelper::suffixList() as $suffix => $name){
            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;
            $links .= ' '.CHtml::link($name, $url);
        }

        return $links;
    }
}
