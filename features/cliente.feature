Feature: Gestión de Clientes

  Scenario: Editar un cliente existente
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | idcliente | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | 240       | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
    When intento editar el cliente con idcliente 240, estableciendo nombre a "Jane", apellido a "Smith", correo a "jane.smith@example.com", iddocumento a "1", documento a "87654321", teléfono a "654321987"
    Then la lista de clientes debe incluir "Jane Smith"

  Scenario: Buscar clientes por término
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | idcliente | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | 1         | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
      | 2         | Jane   | Smith    | jane.smith@example.com  | 2           | 87654321  | 654321987   |
    When busco clientes con el término "John"
    Then los resultados de la búsqueda deben incluir "John Doe"

  Scenario: Intento de agregar cliente con campos vacíos
    Given que tengo una instancia del modelo Cliente
    When intento añadir un nuevo cliente sin completar todos los campos requeridos
    Then el sistema muestra un mensaje de error indicando que los campos del formulario no pueden estar vacíos

  Scenario: Intento de editar cliente con datos inválidos
    Given que tengo una instancia del modelo Cliente
    And que existen los siguientes clientes en la base de datos:
      | idcliente | nombre | apellido | correo                  | iddocumento | documento | telefono    |
      | 240       | John   | Doe      | john.doe@example.com    | 1           | 12345678  | 987654321   |
    When intento editar el cliente con idcliente 240, estableciendo nombre a "", apellido a "", correo a "", iddocumento a "", documento a "", teléfono a ""
    Then el sistema muestra un mensaje de error indicando que los campos del formulario no pueden estar vacíos
