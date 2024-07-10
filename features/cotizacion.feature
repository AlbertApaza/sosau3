Feature: Quotation Management
  As a user,
  I want to manage quotations in the system
  So that I can view, add, edit, and delete quotations, as well as retrieve client, machinery, and location details.
  Scenario: Create a new quotation
    Given I have a Cotizacion instance
    When I add a new quotation for client with idcliente 1
    Then the quotation should be successfully added

  Scenario: Update an existing quotation
    Given I have a Cotizacion instance
    And there is a quotation with idcotizacion 431
    When I update the quotation with idcotizacion 431, setting idcliente to 2, idmaquinaria to 567, idlugar to 4, total to 1500.50, and tiempo to 5
    Then the quotation with idcotizacion 431 should be successfully updated

  Scenario: Get client details for quotation
    Given I have a Cotizacion instance
    And there is a client with idcliente 2
    When I fetch the details of the client with idcliente 2
    Then I should receive the details of the client


  Scenario: Get machinery details for quotation
    Given I have a Cotizacion instance
    And there is a machinery with idmaquinaria 567
    When I fetch the details of the machinery with idmaquinaria 567
    Then I should receive the details of the machinery

  Scenario: Get location details for quotation
    Given I have a Cotizacion instance
    And there is a location with idlugar 4
    When I fetch the details of the location with idlugar 4
    Then I should receive the details of the location

  Scenario: Get all available machinery for quotation
    Given I have a Cotizacion instance
    When I fetch all available machinery
    Then I should receive a list of all machinery

  Scenario: Get all available locations for quotation
    Given I have a Cotizacion instance
    When I fetch all available locations
    Then I should receive a list of all locations
