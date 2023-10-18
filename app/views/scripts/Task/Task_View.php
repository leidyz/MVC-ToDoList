<?php
require_once('../app/models/data/DataBase.json');
class TaskView {
   public  $data = array();
    public function __construct($data) {
        $this->data = $data;
    }
    public function displayTasksWithDetails() {
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>User Name</th>';
        echo '<th>User Surname</th>';
        echo '<th>Task Name</th>';
        echo '<th>Description</th>';
        echo '<th>Start Date</th>';
        echo '<th>Finish Date</th>';
        echo '<th>Status</th>';
        echo '<th>Created by</th>';
        echo '</tr>';

        foreach ($this->data as $user) {
            foreach ($user->task as $task) {
                echo '<tr>';
                echo '<td>' . $user->user_name . '</td>';
                echo '<td>' . $user->user_surname . '</td>';
                echo '<td>' . $task->task_name . '</td>';
                echo '<td>' . $task->task_description . '</td>';
                echo '<td>' . $task->start_date . '</td>';
                echo '<td>' . ($task->finish_date ?? 'N/A') . '</td>';
                echo '<td>' . $task->status . '</td>';
                echo '<td>' . $task->created_by . '</td>';
                echo '</tr>';
            }
        }

        echo '</table>';
    }

    public function displayTaskForm() {
        // Mostrar el formulario para agregar tareas
    }

    // Implementar métodos para mostrar formularios de actualización y eliminación
}
?>