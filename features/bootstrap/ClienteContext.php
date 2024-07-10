<?php

use App\Model\Cliente;
use PHPUnit\Framework\Assert;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class ClienteContext implements \Behat\Behat\Context\Context
{
    private $cliente;
    private $clientsList;

    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->clientsList = [];
    }

    /**
     * @Given I have a Cliente instance
     */
    public function iHaveAClienteInstance()
    {
        Assert::assertInstanceOf(Cliente::class, $this->cliente);
    }

    /**
     * @When I request the list of clients
     */
    public function iRequestTheListOfClients()
    {
        $this->clientsList = $this->cliente->listarClientes();
    }

    /**
     * @Then the list should contain at least one client
     */
    public function theListShouldContainAtLeastOneClient()
    {
        Assert::assertNotEmpty($this->clientsList, 'The client list is empty.');
    }

		/**
 * @When I add a new client with nombre :nombre, apellido :apellido, correo :correo, iddocumento :iddocumento, documento :documento, telefono :telefono
 */
public function iAddANewClientWith($nombre, $apellido, $correo, $iddocumento, $documento, $telefono)
{
    try {
        $this->cliente->agregarCliente($nombre, $apellido, $correo, $iddocumento, $documento, $telefono);
        echo "Cliente '$nombre $apellido' agregado correctamente." . PHP_EOL;

        // Actualizar la lista de clientes después de agregar uno nuevo
        $this->iRequestTheListOfClients();
    } catch (\Exception $e) {
        echo "Error al agregar el cliente: " . $e->getMessage() . PHP_EOL;
    }
}




		
    /**
     * @Then the client list should include :expectedClient
     */
    public function theClientListShouldInclude($expectedClient)
    {
        $found = false;
        foreach ($this->clientsList as $client) {
            if ($client['nombre'] . ' ' . $client['apellido'] === $expectedClient) {
                $found = true;
                break;
            }
        }
        Assert::assertTrue($found, "Expected client '$expectedClient' not found in the list.");
    }

    /**
     * @Given there is a client with idcliente :idcliente
     */
    public function thereIsAClientWithIdcliente($idcliente)
    {
        // Assuming a method that adds a client with specific details for testing purposes
        $this->cliente->agregarCliente('John', 'Doe', 'john.doe@example.com', 'DNI', '12345678', '987654321');
    }

	/**
	 * @When I edit the client with idcliente :idcliente, setting nombre to :nombre, apellido to :apellido, correo to :correo, iddocumento to :iddocumento, documento to :documento, telefono to :telefono
	 */
	public function iEditTheClientWithIdcliente($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono)
	{
		try {
			// Realizar la edición del cliente
			$this->cliente->editarCliente($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono);
			echo "Cliente con id $idcliente editado correctamente." . PHP_EOL;

			// Actualizar la lista de clientes después de la edición
			$this->iRequestTheListOfClients();
		} catch (\Exception $e) {
			echo "Error al editar el cliente: " . $e->getMessage() . PHP_EOL;
		}
	}


    /**
     * @When I delete the client with idcliente :idcliente
     */
    public function iDeleteTheClientWithIdcliente($idcliente)
    {
        $this->cliente->eliminarCliente($idcliente);
    }

    /**
     * @Then the client list should not include :expectedClient
     */
    public function theClientListShouldNotInclude($expectedClient)
    {
        $found = false;
        foreach ($this->clientsList as $client) {
            if ($client['nombre'] . ' ' . $client['apellido'] === $expectedClient) {
                $found = true;
                break;
            }
        }
        Assert::assertFalse($found, "Expected client '$expectedClient' found in the list.");
    }

    /**
     * @When I search for clients with term :term
     */
    public function iSearchForClientsWithTerm($term)
    {
        $this->clientsList = $this->cliente->buscarCliente($term);
    }

	/**
	 * @Then the search results should include :expectedClient
	 */
	public function theSearchResultsShouldInclude($expectedClient)
	{
		if ($this->clientsList === null) {
			throw new \Exception("Client list is null. Ensure it is initialized properly.");
		}

		$found = false;
		foreach ($this->clientsList as $client) {
			if ($client['nombre'] . ' ' . $client['apellido'] === $expectedClient) {
				$found = true;
				break;
			}
		}
		Assert::assertTrue($found, "Expected client '$expectedClient' not found in the search results.");
	}
}
?>