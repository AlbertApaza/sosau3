<?php

namespace App\Controller;

use App\Model\DetalleMaquinariaModel;

class DetalleMaquinariaController
{
    private DetalleMaquinariaModel $detalleMaquinariaModel;
    private \PDO $db;

    public function __construct(DetalleMaquinariaModel $detalleMaquinariaModel, \PDO $db)
    {
        $this->detalleMaquinariaModel = $detalleMaquinariaModel;
        $this->db = $db;
    }

    public function listarDetalleMaquinariaAdmin()
    {
        return $this->detalleMaquinariaModel->listarDetalleMaquinaria();
    }

    public function obtenerDetallePorId($idDetalle)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbdetallemaquinaria WHERE iddetalle = ?");
        $stmt->execute([$idDetalle]);
        return $stmt->fetch();
    }

    public function actualizarDetalle($data)
    {
        $stmt = $this->db->prepare("UPDATE tbdetallemaquinaria SET idmaquinaria = ?, descripcion = ? WHERE iddetalle = ?");
        return $stmt->execute([$data['idmaquinaria'], $data['descripcion'], $data['id']]);
    }

    public function eliminarDetalle($idDetalle)
    {
        $stmt = $this->db->prepare("DELETE FROM tbdetallemaquinaria WHERE iddetalle = ?");
        return $stmt->execute([$idDetalle]);
    }
}
