<?php

// This is the database connection configuration.
return array(
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	'connectionString' => 'mysql:host=localhost;dbname=unlock_rumman',
	'emulatePrepare' => true,
	'username' => 'unlock_dev',
	'password' => 'sTe09*sTe09*',
	'charset' => 'utf8',
    'tablePrefix' => 'ps_',
);