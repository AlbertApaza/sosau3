Feature: Administrar Lugares
  Como Personal administrativo
  Quiero administrar los lugares en el sistema
  Para poder visualizar los lugares disponibles

  Scenario: Visualizar todos los lugares
    Given que el Personal navega a la página de administración de lugares
    When el sistema solicita todos los lugares
    Then el sistema muestra la lista de lugares disponibles
