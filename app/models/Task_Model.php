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
    
        public function createTask($newTask){//listo y revisado
            $jsonData = file_get_contents($this->jsonFile);
            $task= json_decode($jsonData, true);
    
            $task[] = $newTask;
            $newJsonData = json_encode($task, JSON_PRETTY_PRINT);

            file_put_contents($this->jsonFile, $newJsonData);
        }
        public function getAllTask(){//listo y revisado
            $jsonData = file_get_contents($this->jsonFile);
            $task= json_decode($jsonData, true);
            $taskWithDetails = [];
    
                //foreach ($task as $user) {
                    // if (isset($user['task'])) {
                    //     foreach ($user['task'] as $task) {
                            $taskDetails = [
                                'task_name' => $task['task_name'],
                                'task_description' => $task['task_description'],
                                'start_date' => $task['start_date'],
                                'finish_date' => $task['finish_date'],
                                'status' => $task['status'],
                                'created_by' => $task['created_by'],
                            ];
                            $taskWithDetails[] = $taskDetails;
                    //     }
                    // }
               // }
                return $taskWithDetails;
            }
    public function deleteTask($task_id) {//listo y revisado
        $jsonData = file_get_contents($this->jsonFile);
        $task= json_decode($jsonData, true);
        
        foreach ($this->task as $key => $task) {
            if ($task['task_id'] == $task_id) {
                unset($this->task[$key]); 
                $this->saveTask(); //dudo con que esta linea sea necesaria... tiene sentido realmente?
                return true; 
            }
            return false; 
        }
            
    }    

    public function editTask($task_id, $newTaskData) { //listo y revisado
        $jsonData = file_get_contents($this->jsonFile);
        $task = json_decode($jsonData, true);
    
        foreach ($task as $newTask) {
            if ($newTask['task_id'] == $task_id) {
                
                $newTask['task_name'] = $newTaskData['task_name'];
                $newTask['task_description'] = $newTaskData['task_description'];
                $newTask['start_date'] = $newTaskData['start_date'];
                $newTask['finish_date'] = $newTaskData['finish_date'];
                $newTask['status'] = $newTaskData['status'];
                $newTask['created_by'] = $newTaskData['created_by'];
    
                
                $this->saveTask();
            }
        }
    }
    
    
}