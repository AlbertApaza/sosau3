<?php
namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Maquinaria;

class MaquinariaTest extends TestCase {
    protected $maquinaria;

    protected function setUp(): void {
        parent::setUp();
        $this->maquinaria = new Maquinaria();
    }
    public function testListarMaquinarias2()
    {
        // Obtener las maquinarias desde el método listarMaquinarias()
        $maquinarias = $this->maquinaria->listarMaquinarias();

        // Verificar que el resultado sea un array
        $this->assertIsArray($maquinarias);

        // Verificar que el array no esté vacío (al menos una maquinaria)
        $this->assertNotEmpty($maquinarias);

        // Verificar la estructura de cada maquinaria en el listado
        foreach ($maquinarias as $maquinaria) {
            $this->assertArrayHasKey('idmaquinaria', $maquinaria);
            $this->assertArrayHasKey('numserie', $maquinaria);
            $this->assertArrayHasKey('nombre', $maquinaria);
            $this->assertArrayHasKey('marca', $maquinaria);
            $this->assertArrayHasKey('modelo', $maquinaria);
            $this->assertArrayHasKey('costoh', $maquinaria);
            $this->assertArrayHasKey('imagenprincipal', $maquinaria);
            // Puedes agregar más aserciones según los campos que esperas en cada maquinaria
        }
    }
    // Test para listar todas las maquinarias
    public function testListarMaquinarias()
    {
        // Obtener las maquinarias desde el método listar_Maquinarias()
        $maquinarias = $this->maquinaria->listar_Maquinarias();

        // Verificar que el resultado sea un array
        $this->assertIsArray($maquinarias);

        // Verificar que el array no esté vacío (al menos una maquinaria)
        $this->assertNotEmpty($maquinarias);

        // Verificar la estructura de cada maquinaria en el listado
        foreach ($maquinarias as $maquinaria) {
            $this->assertArrayHasKey('idmaquinaria', $maquinaria);
            $this->assertArrayHasKey('numserie', $maquinaria);
            $this->assertArrayHasKey('nombre', $maquinaria);
            $this->assertArrayHasKey('marca', $maquinaria);
            $this->assertArrayHasKey('modelo', $maquinaria);
            $this->assertArrayHasKey('costoh', $maquinaria);
            $this->assertArrayHasKey('imagenprincipal', $maquinaria);
            // Puedes agregar más aserciones según los campos que esperas en cada maquinaria
        }
    }

    // Test para mostrar una maquinaria por ID
    public function testMostrarMaquinaria() {
        $idMaquinariaExistente = 1; // Cambia este valor por un ID existente en tu base de datos de prueba
        $maquinaria = $this->maquinaria->mostrar_Maquinaria($idMaquinariaExistente);
        $this->assertNotNull($maquinaria);
        $this->assertArrayHasKey('idmaquinaria', $maquinaria);
    }

    // Test para agregar una nueva maquinaria
    public function testAgregarMaquinaria() {
        $resultado = $this->maquinaria->agregarMaquinaria('12345', 'aaa', 'Caterpillar', 'CAT320', 100.50, 'imagen.jpg');
        $this->assertTrue($resultado);
    }

    // Test para editar una maquinaria existente
    public function testEditarMaquinaria() {
        $idMaquinariaExistente = 641; // Cambia este valor por un ID existente en tu base de datos de prueba
        $resultado = $this->maquinaria->editarMaquinaria($idMaquinariaExistente, '12345', 'Excavadora', 'Caterpillar', 'CAT320', 120.50, 'imagen_nueva.jpg');
        $this->assertTrue($resultado);
    }

    // Test para eliminar una maquinaria existente
    public function testEliminarMaquinaria() {
        $idMaquinariaExistente = 640; // Cambia este valor por un ID existente en tu base de datos de prueba
        $resultado = $this->maquinaria->eliminarMaquinaria($idMaquinariaExistente);
        $this->assertTrue($resultado);
    }

    // Test para buscar maquinarias por término
    public function testBuscarMaquinaria() {
        $termino = 'Excavadora';
        $maquinarias = $this->maquinaria->buscarMaquinaria($termino);
        $this->assertIsArray($maquinarias);
    }

    // Test para buscar una maquinaria por ID
    public function testBuscarMaquinariaPorId() {
        $idMaquinariaExistente = 567; // Cambia este valor por un ID existente en tu base de datos de prueba
        $maquinaria = $this->maquinaria->buscarMaquinariaPorId($idMaquinariaExistente);
        $this->assertNotNull($maquinaria);
        $this->assertArrayHasKey('idmaquinaria', $maquinaria);
    }
}
?>
