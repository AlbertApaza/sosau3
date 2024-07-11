Feature: Gestión de Clientes

  Scenario: Listar clientes existentes
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
      | Jane   | Smith    | jane.smith@example.com  | 2           | 87654321  | 654321987   |
    When solicito la lista de clientes
    Then la lista debe contener al menos un cliente

  Scenario: Añadir un nuevo cliente
    Given que tengo una instancia del modelo Cliente
    When añado un nuevo cliente con nombre "Alice", apellido "Johnson", correo "alice.johnson@example.com", iddocumento "1", documento "55555555", teléfono "999888777"
    Then la lista de clientes debe incluir "Alice Johnson"

  Scenario: Buscar clientes por término
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
      | Jane   | Smith    | jane.smith@example.com  | 2           | 87654321  | 654321987   |
    When busco clientes con el término "John"
    Then los resultados de la búsqueda deben incluir "John Doe"

  Scenario: Intento añadir cliente con campos vacíos
    Given que tengo una instancia del modelo Cliente
    When intento añadir un nuevo cliente sin completar todos los campos requeridos

  Scenario: Editar un cliente existente
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | idcliente | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | 1         | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
      | 2         | Jane   | Smith    | jane.smith@example.com  | 2           | 87654321  | 654321987   |
    When intento editar el cliente con idcliente 1, estableciendo nombre a "Johnny", apellido a "Doe", correo a "johnny.doe@example.com", iddocumento a "1", documento a "99999999", teléfono a "111222333"
    Then la lista de clientes debe incluir "Johnny Doe"

  Scenario: Intento editar cliente con datos inválidos
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | idcliente | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | 1         | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
    When intento editar el cliente con idcliente 1, estableciendo nombre a "", apellido a "", correo a "", iddocumento a "", documento a "", teléfono a ""

  Scenario: Eliminar un cliente existente
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | idcliente | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | 1         | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
    When intento eliminar el cliente con idcliente 1
    Then el cliente con idcliente 1 ya no debe estar en la lista de clientes
