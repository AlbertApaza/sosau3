<?php
namespace App\Controller;

use App\Model\Maquinaria;

class MaquinariaController {

    private $modeloMaquinaria;

    public function __construct(Maquinaria $modeloMaquinaria) {
        $this->modeloMaquinaria = $modeloMaquinaria;
    }

    // VISTA CLIENTE
    public function catalogoMaquinaria() {
        try {
            $datos = $this->modeloMaquinaria->listarMaquinarias();
            // Aquí normalmente se devolverían los datos o se pasarían a una vista
            return $datos;
        } finally {
            // Puedes agregar lógica adicional aquí si es necesario
        }
    }

    // Funcion del controlador para mostrar detalles de una maquinaria cuando se le haga click
    public function detalleMaquinaria($idmaquinaria) {
        try {
            $fila = $this->modeloMaquinaria->mostrar_Maquinaria($idmaquinaria);
            return $fila;
        } catch (Exception $e) {
            // Manejo de excepciones si es necesario
            throw $e;
        }
    }
    

    // VISTA ADMINISTRADOR

    // Función para listar maquinaria en la interfaz del administrador
    public function listarMaquinariaAdmin() {
        try {
            $datos = $this->modeloMaquinaria->listarMaquinarias();
            // Aquí normalmente se devolverían los datos o se pasarían a una vista
            return $datos;
        } finally {
            
        }
    }

    // Función para agregar maquinaria
    public function agregarMaquinariaAdmin($numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal) {
        try {
            $this->modeloMaquinaria->agregarMaquinaria($numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal);
            echo "Maquinaria agregada correctamente.";
        } finally {
            
        }
    }

    // Función para eliminar maquinaria
    public function eliminarMaquinariaAdmin($id) {
        try {
            $resultado = $this->modeloMaquinaria->eliminarMaquinaria($id);
            if ($resultado) {
                echo "Maquinaria eliminada correctamente.";
            } 
        } finally {
            
        }
    }

    // Función para editar maquinaria
    public function editarMaquinariaAdmin($id, $numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal) {
        try {
            $this->modeloMaquinaria->editarMaquinaria($id, $numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal);
            echo "Maquinaria editada correctamente.";
        } finally {
            
        }
    }

    // Función para buscar maquinaria
    public function buscarMaquinariaAdmin($termino) {
        try {
            $resultados = $this->modeloMaquinaria->buscarMaquinaria($termino);
            // Aquí normalmente se devolverían los datos o se pasarían a una vista
            return $resultados;
        } finally {
            
        }
    }

    // Función para mostrar formulario de edición de maquinaria
    public function mostrarFormularioEditar($id) {
        try {
            $maquinaria = $this->modeloMaquinaria->buscarMaquinariaPorId($id);
            // Aquí normalmente se devolverían los datos o se pasarían a una vista
            return $maquinaria;
        } finally {

        }
    }
}
?>
