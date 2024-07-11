<?php
namespace App\Model;

use DB\Conectar;

class Lugar {
    private $db;

    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function obtenerTodosLugares() {
        try {
            $lugares = array();

            $sql = "SELECT idlugar, ciudad FROM tblugar";
            $resultado = $this->db->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $lugares[] = $fila;
                }
                $resultado->close();
            }

            return $lugares;
        } finally {
        }
    }
}
?>
