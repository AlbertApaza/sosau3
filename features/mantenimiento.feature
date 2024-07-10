Feature: Maintenance Management

  Scenario: Add a new maintenance record
    Given I have a Mantenimiento instance
    When I add a new maintenance record with idmaquinaria 1, fecha "2024-06-30", descripcion "Limpieza y revisión", costopro 200.50, idempleado 1, estado "Pendiente", tipo 1
    Then the maintenance list should include "Limpieza y revisión"

  Scenario: Edit an existing maintenance record
    Given I have a Mantenimiento instance
    And there is a maintenance record with idmantenimiento 1
    When I edit the maintenance record with idmantenimiento 1, setting idmaquinaria to 2, fecha to "2024-07-01", descripcion to "Reparación de motor", costopro to 500.75, idempleado to 2, estado to "Completado", tipo 2
    Then the maintenance list should include "Reparación de motor"

  Scenario: Delete an existing maintenance record
    Given I have a Mantenimiento instance
    And there is a maintenance record with idmantenimiento 3
    When I delete the maintenance record with idmantenimiento 3
    Then the maintenance list should not include "Reparación de motor"

  Scenario: Search maintenance records by term
    Given I have a Mantenimiento instance
    When I search for maintenance records with term "Limpieza y revisión"
    Then the search results should include "Limpieza y revisión"

  Scenario: Get maintenance details by ID
    Given I have a Mantenimiento instance
    And there is a maintenance record with idmantenimiento 2
    When I fetch the details of the maintenance record with idmantenimiento 2
    Then I should receive the details of the maintenance record
