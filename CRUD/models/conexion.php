<?php 

require_once __DIR__ . '/../config/config.php';

class Conexion {

    static public function getConnect() {
        $connect = 'pgsql:host='.DB_HOST.';port=5432;dbname='.DB_NAME.';';
        try {
            $conn = new PDO($connect, DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn; // Conexión exitosa
        } catch (PDOException $th) {
            die(json_encode(["error" => "ERROR DE CONEXIÓN: " . $th->getMessage()]));
        }
    }
}
?>
