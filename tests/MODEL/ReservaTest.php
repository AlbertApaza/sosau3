<?php
namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Reserva;

class ReservaTest extends TestCase {
    protected $reserva;

    protected function setUp(): void {
        parent::setUp();
        $this->reserva = new Reserva();
    }

    // Test para verificar el listado de reservas
    public function testListarReserva() {
        $reservas = $this->reserva->listarReserva();
        $this->assertIsArray($reservas);
        // Aquí puedes añadir más aserciones según lo que esperas en tus datos de prueba
    }

    // Test para agregar una reserva nueva
    public function testAgregarReserva() {
        $resultado = $this->reserva->agregarReserva(205, 639, 1, 1, '2024-06-18 01:37:05', '2024-06-18 01:37:07', '2024-06-18 01:37:08', 1);
        $this->assertTrue($resultado);
    }
    

    // Test para editar una reserva existente
    public function testEditarReserva() {
        $idReservaExistente = 8;
        $resultado = $this->reserva->editarReserva($idReservaExistente, 34, 639, 3, 1, '2024-06-30 00:00:00', '2024-07-01 00:00:00', '2024-07-02 00:00:00', 1);
        $this->assertTrue($resultado);
    }

    // Test para eliminar una reserva existente
    public function testEliminarReserva() {
        $idReservaExistente = 12;
        $resultado = $this->reserva->eliminarReserva($idReservaExistente);
        $this->assertTrue($resultado);
    }

    // Test para buscar reservas por término
    public function testBuscarReserva() {
        $termino = 567;
        $reservasEncontradas = $this->reserva->buscarReserva($termino);
        $this->assertIsArray($reservasEncontradas);
        // Aquí puedes añadir más aserciones según lo que esperas en tus datos de prueba
    }

    // Test para obtener reserva por ID
    public function testObtenerReservaPorId() {
        // Primero, asegúrate de tener un ID de reserva existente en tu base de datos para probar la obtención por ID
        $idReservaExistente = 7;
        $reserva = $this->reserva->obtenerReservaPorId($idReservaExistente);
        $this->assertNotNull($reserva);
        // Aquí puedes añadir más aserciones según lo que esperas en tus datos de prueba
    }
}
?>
