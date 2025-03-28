<?php

    // const DB_HOST = '127.0.0.1';
    // const DB_NAME = 'dbCrudSolati';
    // const DB_USER = 'postgres';
    // const DB_PASSWORD = '1234';

    //     $connect = 'pgsql:host='.DB_HOST.';port=5432;dbname='.DB_NAME.';';

    //     try {
    //         $conn = new PDO($connect, DB_USER, DB_PASSWORD);
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         echo 'Conexion ok';

    //     } catch (PDOException $th) {
    //         echo 'ERROR DE CONEXION '.$th->getMessage();
    //     }

    //     return  $conn;

    
?>

<?php
require_once 'models/conexion.php';

try {
    $conn = Conexion::getConnect();
    echo json_encode(["message" => "Conexión exitosa"]);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>