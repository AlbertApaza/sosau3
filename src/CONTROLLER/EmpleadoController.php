<?php
namespace App\Controller;

use App\Model\Empleado;

class EmpleadoController {

    private $empleadoModel;

    public function __construct(Empleado $empleadoModel) {
        $this->empleadoModel = $empleadoModel;
    }

    public function listarEmpleadosAdmin() {
        $empleados = $this->empleadoModel->listarEmpleados();
        // Aquí podrías retornar o pasar los datos a una vista
        return $empleados;
    }

    // Otros métodos del controlador
}
?>
