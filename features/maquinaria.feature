Feature: Administrar Maquinaria
  Como Administrador
  Quiero gestionar la información de maquinaria
  Para mantener un catálogo actualizado

  Background:
    Given que el sistema está configurado para administrar la maquinaria

  Scenario: Listar todas las maquinarias
    Given que el Personal navega a la página de administración de maquinaria
    When el sistema solicita todas las maquinarias
    Then el sistema muestra la lista de maquinarias disponibles

  Scenario: Mostrar detalles de una maquinaria específica
    Given que el Personal navega a la página de administración de maquinaria
    And selecciona una maquinaria específica
    When el sistema muestra los detalles de la maquinaria con ID 1
    Then el sistema muestra la información de la maquinaria correctamente

  Scenario: Agregar una nueva maquinaria
    Given que el Personal navega a la página de administración de maquinaria
    And selecciona "Agregar nueva maquinaria"
    And completa el formulario con los datos de la nueva maquinaria
    When el sistema guarda la nueva maquinaria en la base de datos
    Then el sistema muestra un mensaje de confirmación

  Scenario: Editar una maquinaria existente
    Given que el Personal navega a la página de administración de maquinaria
    And selecciona una maquinaria para editar
    And modifica la información de la maquinaria
    When el sistema actualiza la maquinaria en la base de datos
    Then el sistema muestra un mensaje de confirmación

  Scenario: Eliminar una maquinaria existente
    Given que el Personal navega a la página de administración de maquinaria
    And selecciona una maquinaria para eliminar
    When el sistema confirma la eliminación
    Then el sistema elimina la maquinaria de la base de datos
    And muestra un mensaje de confirmación
