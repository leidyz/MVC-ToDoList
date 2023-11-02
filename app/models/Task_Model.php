<?php

class Task_Model {
    protected $jsonFile;
    protected $task=[];
    

    public function __construct() {
        $this->jsonFile=__DIR__. '\data\DataBase.json';
       // $this->task;
    }

    public function getTask() {
        return $this->task;
    }
    public function setTask() {
        return $this->task;
    }
   
    public function setJsonFile($jsonFile) {
        $this->jsonFile=$jsonFile;
    }
    public function getJsonFile() {
        return $this->jsonFile;
    }
    private function saveTask()  {
        $result = file_put_contents($this->jsonFile, json_encode($this->task, JSON_PRETTY_PRINT));
        
        if ($result === false) {
            echo "Error! try again.";
        }
    }
    public function getTaskById($task_id) {
        
        $jsonData = file_get_contents($this->jsonFile);
        $tasks = json_decode($jsonData, true);
        
        
        foreach ($tasks as $task) {
            if ($task['task_id'] === $task_id) {
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
                $newTask['task_id'] = $maxId + 1;
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
    
        foreach ($tasks as $key => $task) {
            if ($task['task_id'] == $task_id) {
                unset($tasks[$key]);
    
                $jsonData = json_encode($tasks, JSON_PRETTY_PRINT);
                file_put_contents($this->jsonFile, $jsonData);
    
                return true; 
            }
        }
    
        return false; 
    }
    
    
    public function editTask($task_id, $newTaskData) {
        $jsonData = file_get_contents($this->jsonFile);
        $task = json_decode($jsonData, true);
    
        foreach ($task as &$currentTask) { // Usamos & para obtener una referencia al elemento actual
            if ($currentTask['task_id'] == $task_id) {
                $currentTask['task_name'] = $newTaskData['task_name'];
                $currentTask['task_description'] = $newTaskData['task_description'];
                $currentTask['start_date'] = $newTaskData['start_date'];
                $currentTask['finish_date'] = $newTaskData['finish_date'];
                $currentTask['status'] = $newTaskData['status'];
                $currentTask['created_by'] = $newTaskData['created_by'];
            }
        }
    
        $newJsonData = json_encode($task, JSON_PRETTY_PRINT);
        file_put_contents($this->jsonFile, $newJsonData);
    }
    
    
}