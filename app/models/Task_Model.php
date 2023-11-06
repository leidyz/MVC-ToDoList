<?php

class Task_Model {
    protected $jsonFile;
    protected $task=[];
    

    public function __construct() {
        $this->jsonFile=__DIR__. '\data\DataBase.json';
       // $this->task;
    }
    public function getTaskById($task_id) {
       
        $jsonData = file_get_contents($this->jsonFile);
        $tasks = json_decode($jsonData, true);
        
        foreach ($tasks as $task) {
            //var_dump($task);
            if ($task['task_id'] == $task_id) {
                return $task;
            }
        }
        return "The specified task does not exist";
    }
   
    
    public function createTask($newTask){
            $jsonData = file_get_contents($this->jsonFile);
            $task= json_decode($jsonData, true);

            if (empty($task)) {
                $maxId = 0;
                } else {
                    $maxId = max(array_column($task, 'task_id'));
                }
                $newTask['task_id'] = $maxId +1;
                $task[] = $newTask;
                $newJsonData = json_encode($task, JSON_PRETTY_PRINT);
                file_put_contents($this->jsonFile, $newJsonData);
    }
    public function getAllTask(){
        $jsonData = file_get_contents($this->jsonFile);
        $taskDetails= json_decode($jsonData, true);
    return $taskDetails;
    }
    public function deleteTask($task_id) {
        $jsonData = file_get_contents($this->jsonFile);
        $tasks = json_decode($jsonData, true);
            
        unset($tasks[$task_id-1]);
                               
        $jsonData = json_encode($tasks, JSON_PRETTY_PRINT);
        file_put_contents($this->jsonFile, $jsonData);   
    }
    public function saveTask($task_id, $newTaskData){
        $jsonData = file_get_contents($this->jsonFile);

        $tasks = json_decode($jsonData, true);

        foreach ($tasks as &$task) {
            if ($task['task_id'] == $task_id) {
                
                $task = array_merge($task, $newTaskData);
                break;
            }
        }
        $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);
        file_put_contents($this->jsonFile, $newJsonData);
    }
}