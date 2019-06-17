<?php

namespace App;

use App;
use \App\Db;

class Model {

    public function __construct() {
		$this->connection = new Db();
    }

    /**
    * Method for finding one object in database
    * by id with extra parametrs from model by default or controller.
    **/
    public function find($id=null, $params=null) {
        $queryParams = $this->params;
        if(!($params===null)){
            foreach ($params as $key => $value) {
                $queryParams[$key] = $value;
            }
        }

        $query = "SELECT {$queryParams['fields']} FROM {$queryParams['table']}";

        if(!empty($queryParams['join'])){
            $query.=' '.strtoupper($queryParams['join']['type']).
                                ' JOIN '. $queryParams['join']['table'].
                                ' ON '.$queryParams["table"].
                                '.'.$queryParams["foreignKey"].
                                '='.$queryParams['join']['table'].
                                '.'.$queryParams['join']['key'];
        }

        if(!($id===null)){
            $query.= " WHERE id = $id";
        }elseif (!empty($queryParams['conditions'])) {
            $query.= " WHERE ";
            $lastElement = end($queryParams['conditions']);
            foreach ($queryParams['conditions'] as $key => $value) {
                $query.= " $key = \"$value\"";
                if($value<>$lastElement) $query.=", ";
            }
        }
        if(!empty($queryParams['order'])){
            $query.=" ORDER BY {$queryParams['order']['field']} {$queryParams['order']['direction']}";
        }
        if(!empty($queryParams['limit'])){
            $query.=' LIMIT '.
                    $queryParams['limit']['from'].
                    ', '. $queryParams['limit']['to'];
        }
        $result = $this->connection->execute($query);
        return $result;
    }

    /**
    * Method for finding all objects in database,
    * without any extra parametrs.
    **/
    public function findAll() {
        $params = $this->params;
        $query = "SELECT {$params['fields']} FROM {$params['table']}";
        $result = $this->connection->execute($query);
        return $result;
    }

    /**
    * Method for save objects to database.
    * In case id=null object its to be inserted new, in otherwise its to be updated.
    **/
    public function save($object, $params=null) {
        $params =$params ?? $this->params;
        $fields="";
        if(!empty($object['id'])){
            foreach ($object as $key => $value) {
                $tmp_array[]=$key.' = '."\"".htmlentities($value)."\"";
            }
            $fields = implode(', ',$tmp_array);
            $query = "UPDATE {$params['table']} SET $fields WHERE id = {$object['id']}";
        } else {
            $fields .= " (`".implode("`, `", array_keys($object))."`)";
            $fields .= " VALUES ('".implode("', '", $object)."') ";
            $query = "INSERT INTO {$params['table']} $fields";
        }
        $result = $this->connection->execute($query);
        if($result===false) return false;
        return true;
    }

    /**
    * Method for validate objects.
    * Its check fields for fill and email for valid,
    * with regular expressions.
    **/
    public function validate($fields=null) {
        $rules = $this->validations;
        $errors = [];
        foreach ($fields as $key => $value) {
            if(!empty($rules[$key])){
                if(!empty($rules[$key]['required']) && $fields[$key]==""){
                    $errors[$key] = $rules[$key]['required']['message'];
                }
                if(!empty($rules[$key]['email']) && !empty($fields[$key])){
                    preg_match('/.+@.+\..+/i', $value, $matches, PREG_OFFSET_CAPTURE, 0);
                    if(!$matches) $errors[$key] = $rules[$key]['email']['message'];
                }
            }
        }
        return $errors;
    }
}