<?php

/**
 * This is the model class for table "users_answers".
 *
 * The followings are the available columns in table 'users_answers':
 * @property integer $id
 * @property integer $user_id
 * @property integer $answer_id
 * @property integer $question_id
 * @property integer $answer
 */
class UsersAnswers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, answer_id, question_id', 'required'),
			array('user_id, answer_id, question_id, answer', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, answer_id, question_id, answer', 'safe', 'on'=>'search'),
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
            'answers' => array(self::BELONGS_TO, 'Answers', array('answer_id' => 'answer_id')),
            'comments'=> array(self::BELONGS_TO, 'Comments', array('answer_id' => 'answer_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => tt('User'),
			'answer_id' => tt('Answer'),
			'question_id' => tt('Question'),
			'answer' => tt('Answer'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('answer_id',$this->answer_id);
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('answer',$this->answer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersAnswers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getCountOfAnswers($questionId, $answerId = false)
    {
        $answerSql = '';
        if($answerId)
            $answerSql = ' AND answer_id='.$answerId;
        
        $sql = <<<SQL
          SELECT COUNT(*) as likes
          FROM {$this->tableName()}
          WHERE question_id LIKE :questionId AND answer = 1{$answerSql}
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':questionId', $questionId);
        $data['likes'] = $command->queryScalar();
        
        $sql = <<<SQL
          SELECT COUNT(*) as dislikes
          FROM {$this->tableName()}
          WHERE question_id LIKE :questionId AND answer = 2{$answerSql}
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':questionId', $questionId);
        $data['dislikes'] = $command->queryScalar();
        
        $sql = <<<SQL
          SELECT COUNT(*) as revision
          FROM {$this->tableName()}
          WHERE question_id LIKE :questionId AND answer = 3{$answerSql}
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':questionId', $questionId);
        $data['revision'] = $command->queryScalar();
        
        return $data;
    }

    public function getStatistic($questionId)
    {
        $params = array('1'=>'likes','2'=>'dislikes','3'=>'ref');
        $statistic = array();

        foreach($params as $key=>$param)
        {
            $statistic[$param] = Yii::app()->db->createCommand()
                ->select('t.user_id, p.last_name, p.first_name')
                ->from('users_answers t')
                ->where('question_id LIKE :questionId AND answer = :key', array(':questionId'=>$questionId,':key'=>$key))
                ->join('profiles p','p.user_id=t.user_id')
                ->queryAll();
        }

        return $statistic;
    }
}
