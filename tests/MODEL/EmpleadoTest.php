<?php
namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Empleado;

class EmpleadoTest extends TestCase {
    private $db;
    private $empleado;

    protected function setUp(): void {
        // Crear un mock de la conexión de base de datos
        $this->db = $this->createMock(\mysqli::class);

        // Crear la instancia de Empleado con el mock de la base de datos
        $this->empleado = new Empleado($this->db);
    }

    public function testListarEmpleados() {
        $resultadoEsperado = [
            ["idempleado" => '1', "nombre" => 'Juan', "apellido" => 'Perez', "idcargo" => '1', "dni" => '12345678'],
            ["idempleado" => '2', "nombre" => 'Maria', "apellido" => 'Lopez', "idcargo" => '2', "dni" => '87654321'],
        ];

        // Crear un mock de los resultados de la consulta
        $mockResult = $this->createMock(\mysqli_result::class);
        $mockResult->expects($this->exactly(3))
            ->method('fetch_assoc')
            ->will($this->onConsecutiveCalls(
                $resultadoEsperado[0],
                $resultadoEsperado[1],
                null
            ));

        // Configurar el mock de la base de datos para devolver el mock de los resultados
        $this->db->expects($this->once())
            ->method('query')
            ->with($this->equalTo("SELECT * FROM tbempleado"))
            ->willReturn($mockResult);

        $result = $this->empleado->listarEmpleados();
        $this->assertEquals($resultadoEsperado, $result);
    }

    // Puedes agregar más tests para otros métodos aquí
}
?>
