Feature:
  Search beers

  Scenario: It should fail with a 404 if the beer "id" doesn't exist
    Given a user sends a GET request to "/api/v1/beers/0"
    Then the response status code should be 404
    Then a message field should be provided

  Scenario: A beer detail should be provided for an existing "id"
    Given a user sends a GET request to "/api/v1/beers/1"
    Then the response status code should be 200
    And user can see id field in data field
    And user can see name field in data field
    And user can see description field in data field
    And user can see image field in data field
    And user can see slogan field in data field
    And user can see date field in data field
