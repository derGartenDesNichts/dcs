<?php
class LanguageSwitcher
{
    public static function get()
    {
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $links = '<div class="lang-switcher">';
        foreach (DMultilangHelper::suffixList() as $suffix => $name){
            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;

            /*$imageUrl = Yii::app()->baseUrl . '/images/'.$name .'1.png';
            $image = CHtml::image($imageUrl, $name, array('width'=>30,'height'=>30));*/

            $image = '<span class="label label-inverse">'.$name.'</span>';
            $links .= ' '.CHtml::link($image, $url);
        }

        $links .= '</div>';
        return $links;
    }
}
