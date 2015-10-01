<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class FileImport extends CFormModel
{
	public $file;	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('file', 'required'),
			// rememberMe needs to be a boolean	
			array('file', 'file',
                'types'=>'jpg,csv',
                'maxSize'=>1024 * 1024 * 1, // 1MB
                'tooLarge'=>'The file was larger than 1MB. Please upload a smaller file.',
            ),	
            array('file', 'safe'),	
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'file'=>'File can not be blank',
		);
	}


	
}
