<?php

use App\Model\Cotizacion;
use PHPUnit\Framework\Assert;
use Behat\Behat\Context\Context;

class CotizacionContext implements Context
{
    private $conexion;
    private $cotizacion;
    private $clientDetails;
    private $machineryDetails;
    private $locationDetails;
    private $allMachinery;
    private $allLocations;

    public function __construct()
    {
        // Create a mysqli connection
        $this->conexion = new \mysqli('161.132.38.229', 'root', 'Upt2024', 'DBSOSA');
        if ($this->conexion->connect_error) {
            die("Connection failed: " . $this->conexion->connect_error);
        }
        
        // Initialize the Cotizacion class with the mysqli connection
        $this->cotizacion = new Cotizacion($this->conexion);

        // Initialize other variables or dependencies needed for the context
        $this->clientDetails = [];
        $this->machineryDetails = [];
        $this->locationDetails = [];
        $this->allMachinery = [];
        $this->allLocations = [];
    }

    /**
     * @Given I have a Cotizacion instance
     */
    public function iHaveACotizacionInstance()
    {
        Assert::assertInstanceOf(Cotizacion::class, $this->cotizacion);
    }

    /**
     * @When I add a new quotation for client with idcliente :idcliente
     */
    public function iAddANewQuotationForClientWithIdcliente($idcliente)
    {
        $idcotizacion = $this->cotizacion->agregarCotizacion($idcliente);
        Assert::assertNotNull($idcotizacion, 'Failed to add new quotation.');
    }

    /**
     * @Then the quotation should be successfully added
     */
    public function theQuotationShouldBeSuccessfullyAdded()
    {
        // Assuming the last insert ID is greater than zero
        $lastInsertId = $this->conexion->insert_id;
        Assert::assertGreaterThan(0, $lastInsertId, 'Quotation was not added successfully.');
    }

    /**
     * @Given there is a quotation with idcotizacion :idcotizacion
     */
    public function thereIsAQuotationWithIdcotizacion($idcotizacion)
    {
        // Ensure there is no existing quotation with the same idcotizacion
        $sql = "DELETE FROM tbcotizacion WHERE idcotizacion = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $idcotizacion);
        $stmt->execute();

        // Insert a new quotation
        $sql = "INSERT INTO tbcotizacion (idcotizacion, idcliente) VALUES (?, 1)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $idcotizacion);
        $stmt->execute();
        Assert::assertTrue($stmt->affected_rows > 0, 'Failed to insert quotation.');
    }

    /**
     * @When I update the quotation with idcotizacion :idcotizacion, setting idcliente to :idcliente, idmaquinaria to :idmaquinaria, idlugar to :idlugar, total to :total, and tiempo to :tiempo
     */
    public function iUpdateTheQuotationWithIdcotizacionSetting($idcotizacion, $idcliente, $idmaquinaria, $idlugar, $total, $tiempo)
    {
        $result = $this->cotizacion->actualizarCotizacion($idcotizacion, $idcliente, $idmaquinaria, $idlugar, $total, $tiempo);
        Assert::assertTrue($result, 'Failed to update quotation.');
    }

    /**
     * @Then the quotation with idcotizacion :idcotizacion should be successfully updated
     */
    public function theQuotationWithIdcotizacionShouldBeSuccessfullyUpdated($idcotizacion)
    {
        $sql = "SELECT * FROM tbcotizacion WHERE idcotizacion = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $idcotizacion);
        $stmt->execute();
        $stmt->store_result();
        Assert::assertTrue($stmt->num_rows > 0, 'Quotation was not updated successfully.');
    }

    /**
     * @Given there is a client with idcliente :idcliente cotizacion
     */
    public function thereIsAClientWithIdcliente($idcliente)
    {
        $client = $this->cotizacion->obtenerClientePorId($idcliente);
        Assert::assertNotEmpty($client, 'Client does not exist.');
    }

    /**
     * @When I fetch the details of the client with idcliente :idcliente
     */
    public function iFetchTheDetailsOfTheClientWithIdcliente($idcliente)
    {
        $this->clientDetails = $this->cotizacion->obtenerClientePorId($idcliente);
    }

    /**
     * @Then I should receive the details of the client
     */
    public function iShouldReceiveTheDetailsOfTheClient()
    {
        Assert::assertNotEmpty($this->clientDetails);
    }

    /**
     * @Given there is a machinery with idmaquinaria :idmaquinaria
     */
    public function thereIsAMachineryWithIdmaquinaria($idmaquinaria)
    {
        $machinery = $this->cotizacion->obtenerMaquinariaPorId($idmaquinaria);
        Assert::assertNotEmpty($machinery, 'Machinery does not exist.');
    }

    /**
     * @When I fetch the details of the machinery with idmaquinaria :idmaquinaria
     */
    public function iFetchTheDetailsOfTheMachineryWithIdmaquinaria($idmaquinaria)
    {
        $this->machineryDetails = $this->cotizacion->obtenerMaquinariaPorId($idmaquinaria);
    }

    /**
     * @Then I should receive the details of the machinery
     */
    public function iShouldReceiveTheDetailsOfTheMachinery()
    {
        Assert::assertNotEmpty($this->machineryDetails);
    }

    /**
     * @Given there is a location with idlugar :idlugar
     */
    public function thereIsALocationWithIdlugar($idlugar)
    {
        $location = $this->cotizacion->obtenerLugarPorId($idlugar);
        Assert::assertNotEmpty($location, 'Location does not exist.');
    }

    /**
     * @When I fetch the details of the location with idlugar :idlugar
     */
    public function iFetchTheDetailsOfTheLocationWithIdlugar($idlugar)
    {
        $this->locationDetails = $this->cotizacion->obtenerLugarPorId($idlugar);
    }

    /**
     * @Then I should receive the details of the location
     */
    public function iShouldReceiveTheDetailsOfTheLocation()
    {
        Assert::assertNotEmpty($this->locationDetails);
    }

    /**
     * @When I fetch all available machinery
     */
    public function iFetchAllAvailableMachinery()
    {
        $this->allMachinery = $this->cotizacion->obtenerTodasMaquinarias();
    }

    /**
     * @Then I should receive a list of all machinery
     */
    public function iShouldReceiveAListOfAllMachinery()
    {
        Assert::assertNotEmpty($this->allMachinery);
    }

    /**
     * @When I fetch all available locations
     */
    public function iFetchAllAvailableLocations()
    {
        $this->allLocations = $this->cotizacion->obtenerTodosLugares();
    }

    /**
     * @Then I should receive a list of all locations
     */
    public function iShouldReceiveAListOfAllLocations()
    {
        Assert::assertNotEmpty($this->allLocations);
    }
	
}

?>
