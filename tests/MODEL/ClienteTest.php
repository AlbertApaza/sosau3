<?php
namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Cliente;

class ClienteTest extends TestCase {
    protected $cliente;

    protected function setUp(): void {
        parent::setUp();
        $this->cliente = new Cliente();
    }

    public function testListarClientes() {
        $clientes = $this->cliente->listarClientes();
        $this->assertIsArray($clientes);
        // Aquí puedes añadir más aserciones según lo que esperas en tus datos de prueba
    }

    public function testAgregarCliente() {
        $nombre = "Juan";
        $apellido = "Perez";
        $correo = "juan@example.com";
        $iddocumento = "DNI";
        $documento = "12345678";
        $telefono = "987654321";

        $resultado = $this->cliente->agregarCliente($nombre, $apellido, $correo, $iddocumento, $documento, $telefono);
        $this->assertTrue($resultado);
        
        $clienteAgregado = $this->cliente->obtenerClientePorId($this->cliente->obtenerUltimoIdCliente());
        $this->assertEquals($nombre, $clienteAgregado['nombre']);
        $this->assertEquals($apellido, $clienteAgregado['apellido']);
        $this->assertEquals($correo, $clienteAgregado['correo']);
    }

    public function testEditarCliente() {
        $idcliente = 3;
        $nombre = "Nuevo Nombre";
        $apellido = "Nuevo Apellido";
        $correo = "nuevo@example.com";
        $iddocumento = "DNI";
        $documento = "87654321";
        $telefono = "123456789";

        $resultado = $this->cliente->editarCliente($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono);
        $this->assertTrue($resultado);

        // Verificar que el cliente se ha editado correctamente
        $clienteEditado = $this->cliente->obtenerClientePorId($idcliente);
        $this->assertEquals($nombre, $clienteEditado['nombre']);
        $this->assertEquals($apellido, $clienteEditado['apellido']);
        $this->assertEquals($correo, $clienteEditado['correo']);
        // Agrega más aserciones según sea necesario
    }

public function testEliminarCliente() {
    $idcliente = 235; // Asegúrate de que este ID exista en tu base de datos de prueba

    $resultado = $this->cliente->eliminarCliente($idcliente);

    $this->assertTrue($resultado, "La eliminación del cliente no fue exitosa.");

    $conexion = Conectar::conexion(); // Asegúrate de tener una forma de conexión aquí

    $query = "SELECT * FROM tbcliente WHERE idcliente = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idcliente);
    $stmt->execute();
    $stmt->store_result();

    $this->assertEquals(0, $stmt->num_rows, "El cliente todavía existe en la base de datos después de eliminarlo.");

    $stmt->close();
    $conexion->close();
}



	public function testObtenerClienteExistentePorId() {
        // Asume que este ID de cliente existe en tus datos de prueba
        $idclienteExistente = 1;

        // Ejecutar el método y obtener el cliente
        $cliente = $this->cliente->obtenerClientePorId($idclienteExistente);

        // Verificar que se obtenga un array con datos
        $this->assertIsArray($cliente);
        $this->assertNotEmpty($cliente);

        // Verificar que el cliente obtenido tenga los campos esperados
        $this->assertArrayHasKey('idcliente', $cliente);
        $this->assertArrayHasKey('nombre', $cliente);
        $this->assertArrayHasKey('apellido', $cliente);
        $this->assertArrayHasKey('correo', $cliente);
        $this->assertArrayHasKey('iddocumento', $cliente);
        $this->assertArrayHasKey('documento', $cliente);
        $this->assertArrayHasKey('telefono', $cliente);

    }

    public function testBuscarCliente() {
        $termino = "1";

        $clientesEncontrados = $this->cliente->buscarCliente($termino);
        $this->assertIsArray($clientesEncontrados);
        // Aquí puedes añadir más aserciones según lo que esperas en tus datos de prueba
    }

    protected function tearDown(): void {
        parent::tearDown();
        // Aquí podrías agregar código para limpiar datos de prueba o cerrar recursos
    }
}
?>
