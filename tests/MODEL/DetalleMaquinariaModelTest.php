<?php
namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\DetalleMaquinariaModel;

class DetalleMaquinariaModelTest extends TestCase {
    protected $model;
    protected $mockDb;

    protected function setUp(): void {
        parent::setUp();
        // Crear un mock de la conexión a la base de datos
        $this->mockDb = $this->createMock(\mysqli::class);

        // Pasar el mock de la base de datos al modelo
        $this->model = new DetalleMaquinariaModel($this->mockDb);
    }

    public function testListarDetalleMaquinaria() {
        // Simular resultados de la base de datos esperados
        $mockResult = $this->getMockBuilder(\mysqli_result::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        // Datos simulados
        $mockRows = [
            ['iddetalle' => 567, 'idmaquinaria' => 567, 'imagen1' => NULL, 'imagen2' => NULL, 'imagen3' => NULL, 'modelo3d' => '', 'descripcion' => 'dasdsadasdasdasdadas hidráulica Caterpillar 320D es una máquina versátil diseñada para una variedad de aplicaciones de excavación. Con un motor potente y un sistema hidráulico eficiente, esta excavadora ofrece un rendimiento excepcional en cualquier sitio de trabajo. Su diseño duradero y su cabina cómoda hacen que sea una opción popular entre los operadores de maquinaria pesada.'],
            ['iddetalle' => 568, 'idmaquinaria' => 568, 'imagen1' => 'server-icon.png', 'imagen2' => NULL, 'imagen3' => NULL, 'modelo3d' => 'modelo3d_666fbdffe51e74.24586243', 'descripcion' => 'dfdaddfdfsdaD65EX-17 es una máquina robusta diseñada para tareas de nivelación y movimiento de tierras en proyectos de construcción y minería. Con su potente motor y su cuchilla frontal resistente, este bulldozer ofrece un rendimiento excepcional en terrenos difíciles. Su cabina espaciosa y ergonómica proporciona comodidad y seguridad para el operador durante largas jornadas de trabajo.'],
            ['iddetalle' => 569, 'idmaquinaria' => 569, 'imagen1' => 'imagen1.jpg', 'imagen2' => 'imagen2.png', 'imagen3' => 'imagen3.png', 'modelo3d' => 'Modelo', 'descripcion' => 'PRUEBAAAAAAAA ASASLiebherr LTM h1200-5.1 es una máquina potente y versátil diseñada para la elevación de cargas pesadas en proyectos de construcción y montaje industrial. Con su brazo telescópico y su sistema de contrapeso ajustable, esta grúa ofrece una gran capacidad de elevación y un alcance impresionante. Su cabina confortable y su avanzado sistema de control hacen que sea fácil de operar incluso en condiciones exigentes.']
        ];

        // Configurar el mock para el método fetch_assoc
        $mockResult->expects($this->any())
                   ->method('fetch_assoc')
                   ->willReturnOnConsecutiveCalls($mockRows[0], $mockRows[1], $mockRows[2], null);

        // Configurar el mock para el método query
        $this->mockDb->expects($this->once())
                     ->method('query')
                     ->with("SELECT * FROM tbdetallemaquinaria")
                     ->willReturn($mockResult);

        // Ejecutar el método a probar
        $result = $this->model->listarDetalleMaquinaria();

        // Afirmar que se devuelva un array con al menos un detalle
        $this->assertIsArray($result);
        $this->assertCount(3, $result); // Verificar que se devuelvan exactamente tres detalles
        $this->assertEquals('dasdsadasdasdasdadas hidráulica Caterpillar 320D es una máquina versátil diseñada para una variedad de aplicaciones de excavación. Con un motor potente y un sistema hidráulico eficiente, esta excavadora ofrece un rendimiento excepcional en cualquier sitio de trabajo. Su diseño duradero y su cabina cómoda hacen que sea una opción popular entre los operadores de maquinaria pesada.', $result[0]['descripcion']); // Verificar un detalle específico
    }

    public function testObtenerDetallePorId() {
        $idDetalle = 567;
        $mockDetalle = ['iddetalle' => $idDetalle, 'idmaquinaria' => 567, 'imagen1' => NULL, 'imagen2' => NULL, 'imagen3' => NULL, 'modelo3d' => '', 'descripcion' => 'dasdsadasdasdasdadas hidráulica Caterpillar 320D es una máquina versátil diseñada para una variedad de aplicaciones de excavación. Con un motor potente y un sistema hidráulico eficiente, esta excavadora ofrece un rendimiento excepcional en cualquier sitio de trabajo. Su diseño duradero y su cabina cómoda hacen que sea una opción popular entre los operadores de maquinaria pesada.'];

        // Configurar el mock para el método prepare
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with('i', $idDetalle);
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        // Crear un mock de mysqli_result para el método get_result()
        $mockResult = $this->createMock(\mysqli_result::class);
        $mockResult->expects($this->once())
                   ->method('fetch_assoc')
                   ->willReturn($mockDetalle);

        $mockStmt->expects($this->once())
                 ->method('get_result')
                 ->willReturn($mockResult);

        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->with("SELECT * FROM tbdetallemaquinaria WHERE iddetalle = ?")
                     ->willReturn($mockStmt);

        // Ejecutar el método a probar
        $result = $this->model->obtenerDetallePorId($idDetalle);

        // Afirmar que se obtenga el detalle correcto
        $this->assertIsArray($result);
        $this->assertEquals($mockDetalle, $result);
        $this->assertEquals('dasdsadasdasdasdadas hidráulica Caterpillar 320D es una máquina versátil diseñada para una variedad de aplicaciones de excavación. Con un motor potente y un sistema hidráulico eficiente, esta excavadora ofrece un rendimiento excepcional en cualquier sitio de trabajo. Su diseño duradero y su cabina cómoda hacen que sea una opción popular entre los operadores de maquinaria pesada.', $result['descripcion']); // Verificar la descripción del detalle obtenido
    }

    public function testActualizarDetalle() {
        $data = [
            'id' => 1,
            'idmaquinaria' => 201,
            'descripcion' => 'Nueva descripción'
        ];

        // Configurar el mock para el método prepare(), bind_param() y execute()
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with('isi', $data['idmaquinaria'], $data['descripcion'], $data['id'])
                 ->willReturn(true);
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->with("UPDATE tbdetallemaquinaria SET idmaquinaria = ?, descripcion = ? WHERE iddetalle = ?")
                     ->willReturn($mockStmt);

        // Ejecutar el método a probar
        $result = $this->model->actualizarDetalle($data);

        // Afirmar que la actualización fue exitosa
        $this->assertTrue($result);
    }

    public function testEliminarDetalle() {
        $idDetalle = 1;

        // Configurar el mock para el método prepare(), bind_param() y execute()
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $mockStmt->expects($this->once())
                 ->method('bind_param')
                 ->with('i', $idDetalle);
        $mockStmt->expects($this->once())
                 ->method('execute')
                 ->willReturn(true);

        $this->mockDb->expects($this->once())
                     ->method('prepare')
                     ->with("DELETE FROM tbdetallemaquinaria WHERE iddetalle = ?")
                     ->willReturn($mockStmt);

        // Ejecutar el método a probar
        $result = $this->model->eliminarDetalle($idDetalle);

        // Afirmar que el detalle fue eliminado correctamente
        $this->assertTrue($result);
    }
}
?>
