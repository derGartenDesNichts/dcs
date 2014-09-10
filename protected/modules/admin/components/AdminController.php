<?php

class AdminController extends Controller
{
    public $layout='//layouts/column2f';

    protected  $_model;
    
    public $menuItem;
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'users'=>UserModule::getAdmins(),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

}
