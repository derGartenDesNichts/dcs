<?php

class MessagesController extends Controller
{
    public $layout='//layouts/column2';
    public $currUserId;

    protected function beforeAction($action)
    {
        $this->currUserId = Yii::app()->user->id;
        return parent::beforeAction($action);
    }


    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
            array('allow',
                'actions'=>array('conversationwith', 'lastuserslist'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionConversationWith($userId, $limitation = 1)
    {
        $created = $this->getCreatedLimit($limitation);

        $model = new Messages;

        if (isset($_POST['Messages'])) {
            $model->attributes = $_POST['Messages'];
            $model->user_from  = $this->currUserId;
            $model->user_to    = $userId;

            if ($model->user_from != $model->user_to)
                if ($model->save())
                    $this->refresh();

        }


        $messages =
            Yii::app()->db->createCommand()
                ->select('m.*')
                ->from('messages as m')
                ->where(
                    'created > :CREATED AND  m.user_from in (:USER_1, :USER_2) AND m.user_to in (:USER_1, :USER_2)',
                    array(
                        ':USER_1'  => $this->currUserId,
                        ':USER_2'  => $userId,
                        ':CREATED' => $created,
                    )
                )
                ->order('created')
                ->queryAll();

        // mark messages as read
        foreach ($messages as $message) {
            Yii::app()->db->createCommand()
                ->update('messages', array(
                        'is_read'=>'1',
                    ),
                    'id=:ID and user_to=:USER_TO',
                    array(
                        ':ID'=>$message['id'],
                        ':USER_TO'=>$this->currUserId
                    )
                );
        }


        $this->render('conversation_with', array(
            'model'      => $model,
            'messages'   => $messages,
            'currUserId' => $this->currUserId,
            'userId'     => $userId,
            'limitation' => $limitation
        ));
    }

    public function actionLastUsersList()
    {
        $lastUserIds =
            Yii::app()->db->createCommand()
                ->select('IF(m.user_from = :USER_1, m.user_to, m.user_from) AS userId')
                ->from('messages as m')
                ->where('m.user_from = :USER_1 or m.user_to = :USER_1',
                    array(
                        ':USER_1' => $this->currUserId,
                    )
                )
                ->group('userId')
                ->order('created DESC')
                ->limit(10)
                ->queryColumn();

        $lastUsers = User::model()->findAllByPk($lastUserIds);

        $this->render('last_users_list', array(
            'lastUsers' => $lastUsers
        ));
    }

    private function getCreatedLimit($case)
    {
        switch($case) {
            case 1:
                $created = date('Y-m-d', strtotime('-1 day')); // last 24 hour
                break;
            case 2:
                $created = date('Y-m-d', strtotime('-7 day')); // last week
                break;
            case 3:
                $created = date('Y-m-d', strtotime('2000-01-01')); // all
                break;
            default:
                $created = date('Y-m-d', strtotime('-1 day')); // last 24 hour
        }

        return $created;
    }
}
