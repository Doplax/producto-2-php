<?php

namespace App\Controllers;

require_once '../app/core/Database.php';

class BaseController
{
    protected $db; //propiedad para guardar la connexión a bbdd

    public function __construct() //se ejecuta el constructor y guarda la instacia de Database en la propiedad
    {
        $database = new \Database();
        $this->db = $database->connection;
    }


    protected function loadView($viewName, $data = [])
    {
        extract($data);

        $viewFile = '../app/views/' . $viewName . '.php';

        if (file_exists($viewFile)) {
            require_once '../app/views/layout/header.php'; // Carga el header

            require_once $viewFile; // Carga la vista específica

            require_once '../app/views/layout/footer.php'; // Carga el footer
        } else {
            die('Error Fatal: La vista "' . $viewName . '.php" no existe en la carpeta app/views/.');
        }
    }


    protected function requireMethod(string $method)
    {
        if ($_SERVER['REQUEST_METHOD'] !== strtoupper($method)) {
            http_response_code(405);
            header('Allow: ' . strtoupper($method));
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido. Use ' . strtoupper($method) . '.']);
            die();
        }
    }
}
