<?php

use Behat\Behat\Context\Context;
use App\Model\Lugar;


class LugarContext implements Context
{
    private $places;

    /**
     * @Given there are places in the database
     */
    public function thereArePlacesInTheDatabase()
    {
        // Assuming the database is pre-populated with places for this test
        // You can use a database seeder or fixture here
        // For now, we assume that places exist in the database
    }

    /**
     * @When I request all places
     */
    public function iRequestAllPlaces()
    {
        $lugarModel = new Lugar();
        $this->places = $lugarModel->obtenerTodosLugares();
    }

    /**
     * @Then I should get a list of places
     */
    public function iShouldGetAListOfPlaces()
    {
        if (empty($this->places)) {
            throw new Exception("No places found");
        }
    }

    /**
     * @Then each place should have an :arg1
     */
    public function eachPlaceShouldHaveAn($arg1)
    {
        foreach ($this->places as $place) {
            if (!isset($place[$arg1])) {
                throw new Exception("Place does not have a $arg1");
            }
        }
    }
}
?>