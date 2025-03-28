<?php

include 'models/TaskRepositoryModel.php';

$taskRepository = new TaskRepositoryModel();
$result = $taskRepository->eliminarTask(2);

if($result){
    echo 'Tarea eliminada correctamente ok';
}else{
    echo 'Error al eliminar tarea ID no encontrado';
}
?>