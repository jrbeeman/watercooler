@api @watercooler
Feature: Watercooler Podcast
  Makes sure that the podcast content type was created during installation and assures it behaves as expected.

  Scenario: Make sure that the podcast content types provided by Watercooler at installation are present.
    Given I am logged in as a user with the administrator role
    When I visit "/node/add"
    Then I should see "Podcast"
    And I should see "Podcast episode"
