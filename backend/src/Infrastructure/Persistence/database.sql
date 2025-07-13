CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    health_status VARCHAR(255) NOT NULL
);

CREATE TABLE statistics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT NOT NULL,
    stat_name VARCHAR(255) NOT NULL,
    stat_value VARCHAR(255) NOT NULL,
    FOREIGN KEY (player_id) REFERENCES players(id)
);

CREATE TABLE game_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE game_plan_assignments (
    game_plan_id INT NOT NULL,
    player_id INT NOT NULL,
    PRIMARY KEY (game_plan_id, player_id),
    FOREIGN KEY (game_plan_id) REFERENCES game_plans(id),
    FOREIGN KEY (player_id) REFERENCES players(id)
);

CREATE TABLE budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL
);

CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    budget_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (budget_id) REFERENCES budgets(id)
);

CREATE TABLE contracts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    FOREIGN KEY (player_id) REFERENCES players(id)
);

CREATE TABLE trainings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    date DATETIME NOT NULL
);

CREATE TABLE training_players (
    training_id INT NOT NULL,
    player_id INT NOT NULL,
    PRIMARY KEY (training_id, player_id),
    FOREIGN KEY (training_id) REFERENCES trainings(id),
    FOREIGN KEY (player_id) REFERENCES players(id)
);

CREATE TABLE injuries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT NOT NULL,
    injury_description VARCHAR(255) NOT NULL,
    is_recovered BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (player_id) REFERENCES players(id)
);
