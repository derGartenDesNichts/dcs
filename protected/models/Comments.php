<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $comment_id
 * @property string $answer_id
 * @property string $user_id
 * @property string $text
 * @property string $date_added
 */
class Comments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('answer_id, user_id, text, date_added', 'required'),
			array('answer_id', 'length', 'max'=>10),
			array('user_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('comment_id, $answer_id, user_id, text, date_added', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'userProfile' => array(self::BELONGS_TO, 'Profile', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comment_id' => tt('Comment'),
			'answer_id' => tt('Answer ID'),
			'user_id' => tt('User'),
			'text' => tt('Text'),
			'date_added' => tt('Date Added'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('answer_id',$this->answer_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getComments($answer_id)
    {
        $criteria=new CDbCriteria;

        $criteria->compare('answer_id',$answer_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function getCommentsCount($questionId, $userId = null)
    {
        if(!$userId)
            $userId = Yii::app()->user->id;
        
        $table = $this->tableName();               
        
        $sql = <<<SQL
                SELECT COUNT(*) 
                FROM {$table} c
                    INNER JOIN answers a ON (a.answer_id = c.answer_id)
                    INNER JOIN questions q ON (q.question_id = a.question_id)
                    INNER JOIN users_answers u ON (a.answer_id = u.answer_id)
                WHERE a.question_id = :questionId AND u.user_id = :userId;
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':userId', $userId);
        $command->bindValue(':questionId', $questionId);        
        
        return $command->queryScalar();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
