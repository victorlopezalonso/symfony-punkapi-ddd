Feature:
  Search beers

  Scenario: It should fail with validations when the user calls without the required "page" query param
    Given a user sends a GET request to "/api/v1/beers"
    Then the response status code should be 400
    Then a message field should be provided
    Then a validations field should be provided

  Scenario: A list of 15 beers should be provided when the "page" query param is present
    Given a user sends a GET request to "/api/v1/beers?page=1"
    Then the response status code should be 200
    And the response data should contain 15 items
    And user can see id field in data field
    And user can see name field in data field
    And user can see description field in data field
    And user cannot see image field in data field
    And user cannot see slogan field in data field
    And user cannot see date field in data field

  Scenario: A list of N beers should be provided when the "perPage" query param is present
    Given a user sends a GET request to "/api/v1/beers?page=1&perPage=1"
    Then the response status code should be 200
    And the response data should contain 1 items

  Scenario: A list of N beers should be provided when the user filters by food
    Given a user sends a GET request to "/api/v1/beers?page=1&perPage=2&food=coriander"
    Then the response status code should be 200
    And the response data should contain 2 items
