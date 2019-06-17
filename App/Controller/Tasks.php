<?php

namespace App\Controller;

use \App\Pagination;
use \App\Db;
use \App\Model\Task;

class Tasks extends \App\Controller
{
    private $params = [];

    /**
    * Method for Listing of all tasks with pagination and sorting.
    **/
    public function index ()
    {
        $currentPage = $_GET["page"] ?? 1;
        $sortBy = $_GET["sort"] ?? 'id';
        $sortDirection = $_GET["sortDirection"] ?? 'ASC';
        $showRecordPerPage = 3;
        $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;

        $Task = new Task();
        $allTasks = $Task->findAll();
        $currentTasks = $Task->find(null, [
            'fields'=>'id, text, completed, email, username',
            'limit'=>[
                'from'=>$startFrom,
                'to' =>$showRecordPerPage
            ],
            'order'=>['field'=>$sortBy,'direction'=>$sortDirection]
            ]);

        $pagination = new Pagination(sizeof($allTasks), $showRecordPerPage, $currentPage, $sortBy, $sortDirection);
        $params['Pagination'] = $pagination;
        $params['Tasks'] = $currentTasks;
        $params['authUser'] = [];
        $params['Sort']['direction'] = $sortDirection;
        if(isset($_SESSION['logged_user'])){
            $params['authUser'] = $_SESSION['logged_user'];
        }
        return $this->render('Tasks', $params);
    }

    /**
    * Method for add new task.
    **/
    public function add () {
        if(!empty($_POST)) {
            $Task = new Task();
            $task = $_POST;
            if($_SESSION['logged_user']){
                $task['user_id'] = $_SESSION['logged_user']['id'];
            }
            
            // Validations
            $errors = $Task->validate($_POST);
            if(empty($errors)){
                // And save it if errors is empty
                if($Task->save($task)) {
                    $action = 'Tasks';
                    header("Location:".WWW_ROOT."/$action");
                    exit();
                }
            } else {
                $params['Errors'] = $errors;
                return $this->render('Add', $params);
            }
        }
        return $this->render('Add');
    }

    /**
    * Method for edit task.
    **/
    public function edit ($id=null) {
        $Task = new Task();
        if(!empty($_POST)) {
            $task = $_POST;
            $task['completed'] = $task['completed']=='on'?1:0;
            // Validations
            $errors = $Task->validate($_POST);
            if(empty($errors)){
                // And save it if errors is empty
                if($Task->save($task)) {
                    $action = 'Tasks';
                    header("Location:".WWW_ROOT."/$action");
                    exit();
                }
            } else {
                $this->params['Errors'] = $errors;
            }
        }
        if(!$Task->exists($id[0])) return false;
        $task = $Task->find($id[0]);
        $this->params['Task'] = $task;
        return $this->render('Edit', $this->params);
    }
}