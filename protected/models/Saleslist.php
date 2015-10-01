<?php

/**
 * This is the model class for table "{{saleslist}}".
 *
 * The followings are the available columns in table '{{saleslist}}':
 * @property string $id
 * @property string $customerName
 * @property string $productName
 * @property string $date
 * @property integer $crBy
 * @property string $crDate
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $crBy0
 * @property Lookup $status0
 */
class Saleslist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const STATUS_ACTIVE=1;
	const STATUS_INACTIVE=2;
	const STATUS_PENDING=3;

	public $dateSecond;

	public function tableName()
	{
		return '{{saleslist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerName, productName, date, status', 'required'),
			array('customerName+productName', 'application.extensions.uniqueMultiColumnValidator.uniqueMultiColumnValidator'),
         
			array('crBy, status', 'numerical', 'integerOnly'=>true),
			array('customerName, productName', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customerName, productName, date, crBy, crDate, status', 'safe', 'on'=>'search'),
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
			'crBy0' => array(self::BELONGS_TO, 'Users', 'crBy'),
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
			'customerName' => 'Customer Name',
			'productName' => 'Product Name',
			'date' => 'Date',
			'crBy' => 'Cr By',
			'crDate' => 'Cr Date',
			'status' => 'Status',
		);
	}


	public function beforeSave()
	{
        if ($this->isNewRecord) {
            $this->crDate = date('Y-m-d H:m:s');           
            $this->crBy =Yii::app()->user->id; 
            // $this->status=0; //option by default
        } else {
        //$this->moDate = date('Y-m-d H:m:s');
        //$this->moBy=Yii::app()->user->id;
        }
        return parent::beforeSave();
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('customerName',$this->customerName,true);
		$criteria->compare('productName',$this->productName,true);
		$criteria->compare('date',$this->date,true);
		if(Yii::app()->session['userType']==Users::IS_USER)
			$criteria->compare('crBy', Yii::app()->session['userBy']);
		else
			$criteria->compare('crBy', $this->crBy);
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
	 * @return Saleslist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
