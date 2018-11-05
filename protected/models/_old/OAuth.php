<?php

/**
 * This is the model class for table "oauth".
 *
 * The followings are the available columns in table 'oauth':
 * @property string $id
 * @property string $user_id
 * @property string $server
 * @property string $remote_user_id
 * @property string $access_token
 * @property string $access_secret
 * @property string $status
 * @property string $changed
 * @property User $user
 */
class OAuth extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OAuth the static model class
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
		return 'oauth';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, server, remote_user_id, access_token, access_secret', 'required'),
			array('user_id, remote_user_id', 'length', 'max'=>10),
			array('server, status', 'length', 'max'=>7),
			array('access_token, access_secret', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, server, remote_user_id, access_token, access_secret, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id')
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
			'server' => 'Server',
			'remote_user_id' => 'Remote User',
			'access_token' => 'Access Token',
			'access_secret' => 'Access Secret',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('remote_user_id',$this->remote_user_id,true);
		$criteria->compare('access_token',$this->access_token,true);
		$criteria->compare('access_secret',$this->access_secret,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}