<?php
namespace Tests\Controller;

use App\Controller\MantenimientoController;
use App\Model\Mantenimiento;
use PHPUnit\Framework\TestCase;

class MantenimientoControllerTest extends TestCase
{
    public function testListarMantenimientoAdmin()
    {
        // Creamos un mock del modelo Mantenimiento
        $mockModel = $this->getMockBuilder(Mantenimiento::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        // Configuramos el comportamiento esperado del mock para listar mantenimientos
        $mockModel->expects($this->once())
                  ->method('listarMantenimiento')
                  ->willReturn([
                      ['idmantenimiento' => 1, 'idmaquinaria' => 1, 'fecha' => '2024-06-20', 'descripcion' => 'Mantenimiento 1'],
                      ['idmantenimiento' => 2, 'idmaquinaria' => 2, 'fecha' => '2024-06-21', 'descripcion' => 'Mantenimiento 2']
                  ]);

        // Creamos una instancia del controlador inyectando el mock del modelo
        $controller = new MantenimientoController($mockModel);

        // Ejecutamos el método del controlador que queremos probar
        $mantenimientos = $controller->listarMantenimientoAdmin();

        // Verificamos que el método devuelve los mantenimientos esperados
        $this->assertCount(2, $mantenimientos);
        $this->assertEquals(['idmantenimiento' => 1, 'idmaquinaria' => 1, 'fecha' => '2024-06-20', 'descripcion' => 'Mantenimiento 1'], $mantenimientos[0]);
        $this->assertEquals(['idmantenimiento' => 2, 'idmaquinaria' => 2, 'fecha' => '2024-06-21', 'descripcion' => 'Mantenimiento 2'], $mantenimientos[1]);
    }
    public function testAgregarMantenimientoAdmin()
    {
        // Crear un mock del modelo Mantenimiento
        $mockModel = $this->createMock(Mantenimiento::class);
        $mockModel->expects($this->once())
                  ->method('agregarMantenimiento')
                  ->with(1, '2024-06-20', 'Descripción', 100, 1, 'activo', 'correctivo');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MantenimientoController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->agregarMantenimientoAdmin(1, '2024-06-20', 'Descripción', 100, 1, 'activo', 'correctivo');
    }

    public function testEditarMantenimientoAdmin()
    {
        // Crear un mock del modelo Mantenimiento
        $mockModel = $this->createMock(Mantenimiento::class);
        $mockModel->expects($this->once())
                  ->method('editarMantenimiento')
                  ->with(1, 1, '2024-06-20', 'Descripción', 100, 1, 'activo', 'correctivo');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MantenimientoController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->editarMantenimientoAdmin(1, 1, '2024-06-20', 'Descripción', 100, 1, 'activo', 'correctivo');
    }

    public function testEliminarMantenimientoAdmin()
    {
        // Crear un mock del modelo Mantenimiento
        $mockModel = $this->createMock(Mantenimiento::class);
        $mockModel->method('eliminarMantenimiento')
                  ->willReturn(true);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MantenimientoController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $resultado = $controller->eliminarMantenimientoAdmin(1);

        // Verificar que el método devuelve true cuando se elimina correctamente
        $this->assertTrue($resultado);
    }

    public function testBuscarMantenimientoAdmin()
    {
        // Crear un mock del modelo Mantenimiento
        $mockModel = $this->createMock(Mantenimiento::class);
        $mockModel->method('buscarMantenimiento')
                  ->with('buscar término')
                  ->willReturn([
                      ['idmantenimiento' => 1, 'idmaquinaria' => 1, 'fecha' => '2024-06-20', 'descripcion' => 'Mantenimiento 1']
                  ]);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MantenimientoController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $mantenimientos = $controller->buscarMantenimientoAdmin('buscar término');

        // Verificar que el método devuelve los mantenimientos esperados
        $this->assertCount(1, $mantenimientos);
        $this->assertEquals(['idmantenimiento' => 1, 'idmaquinaria' => 1, 'fecha' => '2024-06-20', 'descripcion' => 'Mantenimiento 1'], $mantenimientos[0]);
    }

    public function testMostrarFormularioEditar()
    {
        // Crear un mock del modelo Mantenimiento
        $mockModel = $this->createMock(Mantenimiento::class);
        $mockModel->method('obtenerMantenimientoPorId')
                  ->with(1)
                  ->willReturn(['idmantenimiento' => 1, 'idmaquinaria' => 1, 'fecha' => '2024-06-20', 'descripcion' => 'Mantenimiento 1']);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MantenimientoController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $mantenimiento = $controller->mostrarFormularioEditar(1);

        // Verificar que el método devuelve el mantenimiento esperado
        $this->assertEquals(['idmantenimiento' => 1, 'idmaquinaria' => 1, 'fecha' => '2024-06-20', 'descripcion' => 'Mantenimiento 1'], $mantenimiento);
    }

    // Puedes añadir más métodos de prueba para otros métodos del controlador MantenimientoController
}

?>
