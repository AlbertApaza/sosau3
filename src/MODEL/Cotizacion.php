<?php
namespace App\Model;

use mysqli;

class Cotizacion {
    private $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function actualizarCotizacion($idcotizacion, $idcliente, $idmaquinaria, $idlugar, $total, $tiempo) {
        try {
            $sql = "UPDATE tbcotizacion SET idcliente = ?, idmaquinaria = ?, idlugar = ?, total = ?, tiempo = ? WHERE idcotizacion = ?";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("iiidii", $idcliente, $idmaquinaria, $idlugar, $total, $tiempo, $idcotizacion);
            $stmt->execute();

        } finally {

        }
    }

    public function obtenerClientePorId($idcliente) {
        try {
            $sql = "SELECT * FROM tbcliente WHERE idcliente = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("i", $idcliente);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $cliente = $resultado->fetch_assoc();
            return $cliente;
        } finally {

        }
    }
    
    public function obtenerMaquinariaPorId($idmaquinaria) {
        try {
            $sql = "SELECT * FROM tbmaquinaria WHERE idmaquinaria = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("i", $idmaquinaria);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $maquinaria = $resultado->fetch_assoc();
            return $maquinaria;
        } finally {
        }
    }
    
    public function obtenerLugarPorId($idlugar) {
        try {
            $sql = "SELECT * FROM tblugar WHERE idlugar = ?";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("i", $idlugar);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $lugar = $resultado->fetch_assoc();
            
            return $lugar;
        } finally {
        }
    }
    
    public function agregarCotizacion($idcliente = null) {
        try {
            $sql = "INSERT INTO tbcotizacion (idcliente) VALUES (?)";
            
            $stmt = $this->conexion->prepare($sql);
            
            $stmt->bind_param("i", $idcliente);
            
            $stmt->execute();
            
            $idcotizacion = $stmt->insert_id;
            
            return $idcotizacion;
        } finally {
        }
    }
    
    public function obtenerTodasMaquinarias() {
        try {
            $sql = "SELECT * FROM tbmaquinaria";
            
            $resultado = $this->conexion->query($sql);
            
            $maquinarias = [];
            while ($row = $resultado->fetch_assoc()) {
                $maquinarias[] = $row;
            }
            
            return $maquinarias;
        } finally {

        }
    }
    
		public function obtenerTodosLugares() {
			try {
				$sql = "SELECT * FROM tblugar";
				
				$resultado = $this->conexion->query($sql);
				
				$lugares = [];
				while ($row = $resultado->fetch_assoc()) {
					$lugares[] = $row;
				}
				
				return $lugares;
			} finally {
	
			}
		}
}
?>
