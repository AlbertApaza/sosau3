<?php
namespace App\Model;

class Empleado {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listarEmpleados() {
        $empleados = array();
        $consulta = $this->db->query("SELECT * FROM tbempleado");
        while ($fila = $consulta->fetch_assoc()) {
            $empleados[] = $fila;
        }
        return $empleados;
    }

    // Otros métodos para agregar, editar, eliminar y buscar empleados
}
?>
