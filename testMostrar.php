<?php 

require 'models/TaskRepositoryModel.php';

$taskRepository = new TaskRepositoryModel();

$tasks = $taskRepository->mostrarTasks();
echo '<pre>';
print_r($tasks);
echo '</pre>';
?>