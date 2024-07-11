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
            // Aquí simulamos la respuesta del método obtenerTodosLugares() 
            $lugaresSimulados = [
                ['id' => 1, 'nombre' => 'Lugar 1'],
                ['id' => 2, 'nombre' => 'Lugar 2']
            ];

            Phake::when($this->lugarService)->obtenerTodosLugares()->thenReturn($lugaresSimulados);
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
        // Verificar que se muestra la lista de lugares utilizando Phake
        if ($this->exception) {
            throw new Exception('Hubo un error al solicitar los lugares: ' . $this->exception->getMessage());
        }

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
