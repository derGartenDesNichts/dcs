<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property integer $question_id
 * @property integer $user_id
 * @property string $level_id
 * @property string $iteration_count
 * @property string $answer
 * @property string $text
 * @property string $date_added
 * @property string $expired_date
 * @property string $result
 */
class Questions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, level_id, iteration_count, answer, text, date_added, title', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('level_id, iteration_count', 'length', 'max'=>10),
			array('answer, result', 'length', 'max'=>255),
			array('expired_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('question_id, user_id, level_id, iteration_count, answer, text, date_added, expired_date, result, title', 'safe', 'on'=>'search'),
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
			'question_id' => 'Question',
			'user_id' => 'User',
			'level_id' => 'Level',
			'iteration_count' => 'Iteration Count',
			'answer' => 'Answer',
			'text' => 'Text',
			'date_added' => 'Date Added',
			'expired_date' => 'Expired Date',
			'result' => 'Result',
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

		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('iteration_count',$this->iteration_count,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('expired_date',$this->expired_date,true);
		$criteria->compare('result',$this->result,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Questions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getNewQuestions()
    {
        $criteria = new CDbCriteria();

        $criteria->addCondition('date_added>"'.date('Y-m-d',strtotime('yesterday')).'"');

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria
        ));
    }
}
