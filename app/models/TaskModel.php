<?php

class TaskModel {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function getAllTasks() {
        return $this->data;
    }

    public function getTaskById($id) {
        foreach ($this->data as $user) {
            if (isset($user['task'])) {
                foreach ($user['task'] as $task) {
                    if (isset($task['id']) && $task['id'] == $id) {
                        return $task;
                    }
                }
            }
        }
        return null;
    }

    public function addTask($id, $task) {
        foreach ($this->data as &$user) {
            if ($user['id'] == $id) {
                if (!isset($user['task'])) {
                    $user['task'] = [];
                }
                $user['task'][] = $task;
                return true;
            }
        }
        return false;
    }

    public function updateTask($id, $taskId, $updatedTask) {
        foreach ($this->data as &$user) {
            if ($user['id'] == $id && isset($user['task'])) {
                foreach ($user['task'] as &$task) {
                    if (isset($task['id']) && $task['id'] == $taskId) {
                        $task = array_merge($task, $updatedTask);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function deleteTask($id, $taskId) {
        foreach ($this->data as &$user) {
            if ($user['id'] == $id && isset($user['task'])) {
                foreach ($user['task'] as $key => $task) {
                    if (isset($task['id']) && $task['id'] == $taskId) {
                        unset($user['task'][$key]);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    // Función para obtener todas las tareas con su estado, hora de inicio y finalización, y usuario creador
    public function getAllTasksWithDetails() {
        $tasksWithDetails = [];
        foreach ($this->data as $user) {
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
                    $tasksWithDetails[] = $taskDetails;
                }
            }
        }
        return $tasksWithDetails;
    }
}