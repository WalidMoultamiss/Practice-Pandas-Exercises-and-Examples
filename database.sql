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
