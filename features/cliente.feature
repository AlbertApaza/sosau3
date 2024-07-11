Feature: Gestión de Clientes

  Como usuario
  Quiero gestionar clientes en el sistema
  Para poder ver, añadir, editar, eliminar y buscar clientes

  Scenario: Listar clientes existentes
    Given que tengo una instancia del modelo Cliente
    When solicito la lista de clientes
    Then la lista debe contener al menos un cliente

  Scenario: Agregar un nuevo cliente
    Given que tengo una instancia del modelo Cliente
    When añado un nuevo cliente con nombre "John", apellido "Doe", correo "john.doe@example.com", iddocumento "1", documento "12345678", teléfono "987654321"
    Then la lista de clientes debe incluir "John Doe"

  Scenario: Editar un cliente existente
    Given que tengo una instancia del modelo Cliente
    And existe un cliente con idcliente 240
    When edito el cliente con idcliente 240, estableciendo nombre a "Jane", apellido a "Smith", correo a "jane.smith@example.com", iddocumento a "1", documento a "87654321", teléfono a "654321987"
    Then la lista de clientes debe incluir "Jane Smith"

  Scenario: Buscar clientes por término
    Given que tengo una instancia del modelo Cliente
    When busco clientes con el término "John"
    Then los resultados de la búsqueda deben incluir "John Doe"

  Scenario: Intento de agregar cliente con campos vacíos
    Given que tengo una instancia del modelo Cliente
    When intento añadir un nuevo cliente sin completar todos los campos requeridos
    Then el sistema muestra un mensaje de error indicando que los campos del formulario no pueden estar vacíos

  Scenario: Intento de editar cliente con datos inválidos
    Given que tengo una instancia del modelo Cliente
    And existe un cliente con idcliente 240
    When intento editar el cliente con idcliente 240, estableciendo nombre a "", apellido a "", correo a "", iddocumento a "", documento a "", teléfono a ""
    Then el sistema muestra un mensaje de error indicando que los campos del formulario no pueden estar vacíos
