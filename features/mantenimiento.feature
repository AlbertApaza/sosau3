Feature: Administrar Mantenimientos
  Como Personal de mantenimiento
  Quiero administrar los registros de mantenimiento en el sistema
  Para poder gestionar las maquinarias de manera eficiente

  Scenario: Listar todos los mantenimientos
    Given que el Personal navega a la página de mantenimientos
    When el sistema solicita todos los registros de mantenimiento

  Scenario: Agregar un nuevo mantenimiento
    Given que el Personal proporciona los detalles del mantenimiento
    When el sistema agrega un nuevo registro de mantenimiento
    Then el sistema confirma que el mantenimiento se ha agregado exitosamente

  Scenario: Eliminar un mantenimiento
    Given que el Personal selecciona un mantenimiento para eliminar
    When el sistema elimina el mantenimiento seleccionado
    Then el sistema confirma que el mantenimiento se ha eliminado exitosamente

  Scenario: Editar un mantenimiento existente
    Given que el Personal proporciona los detalles actualizados del mantenimiento
    When el sistema actualiza el registro de mantenimiento
    Then el sistema confirma que el mantenimiento se ha actualizado exitosamente

  Scenario: Buscar mantenimientos
    Given que el Personal proporciona un término de búsqueda
    When el sistema busca registros de mantenimiento que coincidan con el término
    Then el sistema muestra los registros de mantenimiento que coinciden con el término de búsqueda
