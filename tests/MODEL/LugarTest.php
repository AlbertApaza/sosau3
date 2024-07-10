<?php

namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Lugar;
use mysqli;
use mysqli_result;
use PHPUnit\Framework\MockObject\MockObject;

class LugarTest extends TestCase
{
    /** @var mysqli|MockObject */
    private $dbMock;

    /** @var Lugar */
    private $lugar;

    protected function setUp(): void
    {
        // Crear un mock de la conexión a la base de datos
        $this->dbMock = $this->createMock(mysqli::class);
        
        // Crear la instancia de Lugar usando el mock de la base de datos
        $this->lugar = new Lugar($this->dbMock);
    }

    public function testObtenerTodosLugares()
    {
        // Crear un mock del resultado de la consulta
        $resultMock = $this->createMock(mysqli_result::class);

        // Configurar el mock para que devuelva los valores esperados
        $resultMock->method('num_rows')->willReturn(2);
        $resultMock->method('fetch_assoc')->willReturnOnConsecutiveCalls(
            ['idlugar' => 1, 'ciudad' => 'Ciudad 1'],
            ['idlugar' => 2, 'ciudad' => 'Ciudad 2'],
            null // Para simular el final del fetch_assoc
        );

        // Configurar el mock de la base de datos para que devuelva el resultado esperado
        $this->dbMock->method('query')->willReturn($resultMock);

        // Ejecutar el método a probar
        $lugares = $this->lugar->obtenerTodosLugares();

        // Verificar que el resultado es el esperado
        $this->assertCount(2, $lugares);
        $this->assertEquals(['idlugar' => 1, 'ciudad' => 'Ciudad 1'], $lugares[0]);
        $this->assertEquals(['idlugar' => 2, 'ciudad' => 'Ciudad 2'], $lugares[1]);
    }

    public function testObtenerTodosLugaresError()
    {
        // Configurar el mock de la base de datos para que lance una excepción
        $this->dbMock->method('query')->will($this->throwException(new \Exception('DB Error')));

        // Ejecutar el método a probar y verificar que devuelve false en caso de error
        $this->assertFalse($this->lugar->obtenerTodosLugares());
    }
}
?>
