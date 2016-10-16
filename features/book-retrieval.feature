Feature: Book retrieval
  In order to keep track of what books I have
  As a librarian
  I need to be able to retrieve books

  Scenario: Get a book
    When I retrieve a book
    Then I should be given a book