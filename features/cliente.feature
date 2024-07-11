Feature: Gestión de Clientes
  Como usuario,
  Quiero gestionar clientes en el sistema
  Para poder ver, añadir, editar, eliminar y buscar clientes.

  Escenario: Listar clientes
    Dado que tengo una instancia de Cliente
    Cuando solicite la lista de clientes
    Entonces la lista debe contener al menos un cliente

  Escenario: Añadir un nuevo cliente
    Dado que tengo una instancia de Cliente
    Cuando añada un nuevo cliente con nombre "John", apellido "Doe", correo "john.doe@example.com", iddocumento "1", documento "12345678", teléfono "987654321"
    Entonces la lista de clientes debe incluir "John Doe"

  Escenario: Editar un cliente existente
    Dado que tengo una instancia de Cliente
    Y hay un cliente con idcliente 240
    Cuando edite el cliente con idcliente 240, estableciendo nombre a "Jane", apellido a "Smith", correo a "jane.smith@example.com", iddocumento a "1", documento a "87654321", teléfono a "654321987"
    Entonces la lista de clientes debe incluir "Jane Smith"

  Escenario: Eliminar un cliente existente
    Dado que tengo una instancia de Cliente
    Cuando elimine el cliente con idcliente 239
    Entonces la lista de clientes no debe incluir "Jane Smith"

  Escenario: Buscar clientes por término
    Dado que tengo una instancia de Cliente
    Cuando busque clientes con el término "John"
    Entonces los resultados de la búsqueda deben incluir "John Doe"
