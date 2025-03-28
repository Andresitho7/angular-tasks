<?php 

include 'models/TaskRepositoryModel.php';

$taskRepository = new TaskRepositoryModel();
$task = $taskRepository->mostrarTaskPorId(2);

echo '<pre>';
print_r($task);
echo '</pre>';
?>