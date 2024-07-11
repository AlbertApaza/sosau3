Feature: Client Management
  As a user,
  I want to manage clients in the system
  So that I can view, add, edit, delete, and search clients.

  Scenario: List clients
    Given I have a Cliente instance
    When I request the list of clients
    Then the list should contain at least one client

  Scenario: Add a new client
    Given I have a Cliente instance
    When I add a new client with nombre "John", apellido "Doe", correo "john.doe@example.com", iddocumento "1", documento "12345678", telefono "987654321"
    Then the client list should include "John Doe"

  Scenario: Edit an existing client
    Given I have a Cliente instance
    And there is a client with idcliente 240
    When I edit the client with idcliente 240, setting nombre to "Jane", apellido to "Smith", correo to "jane.smith@example.com", iddocumento to "1", documento to "87654321", telefono to "654321987"
    Then the client list should include "Jane Smith"

  Scenario: Delete an existing client
    Given I have a Cliente instance
    When I delete the client with idcliente 239
    Then the client list should not include "Jane Smith"

  Scenario: Search clients by term
    Given I have a Cliente instance
    When I search for clients with term "John"
    Then the search results should include "John Doe"
