<?php
use App\Controller\ReservaController;
use App\Model\Reserva;
use PHPUnit\Framework\TestCase;

class ReservaControllerTest extends TestCase
{
    public function testListarReservaAdmin()
    {
        // Crear un mock del modelo Reserva
        $mockModel = $this->createMock(Reserva::class);
        $mockModel->method('listarReserva')
                  ->willReturn([
                      ['idreserva' => 1, 'idcliente' => 1, 'idmaquinaria' => 1, 'fechareserva' => '2024-06-20', 'estado' => 'activo'],
                      ['idreserva' => 2, 'idcliente' => 2, 'idmaquinaria' => 2, 'fechareserva' => '2024-06-21', 'estado' => 'pendiente']
                  ]);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ReservaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $reservas = $controller->listarReservaAdmin();

        // Verificar que el método devuelve las reservas esperadas
        $this->assertCount(2, $reservas);
        $this->assertEquals(['idreserva' => 1, 'idcliente' => 1, 'idmaquinaria' => 1, 'fechareserva' => '2024-06-20', 'estado' => 'activo'], $reservas[0]);
        $this->assertEquals(['idreserva' => 2, 'idcliente' => 2, 'idmaquinaria' => 2, 'fechareserva' => '2024-06-21', 'estado' => 'pendiente'], $reservas[1]);
    }

    public function testAgregarReservaAdmin()
    {
        // Crear un mock del modelo Reserva
        $mockModel = $this->createMock(Reserva::class);
        $mockModel->expects($this->once())
                  ->method('agregarReserva')
                  ->with(1, 1, 1, 1, '2024-06-20', '2024-06-21', '2024-06-22', 'activo');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ReservaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->agregarReservaAdmin(1, 1, 1, 1, '2024-06-20', '2024-06-21', '2024-06-22', 'activo');
    }

    public function testEditarReservaAdmin()
    {
        // Crear un mock del modelo Reserva
        $mockModel = $this->createMock(Reserva::class);
        $mockModel->expects($this->once())
                  ->method('editarReserva')
                  ->with(1, 1, 1, 1, 1, '2024-06-20', '2024-06-21', '2024-06-22', 'activo');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ReservaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->editarReservaAdmin(1, 1, 1, 1, 1, '2024-06-20', '2024-06-21', '2024-06-22', 'activo');
    }

    public function testEliminarReservaAdmin()
    {
        // Crear un mock del modelo Reserva
        $mockModel = $this->createMock(Reserva::class);
        $mockModel->method('eliminarReserva')
                  ->willReturn(true);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ReservaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $resultado = $controller->eliminarReservaAdmin(1);

        // Verificar que el método devuelve true cuando se elimina correctamente
        $this->assertTrue($resultado);
    }

    public function testBuscarReservaAdmin()
    {
        // Crear un mock del modelo Reserva
        $mockModel = $this->createMock(Reserva::class);
        $mockModel->method('buscarReserva')
                  ->with('buscar término')
                  ->willReturn([
                      ['idreserva' => 1, 'idcliente' => 1, 'idmaquinaria' => 1, 'fechareserva' => '2024-06-20', 'estado' => 'activo']
                  ]);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ReservaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $reservas = $controller->buscarReservaAdmin('buscar término');

        // Verificar que el método devuelve las reservas esperadas
        $this->assertCount(1, $reservas);
        $this->assertEquals(['idreserva' => 1, 'idcliente' => 1, 'idmaquinaria' => 1, 'fechareserva' => '2024-06-20', 'estado' => 'activo'], $reservas[0]);
    }

    public function testMostrarFormularioEditar()
    {
        // Crear un mock del modelo Reserva
        $mockModel = $this->createMock(Reserva::class);
        $mockModel->method('obtenerReservaPorId')
                  ->with(1)
                  ->willReturn(['idreserva' => 1, 'idcliente' => 1, 'idmaquinaria' => 1, 'fechareserva' => '2024-06-20', 'estado' => 'activo']);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ReservaController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $reserva = $controller->mostrarFormularioEditar(1);

        // Verificar que el método devuelve la reserva esperada
        $this->assertEquals(['idreserva' => 1, 'idcliente' => 1, 'idmaquinaria' => 1, 'fechareserva' => '2024-06-20', 'estado' => 'activo'], $reserva);
    }
}
?>
