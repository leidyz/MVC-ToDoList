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
    public function editTask($task_id, $updatedTaskData){
       
            $jsonData = file_get_contents($this->jsonFile);
            $tasks = json_decode($jsonData, true);
    
            foreach ($tasks as & $task) {
                if ($task['task_id']=== $task_id) {
                    $task['task_name'] = $updatedTaskData['task_name'];
                    $task['task_description'] = $updatedTaskData['task_description'];
                    $task['start_date'] = $updatedTaskData['start_date'];
                    $task['finish_date'] = $updatedTaskData['finish_date'];
                    $task['status'] = $updatedTaskData['status'];
                    $task['created_by'] = $updatedTaskData['created_by'];

                }
            }

            $this->saveTask($updatedTaskData);
        
            
          
}

    public function saveTask($task)
{
    $jsonData = json_encode($task, JSON_PRETTY_PRINT);
    file_put_contents($this->jsonFile, $jsonData);
}

}