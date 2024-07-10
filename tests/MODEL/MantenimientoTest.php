<?php

namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Mantenimiento;

class MantenimientoTest extends TestCase
{
    protected $mantenimiento;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mantenimiento = new Mantenimiento();
    }

    // Test para verificar la operación de listar mantenimientos
    public function testListarMantenimientos()
    {
        // Obtener los mantenimientos desde el método listarMantenimiento()
        $mantenimientos = $this->mantenimiento->listarMantenimiento();

        // Verificar que el resultado sea un array
        $this->assertIsArray($mantenimientos);

        // Verificar que el array no esté vacío (al menos un mantenimiento)
        $this->assertNotEmpty($mantenimientos);

        // Verificar la estructura de cada mantenimiento en el listado
        foreach ($mantenimientos as $mantenimiento) {
            $this->assertArrayHasKey('idmantenimiento', $mantenimiento);
            $this->assertArrayHasKey('idmaquinaria', $mantenimiento);
            $this->assertArrayHasKey('fecha', $mantenimiento);
            $this->assertArrayHasKey('descripcion', $mantenimiento);
            $this->assertArrayHasKey('costopro', $mantenimiento);
            $this->assertArrayHasKey('idempleado', $mantenimiento);
            $this->assertArrayHasKey('estado', $mantenimiento);
            $this->assertArrayHasKey('tipo', $mantenimiento);
            // Puedes agregar más aserciones según los campos que esperas en cada mantenimiento
        }
    }

    // Test para verificar la operación de agregar mantenimiento
    public function testAgregarMantenimiento()
    {
        // Datos de ejemplo para agregar un mantenimiento
        $idmaquinaria = 639;
        $fecha = '2024-06-20';
        $descripcion = 'Mantenimiento preventivo';
        $costopro = 250.50;
        $idempleado = 1;
        $estado = 1;
        $tipo = 1;

        // Llamar al método agregarMantenimiento() con los datos de prueba
        $resultado = $this->mantenimiento->agregarMantenimiento($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);

        // Verificar que la operación de agregar fue exitosa
        $this->assertTrue($resultado);

        // Opcional: Verificar que el mantenimiento realmente se agregó (puedes hacer una búsqueda por los datos agregados)
        // Por ejemplo:
        $mantenimientoAgregado = $this->mantenimiento->buscarMantenimiento($descripcion);

        // Verificar que se encontró al menos un mantenimiento con la descripción dada
        $this->assertNotEmpty($mantenimientoAgregado);
    }

    // Test para verificar la operación de eliminar mantenimiento
    public function testEliminarMantenimiento()
    {
        // Supongamos que queremos eliminar el mantenimiento con idmantenimiento = 1 (debe existir en la base de datos)
        $idmantenimiento = 10;

        // Llamar al método eliminarMantenimiento() con el id del mantenimiento a eliminar
        $resultado = $this->mantenimiento->eliminarMantenimiento($idmantenimiento);

        // Verificar que la operación de eliminar fue exitosa
        $this->assertTrue($resultado);
    }

    // Test para verificar la operación de editar mantenimiento
    public function testEditarMantenimiento()
    {
        // Supongamos que queremos editar el mantenimiento con idmantenimiento = 1 (debe existir en la base de datos)
        $idmantenimiento = 11;
        $idmaquinaria = 567; // Nuevo id de maquinaria
        $fecha = '2024-06-21'; // Nueva fecha
        $descripcion = 'Mantenimiento corregido'; // Nueva descripción
        $costopro = 300.75; // Nuevo costo
        $idempleado = 1; // Nuevo id de empleado
        $estado = 1; // Nuevo estado
        $tipo = 1; // Nuevo tipo

        // Llamar al método editarMantenimiento() con los nuevos datos
        $resultado = $this->mantenimiento->editarMantenimiento($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);

        // Verificar que la operación de editar fue exitosa
        $this->assertTrue($resultado);
    }

    // Test para verificar la operación de buscar mantenimiento por término
    public function testBuscarMantenimiento()
    {
        // Supongamos que queremos buscar mantenimientos que contengan el término 'preventivo' en la descripción
        $termino = 'preventivo';

        // Llamar al método buscarMantenimiento() con el término de búsqueda
        $resultados = $this->mantenimiento->buscarMantenimiento($termino);

        // Verificar que se encontraron resultados
        $this->assertNotEmpty($resultados);

        // Verificar la estructura de cada mantenimiento encontrado
        foreach ($resultados as $mantenimiento) {
            $this->assertStringContainsStringIgnoringCase($termino, $mantenimiento['descripcion']);
            // Puedes agregar más aserciones según los campos que esperas en cada mantenimiento
        }
    }

    // Test para verificar la operación de obtener mantenimiento por ID
    public function testObtenerMantenimientoPorId()
    {
        // Supongamos que queremos obtener el mantenimiento con idmantenimiento = 1 (debe existir en la base de datos)
        $idmantenimiento = 1;

        // Llamar al método obtenerMantenimientoPorId() con el id del mantenimiento
        $mantenimiento = $this->mantenimiento->obtenerMantenimientoPorId($idmantenimiento);

        // Verificar que se obtuvo un mantenimiento válido
        $this->assertNotNull($mantenimiento);
        $this->assertEquals($idmantenimiento, $mantenimiento['idmantenimiento']);
        // Puedes agregar más aserciones según los campos que esperas en el mantenimiento
    }
}

?>
