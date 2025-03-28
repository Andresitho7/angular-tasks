<?php
require_once __DIR__ . '/../controllers/TaskController.php';

$controller = new TaskController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $controller->getTask($_GET['id']);
        } else {
            $controller->getTasks();
        }
        break;

    case 'POST':
        $controller->createTask();
        break;

    case 'PUT':
        $controller->updateTask();
        break;

    case 'DELETE':
        $controller->deleteTask();
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>
