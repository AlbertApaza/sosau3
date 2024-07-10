Feature: Manage machinery
  As a user
  I want to manage machinery in the database
  So that I can see, add, edit, delete, and search machinery

  Scenario: List all machinery
    Given there is machinery in the database
    When I request all machinery
    Then I should get a list of machinery
      And each machinery should have an "idmaquinaria"
      And each machinery should have a "nombre"

  Scenario: Add a new machinery
    Given I have a Maquinaria instance
    When I add a new machinery with numserie "ABC123", nombre "Excavator", marca "CAT", modelo "X1", costoh 100.50, imagenprincipal "excavator.jpg"
    Then the machinery list should include "Excavator"

  Scenario: Edit an existing machinery
    Given I have a Maquinaria instance
    And there is a machinery with idmaquinaria 1
    When I edit the machinery with idmaquinaria 1, setting numserie to "XYZ789", nombre to "Bulldozer", marca to "CAT", modelo to "B2", costoh to 150.75, imagenprincipal to "bulldozer.jpg"
    Then the machinery list should include "Bulldozer"

  Scenario: Delete an existing machinery
    Given I have a Maquinaria instance
    When I delete the machinery with idmaquinaria 834
    Then the machinery list should not include "Excavator"

  Scenario: Search machinery by term
    Given I have a Maquinaria instance
    When I search for machinery with term "Excavator"
    Then the search results should include "Excavator"
