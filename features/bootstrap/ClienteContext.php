<?php

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

class ClienteContext implements Context
{
    private $clienteService;
    private $clientsList;
    private $clientData;

    public function __construct()
    {
        // Inicializar el servicio utilizando Phake para simular
        $this->clienteService = Phake::mock('ClienteService');
        $this->clientsList = [];
        $this->clientData = [];
    }

    /**
     * @Given I have a Cliente instance
     */
    public function iHaveAClienteInstance()
    {
        // Simular la instancia de Cliente (opcional dependiendo del enfoque)
        // Esto podría ser una inicialización de datos simulados
        $this->clientData = [
            ['nombre' => 'John', 'apellido' => 'Doe', 'correo' => 'john.doe@example.com'],
            ['nombre' => 'Jane', 'apellido' => 'Smith', 'correo' => 'jane.smith@example.com'],
        ];
    }

    /**
     * @When I request the list of clients
     */
    public function iRequestTheListOfClients()
    {
        // Simular la solicitud de lista de clientes
        $this->clientsList = $this->clienteService->listarClientes();
    }

    /**
     * @Then the list should contain at least one client
     */
    public function theListShouldContainAtLeastOneClient()
    {
        // Verificar que la lista contenga al menos un cliente
        Assert::assertNotEmpty($this->clientsList, 'The client list is empty.');
    }

    /**
     * @When I add a new client with nombre :nombre, apellido :apellido, correo :correo
     */
    public function iAddANewClientWith($nombre, $apellido, $correo)
    {
        // Simular agregar un nuevo cliente
        $this->clienteService->crearCliente(['nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo]);
        echo "Cliente '$nombre $apellido' agregado correctamente." . PHP_EOL;
    }

    /**
     * @Then the client list should include :expectedClient
     */
    public function theClientListShouldInclude($expectedClient)
    {
        // Simular verificar que la lista incluya un cliente esperado
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
        // Simular agregar un cliente con un ID específico
        $this->clienteService->crearCliente(['nombre' => 'John', 'apellido' => 'Doe', 'correo' => 'john.doe@example.com']);
    }

    /**
     * @When I edit the client with idcliente :idcliente, setting nombre to :nombre, apellido to :apellido, correo to :correo
     */
    public function iEditTheClientWithIdcliente($idcliente, $nombre, $apellido, $correo)
    {
        // Simular editar un cliente con un ID específico
        $this->clienteService->editarCliente($idcliente, ['nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo]);
        echo "Cliente con id $idcliente editado correctamente." . PHP_EOL;
    }

    /**
     * @When I delete the client with idcliente :idcliente
     */
    public function iDeleteTheClientWithIdcliente($idcliente)
    {
        // Simular eliminar un cliente con un ID específico
        $this->clienteService->eliminarCliente($idcliente);
    }

    /**
     * @Then the client list should not include :expectedClient
     */
    public function theClientListShouldNotInclude($expectedClient)
    {
        // Simular verificar que la lista no incluya un cliente esperado
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
        // Simular buscar clientes con un término específico
        $this->clientsList = $this->clienteService->buscarCliente($term);
    }

    /**
     * @Then the search results should include :expectedClient
     */
    public function theSearchResultsShouldInclude($expectedClient)
    {
        // Simular verificar que los resultados de búsqueda incluyan un cliente esperado
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
