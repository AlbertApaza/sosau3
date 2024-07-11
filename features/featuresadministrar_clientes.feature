Feature: Administrar Clientes
  Como Personal administrativo
  Quiero administrar clientes en el sistema
  Para poder crear, visualizar, actualizar y eliminar clientes

  Scenario: Visualizar Clientes
    Given que el Personal navega a la página de administración de clientes
    Then el sistema muestra la lista de clientes disponibles
