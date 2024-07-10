<?php
namespace Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\ClienteController;
use App\Model\Cliente;

class ClienteControllerTest extends TestCase
{
    public function testListarClienteAdmin()
    {
        // Crear un mock del modelo Cliente
        $mockModel = $this->createMock(Cliente::class);
        $mockModel->method('listarClientes')
                  ->willReturn([
                      ['idcliente' => 1, 'nombre' => 'Cliente 1', 'apellido' => 'Apellido 1', 'correo' => 'cliente1@example.com'],
                      ['idcliente' => 2, 'nombre' => 'Cliente 2', 'apellido' => 'Apellido 2', 'correo' => 'cliente2@example.com']
                  ]);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ClienteController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $clientes = $controller->listarClienteAdmin();

        // Verificar que el método devuelve los clientes esperados
        $this->assertCount(2, $clientes);
        $this->assertEquals(['idcliente' => 1, 'nombre' => 'Cliente 1', 'apellido' => 'Apellido 1', 'correo' => 'cliente1@example.com'], $clientes[0]);
        $this->assertEquals(['idcliente' => 2, 'nombre' => 'Cliente 2', 'apellido' => 'Apellido 2', 'correo' => 'cliente2@example.com'], $clientes[1]);
    }

    public function testAgregarClienteAdmin()
    {
        // Crear un mock del modelo Cliente
        $mockModel = $this->createMock(Cliente::class);
        $mockModel->expects($this->once())
                  ->method('agregarCliente')
                  ->with('Nombre', 'Apellido', 'cliente@example.com', 'DNI', '12345678', '123456789');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ClienteController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->agregarClienteAdmin('Nombre', 'Apellido', 'cliente@example.com', 'DNI', '12345678', '123456789');
    }

    public function testEditarClienteAdmin()
    {
        // Crear un mock del modelo Cliente
        $mockModel = $this->createMock(Cliente::class);
        $mockModel->expects($this->once())
                  ->method('editarCliente')
                  ->with(1, 'Nombre', 'Apellido', 'cliente@example.com', 'DNI', '12345678', '123456789');

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ClienteController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $controller->editarClienteAdmin(1, 'Nombre', 'Apellido', 'cliente@example.com', 'DNI', '12345678', '123456789');
    }

    public function testEliminarClienteAdmin()
    {
        // Crear un mock del modelo Cliente
        $mockModel = $this->createMock(Cliente::class);
        $mockModel->method('eliminarCliente')
                  ->willReturn(true);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ClienteController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $resultado = $controller->eliminarClienteAdmin(1);

        // Verificar que el método devuelve true cuando se elimina correctamente
        $this->assertTrue($resultado);
    }

    public function testBuscarClienteAdmin()
    {
        // Crear un mock del modelo Cliente
        $mockModel = $this->createMock(Cliente::class);
        $mockModel->method('buscarCliente')
                  ->with('buscar término')
                  ->willReturn([
                      ['idcliente' => 1, 'nombre' => 'Cliente 1', 'apellido' => 'Apellido 1', 'correo' => 'cliente1@example.com']
                  ]);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ClienteController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $clientes = $controller->buscarClienteAdmin('buscar término');

        // Verificar que el método devuelve los clientes esperados
        $this->assertCount(1, $clientes);
        $this->assertEquals(['idcliente' => 1, 'nombre' => 'Cliente 1', 'apellido' => 'Apellido 1', 'correo' => 'cliente1@example.com'], $clientes[0]);
    }

    public function testMostrarFormularioEditar()
    {
        // Crear un mock del modelo Cliente
        $mockModel = $this->createMock(Cliente::class);
        $mockModel->method('obtenerClientePorId')
                  ->with(1)
                  ->willReturn(['idcliente' => 1, 'nombre' => 'Cliente 1', 'apellido' => 'Apellido 1', 'correo' => 'cliente1@example.com']);

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ClienteController($mockModel);

        // Ejecutar el método del controlador que queremos probar
        $cliente = $controller->mostrarFormularioEditar(1);

        // Verificar que el método devuelve el cliente esperado
        $this->assertEquals(['idcliente' => 1, 'nombre' => 'Cliente 1', 'apellido' => 'Apellido 1', 'correo' => 'cliente1@example.com'], $cliente);
    }

    // Puedes añadir más métodos de prueba para otros métodos del controlador ClienteController
}
?>
