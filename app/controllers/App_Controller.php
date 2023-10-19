<?php

require_once('../app/models/Task_model.php');
require_once('../lib/base/Controller.php');

class App_Controller extends Controller 
{
	private $model;
    private $jsonFile;

    public function __construct($model) {
        $this->model = new Task_Model($model);
        $this->jsonFile = '../app/models/data/DataBase.json';
    }

    public function getAllTasks() {
        return $this->model->getAllTasksWithDetails();
    }

    // public function getTaskById($id) {
    //     return $this->model->getTaskById($id);
    // }

    public function addTask($id, $task) {
        return $this->model->addTask($id, $task);
    }

    // public function updateTask($id, $taskId, $updatedTask) {
    //     return $this->model->updateTask($id, $taskId, $updatedTask);
    // }

    public function deleteTask($id) {
        return $this->model->deleteTask($id);
    }
}
