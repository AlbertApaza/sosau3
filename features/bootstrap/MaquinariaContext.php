<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class MaquinariaContext implements Context
{
    private $maquinariaModel;
    private $maquinariaList;
    private $maquinariaDetails;
    private $newMaquinariaData;
    private $updatedMaquinariaData;

    public function __construct()
    {
        // Reemplaza 'Maquinaria' con la clase correspondiente en tu modelo
        $this->maquinariaModel = new Maquinaria();
    }

    /**
     * @Given que el sistema está configurado para administrar la maquinaria
     */
    public function queElSistemaEstaConfiguradoParaAdministrarLaMaquinaria()
    {
        // No se requiere implementación específica para el contexto de Behat
    }

    /**
     * @Given que el Personal navega a la página de administración de maquinaria
     */
    public function queElPersonalNavegaALaPaginaDeAdministracionDeMaquinaria()
    {
        // No se requiere implementación específica para el contexto de Behat
    }

    /**
     * @When el sistema solicita todas las maquinarias
     */
    public function elSistemaSolicitaTodasLasMaquinarias()
    {
        $this->maquinariaList = $this->maquinariaModel->listar_Maquinarias();
    }

    /**
     * @Then el sistema muestra la lista de maquinarias disponibles
     */
    public function elSistemaMuestraLaListaDeMaquinariasDisponibles()
    {
        if (empty($this->maquinariaList)) {
            throw new Exception('No se encontraron maquinarias en la lista.');
        }
        // Puedes agregar más validaciones según sea necesario
    }

    /**
     * @Given selecciona una maquinaria específica
     */
    public function seleccionaUnaMaquinariaEspecifica()
    {
        // Simula la selección de una maquinaria específica, por ejemplo, la primera en la lista
        if (isset($this->maquinariaList[0])) {
            $this->maquinariaDetails = $this->maquinariaModel->mostrar_Maquinaria($this->maquinariaList[0]['idmaquinaria']);
        } else {
            throw new Exception('No hay maquinarias para seleccionar.');
        }
    }

    /**
     * @When el sistema muestra los detalles de la maquinaria con ID 1
     */
    public function elSistemaMuestraLosDetallesDeLaMaquinariaConID()
    {
        if (empty($this->maquinariaDetails)) {
            throw new Exception('No se pudieron obtener los detalles de la maquinaria.');
        }
        // Puedes agregar más validaciones según sea necesario
    }

    /**
     * @Given selecciona "Agregar nueva maquinaria"
     */
    public function seleccionaAgregarNuevaMaquinaria()
    {
        // Simula el inicio del proceso de agregar una nueva maquinaria
        $this->newMaquinariaData = [
            'numserie' => '12345',
            'nombre' => 'Nueva Maquinaria',
            'marca' => 'MarcaNueva',
            'modelo' => 'ModeloNuevo',
            'costoh' => 1000.00,
            'imagenprincipal' => 'imagen.jpg'
        ];
    }

    /**
     * @When completa el formulario con los datos de la nueva maquinaria
     */
    public function completaElFormularioConLosDatosDeLaNuevaMaquinaria()
    {
        // Simula el proceso de completar el formulario y guardar la nueva maquinaria
        $this->maquinariaModel->agregarMaquinaria(
            $this->newMaquinariaData['numserie'],
            $this->newMaquinariaData['nombre'],
            $this->newMaquinariaData['marca'],
            $this->newMaquinariaData['modelo'],
            $this->newMaquinariaData['costoh'],
            $this->newMaquinariaData['imagenprincipal']
        );
    }

    /**
     * @Then el sistema muestra un mensaje de confirmación
     */
    public function elSistemaMuestraUnMensajeDeConfirmacion()
    {
        // Puedes verificar si se ha guardado correctamente la nueva maquinaria
        // y mostrar un mensaje de confirmación apropiado
    }

    /**
     * @Given selecciona una maquinaria para editar
     */
    public function seleccionaUnaMaquinariaParaEditar()
    {
        // Simula la selección de una maquinaria específica para editar
        if (isset($this->maquinariaList[0])) {
            $maquinariaId = $this->maquinariaList[0]['idmaquinaria'];
            $this->updatedMaquinariaData = [
                'id' => $maquinariaId,
                'numserie' => '54321',
                'nombre' => 'Maquinaria Editada',
                'marca' => 'MarcaEditada',
                'modelo' => 'ModeloEditado',
                'costoh' => 1500.00,
                'imagenprincipal' => 'imagen_editada.jpg'
            ];
        } else {
            throw new Exception('No hay maquinarias para editar.');
        }
    }

    /**
     * @When modifica la información de la maquinaria
     */
    public function modificaLaInformacionDeLaMaquinaria()
    {
        // Simula el proceso de modificación de la maquinaria
        $this->maquinariaModel->editarMaquinaria(
            $this->updatedMaquinariaData['id'],
            $this->updatedMaquinariaData['numserie'],
            $this->updatedMaquinariaData['nombre'],
            $this->updatedMaquinariaData['marca'],
            $this->updatedMaquinariaData['modelo'],
            $this->updatedMaquinariaData['costoh'],
            $this->updatedMaquinariaData['imagenprincipal']
        );
    }

    /**
     * @Then el sistema muestra un mensaje de confirmación
     */
    public function elSistemaMuestraUnMensajeDeConfirmacionParaEdicion()
    {
        // Puedes verificar si se ha editado correctamente la maquinaria
        // y mostrar un mensaje de confirmación apropiado
    }

    /**
     * @Given selecciona una maquinaria para eliminar
     */
    public function seleccionaUnaMaquinariaParaEliminar()
    {
        // Simula la selección de una maquinaria específica para eliminar
        if (isset($this->maquinariaList[0])) {
            $maquinariaId = $this->maquinariaList[0]['idmaquinaria'];
            $this->maquinariaModel->eliminarMaquinaria($maquinariaId);
        } else {
            throw new Exception('No hay maquinarias para eliminar.');
        }
    }

    /**
     * @When el sistema confirma la eliminación
     */
    public function elSistemaConfirmaLaEliminacion()
    {
        // Simula el proceso de confirmación y eliminación de la maquinaria
        // Esto ya se ejecutó en el paso anterior (eliminarMaquinaria)
    }

    /**
     * @Then el sistema elimina la maquinaria de la base de datos
     * @And muestra un mensaje de confirmación
     */
    public function elSistemaEliminaLaMaquinariaDeLaBaseDeDatos()
    {
        // Puedes verificar si se ha eliminado correctamente la maquinaria
        // y mostrar un mensaje de confirmación apropiado
    }
}
?>
