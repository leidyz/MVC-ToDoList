<?php

require_once('/../app/models/Task_model.php');
require_once('/../lib/base/Controller.php');

class App_Controller extends Controller 
{
	private $model;
    private $jsonFile;

    public function __construct($model) { //pendiente
        $this->model = new Task_Model($model);
        $this->jsonFile = '../app/models/data/DataBase.json';
    }
    public function indexAction()
    {
        
    }
    public function getAllTaskAction() {
        //listo y revisado
            $taskModel = new Task_Model();
            $task = $taskModel->getAllTaskWithDetails();
    
            $this->view->task = $task;
           
            return $this->model->getAllTaskWithDetails();
        }
    public function createTaskAction(){
           //listo y revisado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $task_name=$_POST['task_name'];
            $task_description=$_POST['task_description'];
            $start_date=$_POST['start_date'];
            $finish_date=$_POST['finish_date'];
            $status=$_POST['status'];
            $created_by=$_POST['created_by'];

                $taskData = [
                    'task_name' => $task_name,
                    'task_description' =>$task_description,
                    'start_date' => $start_date,
                    'finish_date'=>$finish_date,
                    'status'=> $status,
                    'created_by'=> $created_by];
    
                $taskModel = new Task_Model();
                $taskModel->createTask($taskData);
    
            }
        }
    public function addTask($id, $task) {//pendiente
        return $this->model->addTask($id, $task);
    }
    public function deleteTask($id) {//pendiente
        return $this->model->deleteTask($id);
    }
    public function editTask($id,$task_name,$task_description,$start_date,$finish_date,$status,$created_by) {//pendiente
        return $this->model->editTask($id,$task_name,$task_description,$start_date,$finish_date,$status,$created_by);
    }
}
