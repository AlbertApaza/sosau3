Feature: Gestión de Cotizaciones
  Como usuario,
  Quiero gestionar cotizaciones en el sistema
  Para poder ver, añadir, editar y eliminar cotizaciones, así como recuperar detalles de clientes, maquinaria y ubicaciones.
  Scenario: Crear una nueva cotización
    Given tengo una instancia del modelo Cotizacion
    When añado una nueva cotización para el cliente con idcliente 1
    Then la cotización debería añadirse exitosamente
  
  Scenario: Actualizar una cotización existente
    Given tengo una instancia del modelo Cotizacion
    And existe una cotización con idcotizacion 431
    When actualizo la cotización con idcotizacion 431, estableciendo idcliente a 2, idmaquinaria a 567, idlugar a 4, total a 1500.50 y tiempo a 5
    Then la cotización con idcotizacion 431 debería actualizarse exitosamente
  
  Scenario: Obtener detalles del cliente para la cotización
    Given tengo una instancia del modelo Cotizacion
    And existe un cliente con idcliente 2
    When obtengo los detalles del cliente con idcliente 2
    Then debería recibir los detalles del cliente
  
  Scenario: Obtener detalles de la maquinaria para la cotización
    Given tengo una instancia del modelo Cotizacion
    And existe una maquinaria con idmaquinaria 567
    When obtengo los detalles de la maquinaria con idmaquinaria 567
    Then debería recibir los detalles de la maquinaria
  
  Scenario: Obtener detalles de la ubicación para la cotización
    Given tengo una instancia del modelo Cotizacion
    And existe una ubicación con idlugar 4
    When obtengo los detalles de la ubicación con idlugar 4
    Then debería recibir los detalles de la ubicación
  
  Scenario: Obtener toda la maquinaria disponible para la cotización
    Given tengo una instancia del modelo Cotizacion
    When obtengo toda la maquinaria disponible
    Then debería recibir una lista de toda la maquinaria
  
  Scenario: Obtener todas las ubicaciones disponibles para la cotización
    Given tengo una instancia del modelo Cotizacion
    When obtengo todas las ubicaciones disponibles
    Then debería recibir una lista de todas las ubicaciones
