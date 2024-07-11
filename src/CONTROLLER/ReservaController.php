<?php
namespace App\Controller;

use App\Model\Reserva;

class ReservaController {

    private $modeloReserva;

    public function __construct(Reserva $modeloReserva) {
        $this->modeloReserva = $modeloReserva;
    }

    public function listarReservaAdmin() {
        $datos = $this->modeloReserva->listarReserva();
        // Aquí normalmente se devolverían los datos o se pasarían a una vista
        return $datos;
    }

    public function agregarReservaAdmin($idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        $this->modeloReserva->agregarReserva($idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado);
        // Aquí podrías manejar la lógica de redireccionamiento o respuesta según necesites
    }

    public function editarReservaAdmin($idreserva, $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado) {
        $this->modeloReserva->editarReserva($idreserva, $idcliente, $idmaquinaria, $idcotize, $idempleado, $fechareserva, $fechainicio, $fechafin, $estado);
        // Aquí podrías manejar la lógica de redireccionamiento o respuesta según necesites
    }

    public function eliminarReservaAdmin($idreserva) {
        $resultado = $this->modeloReserva->eliminarReserva($idreserva);
        if ($resultado) {
            // Idealmente se manejaría el redireccionamiento desde el controlador que llama a este método
            return true;
        } 
    }

    public function buscarReservaAdmin($termino) {
        $datos = $this->modeloReserva->buscarReserva($termino);
        // Aquí normalmente se devolverían los datos o se pasarían a una vista
        return $datos;
    }

    public function mostrarFormularioEditar($idreserva) {
        $datos = $this->modeloReserva->obtenerReservaPorId($idreserva);
        // Aquí normalmente se devolverían los datos o se pasarían a una vista
        return $datos;
    }
}
?>
