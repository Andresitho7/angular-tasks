<?php

require 'models/TaskRepositoryModel.php';

$taskRepository = new TaskRepositoryModel();
$tasks = $taskRepository->actualizarTask(4,'Tarea actualizada OK','Descripcion de tarea OK','Aceptado');

if($tasks){
    echo 'Tarea actualizada correctamente';

}else{
    echo 'Error al actualizar tarea';
}

?>