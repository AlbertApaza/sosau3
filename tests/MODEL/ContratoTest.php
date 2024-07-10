<?php
namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Contrato;

class ContratoTest extends TestCase {
    private $db;
    private $contrato;

    protected function setUp(): void {
        // Crear un mock de la conexión de base de datos
        $this->db = $this->createMock(\mysqli::class);
        

        // Crear la instancia de Contrato con el mock de la base de datos
        $this->contrato = new Contrato($this->db);
    }

    public function testListarContrato() {
        $resultadoEsperado = [
            ["idcontrato" => '1', "idreserva" => '1', "idcotizacion" => '1'],
            ["idcontrato" => '2', "idreserva" => '2', "idcotizacion" => '2'],
        ];

        // Crear un mock de los resultados de la consulta
        $mockResult = $this->createMock(\mysqli_result::class);
        $mockResult->expects($this->exactly(3))
            ->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                $resultadoEsperado[0],
                $resultadoEsperado[1],
                null
            );

        // Configurar el mock de la base de datos para devolver el mock de los resultados
        $this->db->expects($this->once())
            ->method('query')
            ->with($this->equalTo("SELECT * FROM tbcontrato"))
            ->willReturn($mockResult);

        $result = $this->contrato->listarContrato();
        $this->assertEquals($resultadoEsperado, $result);
    }

    public function testAgregarContrato() {
        // Crear un mock para el statement de la consulta preparada
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $this->db->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("INSERT INTO tbcontrato (idreserva, idcotizacion) VALUES (?, ?)"))
            ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("ii"), $this->equalTo(1), $this->equalTo(1))
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('close');

        $result = $this->contrato->agregarContrato(1, 1);
        $this->assertTrue($result);
    }

    public function testEditarContrato() {
        // Crear un mock para el statement de la consulta preparada
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $this->db->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("UPDATE tbcontrato SET idreserva = ?, idcotizacion = ? WHERE idcontrato = ?"))
            ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("iii"), $this->equalTo(1), $this->equalTo(1), $this->equalTo(1))
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('close');

        $result = $this->contrato->editarContrato(1, 1, 1);
        $this->assertTrue($result);
    }

    public function testEliminarContrato() {
        $idcontrato = 1;

        // Mock del statement preparado
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("i"), $this->equalTo($idcontrato))
            ->willReturn(true);
        
        $mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('close');

        // Mock de la ejecución de la consulta
        $this->db->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("DELETE FROM tbcontrato WHERE idcontrato = ?"))
            ->willReturn($mockStmt);

        // Llamar al método bajo prueba simulando que una fila fue afectada
        $result = $this->contrato->eliminarContrato($idcontrato, 1);

        // Verificar que se haya eliminado correctamente
        $this->assertTrue($result);
    }
    // Otros métodos de prueba...
    public function testBuscarContrato() {
        $resultadoEsperado = [
            ["idcontrato" => '1', "idreserva" => '1', "idcotizacion" => '1'],
        ];

        // Crear un mock de los resultados de la consulta
        $mockResult = $this->createMock(\mysqli_result::class);
        $mockResult->expects($this->exactly(2))
            ->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                $resultadoEsperado[0],
                null
            );

        // Crear un mock para el statement de la consulta preparada
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $this->db->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("SELECT * FROM tbcontrato WHERE idreserva LIKE ? OR idcotizacion LIKE ?"))
            ->willReturn($mockStmt);

        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("ss"), $this->anything(), $this->anything())
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('get_result')
            ->willReturn($mockResult);

        $mockStmt->expects($this->once())
            ->method('close');

        $result = $this->contrato->buscarContrato('1');
        $this->assertEquals($resultadoEsperado, $result);
    }

    public function testObtenerContratoPorId() {
        // Datos esperados del contrato
        $idcontrato = 1;
        $contratoEsperado = [
            "idcontrato" => '1',  // Asegúrate de que los índices coincidan con los nombres de las columnas en tu base de datos
            "idreserva" => '7',
            "idcotizacion" => '1',
            // Añadir más campos según sea necesario
        ];

        // Crear un mock del resultado de la consulta
        $mockResult = $this->createMock(\mysqli_result::class);
        $mockResult->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn($contratoEsperado);

        // Crear un mock del statement
        $mockStmt = $this->createMock(\mysqli_stmt::class);
        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("i"), $this->equalTo($idcontrato));
        
        $mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('get_result')
            ->willReturn($mockResult);

        $this->db->expects($this->once())
            ->method('prepare')
            ->willReturn($mockStmt);

        // Llamar al método bajo prueba
        $result = $this->contrato->obtenerContratoPorId($idcontrato);

        // Verificar que el resultado retornado sea el esperado
        $this->assertEquals($contratoEsperado, $result);
    }
}
?>
