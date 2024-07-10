<?php
use App\Controller\MaquinariaController;
use App\Model\Maquinaria;
use PHPUnit\Framework\TestCase;

class MaquinariaControllerTest extends TestCase
{
    public function testCatalogoMaquinaria()
    {
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->method('listarMaquinarias')
                  ->willReturn([
                      ['idmaquinaria' => 567, 'numserie' => 'CAT0320DPABC12345', 'nombre' => 'Excavadora hidráulica', 'marca' => 'Caterpillar', 'modelo' => '320D', 'costoh' => 110.5, 'imagenprincipal' => 'excavadora.png'],
                      ['idmaquinaria' => 568, 'numserie' => 'KMTD65EX17XYZ67890', 'nombre' => 'Bulldozer', 'marca' => 'Komatsu', 'modelo' => 'D65EX-17', 'costoh' => 120.2, 'imagenprincipal' => 'excavadora.png']
                  ]);

        $controller = new MaquinariaController($mockModel);
        $maquinarias = $controller->catalogoMaquinaria();

        $this->assertCount(2, $maquinarias);
        $this->assertEquals(['idmaquinaria' => 567, 'numserie' => 'CAT0320DPABC12345', 'nombre' => 'Excavadora hidráulica', 'marca' => 'Caterpillar', 'modelo' => '320D', 'costoh' => 110.5, 'imagenprincipal' => 'excavadora.png'], $maquinarias[0]);
        $this->assertEquals(['idmaquinaria' => 568, 'numserie' => 'KMTD65EX17XYZ67890', 'nombre' => 'Bulldozer', 'marca' => 'Komatsu', 'modelo' => 'D65EX-17', 'costoh' => 120.2, 'imagenprincipal' => 'excavadora.png'], $maquinarias[1]);
    }
    public function testDetalleMaquinaria() {
        // Datos simulados de una maquinaria desde la base de datos
        $detalleMaquinaria = [
            'idmaquinaria' => 567,
            'numserie' => 'CAT0320DPABC12345',
            'nombre' => 'Excavadora hidráulica',
            'marca' => 'Caterpillar',
            'modelo' => '320D',
            'costoh' => 110.5,
            'imagenprincipal' => 'excavadora.png',
            'idmaquinariadetalle' => null,  // Asegúrate de incluir todos los campos necesarios
            'idmaquinaria' => 567,
            'descripcion' => 'Detalle de la maquinaria',
            'ubicacion' => 'Bodega',
            'estado' => 'Operativa',
            'fecha_adquisicion' => '2022-01-01'
        ];

        // Crear un mock del modelo Maquinaria
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->method('mostrarMaquinaria')
                  ->with($this->equalTo(567))  // Asegurarnos de que el ID sea el esperado
                  ->willReturn($detalleMaquinaria);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MaquinariaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $maquinaria = $controller->detalleMaquinaria(567);

        // Verificar que el método devuelve la maquinaria esperada
        $this->assertEquals($detalleMaquinaria, $maquinaria);
    }
    
    
    
    public function testListarMaquinariaAdmin()
    {
        // Crear un mock del modelo Maquinaria
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->method('listarMaquinarias')
                  ->willReturn([
                      ['id' => 1, 'nombre' => 'Excavadora', 'marca' => 'CAT'],
                      ['id' => 2, 'nombre' => 'Grúa', 'marca' => 'Liebherr']
                  ]);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MaquinariaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $maquinarias = $controller->listarMaquinariaAdmin();

        // Verificar que el método devuelve las maquinarias esperadas
        $this->assertCount(2, $maquinarias);
        $this->assertEquals(['id' => 1, 'nombre' => 'Excavadora', 'marca' => 'CAT'], $maquinarias[0]);
        $this->assertEquals(['id' => 2, 'nombre' => 'Grúa', 'marca' => 'Liebherr'], $maquinarias[1]);
    }

    public function testAgregarMaquinariaAdmin()
    {
        // Crear un mock del modelo Maquinaria
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->expects($this->once())
                  ->method('agregarMaquinaria')
                  ->with('12345', 'Excavadora', 'CAT', 'Modelo ABC', 50000, 'imagen.jpg');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MaquinariaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->agregarMaquinariaAdmin('12345', 'Excavadora', 'CAT', 'Modelo ABC', 50000, 'imagen.jpg');
    }

    public function testEditarMaquinariaAdmin()
    {
        // Crear un mock del modelo Maquinaria
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->expects($this->once())
                  ->method('editarMaquinaria')
                  ->with(1, '12345', 'Excavadora', 'CAT', 'Modelo ABC', 50000, 'imagen.jpg');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MaquinariaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->editarMaquinariaAdmin(1, '12345', 'Excavadora', 'CAT', 'Modelo ABC', 50000, 'imagen.jpg');
    }

    public function testEliminarMaquinariaAdmin()
    {
        // Crear un mock del modelo Maquinaria
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->method('eliminarMaquinaria')
                  ->willReturn(true);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MaquinariaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $resultado = $controller->eliminarMaquinariaAdmin(1);

        // Verificar que el método devuelve true cuando se elimina correctamente
        $this->assertTrue($resultado);
    }

    public function testBuscarMaquinariaAdmin()
    {
        // Crear un mock del modelo Maquinaria
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->method('buscarMaquinaria')
                  ->with('buscar término')
                  ->willReturn([
                      ['id' => 1, 'nombre' => 'Excavadora', 'marca' => 'CAT']
                  ]);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MaquinariaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $maquinarias = $controller->buscarMaquinariaAdmin('buscar término');

        // Verificar que el método devuelve las maquinarias esperadas
        $this->assertCount(1, $maquinarias);
        $this->assertEquals(['id' => 1, 'nombre' => 'Excavadora', 'marca' => 'CAT'], $maquinarias[0]);
    }

    public function testMostrarFormularioEditar()
    {
        // Crear un mock del modelo Maquinaria
        $mockModel = $this->createMock(Maquinaria::class);
        $mockModel->method('buscarMaquinariaPorId')
                  ->with(1)
                  ->willReturn(['id' => 1, 'nombre' => 'Excavadora', 'marca' => 'CAT']);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new MaquinariaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $maquinaria = $controller->mostrarFormularioEditar(1);

        // Verificar que el método devuelve la maquinaria esperada para editar
        $this->assertEquals(['id' => 1, 'nombre' => 'Excavadora', 'marca' => 'CAT'], $maquinaria);
    }
}
?>
