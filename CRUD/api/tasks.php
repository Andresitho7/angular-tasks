<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../controllers/TaskController.php';

// Instanciamos la clase TaskController
$taskController = new TaskController();

// Obtenemos el metodo de la peticion (GET, POST, PUT, DELETE) deacuerdo a la accion 
$method = $_SERVER['REQUEST_METHOD'];

// Lee los datos de la solicitud y los convierte en JSON
$input = json_decode(file_get_contents("php://input"), true);

// Obtenemos el id de la tarea a traves de la URL o del JSON
$id = $_GET['id'] ?? ($input['id'] ?? null);


// Dependiendo del metodo de la peticion, se ejecutara el metodo correspondiente
switch ($method) {
    case 'GET':
        if ($id) {
            $taskController->getTask($id); // Obtiene una tarea especifica
        } else {
            $taskController->getTasks(); // Obtiene todas las tareas
        }
        break;

    case 'POST':
        $taskController->createTask(); // Crea una nueva tarea
        break;

    case 'PUT':
        $taskController->updateTask(); //Actualiza una tarea
        break;

    case 'DELETE':
        $taskController->deleteTask(); //Elimina una tarea
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Metodo no permitido"]);
        break;
}
?>
