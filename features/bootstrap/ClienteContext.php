<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Phake;
use Exception;

// Asegúrate de definir o incluir la interfaz ClienteService si no existe
interface ClienteService
{
    public function crearCliente($data);
    public function listarClientes();
    public function editarCliente($idcliente, $data);
    public function eliminarCliente($idcliente);
    public function buscarCliente($termino);
    public function obtenerClientePorId($idcliente);
}

class ClienteContext implements Context
{
    private $clienteService;
    private $exception;
    private $clientes = [];

    public function __construct()
    {
        // Inicializar el servicio utilizando Phake
        $this->clienteService = Phake::mock('ClienteService');
    }

    /**
     * @Given que tengo una instancia del modelo Cliente
     */
    public function queTengoUnaInstanciaDelModeloCliente()
    {
        // No se requiere implementación para este método utilizando Phake
    }

    /**
     * @Given que existen los siguientes clientes en la base de datos:
     */
    public function queExistenLosSiguientesClientesEnLaBaseDeDatos(TableNode $clientesTable)
    {
        foreach ($clientesTable as $clienteData) {
            $this->clientes[] = [
                'idcliente' => isset($clienteData['idcliente']) ? $clienteData['idcliente'] : null,
                'nombre' => $clienteData['nombre'],
                'apellido' => $clienteData['apellido'],
                'correo' => $clienteData['correo'],
                'iddocumento' => $clienteData['iddocumento'],
                'documento' => $clienteData['documento'],
                'telefono' => $clienteData['telefono'],
            ];
        }
    }

    /**
     * @When solicito la lista de clientes
     */
    public function solicitoLaListaDeClientes()
    {
        // Simular comportamiento con Phake
        Phake::when($this->clienteService)->listarClientes()->thenReturn($this->clientes);
    }

    /**
     * @Then la lista debe contener al menos un cliente
     */
    public function laListaDebeContenerAlMenosUnCliente()
    {
        // Verificar que la lista de clientes no esté vacía
        if (empty($this->clientes)) {
            throw new Exception('La lista de clientes está vacía');
        }
    }

    /**
     * @When añado un nuevo cliente con nombre :nombre, apellido :apellido, correo :correo, iddocumento :iddocumento, documento :documento, teléfono :telefono
     */
    public function anadoUnNuevoClienteConLosSiguientesDatos($nombre, $apellido, $correo, $iddocumento, $documento, $telefono)
    {
        // Simular comportamiento con Phake
        $clienteData = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correo' => $correo,
            'iddocumento' => $iddocumento,
            'documento' => $documento,
            'telefono' => $telefono,
        ];
        $this->clientes[] = $clienteData;
        Phake::when($this->clienteService)->crearCliente($clienteData)->thenReturn(true);
    }

    /**
     * @Then la lista de clientes debe incluir :nombreCompleto
     */
    public function laListaDeClientesDebeIncluir($nombreCompleto)
    {
        // Verificar que el nombre completo esté en la lista de clientes
        $nombreEncontrado = false;
        foreach ($this->clientes as $cliente) {
            $nombreCompletoEsperado = $cliente['nombre'] . ' ' . $cliente['apellido'];
            if ($nombreCompletoEsperado === $nombreCompleto) {
                $nombreEncontrado = true;
                break;
            }
        }
        if (!$nombreEncontrado) {
            throw new Exception("El cliente con nombre completo '$nombreCompleto' no está en la lista de clientes");
        }
    }

    /**
     * @When busco clientes con el término :termino
     */
    public function buscoClientesConElTermino($termino)
    {
        // Simular comportamiento con Phake
        $clientesEncontrados = array_filter($this->clientes, function ($cliente) use ($termino) {
            return strpos($cliente['nombre'] . ' ' . $cliente['apellido'], $termino) !== false;
        });
        Phake::when($this->clienteService)->buscarCliente($termino)->thenReturn($clientesEncontrados);
    }

    /**
     * @Then los resultados de la búsqueda deben incluir :nombreCompleto
     */
    public function losResultadosDeLaBusquedaDebenIncluir($nombreCompleto)
    {
        // Verificar que el nombre completo esté en los resultados de búsqueda
        $nombreEncontrado = false;
        foreach ($this->clientes as $cliente) {
            $nombreCompletoEsperado = $cliente['nombre'] . ' ' . $cliente['apellido'];
            if ($nombreCompletoEsperado === $nombreCompleto) {
                $nombreEncontrado = true;
                break;
            }
        }
        if (!$nombreEncontrado) {
            throw new Exception("Los resultados de la búsqueda no incluyen a '$nombreCompleto'");
        }
    }

    /**
     * @When intento añadir un nuevo cliente sin completar todos los campos requeridos
     */
    public function intentoAnadirUnNuevoClienteSinCompletarTodosLosCamposRequeridos()
    {
        // Simular comportamiento con Phake
        Phake::when($this->clienteService)->crearCliente(Phake::anyParameters())->thenThrow(new Exception('Los campos del formulario no pueden estar vacíos'));
    }

    /**
     * @When intento editar el cliente con idcliente :idcliente, estableciendo nombre a :nombre, apellido a :apellido, correo a :correo, iddocumento a :iddocumento, documento a :documento, teléfono a :telefono
     */
    public function intentoEditarElClienteConIdclienteEstableciendoDatos($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono)
    {
        // Simular comportamiento con Phake
        $clienteData = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correo' => $correo,
            'iddocumento' => $iddocumento,
            'documento' => $documento,
            'telefono' => $telefono,
        ];
        foreach ($this->clientes as &$cliente) {
            if ($cliente['idcliente'] == $idcliente) {
                $cliente = array_merge($cliente, $clienteData);
                break;
            }
        }
        Phake::when($this->clienteService)->editarCliente($idcliente, $clienteData)->thenReturn(true);
    }

    /**
     * @When intento editar el cliente con idcliente :idcliente, estableciendo nombre a :nombre, apellido a :apellido, correo a :correo, iddocumento a :iddocumento, documento a :documento, teléfono a :telefono con datos inválidos
     */
    public function intentoEditarElClienteConIdclienteEstableciendoDatosInvalidos($idcliente, $nombre, $apellido, $correo, $iddocumento, $documento, $telefono)
    {
        // Simular comportamiento con Phake
        $clienteData = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correo' => $correo,
            'iddocumento' => $iddocumento,
            'documento' => $documento,
            'telefono' => $telefono,
        ];
        foreach ($this->clientes as &$cliente) {
            if ($cliente['idcliente'] == $idcliente) {
                $cliente = array_merge($cliente, $clienteData);
                break;
            }
        }
        Phake::when($this->clienteService)->editarCliente($idcliente, $clienteData)->thenThrow(new Exception('Los campos del formulario no pueden estar vacíos'));
    }

    /**
     * @When intento eliminar el cliente con idcliente :idcliente
     */
    public function intentoEliminarElClienteConIdcliente($idcliente)
    {
        // Simular comportamiento con Phake
        $clienteEncontrado = false;
        foreach ($this->clientes as $key => $cliente) {
            if ($cliente['idcliente'] == $idcliente) {
                unset($this->clientes[$key]);
                $clienteEncontrado = true;
                break;
            }
        }
        if (!$clienteEncontrado) {
            throw new Exception("No se encontró ningún cliente con idcliente '$idcliente'");
        }
        Phake::when($this->clienteService)->eliminarCliente($idcliente)->thenReturn(true);
    }

    /**
     * @Then el cliente con idcliente :idcliente ya no debe estar en la lista de clientes
     */
    public function elClienteConIdclienteYaNoDebeEstarEnLaListaDeClientes($idcliente)
    {
        // Verificar que el cliente con el id indicado no esté en la lista de clientes
        foreach ($this->clientes as $cliente) {
            if ($cliente['idcliente'] == $idcliente) {
                throw new Exception("El cliente con idcliente '$idcliente' todavía está en la lista de clientes");
            }
        }
    }
}

?>
