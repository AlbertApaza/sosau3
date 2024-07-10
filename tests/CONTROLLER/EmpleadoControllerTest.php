<?php
namespace Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\EmpleadoController;
use App\Model\Empleado;

class EmpleadoControllerTest extends TestCase {

    public function testListarEmpleadosAdmin() {
        // Creamos un mock del modelo Empleado
        $mockModel = $this->getMockBuilder(Empleado::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el comportamiento esperado del mock para listar empleados
        $mockModel->expects($this->once())
                  ->method('listarEmpleados')
                  ->willReturn([
                      ['id' => 1, 'nombre' => 'Juan'],
                      ['id' => 2, 'nombre' => 'María']
                  ]);

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new EmpleadoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $empleados = $controller->listarEmpleadosAdmin();

        // Verificamos que el método devuelve los empleados esperados
        $this->assertCount(2, $empleados);
        $this->assertEquals(['id' => 1, 'nombre' => 'Juan'], $empleados[0]);
        $this->assertEquals(['id' => 2, 'nombre' => 'María'], $empleados[1]);
    }
}
?>
