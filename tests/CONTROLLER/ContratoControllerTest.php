<?php
namespace Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\ContratoController;
use App\Model\Contrato;

class ContratoControllerTest extends TestCase {

    public function testListarContratoAdmin() {
        // Creamos un mock del modelo Contrato
        $mockModel = $this->getMockBuilder(Contrato::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el comportamiento esperado del mock para listar contratos
        $mockModel->expects($this->once())
                  ->method('listarContrato')
                  ->willReturn([
                      ['id' => 1, 'nombre' => 'Cliente A'],
                      ['id' => 2, 'nombre' => 'Cliente B']
                  ]);

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new ContratoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $contratos = $controller->listarContratoAdmin();

        // Verificamos que el método devuelve los contratos esperados
        $this->assertCount(2, $contratos);
        $this->assertEquals(['id' => 1, 'nombre' => 'Cliente A'], $contratos[0]);
        $this->assertEquals(['id' => 2, 'nombre' => 'Cliente B'], $contratos[1]);
    }

    public function testAgregarContratoAdmin() {
        // Creamos un mock del modelo Contrato
        $mockModel = $this->getMockBuilder(Contrato::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el mock para el método agregarContrato
        $mockModel->expects($this->once())
                  ->method('agregarContrato')
                  ->with(1, 1); // Verificamos los parámetros

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new ContratoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $controller->agregarContratoAdmin(1, 1);

        // No necesitamos verificar el resultado porque el método solo imprime un mensaje
        // Podríamos verificar que se imprima el mensaje correctamente usando output buffering
    }

    public function testEditarContratoAdmin() {
        // Creamos un mock del modelo Contrato
        $mockModel = $this->getMockBuilder(Contrato::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el mock para el método editarContrato
        $mockModel->expects($this->once())
                  ->method('editarContrato')
                  ->with(1, 1, 1); // Verificamos los parámetros

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new ContratoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $controller->editarContratoAdmin(1, 1, 1);

        // No necesitamos verificar el resultado porque el método solo imprime un mensaje
        // Podríamos verificar que se imprima el mensaje correctamente usando output buffering
    }

    public function testEliminarContratoAdmin() {
        // Creamos un mock del modelo Contrato
        $mockModel = $this->getMockBuilder(Contrato::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el mock para el método eliminarContrato
        $mockModel->expects($this->once())
                  ->method('eliminarContrato')
                  ->with(1)
                  ->willReturn(true); // Simulamos que la eliminación fue exitosa

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new ContratoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $controller->eliminarContratoAdmin(1);

        // No necesitamos verificar el resultado porque el método solo redirige o imprime un mensaje
        // Podríamos verificar el redireccionamiento o mensaje usando output buffering
    }

    public function testBuscarContratoAdmin() {
        // Creamos un mock del modelo Contrato
        $mockModel = $this->getMockBuilder(Contrato::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el comportamiento esperado del mock para buscar contrato
        $mockModel->expects($this->once())
                  ->method('buscarContrato')
                  ->with('termino'); // Verificamos el parámetro

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new ContratoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $controller->buscarContratoAdmin('termino');

        // No necesitamos verificar el resultado porque el método solo carga una vista
        // Podríamos verificar la carga de la vista usando output buffering
    }

    public function testMostrarFormularioEditar() {
        // Creamos un mock del modelo Contrato
        $mockModel = $this->getMockBuilder(Contrato::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el mock para el método obtenerContratoPorId
        $mockModel->expects($this->once())
                  ->method('obtenerContratoPorId')
                  ->with(1); // Verificamos el parámetro

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new ContratoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $controller->mostrarFormularioEditar(1);

        // No necesitamos verificar el resultado porque el método solo carga una vista
        // Podríamos verificar la carga de la vista usando output buffering
    }


}
?>
