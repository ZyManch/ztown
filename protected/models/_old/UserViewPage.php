<?php

/**
 * This is the model class for table "user_view_page".
 *
 * The followings are the available columns in table 'user_view_page':
 * @property string $id
 * @property integer $user_id
 * @property integer $url
 * @property string $count
 * @property string $status
 * @property string $changed
 */
class UserViewPage extends ActiveRecord {

    const COUNT_NEVER = 'Never';
    const COUNT_ONE = 'One';
    const COUNT_ALWAYS = 'Always';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserViewPage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_view_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, url, count, changed', 'required'),
			array('user_id, url', 'numerical', 'integerOnly'=>true),
			array('count', 'length', 'max'=>6),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, url, count, status, changed', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id' => 'User',
			'url' => 'Url',
			'count' => 'Count',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('url',$this->url);
		$criteria->compare('count',$this->count,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function isCurrentUrl() {
        return strpos($_SERVER['REQUEST_URI'], $this->url) == 0;
    }

    public function redirect() {
        \Yii::$app->request->redirect($this->url);
    }
}