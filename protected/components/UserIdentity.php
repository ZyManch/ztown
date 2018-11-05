<?php
namespace components;

class UserIdentity extends CUserIdentity {
    protected $_id;
	/**
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
        /** @var $user User */
        $criteria = new CDbCriteria();
        $criteria->compare('email', strtolower($this->username));
        $criteria->compare('login', $this->username, true, 'OR');
		$user = User::model()->find($criteria);
		if(!$user) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if($user->getCryptedPassword($this->password) != $user->password){
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->id;
			$this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}

    public function getId(){
        return $this->_id;
    }
}