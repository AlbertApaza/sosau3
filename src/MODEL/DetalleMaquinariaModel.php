<?php
namespace App\Model;

class DetalleMaquinariaModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listarDetalleMaquinaria() {
        $query = "SELECT * FROM tbdetallemaquinaria";
        $result = $this->db->query($query);
        $detalles = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $detalles[] = $row;
            }
        }
        return $detalles;
    }

    public function obtenerDetallePorId($id) {
        $query = "SELECT * FROM tbdetallemaquinaria WHERE iddetalle = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $detalle = $result->fetch_assoc();
        $stmt->close();
        return $detalle;
    }

    public function actualizarDetalle($data) {
        $id = $data['id'];
        $idmaquinaria = $data['idmaquinaria'];
        $descripcion = $data['descripcion'];

        $query = "UPDATE tbdetallemaquinaria SET idmaquinaria = ?, descripcion = ? WHERE iddetalle = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isi", $idmaquinaria, $descripcion, $id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function eliminarDetalle($id) {
        $query = "DELETE FROM tbdetallemaquinaria WHERE iddetalle = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
}
?>
