@api @watercooler
Feature: Watercooler Podcast
  Makes sure that the podcast content type was created during installation and assures it behaves as expected.

  Scenario: Ensure that the podcast content types provided by Watercooler at installation are present.
    Given I am logged in as a user with the administrator role
    When I visit "/node/add"
    Then I should see "Podcast"
    And I should see "Podcast episode"

  @javascript
  Scenario: Ensure that podcast fields are present.
    Given I am logged in as a user with the administrator role
    When I visit "node/add/podcast"
    Then I should see a "title[0][value]" field
    And I should see a "field_subtitle[0][value]" field
    And I should see a "body[0][value]" field
    And I should see a "field_podcast_category[0][target_id]" field
    And I should see a "field_podcast_explicit" field
    And I should see a "field_podcast_owner[0][value]" field
    And I should see a "field_podcast_author[0][value]" field
    And I should see a "field_podcast_editor[0][value]" field

  Scenario: Ensure that podcast episode fields are present.
    Given I am logged in as a user with the administrator role
    When I visit "node/add/podcast_episode"
    Then I should see a "title[0][value]" field
    And I should see a "field_podcast[0][target_id]" field
    And I should see a "body[0][value]" field
    And I should see a "field_podcast_enclosure[0][value]" field
    And I should see a "field_podcast_author[0][value]" field
    And I should see a "field_podcast_category[0][target_id]" field
    And I should see a "field_podcast_explicit" field
