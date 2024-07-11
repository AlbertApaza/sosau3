<?php
namespace App\Controller;

use App\Model\Cliente;

class ClienteController
{
    private $clienteModel;

    public function __construct(Cliente $clienteModel)
    {
        $this->clienteModel = $clienteModel;
    }

    public function listarClienteAdmin()
    {
        // Llamar al método del modelo para listar clientes
        return $this->clienteModel->listarClientes();
    }

    public function agregarClienteAdmin($nombre, $apellido, $correo, $tipoDocumento, $numeroDocumento, $telefono)
    {
        // Llamar al método del modelo para agregar un cliente
        return $this->clienteModel->agregarCliente($nombre, $apellido, $correo, $tipoDocumento, $numeroDocumento, $telefono);
    }

    public function editarClienteAdmin($idCliente, $nombre, $apellido, $correo, $tipoDocumento, $numeroDocumento, $telefono)
    {
        // Llamar al método del modelo para editar un cliente
        return $this->clienteModel->editarCliente($idCliente, $nombre, $apellido, $correo, $tipoDocumento, $numeroDocumento, $telefono);
    }

    public function eliminarClienteAdmin($idCliente)
    {
        // Llamar al método del modelo para eliminar un cliente
        return $this->clienteModel->eliminarCliente($idCliente);
    }

    public function buscarClienteAdmin($terminoBusqueda)
    {
        // Llamar al método del modelo para buscar clientes
        return $this->clienteModel->buscarCliente($terminoBusqueda);
    }

    public function mostrarFormularioEditar($idCliente)
    {
        // Llamar al método del modelo para obtener un cliente por su ID
        return $this->clienteModel->obtenerClientePorId($idCliente);
    }
}
?>
