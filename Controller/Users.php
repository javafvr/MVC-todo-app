<?php

namespace App\Controller;

use \App\Pagination;
use \App\Db;
use \App\Model\User;

class Users extends \App\Controller {

    /**
    * Login user.
    **/
    public function login (){
        $params=[];
        if(!empty($_POST)){
            $User = new User();
            // Validations
            $errors = $User->validate($_POST);
            if(empty($errors)){
                $request['login'] = $_POST['login'];
                $request['password'] = $_POST['password'];
                $user = $User->find(null, [
                    'conditions'=>[
                        'login'=>$request['login']
                        ]
                    ]);
                if($User->checkPassword($request, $user[0]['password'])){
                    $_SESSION['logged_user'] = $user[0];
                    $_SESSION['login'] = "1";
                    $_SESSION['role'] = $user[0]['role'];
                    $action = 'Tasks';
                    header("Location:".WWW_ROOT."/$action");
                    exit();
                } else {
                    $params['Errors'] = ['password'=>'Логин или пароль не верны'];
                }
            } else {
                $params['Errors']=$errors;
            }
        }
        return $this->render('Login', $params);
    }

    /**
    * Logout user and clean the session.
    **/
    public function logout (){
        $_SESSION['logged_user'] = "";
        $_SESSION['login'] = "";
        $_SESSION['role'] = "";
        session_destroy();
        $action = 'Tasks';
        header("Location:".WWW_ROOT."/$action");
        exit();
    }
}