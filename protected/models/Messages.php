<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property integer $user_from
 * @property integer $user_to
 * @property string $text
 * @property string $created
 * @property integer $is_read
 */
class Messages extends CActiveRecord
{
    public function beforeSave()
    {
        if ($this->isNewRecord)
            $this->created = new CDbExpression('NOW()');

        return parent::beforeSave();
    }



	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_from, user_to', 'required'),
			array('user_from, user_to, is_read', 'numerical', 'integerOnly'=>true),
			array('text, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_from, user_to, text, created, is_read', 'safe', 'on'=>'search'),
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
            'userFrom' => array(self::BELONGS_TO, 'Users', 'user_from'),
            'userTo'   => array(self::BELONGS_TO, 'Users', 'user_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_from' => 'User From',
			'user_to' => 'User To',
			'text' => 'Text',
			'created' => 'Created',
			'is_read' => 'Is Read',
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
		$criteria->compare('user_from',$this->user_from);
		$criteria->compare('user_to',$this->user_to);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('is_read',$this->is_read);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getLastMessage($user_from,$user_to)
    {
        $criteria = array(
            'order' => 'created DESC',
            'condition'=>'user_from IN('.$user_from.','.$user_to.') AND user_to IN('.$user_from.','.$user_to.')'
        );

        return Messages::model()->find($criteria);
    }
}
