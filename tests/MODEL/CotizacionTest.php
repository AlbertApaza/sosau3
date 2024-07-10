<?php
use PHPUnit\Framework\TestCase;
use App\Model\Cotizacion;
use mysqli;
use PHPUnit\Framework\MockObject\MockObject;
use DB\Conectar;

class CotizacionTest extends TestCase {
    private $conexionMock;
	private $conexion;
    private $cotizacion;

    protected function setUp(): void {
        parent::setUp();
        $this->conexionMock = $this->getMockBuilder(mysqli::class)->disableOriginalConstructor()->getMock();
		$this->conexion = Conectar::conexion();
        $this->cotizacion = new Cotizacion($this->conexion);
    }
	         
public function testActualizarCotizacion() {
    $idcliente = 10;
    $idcotizacion = $this->cotizacion->agregarCotizacion($idcliente);

    $this->assertGreaterThan(0, $idcotizacion);

    $nuevoIdCliente = 20;
    $idmaquinaria = 662;
    $idlugar = 1;
    $total = 1500;
    $tiempo = 8;

    $resultado = $this->cotizacion->actualizarCotizacion($idcotizacion, $nuevoIdCliente, $idmaquinaria, $idlugar, $total, $tiempo);

    $this->assertTrue($resultado);

    $resultadoConsulta = $this->conexion->query("SELECT * FROM tbcotizacion WHERE idcotizacion = $idcotizacion");
    $cotizacionActualizada = $resultadoConsulta->fetch_assoc();

    $this->assertEquals($nuevoIdCliente, $cotizacionActualizada['idcliente']);
    $this->assertEquals($idmaquinaria, $cotizacionActualizada['idmaquinaria']);
    $this->assertEquals($idlugar, $cotizacionActualizada['idlugar']);
    $this->assertEquals($total, $cotizacionActualizada['total']);
    $this->assertEquals($tiempo, $cotizacionActualizada['tiempo']);

    //$this->conexion->query("DELETE FROM tbcotizacion WHERE idcotizacion = $idcotizacion");
}

    public function testAgregarCotizacion() {
        $idcliente = 10;

        $idcotizacion = $this->cotizacion->agregarCotizacion($idcliente);

        $this->assertGreaterThan(0, $idcotizacion);

        $resultado = $this->conexion->query("SELECT * FROM tbcotizacion WHERE idcotizacion = $idcotizacion");
        $this->assertTrue($resultado->num_rows > 0);

        $this->conexion->query("DELETE FROM tbcotizacion WHERE idcotizacion = $idcotizacion");
    }

    public function testObtenerClientePorId() {
        $this->conexionMock->expects($this->once())->method('prepare')->willReturn($stmtMock = $this->createMock(mysqli_stmt::class));
        $stmtMock->expects($this->once())->method('execute')->willReturn(true);
        $clienteSimulado = ['idcliente' => 1, 'nombre' => 'Cliente A'];
        $mockedResult = $this->getMockBuilder(mysqli_result::class)->disableOriginalConstructor()->getMock();
        $mockedResult->expects($this->once())->method('fetch_assoc')->willReturn($clienteSimulado);
        $stmtMock->expects($this->once())->method('get_result')->willReturn($mockedResult);
        $cotizacion = new Cotizacion($this->conexionMock);
        $clienteObtenido = $cotizacion->obtenerClientePorId(1);
        $this->assertEquals($clienteSimulado, $clienteObtenido);
    }

    public function testObtenerMaquinariaPorId() {
        $this->conexionMock->expects($this->once())->method('prepare')->willReturn($stmtMock = $this->createMock(mysqli_stmt::class));
        $stmtMock->expects($this->once())->method('execute')->willReturn(true);
        $maquinariaSimulada = ['idmaquinaria' => 1, 'nombre' => 'Maquinaria A'];
        $mockedResult = $this->getMockBuilder(mysqli_result::class)->disableOriginalConstructor()->getMock();
        $mockedResult->expects($this->once())->method('fetch_assoc')->willReturn($maquinariaSimulada);
        $stmtMock->expects($this->once())->method('get_result')->willReturn($mockedResult);
        $cotizacion = new Cotizacion($this->conexionMock);
        $maquinariaObtenida = $cotizacion->obtenerMaquinariaPorId(1);
        $this->assertEquals($maquinariaSimulada, $maquinariaObtenida);
    }

    public function testObtenerLugarPorId() {
        $this->conexionMock->expects($this->once())->method('prepare')->willReturn($stmtMock = $this->createMock(mysqli_stmt::class));
        $stmtMock->expects($this->once())->method('execute')->willReturn(true);
        $lugaresSimulados = ['idlugar' => 1, 'nombre' => 'Lugar A'];
        $mockedResult = $this->getMockBuilder(mysqli_result::class)->disableOriginalConstructor()->getMock();
        $mockedResult->expects($this->once())->method('fetch_assoc')->willReturn($lugaresSimulados);
        $stmtMock->expects($this->once())->method('get_result')->willReturn($mockedResult);
        $cotizacion = new Cotizacion($this->conexionMock);
        $lugarObtenido = $cotizacion->obtenerLugarPorId(1);
        $this->assertEquals($lugaresSimulados, $lugarObtenido);
    }

    public function testObtenerTodosLugares() {
        $cotizacion = new Cotizacion($this->conexionMock);
        $lugaresSimulados = [['idlugar' => 1, 'nombre' => 'Lugar A'], ['idlugar' => 2, 'nombre' => 'Lugar B']];
        $this->conexionMock->expects($this->once())->method('query')->willReturn($this->createMockedResultSet($lugaresSimulados));
        $lugaresObtenidos = $cotizacion->obtenerTodosLugares();
        $this->assertEquals($lugaresSimulados, $lugaresObtenidos);
    }

    public function testObtenerTodasMaquinarias() {
        $cotizacion = new Cotizacion($this->conexionMock);
        $maquinariasSimuladas = [['idmaquinaria' => 1, 'nombre' => 'Maquinaria A'], ['idmaquinaria' => 2, 'nombre' => 'Maquinaria B']];
        $this->conexionMock->expects($this->once())->method('query')->willReturn($this->createMockedResultSet($maquinariasSimuladas));
        $maquinariasObtenidas = $cotizacion->obtenerTodasMaquinarias();
        $this->assertEquals($maquinariasSimuladas, $maquinariasObtenidas);
    }

    protected function createMockedResultSet(array $data): MockObject {
        $mockedResult = $this->getMockBuilder(mysqli_result::class)->disableOriginalConstructor()->getMock();
        $mockedResult->expects($this->any())->method('fetch_assoc')->will($this->onConsecutiveCalls(...array_map(fn($row) => $row, $data)));
        return $mockedResult;
    }

    protected function tearDown(): void {
        parent::tearDown();
        $this->conexionMock = null;
    }
}
?>
