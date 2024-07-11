<?php
namespace App\Model;

use DB\Conectar;

class Reserva {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    // Listar todas las reservas
    public function listarReserva() {
        $reservas = array();
        $consulta = $this->db->query("SELECT * FROM tbreserva");
        while ($fila = $consulta->fetch_assoc()) {
            $reservas[] = $fila;
        }
        return $reservas;
    }

    // Agregar una reserva nueva
    public function agregarReserva($idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        try {
            $sql = "INSERT INTO tbreserva (idcliente, idmaquinaria, idcotize, idempleado, fechareserva, fechainicio, fechafin, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iiiissss", $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado);
            $stmt->execute();
            $stmt->close();
            return true;
        } finally {	
        }
    }
    

    // Eliminar una reserva
    public function eliminarReserva($idreserva) {
        try {
            $sql = "DELETE FROM tbreserva WHERE idreserva = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $idreserva);
            $stmt->execute();
            $resultado = $stmt->affected_rows > 0;
            $stmt->close();
            return $resultado;
        } finally {	
        }
    }

    // Editar una reserva existente
    public function editarReserva($idreserva, $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        try {
            $sql = "UPDATE tbreserva SET idcliente = ?, idmaquinaria = ?, idcotize = ?, idempleado = ?, fechareserva = ?, fechainicio = ?, fechafin = ?, estado = ? WHERE idreserva = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iiiiisssi", $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado, $idreserva);
            $stmt->execute();
            $stmt->close();
            return true;
        } finally {	
        }
    }

    // Buscar reservas por término
    public function buscarReserva($termino) {
        $reservas = array();
        $termino = "%" . $termino . "%";
        $sql = "SELECT * FROM tbreserva WHERE idcliente LIKE ? OR idmaquinaria LIKE ? OR idcotize LIKE ? OR idempleado LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $termino, $termino, $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($fila = $result->fetch_assoc()) {
            $reservas[] = $fila;
        }
        $stmt->close();
        return $reservas;
    }

    // Obtener reserva por ID
    public function obtenerReservaPorId($idreserva) {
        $sql = "SELECT * FROM tbreserva WHERE idreserva = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idreserva);
        $stmt->execute();
        $result = $stmt->get_result();
        $reserva = $result->fetch_assoc();
        $stmt->close();
        return $reserva;
    }
}
?>
