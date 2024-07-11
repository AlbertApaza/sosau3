Feature: Gestión de Clientes
  Como usuario,
  Quiero gestionar clientes en el sistema
  Para poder ver, añadir, editar, eliminar y buscar clientes.

  Scenario: Listar clientes
    Given que tengo una instancia de Cliente
    When solicite la lista de clientes
    Then la lista debe contener al menos un cliente

  Scenario: Añadir un nuevo cliente
    Given que tengo una instancia de Cliente
    When añada un nuevo cliente con nombre "John", apellido "Doe", correo "john.doe@example.com", iddocumento "1", documento "12345678", teléfono "987654321"
    Then la lista de clientes debe incluir "John Doe"

  Scenario: Editar un cliente existente
    Given que tengo una instancia de Cliente
    And hay un cliente con idcliente 240
    When edite el cliente con idcliente 240, estableciendo nombre a "Jane", apellido a "Smith", correo a "jane.smith@example.com", iddocumento a "1", documento a "87654321", teléfono a "654321987"
    Then la lista de clientes debe incluir "Jane Smith"

  Scenario: Eliminar un cliente existente
    Given que tengo una instancia de Cliente
    When elimine el cliente con idcliente 239
    Then la lista de clientes no debe incluir "Jane Smith"

  Scenario: Buscar clientes por término
    Given que tengo una instancia de Cliente
    When busque clientes con el término "John"
    Then los resultados de la búsqueda deben incluir "John Doe"
