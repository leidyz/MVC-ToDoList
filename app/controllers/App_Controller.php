<?php

require_once('/../app/models/Task_model.php');
require_once('/../lib/base/Controller.php');

class App_Controller extends Controller 
{
    public function indexAction()
    {
        
    }
    public function getAllTaskAction() {
        //listo y revisado
            $taskModel = new Task_Model();
            $task = $taskModel->getAllTaskWithDetails();
    
            $this->view->task = $task;
           
            return $task;
        }
    public function createTaskAction(){
           //listo y revisado. 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $task_id=$_POST['task_id'];
            $task_name=$_POST['task_name'];
            $task_description=$_POST['task_description'];
            $start_date=$_POST['start_date'];
            $finish_date=$_POST['finish_date'];
            $status=$_POST['status'];
            $created_by=$_POST['created_by'];

                $taskData = [
                    'task_id'=>$task_id,
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
    public function deleteTaskAction($task_id) {//listo y revisado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $task_id = isset($_POST["task_id"]) ? $_POST["task_id"] : null;

            if ($task_id !== null) {
                $taskModel = new Task_Model();
                $taskModel->deleteTask($task_id);
                $_SESSION['success_message'] = 'Tasca eliminada correctamente';
               
                header("Location: getAllTask"); //linea que vuelve a mostrar todas las tareas, pensar si lo incluimos en mas metodos.

            } else {
                echo "La taska especificada no existe";
            }
        }
    }
    public function editTaskAction($task_id) { //listo y revisado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $task_id = isset($_POST["task_id"]) ? $_POST["task_id"] : null;
            $newTaskData = isset($_POST["new_task_data"]) ? $_POST["new_task_data"] : null;
    
            if ($task_id !== null && $newTaskData !== null) {
                $taskModel = new Task_Model();
                $taskModel->editTask($task_id, $newTaskData);
                $_SESSION['success_message'] = 'Tarea editada correctamente';
            } else {
                echo "La tarea especificada no existe o no se proporcionaron datos válidos para la edición.";
            }
        }
    }

        
    
    
    
   
}
