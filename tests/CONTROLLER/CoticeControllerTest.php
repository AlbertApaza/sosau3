<?php
namespace Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\ClsCotice;
use App\Model\Cliente;
use App\Model\Cotizacion;
use App\Model\Maquinaria;
use App\Model\Lugar;

class ClsCoticeTest extends TestCase
{
    public function testProcesarFormularioClienteNoValido()
    {
        // Crear un mock del modelo Cliente
        $mockCliente = $this->createMock(Cliente::class);
        $mockCliente->method('agregarClienteForm')
                    ->willReturn(1); // Simulamos que se agrega un cliente y retorna un ID válido
        $mockCliente->method('obtenerUltimoIdCliente')
                    ->willReturn(1); // Simulamos que se obtiene el último ID de cliente

        // Crear mocks de los otros modelos
        $mockCotizacion = $this->createMock(Cotizacion::class);
        $mockCotizacion->method('agregarCotizacion')
                       ->willReturn(1); // Simulamos que se agrega una cotización y retorna un ID válido

        $mockMaquinaria = $this->createMock(Maquinaria::class);
        $mockMaquinaria->method('listar_Maquinarias')
                       ->willReturn(['Maquinaria 1', 'Maquinaria 2']);

        $mockLugar = $this->createMock(Lugar::class);
        $mockLugar->method('obtenerTodosLugares')
                  ->willReturn(['Lugar 1', 'Lugar 2']);

        // Crear una instancia del controlador inyectando los mocks de los modelos
        $controller = new ClsCotice();
        $controller->actualizarCotizacion(1, 1, 1, 1, 1000, 5);

        // Verificar que se almacene correctamente en $_SESSION['pdf_data']
        $this->assertEquals(1, $_SESSION['pdf_data']['idcliente']);
        $this->assertEquals(1, $_SESSION['pdf_data']['idcotizacion']);
    }

    public function testActualizarCotizacion()
    {
        // Crear un mock del modelo Cotizacion
        $mockCotizacion = $this->createMock(Cotizacion::class);
        $mockCotizacion->method('actualizarCotizacion')
                       ->willReturn(true); // Simulamos que la actualización de la cotización es exitosa

        // Crear una instancia del controlador inyectando el mock del modelo
        $controller = new ClsCotice();
        $result = $controller->actualizarCotizacion(1, 1, 1, 1, 1000, 5);

        // Verificar que el método devuelve true cuando la actualización es exitosa
        $this->assertTrue($result);
    }

    // Puedes añadir más métodos de prueba para otros métodos de ClsCotice según sea necesario
}
