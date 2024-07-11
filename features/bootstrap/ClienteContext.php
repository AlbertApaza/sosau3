<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Phake;

/**
 * Defines application features from the specific context.
 */
class ClienteContext implements Context
{
    private $cliente;
    private $clientsList;

    public function __construct()
    {
        // Inicializar el cliente simulado usando Phake
        $this->cliente = Phake::mock('App\Model\Cliente');
        $this->clientsList = [];
    }

    /**
     * @Given I have a Cliente instance
     */
    public function iHaveAClienteInstance()
    {
        // Verificar que se haya inicializado correctamente el cliente simulado
        Assert::assertInstanceOf('App\Model\Cliente', $this->cliente);
    }

    /**
     * @When I request the list of clients
     */
    public function iRequestTheListOfClients()
    {
        // Simular la obtención de la lista de clientes
        Phake::when($this->cliente)->listarClientes()->thenReturn([
            ['nombre' => 'John', 'apellido' => 'Doe'],
            ['nombre' => 'Jane', 'apellido' => 'Smith']
        ]);

        $this->clientsList = $this->cliente->listarClientes();
    }

    /**
     * @Then the list should contain at least one client
     */
    public function theListShouldContainAtLeastOneClient()
    {
        // Verificar que la lista de clientes no esté vacía
        Assert::assertNotEmpty($this->clientsList, 'The client list is empty.');
    }

    /**
     * @When I add a new client with nombre :nombre, apellido :apellido, correo :correo, iddocumento :iddocumento, documento :documento, telefono :telefono
     */
    public function iAddANewClientWith($nombre, $apellido, $correo, $iddocumento, $documento, $telefono)
    {
        try {
            // Simular la adición de un cliente nuevo
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
        // Verificar que el cliente esperado esté en la lista
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
        // Simular la existencia de un cliente con ID específico
        Phake::when($this->cliente)->agregarCliente('John', 'Doe', 'john.doe@example.com', 'DNI', '12345678', '987654321');
    }

    /**
     * @When I edit the client with idcliente :idcliente, setting nombre to :nombre, apellido to :apellido, correo to :correo, iddocumento to :iddocumento, documento to :documento, telefono to :telefono
     */
    public function iEditTheClientWithIdcliente($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono)
    {
        try {
            // Simular la edición del cliente
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
        // Simular la eliminación de un cliente
        Phake::when($this->cliente)->eliminarCliente($idcliente);
    }

    /**
     * @Then the client list should not include :expectedClient
     */
    public function theClientListShouldNotInclude($expectedClient)
    {
        // Verificar que el cliente esperado no esté en la lista
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
        // Simular la búsqueda de clientes con un término específico
        Phake::when($this->cliente)->buscarCliente($term)->thenReturn([
            ['nombre' => 'John', 'apellido' => 'Doe']
        ]);

        $this->clientsList = $this->cliente->buscarCliente($term);
    }

    /**
     * @Then the search results should include :expectedClient
     */
    public function theSearchResultsShouldInclude($expectedClient)
    {
        // Verificar que los resultados de búsqueda contengan al cliente esperado
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
