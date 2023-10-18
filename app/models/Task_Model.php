<?php

//$task= new Task ($task_name, $task_description,$start_date, $finish_date, $status, $created_by);
class Task_Model {
    private $jsonFile;
    private $task=[];
    

    public function __construct($task) {
        $this->jsonFile=__DIR__.'../app/models/data/DataBase.json';
        $this->task = $task;
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
    
    public function createTask($id, $task_name, $task_description, $start_date, $finish_date, $status, $created_by) {
       
        $id = uniqid();
        $this->task = new Task([
            'id' => $id,
            'task_name' => $task_name,
            'task_description' => $task_description,
            'start_date' => $start_date,
            'finish_date'=>$finish_date,
            'status' => $status,
            'created_by'=> $created_by]);
        
        $this->saveTask();     
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

    public function edit($id,$task_name,$task_description,$start_date,$finish_date,$status,$created_by){
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
    public function showTask(){}
}

    // public function getTaskById($id) {
    //     foreach ($this->task as $user) {
    //         if (isset($user['task'])) {
    //             foreach ($user['task'] as $task) {
    //                 if (isset($task['id']) && $task['id'] == $id) {
    //                     return $task;
    //                 }
    //             }
    //         }
    //     }
    //     return null;
    // }

    // public function addTask($id, $task) {
      
    //     foreach ($this->data as &$user) {
    //         if ($user[$id] == $id) {
    //             if (!isset($user['task'])) {
    //                 $user['task'] = [];
    //             }
    //             $user['task'][] = $task;
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // public function updateTask($id, $taskId, $updatedTask) {
    //     foreach ($this->data as &$user) {
    //         if ($user[$id] == $id && isset($user['task'])) {
    //             foreach ($user['task'] as &$task) {
    //                 if (isset($task[$id]) && $task[$id] == $taskId) {
    //                     $task = array_merge($task, $updatedTask);
    //                     return true;
    //                 }
    //             }
    //         }
    //     }
    //     return false;
    // }

    // public function deleteTask($id, $taskId) {
    //     foreach ($this->data as &$user) {
    //         if ($user[$id] == $id && isset($user['task'])) {
    //             foreach ($user['task'] as $key => $task) {
    //                 if (isset($task[$id]) && $task[$id] == $taskId) {
    //                     unset($user['task'][$key]);
    //                     return true;
    //                 }
    //             }
    //         }
    //     }
    //     return false;
    // }

    // // Función para obtener todas las tareas con su estado, hora de inicio y finalización, y usuario creador
    // public function getAllTasksWithDetails() {
    //     $tasksWithDetails = [];
    //     foreach ($this->data as $user) {
    //         if (isset($user['task'])) {
    //             foreach ($user['task'] as $task) {
    //                 $taskDetails = [
    //                     'task_name' => $task['task_name'],
    //                     'task_description' => $task['task_description'],
    //                     'start_date' => $task['start_date'],
    //                     'finish_date' => $task['finish_date'],
    //                     'status' => $task['status'],
    //                     'created_by' => $task['created_by'],
    //                 ];
    //                 $tasksWithDetails[] = $taskDetails;
    //             }
    //         }
    //     }
    //     return $tasksWithDetails;
    // }