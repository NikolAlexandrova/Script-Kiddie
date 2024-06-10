Testing assignment: 

## Test Plan

### User Stories to Test

#### User Story 1: Login Feature
- **As a user, I want to be able to log in with valid credentials, so that I can access my account.**
    - **Positive scenario:**
        - Scenario: User logs in with valid email and password.
        - **Why it is tested:** Ensures that users can access their accounts with the correct credentials.
    - **Negative Scenario:**
        - Scenario: User logs in with invalid credentials.
        - **Why it is tested:** Ensures that incorrect credentials are not accepted, enhancing security.
        - Scenario: User logs in with a nonexistent email.
        - **Why it is tested:** Ensures that only registered users can log in, preventing unauthorized access.

#### User Story 2: Registration Feature
- **As a new user, I want to be able to register with valid data, so that I can create an account.**
    - **Positive Scenario:**
        - Scenario: User registers with all required valid data.
        - **Why it is tested:** Ensures that new users can create accounts without issues.
    - **Negative Scenario:**
        - Scenario: User attempts to register with missing required fields.
        - **Why it is tested:** Ensures that all required information is provided for account creation.

### System Tests Per User Story

**User Story 1: Login Feature**
- **Positive scenario:**
    - Test: Successful login with valid email and password.
    - **Why it is tested:** Ensures that users can access their accounts with the correct credentials.
- **Negative Scenario:**
    - Test: Unsuccessful login with invalid credentials.
    - **Why it is tested:** Ensures that incorrect credentials are not accepted, enhancing security.
    - Test: Unsuccessful login with a nonexistent email.
    - **Why it is tested:** Ensures that only registered users can log in, preventing unauthorized access.

**User Story 2: Registration Feature**
- **Positive scenario:**
    - Test: Successful registration with valid data.
    - **Why it is tested:** Ensures that new users can create accounts without issues.
- **Negative Scenario:**
    - Test: Unsuccessful registration with missing required fields.
    - **Why it is tested:** Ensures that all required information is provided for account creation.

### Unit Tests Per User Story

**User Story 1: Login Feature**
- **Positive scenario:**
    - Test: Check login method with correct credentials.
    - **Why it is tested:** Verifies that the login logic works correctly for valid inputs.
- **Negative Scenario:**
    - Test: Check login method with incorrect password.
    - **Why it is tested:** Verifies that incorrect passwords are rejected.
    - Test: Check login method with nonexistent email.
    - **Why it is tested:** Verifies that only existing users can log in.

**User Story 2: Registration Feature**
- **Positive scenario:**
    - Test: Validate registration method with correct data.
    - **Why it is tested:** Ensures that the registration logic correctly handles valid data.
- **Negative Scenario:**
    - Test: Validate registration method with missing fields.
    - **Why it is tested:** Ensures that registration fails if required fields are missing.

### Evaluation

**Describe a possible mistake/error that can be detected by your test(s):**
- **Example:** One possible mistake that can be detected by the tests is an incorrect password. The test ensures that users cannot log in if they provide a wrong password.

**Describe a possible mistake/error that cannot be detected by your test(s):**
- **Example:** An error that may not be detected by these tests is a bug related to the user interface (UI) that causes login or registration buttons to be non-functional. These tests do not cover front-end issues.

**To what extent can you conclude that "everything works correctly"? Provide arguments!**
- While the tests cover essential aspects of login and registration functionalities, concluding that "everything works correctly" can be premature. The tests ensure that the backend logic for authentication and user creation works as expected for specified scenarios. However, they do not cover all possible edge cases, integration issues with other parts of the application, performance under load, security vulnerabilities, or front-end related bugs. Therefore, comprehensive testing including UI tests, security tests, and performance tests would be necessary to confidently conclude that everything works correctly.

### Linking Tests to the V-Model

1. **Requirement Analysis**: User should be able to log in with valid credentials.
    - **System Tests**: Written to ensure that the system meets all specified requirements.

2. **System Design**: Design the login module.
    - **Integration Tests**: Ensures that different modules or systems work together.

3. **Architecture Design**: Plan how the login module integrates with the rest of the system.
    - **Unit Tests**: Focuses on individual components to ensure that each one operates correctly.

4. **Module Design**: Design the individual components of the login module.
    - **Unit Tests**: Detailed design and testing of individual modules or components.

### Use of Factories
- Implement factories to create consistent and reliable test data for unit and system tests, ensuring a robust test environment.

### Evaluation
- The tests were designed to cover both Positive scenario and Negative Scenario for login and registration functionalities. They ensure that the core authentication mechanisms work correctly and handle various error scenarios gracefully. The testing results indicate that the authentication and registration functionalities are working as intended under normal and adverse conditions. However, the tests do not cover front-end issues or other possible integration problems. While the current tests are comprehensive for backend logic, an improvement would be to include front-end tests using tools like Selenium or Cypress to ensure that UI elements function correctly. Additionally, security tests to check for vulnerabilities such as SQL injection or XSS could be added to the test suite.

