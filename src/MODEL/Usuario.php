<?php
namespace App\Model;

use DB\Conectar; // Importa la clase Conectar desde el namespace DB

class Usuario {
    private $db;

    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function login($username, $password){
        $stmt = $this->db->prepare("SELECT * FROM tbadmin WHERE usuario = ? AND password = ?");
        
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        // Debugging: Verificar cuántas filas devuelve la consulta
        var_dump($result->num_rows); 
        
        return $result->fetch_assoc();
    }
    
    
    
    
    
    
}
?>
