<?php

namespace App\Model;

use App;

class User extends \App\Model {
    /**
    * Props for user model validations.
    **/
    public $validations = array(
        'login' => array(
          'required' => array(
              'message' => 'Введите логин'
          ),
        ),
        'password' => array(
            'required' => array(
                'message' => 'Введите пароль'
            ),
        )
      );
    /**
    * Props for user model queries.
    **/
    public $params = array(
        'table' => 'users',
        'foreignKey' => '',
        'conditions' => [],
        'fields' => 'id, username, role, login, password',
        'order' => ['field'=>'id'],
        'join' => [],
        'limit' => []
    );

    /**
    * Method for validating password.
    * First parametr its fields needed for generating hash of password,
    * second parametr its a hash from database
    **/
    public function checkPassword ($userData, $dbPassword){
        $hash=md5(6546356346234763475687 . $userData['login'] . $userData['password']);
        $hash=base_convert($hash, 16, 10);
        $password= substr($hash,0,5);
        if($password === $dbPassword) return true;
        return false;
    }
}