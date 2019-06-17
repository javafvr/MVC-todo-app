<?php

namespace App\Model;

use App;

class Task extends \App\Model {
    /**
    * Props for task model validations.
    **/
    public $validations = array(
      'text' => array(
        'required' => array(
            'message' => 'Введите текст задачи'
        ),
      ),
      'email' => array(
        'required' => array(
          'message' => 'Введите email'
        ),
        'email' => array(
          'message' => 'Email не верный!'
        )
      )
    );

		/**
    * Props for task model queries.
    **/
    public $params = array(
			'table' => 'tasks',
			'foreignKey' => 'user_id',
			'conditions' => [],
			'fields' => 'id, text, completed, email, username',
			'order' => ['field'=>'tasks.id','direction'=>'ASC'],
			'join' => [],
			'limit' => []
    );
		
		/**
    * This method is cover for find method of global model.
    **/
    public function exists($id=null) {
        if(!$id) return false;
        $task = $this->find($id, $this->params);
				if($task) return true;
        return false;
    }
}