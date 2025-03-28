<?php

require 'conexion.php';

class TaskRepositoryModel {

    private $conn;

    public function __construct() {
        $this->conn = Conexion::getConnect();
    }

    // Método para registrar una tarea
    public function registrarTask($title, $description, $status) {
        try {
            $sql = 'INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                http_response_code(201);
                return json_encode(['message' => 'Tarea registrada correctamente']);
            }
            throw new Exception('No se pudo registrar la tarea.');
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Error al registrar tarea', 'details' => $e->getMessage()]);
        }
    }

    // Método para mostrar todas las tareas
    public function mostrarTasks() {
        try {
            $sql = "SELECT * FROM tasks";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); //Devuelve un array en lugar de un JSON string
        } catch (PDOException $e) {
            http_response_code(500);
            return ['error' => 'Error al obtener las tareas', 'details' => $e->getMessage()];
        }
    }
    
    
    // Método para mostrar una tarea por ID
    public function mostrarTaskPorId($id) {
        try {
            $sql = "SELECT * FROM tasks WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $task = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($task) {
                return json_encode($task);
            }
            http_response_code(404);
            return json_encode(['message' => 'Tarea no encontrada']);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Error al obtener la tarea', 'details' => $e->getMessage()]);
        }
    }

    // Método para actualizar una tarea
    public function actualizarTask($id, $title, $description, $status) {
        try {
            $sql = "UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return json_encode(['message' => 'Tarea actualizada correctamente']);
            }
            throw new Exception('No se pudo actualizar la tarea.');
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Error al actualizar tarea', 'details' => $e->getMessage()]);
        }
    }

    // Método para eliminar una tarea
    public function eliminarTask($id) {
        try {
            $sql = "DELETE FROM tasks WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute() && $stmt->rowCount() > 0) {
                return json_encode(['message' => 'Tarea eliminada correctamente']);
            }
            http_response_code(404);
            return json_encode(['message' => 'Tarea no encontrada']);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(['error' => 'Error al eliminar tarea', 'details' => $e->getMessage()]);
        }
    }
}

?>
