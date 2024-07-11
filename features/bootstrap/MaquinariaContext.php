<?php

use Behat\Behat\Context\Context;
use App\Model\Maquinaria;

class MaquinariaContext implements Context
{
    private $machinery;

    /**
     * @Given there is machinery in the database
     */
    public function thereIsMachineryInTheDatabase()
    {
        // Assuming the database is pre-populated with machinery for this test
        // You can use a database seeder or fixture here
        // For now, we assume that machinery exists in the database
    }

    /**
     * @When I request all machinery
     */
    public function iRequestAllMachinery()
    {
        $maquinariaModel = new Maquinaria();
        $this->machinery = $maquinariaModel->listar_Maquinarias();
		$this->machinery = [];
    }

    /**
     * @Then I should get a list of machinery
     */
    public function iShouldGetAListOfMachinery()
    {
        if (empty($this->machinery)) {
            throw new Exception("No machinery found");
        }
    }

    /**
     * @Then each machinery should have an :arg1
     */
    public function eachMachineryShouldHaveAn($arg1)
    {
        foreach ($this->machinery as $machine) {
            if (!isset($machine[$arg1])) {
                throw new Exception("Machinery does not have a $arg1");
            }
        }
    }

    /**
     * @Given I have a Maquinaria instance
     */
    public function iHaveAMaquinariaInstance()
    {
        // This is to simulate having an instance of the Maquinaria model
    }

    /**
     * @When I add a new machinery with numserie :numserie, nombre :nombre, marca :marca, modelo :modelo, costoh :costoh, imagenprincipal :imagenprincipal
     */
    public function iAddANewMachinery($numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal)
    {
        $maquinariaModel = new Maquinaria();
        $maquinariaModel->agregarMaquinaria($numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal);
    }

    /**
     * @Then the machinery list should include :nombre
     */
    public function theMachineryListShouldInclude($nombre)
    {
        $maquinariaModel = new Maquinaria();
        $machinery = $maquinariaModel->listar_Maquinarias();

        $found = false;
        foreach ($machinery as $machine) {
            if ($machine['nombre'] == $nombre) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            throw new Exception("Machinery list does not include $nombre");
        }
    }

    /**
     * @When I edit the machinery with idmaquinaria :id, setting numserie to :numserie, nombre to :nombre, marca to :marca, modelo to :modelo, costoh to :costoh, imagenprincipal to :imagenprincipal
     */
    public function iEditTheMachinery($id, $numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal)
    {
        $maquinariaModel = new Maquinaria();
        $result = $maquinariaModel->editarMaquinaria($id, $numserie, $nombre, $marca, $modelo, $costoh, $imagenprincipal);

        if (!$result) {
            throw new Exception("Failed to edit machinery with idmaquinaria $id");
        }

        // Verificar si la maquinaria se actualizó correctamente
        $updatedMachinery = $maquinariaModel->buscarMaquinariaPorId($id);
        if ($updatedMachinery['nombre'] !== $nombre) {
            throw new Exception("Machinery with idmaquinaria $id was not updated correctly");
        }
    }

    /**
     * @When I delete the machinery with idmaquinaria :id
     */
    public function iDeleteTheMachinery($id)
    {
        $maquinariaModel = new Maquinaria();
        $maquinariaModel->eliminarMaquinaria($id);
    }

    /**
     * @When I search for machinery with term :term
     */
    public function iSearchForMachineryWithTerm($term)
    {
        $maquinariaModel = new Maquinaria();
        $this->machinery = $maquinariaModel->buscarMaquinaria($term);
    }

    public function theSearchResultsShouldInclude($nombre)
	{
		if ($this->machinery === null) {
			throw new Exception("Machinery list is null. Ensure it is initialized properly.");
		}

		$found = false;
		foreach ($this->machinery as $machine) {
			if ($machine['nombre'] == $nombre) {
				$found = true;
				break;
			}
		}

		if (!$found) {
			throw new Exception("Search results do not include $nombre");
		}
	}

}
?>