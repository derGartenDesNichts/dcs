<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php
    Yii::app()->bootstrap->register();
    Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .'/css/styles.css');
    ?>


    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body>
<div id="wrapper">
    <div class="w1">
        <?php
        $this->widget('bootstrap.widgets.TbNavbar',array(
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'clearfix'),
                    'items'=>array(
                        array('label'=>tt('Home'), 'icon'=>'home', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>tt('Admin'), 'icon'=>'cog', 'url'=>array('/admin/default/index'), 'visible'=>Yii::app()->user->isAdmin()),
                        array('label'=>tt('Profile'),'icon'=>'user', 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>tt('Login'), 'icon'=>'ok', 'url'=>Yii::app()->getModule('user')->loginUrl, 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>tt('Registration'), 'icon'=>'pencil', 'url'=>Yii::app()->getModule('user')->registrationUrl, 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>tt('Logout').' ('.Yii::app()->user->name.')', 'icon'=>'off', 'url'=>Yii::app()->getModule('user')->logoutUrl, 'visible'=>!Yii::app()->user->isGuest),
                    ),
                ),
            ),
        )); ?>

        <div class="container" id="page">

            <?php
            // Breadcrumbs
            if (isset($this->breadcrumbs)) {
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'homeLink' => false,
                    'encodeLabel' => false,
                ));
            }

            $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true, // display a larger alert block?
                'fade'=>true, // use transitions?
                'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
            ));

            echo $content;

            ?>
        </div>
    </div>

    <!-- footer -->
    <footer id="footer">
        <div class="footer-holder">
            <div class="footer-frame">
                <div class="container">
                    <p> Some text bla bla </p>
                </div>
            </div>
        </div>
    </footer>
</div><!-- page -->

</body>
</html>



















