<?php
namespace Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\DetalleMaquinariaController;
use App\Model\DetalleMaquinariaModel;

class DetalleMaquinariaControllerTest extends TestCase {
    protected $controller;
    protected $detalleMaquinariaModel;
    protected $mockDb;

    protected function setUp(): void {
        parent::setUp();

        // Crear un mock de DetalleMaquinariaModel
        $this->detalleMaquinariaModel = $this->createMock(DetalleMaquinariaModel::class);

        // Crear un mock de PDO o mysqli
        $this->mockDb = $this->createMock(\PDO::class); // Puedes usar \mysqli si prefieres

        // Pasa el mock de DetalleMaquinariaModel y el mock de base de datos al constructor de DetalleMaquinariaController
        $this->controller = new DetalleMaquinariaController($this->detalleMaquinariaModel, $this->mockDb);
    }
    
    public function testListarDetalleMaquinariaAdmin()
    {
        // Simular resultados de la base de datos esperados
        $mockDetalles = [
            ['iddetalle' => 567, 'idmaquinaria' => 567, 'imagen1' => NULL, 'imagen2' => NULL, 'imagen3' => NULL, 'modelo3d' => '', 'descripcion' => 'Descripción 1'],
            ['iddetalle' => 568, 'idmaquinaria' => 568, 'imagen1' => 'imagen1.jpg', 'imagen2' => NULL, 'imagen3' => NULL, 'modelo3d' => 'modelo3d_1', 'descripcion' => 'Descripción 2'],
            ['iddetalle' => 569, 'idmaquinaria' => 569, 'imagen1' => 'imagen2.jpg', 'imagen2' => 'imagen2.png', 'imagen3' => 'imagen3.png', 'modelo3d' => 'modelo3d_2', 'descripcion' => 'Descripción 3'],
        ];

        // Configurar el mock para listarDetalleMaquinaria en DetalleMaquinariaModel
        $this->detalleMaquinariaModel->expects($this->once())
                                     ->method('listarDetalleMaquinaria')
                                     ->willReturn($mockDetalles);

        // Ejecutar el método del controlador a probar
        $detalles = $this->controller->listarDetalleMaquinariaAdmin();

        // Afirmar que se devuelva un array con los detalles esperados
        $this->assertIsArray($detalles);
        $this->assertCount(3, $detalles);
        $this->assertEquals('Descripción 1', $detalles[0]['descripcion']);
    }

    public function testObtenerDetallePorId() {
        $idDetalle = 567;
        $mockDetalle = ['iddetalle' => $idDetalle, 'idmaquinaria' => 567, 'descripcion' => 'Descripción detallada'];

        // Crear un mock de PDOStatement
        $mockStmt = $this->createMock(\PDOStatement::class);
        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->with("SELECT * FROM tbdetallemaquinaria WHERE iddetalle = ?")
                     ->willReturn($mockStmt);
        
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        $mockStmt->expects($this->once())
                 ->method('fetch')
                 ->willReturn($mockDetalle);

        $result = $this->controller->obtenerDetallePorId($idDetalle);

        $this->assertIsArray($result);
        $this->assertEquals($mockDetalle, $result);
        $this->assertEquals('Descripción detallada', $result['descripcion']);
    }

    public function testActualizarDetalle() {
        $data = [
            'id' => 1,
            'idmaquinaria' => 201,
            'descripcion' => 'Nueva descripción'
        ];

        // Crear un mock de PDOStatement
        $mockStmt = $this->createMock(\PDOStatement::class);
        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->with("UPDATE tbdetallemaquinaria SET idmaquinaria = ?, descripcion = ? WHERE iddetalle = ?")
                     ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        $result = $this->controller->actualizarDetalle($data);

        $this->assertTrue($result);
    }

    public function testEliminarDetalle() {
        $idDetalle = 1;

        // Crear un mock de PDOStatement
        $mockStmt = $this->createMock(\PDOStatement::class);
        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->with("DELETE FROM tbdetallemaquinaria WHERE iddetalle = ?")
                     ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        $result = $this->controller->eliminarDetalle($idDetalle);

        $this->assertTrue($result);
    }
}
?>
