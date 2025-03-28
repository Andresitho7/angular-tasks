<?php 

require 'models/TaskRepositoryModel.php';

$taskRepository = new TaskRepositoryModel();
$result = $taskRepository->registrarTask('Tarea 2','Descripcion tarea 2','pendiente');

if($result){
    echo 'Tarea registrada correctamente';

}else{
    echo 'Error al registrar tarea';
}


?>