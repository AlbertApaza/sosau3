<?php
// MantenimientoContext.php

use App\Model\Mantenimiento;

class MantenimientoContext implements \Behat\Behat\Context\Context
{
    private $mantenimientoModel;
    private $newMaintenanceId;

    public function __construct()
    {
        $this->mantenimientoModel = new Mantenimiento();
    }

    /**
     * @Given I have a Mantenimiento instance
     */
    public function iHaveAMantenimientoInstance()
    {
        // Nothing to do here; the instance is initialized in the constructor
    }

    /**
     * @When I add a new maintenance record with idmaquinaria :idmaquinaria, fecha :fecha, descripcion :descripcion, costopro :costopro, idempleado :idempleado, estado :estado, tipo :tipo
     */
    public function iAddANewMaintenanceRecord($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo)
    {
        $this->newMaintenanceId = $this->mantenimientoModel->agregarMantenimiento($idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);
    }

    /**
     * @Then the maintenance list should include :descripcion
     */
    public function theMaintenanceListShouldInclude($descripcion)
    {
        $maintenanceRecords = $this->mantenimientoModel->listarMantenimiento();
        foreach ($maintenanceRecords as $record) {
            if ($record['descripcion'] === $descripcion) {
                return;
            }
        }
        throw new Exception("Maintenance list does not include '{$descripcion}'");
    }

    /**
     * @Given there is a maintenance record with idmantenimiento :idmantenimiento
     */
    public function thereIsAMaintenanceRecordWithIdmantenimiento($idmantenimiento)
    {
        // You may implement a data setup method here to ensure the record exists
    }

    /**
     * @When I edit the maintenance record with idmantenimiento :idmantenimiento, setting idmaquinaria to :idmaquinaria, fecha to :fecha, descripcion to :descripcion, costopro to :costopro, idempleado to :idempleado, estado to :estado, tipo to :tipo
     */
    public function iEditTheMaintenanceRecord($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo)
    {
        $this->mantenimientoModel->editarMantenimiento($idmantenimiento, $idmaquinaria, $fecha, $descripcion, $costopro, $idempleado, $estado, $tipo);
    }

    /**
     * @When I delete the maintenance record with idmantenimiento :idmantenimiento
     */
    public function iDeleteTheMaintenanceRecord($idmantenimiento)
    {
        $this->mantenimientoModel->eliminarMantenimiento($idmantenimiento);
    }

    /**
     * @Then the maintenance list should not include :descripcion
     */
    public function theMaintenanceListShouldNotInclude($descripcion)
    {
        $maintenanceRecords = $this->mantenimientoModel->listarMantenimiento();
        foreach ($maintenanceRecords as $record) {
            if ($record['descripcion'] === $descripcion) {
                throw new Exception("Maintenance list still includes '{$descripcion}'");
            }
        }
    }


    /**
     * @When I search for maintenance records with term :term
     */
    public function iSearchForMaintenanceRecordsWithTerm($term)
    {
        $this->searchResults = $this->mantenimientoModel->buscarMantenimiento($term);
    }

    /**
     * @Then the search results should include :descripcion Mantenimiento
     */
    public function theSearchResultsShouldInclude($descripcion)
    {
        if (empty($this->searchResults)) {
            throw new Exception("No maintenance records found for the term.");
        }

        $found = false;
        foreach ($this->searchResults as $result) {
            if ($result['descripcion'] === $descripcion) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            throw new Exception("Search results do not include '{$descripcion}'");
        }
    }
    /**
     * @When I fetch the details of the maintenance record with idmantenimiento :idmantenimiento
     */
    public function iFetchTheDetailsOfTheMaintenanceRecord($idmantenimiento)
    {
        $this->maintenanceDetails = $this->mantenimientoModel->obtenerMantenimientoPorId($idmantenimiento);
    }

    /**
     * @Then I should receive the details of the maintenance record
     */
    public function iShouldReceiveTheDetailsOfTheMaintenanceRecord()
    {
        if (empty($this->maintenanceDetails)) {
            throw new Exception("No maintenance record details received");
        }
        // You may add further assertions here based on expected details
    }
}
?>
