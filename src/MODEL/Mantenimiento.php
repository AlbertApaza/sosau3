<?php
namespace App\Model;

use DB\Conectar;
class Mantenimiento {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }
    
    // Listar
    public function listarMantenimiento() {
        $maquinarias = array();
        $consulta = $this->db->query("SELECT * FROM tbmantenimiento");
        while ($fila = $consulta->fetch_assoc()) {
            $maquinarias[] = $fila;
        }
        return $maquinarias;
    }

    // Agregar
    public function agregarMantenimiento($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo) {
        try {
            $sql = "INSERT INTO tbmantenimiento (idmaquinaria, fecha, descripcion, costopro, idempleado, estado, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("issdsis", $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);
            $stmt->execute();
            $stmt->close();
            return true;
        } finally {
        }
    }

    // Eliminar
    public function eliminarMantenimiento($idmantenimiento) {
        try {
            $sql = "DELETE FROM tbmantenimiento WHERE idmantenimiento = ?";
            $stmt = $this->db->prepare($sql);
        
            $stmt->bind_param("i", $idmantenimiento);
            $stmt->execute();
            
            $resultado = $stmt->affected_rows > 0;
            $stmt->close();
            return $resultado;
        } finally {
        }
    }

    // Editar
    public function editarMantenimiento($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo) {
        try {
            $sql = "UPDATE tbmantenimiento SET idmaquinaria = ?, fecha = ?, descripcion = ?, costopro = ?, idempleado = ?, estado = ?, tipo = ? WHERE idmantenimiento = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("issdsisi", $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo, $idmantenimiento);
            $stmt->execute();
            $stmt->close();
            return true;
        } finally {
        }
    }

    // Buscar
    public function buscarMantenimiento($termino) {
        $maquinarias = array();
        $termino = "%" . $termino . "%";
        $sql = "SELECT * FROM tbmantenimiento WHERE idmaquinaria LIKE ? OR fecha LIKE ? OR descripcion LIKE ? OR idempleado LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $termino, $termino, $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($fila = $result->fetch_assoc()) {
            $maquinarias[] = $fila;
        }
        $stmt->close();
        return $maquinarias;
    }

    // Obtener por ID
    public function obtenerMantenimientoPorId($idmantenimiento) {
        $sql = "SELECT * FROM tbmantenimiento WHERE idmantenimiento = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idmantenimiento);
        $stmt->execute();
        $result = $stmt->get_result();
        $mantenimiento = $result->fetch_assoc();
        $stmt->close();
        return $mantenimiento;
    }
}
?>
