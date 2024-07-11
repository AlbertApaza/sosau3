<?php

use Behat\Behat\Context\Context;
use Phake;

class LugarContext implements Context
{
    private $lugarService;
    private $resultado;
    private $exception;

    public function __construct()
    {
        // Inicializar el servicio utilizando Phake
        $this->lugarService = Phake::mock('LugarService');
    }

    /**
     * @Given que el Personal navega a la página de administración de lugares
     */
    public function queElPersonalNavegaALaPaginaDeAdministracionDeLugares()
    {
        // No se requiere implementación para este método utilizando Phake
    }

    /**
     * @When el sistema solicita todos los lugares
     */
    public function elSistemaSolicitaTodosLosLugares()
    {
        // Simular comportamiento con Phake
        try {
            $this->resultado = $this->lugarService->obtenerTodosLugares();
        } catch (Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then el sistema muestra la lista de lugares disponibles
     */
    public function elSistemaMuestraLaListaDeLugaresDisponibles()
    {
        // Verificar que la lista de lugares se muestra utilizando Phake
        if (is_array($this->resultado) && count($this->resultado) > 0) {
            return true;
        }

        throw new Exception('La lista de lugares no se mostró correctamente.');
    }
}

// Asegúrate de definir o incluir la clase LugarService si no existe
interface LugarService
{
    public function obtenerTodosLugares();
}
?>
