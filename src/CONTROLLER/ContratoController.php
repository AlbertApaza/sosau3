<?php
namespace App\Controller;

use App\Model\Contrato;
use FPDF;

class ContratoController {

    private $modeloContrato;

    public function __construct(Contrato $modeloContrato) {
        $this->modeloContrato = $modeloContrato;
    }

    public function listarContratoAdmin() {
        try {
            $datos = $this->modeloContrato->listarContrato();
            // Aquí normalmente se devolverían los datos o se pasarían a una vista
            return $datos;
        } finally {

        }
    }

    public function agregarContratoAdmin($idreserva, $idcotizacion) {
        try {
            $this->modeloContrato->agregarContrato($idreserva, $idcotizacion);
            echo "Contrato agregado correctamente.";
        } finally {

        }
    }

    public function editarContratoAdmin($idcontrato, $idreserva, $idcotizacion) {
        try {
            $this->modeloContrato->editarContrato($idcontrato, $idreserva, $idcotizacion);
            echo "Contrato editado correctamente.";
        } finally {

        }
    }

    public function eliminarContratoAdmin($idcontrato) {
        try {
            $resultado = $this->modeloContrato->eliminarContrato($idcontrato);
            if ($resultado) {
                echo "Contrato eliminado correctamente.";
            } 
        } finally {

        }
    }

    public function buscarContratoAdmin($termino) {
        try {
            $datos = $this->modeloContrato->buscarContrato($termino);
            // Aquí normalmente se devolverían los datos o se pasarían a una vista
            return $datos;
        } finally {

        }
    }

    public function mostrarFormularioEditar($idcontrato) {
        try {
            $datos = $this->modeloContrato->obtenerContratoPorId($idcontrato);
            // Aquí normalmente se devolverían los datos o se pasarían a una vista
            return $datos;
        } finally {

        }
    }

    
}
?>
