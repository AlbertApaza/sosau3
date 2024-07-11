Feature: Administrar Cotizaciones
  Como Personal administrativo
  Quiero administrar cotizaciones en el sistema
  Para poder crear, visualizar, actualizar y eliminar cotizaciones

  Scenario: Crear Cotización
    Given que el Personal navega a la página de administración de cotizaciones
    And selecciona "Crear nueva cotización"
    And no ingresa datos enviando el formulario
    And envía el formulario
    Then el sistema muestra un mensaje de error "El campo idcliente no puede estar vacío"
    And completa el formulario con la información de la cotización
    And envía el formulario
    Then el sistema guarda la nueva cotización en la base de datos
    And muestra un mensaje de confirmación

  Scenario: Visualizar Cotizaciones
    Given que el Personal navega a la página de administración de cotizaciones
    Then el sistema muestra la lista de cotizaciones disponibles

  Scenario: Actualizar Cotización
    Given que el Personal navega a la página de administración de cotizaciones
    And selecciona una cotización para actualizar
    And modifica la información de la cotización
    And envía el formulario
    Then el sistema actualiza la cotización en la base de datos
    And muestra un mensaje de confirmación

  Scenario: Eliminar Cotización
    Given que el Personal navega a la página de administración de cotizaciones
    And selecciona una cotización para eliminar
    And confirma la eliminación
    Then el sistema elimina la cotización de la base de datos
    And muestra un mensaje de confirmación
