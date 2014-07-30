<?php
class LanguageSwitcher
{
    public static function get()
    {
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $links = '';
        foreach (DMultilangHelper::suffixList() as $suffix => $name){
            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;

            $imageUrl = Yii::app()->baseUrl . '/images/'.$name .'.png';
            $image = CHtml::image($imageUrl, $name, array('width'=>25,'height'=>25));

            $links .= ' '.CHtml::link($image, $url);
        }

        return $links;
    }
}
