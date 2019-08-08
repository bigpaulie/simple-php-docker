Feature:
  Testing container packaging

  Scenario: find hello from hostname string
    Given I go to the homepage
    Then I should see the string "Hello from"