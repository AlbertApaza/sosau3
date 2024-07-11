<?php
namespace App\Controller;

use App\Model\Mantenimiento;

class MantenimientoController {

    private $modeloMantenimiento;

    public function __construct(Mantenimiento $modeloMantenimiento) {
        $this->modeloMantenimiento = $modeloMantenimiento;
    }

    public function listarMantenimientoAdmin() {
        $datos = $this->modeloMantenimiento->listarMantenimiento();
        // Aquí normalmente se devolverían los datos o se pasarían a una vista
        return $datos;
    }

    public function agregarMantenimientoAdmin($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo) {
        $this->modeloMantenimiento->agregarMantenimiento($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);
        // Aquí podrías manejar la lógica de redireccionamiento o respuesta según necesites
    }

    public function editarMantenimientoAdmin($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo) {
        $this->modeloMantenimiento->editarMantenimiento($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);
        // Aquí podrías manejar la lógica de redireccionamiento o respuesta según necesites
    }

    public function eliminarMantenimientoAdmin($idmantenimiento) {
        $resultado = $this->modeloMantenimiento->eliminarMantenimiento($idmantenimiento);
        if ($resultado) {
            // Idealmente se manejaría el redireccionamiento desde el controlador que llama a este método
            return true;
        } 
    }

    public function buscarMantenimientoAdmin($termino) {
        $datos = $this->modeloMantenimiento->buscarMantenimiento($termino);
        // Aquí normalmente se devolverían los datos o se pasarían a una vista
        return $datos;
    }

    public function mostrarFormularioEditar($idmantenimiento) {
        $datos = $this->modeloMantenimiento->obtenerMantenimientoPorId($idmantenimiento);
        // Aquí normalmente se devolverían los datos o se pasarían a una vista
        return $datos;
    }
}
?>
