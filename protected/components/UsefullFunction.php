<?php

class UsefullFunction {

    // get All User Type from database usertype table enum value
    public static function typeStatus($modelName, $fieldName) {
        $model = new $modelName;
        $attr = $fieldName;
        $dataArray = array();
        preg_match('/\((.*)\)/', $model->tableSchema->columns[$attr]->dbType, $matches);
        foreach (explode("','", $matches[1]) as $key => $value) {
            $value = str_replace("'", null, $value);
            $dataArray[$key + 1] = $value;
        }
        return $dataArray;
    }    

    // encript password using salt and return this 
    public static function encriptPassword($pass) {
        $key = '9862Yhs@#Dfhsfhg@7*7fasdfhsjfhsalUNjihQDMOIHBGGVhfjkskfjaslfysars';
        $enPass = $pass . $key;
        return md5($enPass);
    }

}
