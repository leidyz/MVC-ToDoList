<?php

require_once(__DIR__.'\..\models\Task_Model.php');
require_once(__DIR__.'\..\..\lib\base\Controller.php');
//require_once(__DIR__.'\..\views\scripts\app_\index.phtml');


class App_Controller extends Controller 
{
     public function indexAction()
    {
        $taskModel = new Task_Model();
            $taskDetails = $taskModel->getAllTask();
            
            $this->view-> taskDetails= $taskDetails;
           
        
         
            return  $this->view->taskDetails;
    } 
    
    public function getAllTaskAction() {
        //listo y revisado
            $taskModel = new Task_Model();
            $taskDetails = $taskModel->getAllTask();
            
            $this->view-> taskDetails= $taskDetails;
           
            //var_dump($taskDetails);
         
            //return  $this->view->taskDetails;
           // return View('/')->with($taskDetails);
            
        }
         
    
    public function createTaskAction(){
           //listo y revisado. 
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
                header("Location:\IT_Academy\Sprint3\web"); 
                
            }
           
        }
        public function deleteTaskAction() {
 
            if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
                $task_id = $_POST["task_id"];
               
                $taskModel = new Task_Model();
                $taskModel->deleteTask($task_id);

                header("Location: /IT_Academy/Sprint3/web");
            } $this->view->render('app_/index.phtml');
        }
       
            public function editTaskAction() {
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $task_id = $_POST['task_id'];

                        $updatedTaskData = [
                            'tasK_name'=>$_POST['task_name'],
                            'task_description' => $_POST['task_description'],
                            'start_date' => $_POST['start_date'],
                            'finish_date' => $_POST['finish_date'],
                            'status' => $_POST['status'],
                            'created_by' => $_POST['created_by']
                        ];
        
                        $taskModel = new Task_Model();
                        $taskModel->editTask($task_id, $updatedTaskData);
                       
                       // header("Location: /IT_Academy/Sprint3/web");
                    
                }
            }
            public function saveTaskAction() {
                var_dump($_POST);
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtén los datos enviados por el formulario
                    $task_id = $_POST['task_id'];
                    $task_name = $_POST['task_name'];
                    $task_description = $_POST['task_description'];
                    $start_date = $_POST['start_date'];
                    $finish_date = $_POST['finish_date'];
                    $status = $_POST['status'];
                    $created_by = $_POST['created_by'];
            
                    // Llama al modelo para guardar los cambios en la base de datos
                    $taskModel = new Task_Model();
                    $updatedTaskData = [
                        'task_name' => $task_name,
                        'task_description' => $task_description,
                        'start_date' => $start_date,
                        'finish_date' => $finish_date,
                        'status' => $status,
                        'created_by' => $created_by
                    ];
                    $taskModel->editTask($task_id, $updatedTaskData);
            
                    // Redirige a la página principal o a la página de detalles de la tarea, según tus necesidades
                    header("Location: /IT_Academy/Sprint3/web");
                }
            }
 }