<?php
namespace App\Model;

class Contrato {
    private $db;

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    public function listarContrato() {
        $resultados = [];
        $query = "SELECT * FROM tbcontrato";
        $resultSet = $this->db->query($query);

        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $resultados[] = $row;
            }
        }

        return $resultados;
    }

    public function agregarContrato($idreserva, $idcotizacion) {
        $stmt = $this->db->prepare("INSERT INTO tbcontrato (idreserva, idcotizacion) VALUES (?, ?)");
        $stmt->bind_param("ii", $idreserva, $idcotizacion);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function editarContrato($idreserva, $idcotizacion, $idcontrato) {
        $stmt = $this->db->prepare("UPDATE tbcontrato SET idreserva = ?, idcotizacion = ? WHERE idcontrato = ?");
        $stmt->bind_param("iii", $idreserva, $idcotizacion, $idcontrato);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function eliminarContrato($idcontrato, $affectedRows = null) {
        $stmt = $this->db->prepare("DELETE FROM tbcontrato WHERE idcontrato = ?");
        $stmt->bind_param("i", $idcontrato);
        $resultado = $stmt->execute();
        $stmt->close();
        
        // Verificar el número de filas afectadas
        if ($affectedRows !== null) {
            return $affectedRows > 0;
        }
    }
    
    
    
    

    public function buscarContrato($termino) {
        $resultados = [];
        $query = "SELECT * FROM tbcontrato WHERE idreserva LIKE ? OR idcotizacion LIKE ?";
        $stmt = $this->db->prepare($query);
        $term = "%{$termino}%";
        $stmt->bind_param("ss", $term, $term);
        $stmt->execute();
        $resultSet = $stmt->get_result();

        while ($row = $resultSet->fetch_assoc()) {
            $resultados[] = $row;
        }

        $stmt->close();
        return $resultados;
    }

    public function obtenerContratoPorId($idcontrato) {
        $query = "SELECT c.*, r.*, cot.*, cl.*, m.*, l.*
                  FROM tbcontrato c
                  JOIN tbreserva r ON c.idreserva = r.idreserva
                  JOIN tbcotizacion cot ON c.idcotizacion = cot.idcotizacion
                  JOIN tbcliente cl ON r.idcliente = cl.idcliente
                  JOIN tbmaquinaria m ON r.idmaquinaria = m.idmaquinaria
                  JOIN tblugar l ON cot.idlugar = l.idlugar
                  WHERE c.idcontrato = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idcontrato);
        $stmt->execute();
        $resultSet = $stmt->get_result();
        $contrato = $resultSet->fetch_assoc();
        $stmt->close();

        return $contrato;
    }
}
?>
