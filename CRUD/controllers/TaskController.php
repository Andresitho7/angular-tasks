<?php
require_once __DIR__ . '/../models/TaskRepositoryModel.php';


class TaskController {
    
    private $taskRepository;

    public function __construct() {
        $this->taskRepository = new TaskRepositoryModel(); // Crear la instancia dentro del constructor
    }

    // Métodos para manejar las tareas
    public function getTasks() {
        header('Content-Type: application/json');
        echo json_encode($this->taskRepository->mostrarTasks(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Método para obtener una tarea por ID
    public function getTask($id) {
        $task = $this->taskRepository->mostrarTaskPorId($id);
        if ($task) {
            echo json_encode($task);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Tarea no encontrada"]);
        }
    }

    // Método para crear una tarea
    public function createTask() {
        $data = json_decode(file_get_contents("php://input"), true);
        //Se comprueba que los tres campos obligatorios
        if (!empty($data['title']) && !empty($data['description']) && !empty($data['status'])) {
            
            //Se llama al método registrarTask del modelo
            $response = $this->taskRepository->registrarTask($data['title'], $data['description'], $data['status']);
            $responseData = json_decode($response, true);

            if (isset($responseData['message'])) {
                echo json_encode(["message" => "Tarea creada correctamente"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al crear la tarea"]);
            }

        } else {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos"]);
        }
    }

    // Método para actualizar una tarea
    public function updateTask() {
        // Recibe los datos enviados en la petición "php://input"
        $data = json_decode(file_get_contents("php://input"), true);
    
        //Se comprueba que los tres campos obligatorios
        if (!empty($data['id']) && !empty($data['title']) && !empty($data['description']) && !empty($data['status'])) {
            
            //Se llama al método actualizarTask del modelo
            if ($this->taskRepository->actualizarTask($data['id'], $data['title'], $data['description'], $data['status'])) {
                //Convierte el JSON en un array asociativo de PHP
                echo json_encode(["message" => "Tarea actualizada correctamente"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al actualizar la tarea"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos"]);
        }
    }

    // Método para eliminar una tarea
    public function deleteTask() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = isset($data['id']) ? $data['id'] : null;

        if ($id && $this->taskRepository->eliminarTask($id)) {
            echo json_encode(["message" => "Tarea eliminada correctamente"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "ID inválido o no encontrado"]);
        }
    }
}
?>
