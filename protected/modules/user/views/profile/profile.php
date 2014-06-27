<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
    UserModule::t("Profile"),
);

$itIsCurrentUser = $model->id == Yii::app()->user->id;

$menu = array();

if ($itIsCurrentUser) {
    $menu += array(
        array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
        array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
        array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
    );
}
$this->menu = $menu;

?><h1 class="content-title"><?php echo UserModule::t('Profile'); ?></h1>


<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>
<div class="clearfix">
    <div class="user-avatar">
        <?php echo CHtml::image(Yii::app()->baseUrl.$profile->getImageUrl(true))?>
    </div>
    <div class="form-view">
        <div class="form-view-row">
            <span class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></span>
            <span class="controls"><?php echo CHtml::encode($model->username); ?></span>
        </div>
        <?php
        $profileFields=ProfileField::model()->forOwner()->sort()->findAll();
        if ($profileFields) {
            foreach($profileFields as $field) {

                $value = $profile->getAttribute($field->varname);
                if (empty($value))
                    continue;
                ?>
                <div class="form-view-row">
                    <span class="control-label"><?php echo CHtml::encode(UserModule::t($field->title)); ?></span>
                    <span class="controls"><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$value):$value))); ?></span>
                </div>
            <?php
            }
        }
        ?>
        <?php if (!empty($profile->website)) :

            if(strpos($profile->website,'http://') !== 0)
                $profile->website = 'http://' . $profile->website;
            ?>
            <div class="form-view-row">
                <span class="control-label"><?php echo CHtml::encode($profile->getAttributeLabel('website')); ?></span>
                <span class="controls"><?php echo (empty($profile->website) ? '' : CHtml::link($profile->website, $profile->website, array('target' => '_blank')))?></span>
            </div>
        <?php endif; ?>
        <?php if ($itIsCurrentUser) : ?>
            <div class="form-view-row">
                <span class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></span>
                <span class="controls"><?php echo CHtml::link($model->email, 'mailto:' . $model->email)?></span>
            </div>
        <?php endif; ?>
        <div class="form-view-row">
            <span class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></span>
            <span class="controls"><?php echo $model->create_at; ?></span>
        </div>
        <div class="form-view-row">
            <span class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></span>
            <span class="controls"><?php echo $model->lastvisit_at; ?></span>
        </div>

        <?php if (!empty($model->users_locations)) : ?>
            <div class="form-view-row">
                <span class="control-label">Locations</span>
                <span class="controls">
                    <?php
                    echo tt('Ukraine').'<br>';

                    foreach ($model->users_locations as $location) {

                        if($location->locations->level_id == 2)
                        {
                            $district = Districts::model()->findByPk($location->location_id);
                            echo $district->name . '<br>';
                        }

                        if($location->locations->level_id == 3)
                        {
                            $city = Cities::model()->findByPk($location->location_id);
                            echo $city->name . '<br>';
                        }

                    }
                    ?>
                </span>
            </div>
        <?php endif; ?>
    </div>
</div>