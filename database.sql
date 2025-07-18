CREATE DATABASE basketball_team_management;

USE basketball_team_management;

CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    statistics VARCHAR(255) NOT NULL,
    health VARCHAR(255) NOT NULL,
    injuries VARCHAR(255) NOT NULL
);

CREATE TABLE training_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    players_involved TEXT NOT NULL
);

CREATE TABLE budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_amount DECIMAL(10, 2) NOT NULL,
    current_amount DECIMAL(10, 2) NOT NULL
);

CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    date DATE NOT NULL
);
