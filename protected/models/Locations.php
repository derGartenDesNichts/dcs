<?php

/**
 * This is the model class for table "locations".
 *
 * The followings are the available columns in table 'locations':
 * @property integer $location_id
 * @property string $level_id
 * @property string $place_id
 * @property string $date_added
 */
class Locations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'locations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level_id, place_id, date_added', 'required'),
			array('level_id, place_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('location_id, level_id, place_id, date_added', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'location_id' => tt('Location ID'),
			'level_id' => tt('Level ID'),
			'place_id' => tt('Place ID'),
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

		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('place_id',$this->place_id,true);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Locations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getUserLocations($userId = null)
	{
        if(!$userId)
            $userId = Yii::app ()->user->id;
        
		$table = $this->tableName();

        $sql = <<<SQL
                SELECT lev.description, u.location_id
                FROM {$table} l
                  INNER JOIN users_locations u ON (u.location_id = l.location_id)
                  INNER JOIN levels lev ON (lev.level_id = l.level_id)
                WHERE u.user_id = :userId
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':userId', $userId);
        $levels = $command->queryAll();
        
        return $levels;
	}
    
    public function getArea()
	{
        if($this->level_id == 1)
            return 'Україна';
        elseif($this->level_id == 2) {            
            $district = Districts::model()->findByPk($this->location_id);
            return $district->name;
        }elseif($this->level_id == 3) {
            $city = Cities::model()->findByPk($this->location_id);
            return $city->name;
        }
	}
    
    
}
