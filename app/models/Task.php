<?php

class Task{
    private $id=uniqid();
    private $task_name;
    private $task_description;
    private $start_date;
    private $finish_date;
    private $status;
    private $created_by;

    public function __construct( $id,$task_name, $task_description,$start_date, $finish_date, $status, $created_by){  
        $this->id=$id;
        $this->task_name = $task_name;
        $this->task_description = $task_description;
        $this->start_date = $start_date;
        $this->finish_date = $finish_date;
        $this->status = $status;
        $this->created_by = $created_by;
    }
    public function getId(){
        return $this->id;
    }
   
    public function getTaskName(){
        return $this->task_name;
    }
    public function setTaskName($task_name){
        $this->task_name = $task_name;
    }
    public function getTaskDescription(){
    return $this->task_description;
    }
    public function setTaskDescription($task_description){
        $this->task_description = $task_description;
    }
    public function getStartDate(){
        return $this->start_date;
    }
    public function setStartDate($start_date){
        $this->start_date = $start_date;
    }
    public function getFinishDate(){
        return $this->finish_date;
    }
    public function setFinishDate($finish_date){
        $this->finish_date = $finish_date;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
    $this->status = $status;
    }
    public function getCreatedBy(){
        return $this->created_by;
    }
    public function setCreatedBy($created_by){
        $this->created_by = $created_by;
    }

}

?>