# Basketball Team Management

This is a web application for managing a basketball team. It allows you to manage players, schedule training sessions, track the team's budget, and create game strategies.

## How to Run the Project

Follow these steps to get the project up and running on your local machine.

### Prerequisites

-   A web server with PHP support (e.g., Apache)
-   MySQL or MariaDB
-   A web browser

### Step 1: Clone the Repository

Clone this repository to your local machine using the following command:

```bash
git clone https://github.com/your-username/basketball-team-management.git
```

### Step 2: Set Up the Database

1.  Open your MySQL client (e.g., phpMyAdmin, MySQL command-line client).
2.  Create a new database named `basketball_team_management`.
3.  Execute the SQL commands in the `database.sql` file to create the necessary tables.

### Step 3: Configure the Database Connection

1.  Open the `php/config/database.php` file.
2.  Update the database connection details (`$host`, `$db_name`, `$username`, `$password`) to match your local environment.

### Step 4: Run the Application

1.  Place the project files in the root directory of your web server (e.g., `htdocs` for XAMPP, `www` for WampServer).
2.  Open your web browser and navigate to the following URLs to access the different modules of the application:
    -   **Player Management:** `http://localhost/basketball-team-management/`
    -   **Training Schedule:** `http://localhost/basketball-team-management/training.html`
    -   **Budget Management:** `http://localhost/basketball-team-management/budget.html`
    -   **Strategy Board:** `http://localhost/basketball-team-management/strategy.html`

That's it! You should now be able to use the application to manage your basketball team.
