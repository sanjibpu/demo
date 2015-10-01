<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	  private $_id;
	public function authenticate()
	{
		$userName = strtolower(trim($this->username,''));
        $encriptPassword = UsefullFunction::encriptPassword($this->password);             
        $user=Users::model()->find(array(
                                        'condition'=>'username=:username AND status=:status', 
                                        'params'=>array(':username'=>$userName,':status'=>Users::STATUS_ACTIVE)
                                    ));  

		if($user===NULL)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        elseif($user->password!==$encriptPassword)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else{   
        	//$this->setState('userType', $user->typeId);
            $user->loginCount = $user->loginCount+1;         
            $user->ipAddress = $_SERVER['SERVER_ADDR'];                 
            $user->save();   
            $this->setState('userid', $user->id);
            $this->setState('username', $user->username);         
            $this->setState('userType', $user->typeId);       
            $this->_id=$user->id;            
            if($user->typeId!=Users::IS_ADMIN) {
                Yii::app()->session['userBy']=$user->id;
                Yii::app()->session['userType']=$user->typeId;                
            }
            //$this->setState('lastLoginTime', $user->lastLoginTime);
            $this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}

	// set global id
    public function getId()
    {
        return $this->_id;
    }
}