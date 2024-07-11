Feature: Retrieve all places
  As a user
  I want to retrieve all places from the database
  So that I can see a list of available places

  Scenario: User requests all places
    Given there are places in the database
    When I request all places
    Then I should get a list of places
      And each place should have an "idlugar"
