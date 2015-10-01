<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $enKey
 * @property string $email
 * @property integer $typeId
 * @property string $ipAddress
 * @property string $loginCount
 * @property integer $crBy
 * @property string $crDate
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Saleslist[] $saleslists
 * @property Lookup $status0
 */
class Users extends CActiveRecord
{
	const STATUS_ACTIVE=1;
	const STATUS_INACTIVE=2;
	const STATUS_PENDING=3;
	const IS_ADMIN=1;
	const IS_USER=2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, username,typeId, status', 'required'),			
			array('username', 'unique'),			
			array('password', 'required', 'on'=>'insert'),
			array('typeId, crBy, status', 'numerical', 'integerOnly'=>true),
			array('name, username, password, enKey, email', 'length', 'max'=>150),
			array('ipAddress', 'length', 'max'=>100),
			array('loginCount', 'length', 'max'=>11),
			array('crDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, username, password, enKey, email, typeId, ipAddress, loginCount, crBy, crDate, status', 'safe', 'on'=>'search'),
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
			'saleslists' => array(self::HAS_MANY, 'Saleslist', 'crBy'),
			'status0' => array(self::BELONGS_TO, 'Lookup', 'status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'username' => 'Username',
			'password' => 'Password',
			'enKey' => 'En Key',
			'email' => 'Email',
			'typeId' => 'Type',
			'ipAddress' => 'Ip Address',
			'loginCount' => 'Login Count',
			'crBy' => 'Cr By',
			'crDate' => 'Cr Date',
			'status' => 'Status',
		);
	}


	 public function beforeSave() {
        if ($this->isNewRecord) {
            $this->crDate = date('Y-m-d H:m:s');
            $this->enKey = date('YmdHms');
            $this->ipAddress = $_SERVER['SERVER_ADDR'];
            $this->crBy =Yii::app()->user->id;           
            // $this->status=0; //option by default
        } else {
        //$this->moDate = date('Y-m-d H:m:s');
        //$this->moBy=Yii::app()->user->id;
        }
        return parent::beforeSave();
    }

    // get all Active User 
    public static function getAllActiveUser($active)
    {
    	if(Yii::app()->session['userType']==Users::IS_USER)
			return CHtml::listData(self::model()->findAll(array('condition'=>'id=:id AND status=:status', 'params'=>array(':id'=>Yii::app()->user->id, ':status'=>$active))), 'id', 'name');
		else		
			return  CHtml::listData(self::model()->findAll(array('condition'=>'status=:status', 'params'=>array(':status'=>$active))), 'id', 'name');
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('enKey',$this->enKey,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('typeId',$this->typeId);
		$criteria->compare('ipAddress',$this->ipAddress,true);
		$criteria->compare('loginCount',$this->loginCount,true);
		$criteria->compare('crBy',$this->crBy);
		$criteria->compare('crDate',$this->crDate,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        		'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    		),
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
