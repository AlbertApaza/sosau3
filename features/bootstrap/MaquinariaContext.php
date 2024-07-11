<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit\Framework\MockObject\MockObject;

class MaquinariaContext implements Context
{
    private $maquinariaModel;
    private $maquinariaList;
    private $maquinariaDetails;
    private $newMaquinariaData;
    private $updatedMaquinariaData;

    /**
     * @var Maquinaria|MockObject $maquinariaModelMock
     */
    private $maquinariaModelMock;

    public function __construct()
    {
        // Crear un mock de Maquinaria
        $this->maquinariaModelMock = $this->createMock(Maquinaria::class);

        // Asignar el mock a la propiedad maquinariaModel
        $this->maquinariaModel = $this->maquinariaModelMock;
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
        // Configurar el comportamiento del mock para listar maquinarias
        $this->maquinariaList = [
            ['idmaquinaria' => 1, 'numserie' => '12345', 'nombre' => 'Maquinaria 1'],
            ['idmaquinaria' => 2, 'numserie' => '54321', 'nombre' => 'Maquinaria 2'],
        ];
        $this->maquinariaModelMock
            ->expects($this->any())
            ->method('listar_Maquinarias')
            ->willReturn($this->maquinariaList);

        // Llamar al método real para Behat, pero utilizando el mock
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
        // Simular la selección de una maquinaria específica, por ejemplo, la primera en la lista
        if (isset($this->maquinariaList[0])) {
            $this->maquinariaDetails = [
                'idmaquinaria' => $this->maquinariaList[0]['idmaquinaria'],
                'numserie' => $this->maquinariaList[0]['numserie'],
                'nombre' => $this->maquinariaList[0]['nombre'],
                // Añadir más detalles según sea necesario
            ];

            // Configurar el comportamiento del mock para mostrar detalles de maquinaria
            $this->maquinariaModelMock
                ->expects($this->any())
                ->method('mostrar_Maquinaria')
                ->with($this->maquinariaList[0]['idmaquinaria'])
                ->willReturn($this->maquinariaDetails);

            // Llamar al método real para Behat, pero utilizando el mock
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
            // Configurar el comportamiento del mock para eliminar maquinaria
            $this->maquinariaModelMock
                ->expects($this->any())
                ->method('eliminarMaquinaria')
                ->with($maquinariaId);
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
        $this->maquinariaModel->eliminarMaquinaria($this->maquinariaList[0]['idmaquinaria']);
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
