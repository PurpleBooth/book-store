Feature: Book storage
  In order to keep track of what books I have
  As a librarian
  I need to be able to add new books

  Scenario: Add a new book
    When I add a new book
    Then I should be given a book with the ID added