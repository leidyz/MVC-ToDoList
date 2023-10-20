<?php

class Task_Model {
    private $jsonFile;
    private $task=[];
    

    public function __construct() {
        $this->jsonFile=__DIR__.'/../app/models/data/DataBase.json';
        
    }

    public function getTask() {
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
     
        public function createTask($newTask)
        {
            $jsonData = file_get_contents($this->jsonFile);
            $task= json_decode($jsonData, true);
    
            $task[] = $newTask;
            $newJsonData = json_encode($task, JSON_PRETTY_PRINT);

            file_put_contents($this->jsonFile, $newJsonData);
        }
        
    public function deleteTask($id) {
        foreach ($this->task as $key => $task) {
            if ($task['id'] == $id) {
                unset($this->task[$key]); 
                $this->saveTask(); 
                return true; 
            }
        }
            return false; 
    }    

    public function editTask($id,$task_name,$task_description,$start_date,$finish_date,$status,$created_by){
        foreach ($this->task as $key => $task) {
            if ($task['id'] == $id) {
            
            $task['task_name'] = $task_name;
            $task['task_description'] =$task_description;
            $task['start_date'] = $start_date;
            $task['finish_date']=$finish_date;
            $task['status']= $status;
            $task['created_by']= $created_by;

            foreach ($this->task as $key => $value) {
                if ($value['id'] === $id) {
                    $this->task[$key] = $task;
                    break;
                }
            }
            $this->saveTask();
            }
        }     
    }
    public function getAllTaskWithDetails() {
        //listo y revisado
        $jsonData = file_get_contents($this->jsonFile);
        $task= json_decode($jsonData, true);
        $taskWithDetails = [];

            foreach ($this->task as $user) {
                if (isset($user['task'])) {
                    foreach ($user['task'] as $task) {
                        $taskDetails = [
                            'task_name' => $task['task_name'],
                            'task_description' => $task['task_description'],
                            'start_date' => $task['start_date'],
                            'finish_date' => $task['finish_date'],
                            'status' => $task['status'],
                            'created_by' => $task['created_by'],
                        ];
                        $taskWithDetails[] = $taskDetails;
                    }
                }
            }
            return $taskWithDetails;
        }
}