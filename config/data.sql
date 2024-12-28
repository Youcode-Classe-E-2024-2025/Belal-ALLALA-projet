CREATE DATABASE TaskFlow;
USE TaskFlow;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    id_admin INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_group_admin FOREIGN KEY (id_admin) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE team_member (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_group INT NOT NULL,
    id_user INT NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_group_member_group FOREIGN KEY (id_group) REFERENCES teams(id) ON DELETE CASCADE,
    CONSTRAINT fk_group_member_user FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE (id_group, id_user) 
) ENGINE=InnoDB;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    description TEXT,
    deadline DATE NOT NULL,
    statut ENUM('Todo', 'Doing', 'Done') DEFAULT 'Todo',
    type ENUM('Basic', 'Bug', 'Feature') NOT NULL DEFAULT 'Basic',
    id_group INT NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_task_group FOREIGN KEY (id_group) REFERENCES teams(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE task_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_task INT NOT NULL,
    id_user INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_task_user_task FOREIGN KEY (id_task) REFERENCES tasks(id) ON DELETE CASCADE,
    CONSTRAINT fk_task_user_user FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE (id_task, id_user) 
) ENGINE=InnoDB;

-- Insérer des utilisateurs (fake data)
INSERT INTO users (name, email, password_hash) VALUES
('John Doe', 'johndoe@example.com', 'password123'),
('Jane Smith', 'janesmith@example.com', 'password123'),
('Alice Johnson', 'alicej@example.com', 'password123'),
('Bob Brown', 'bobbrown@example.com', 'password123');

-- Insérer des équipes
INSERT INTO teams (name, id_admin) VALUES
('Team A', 1),  -- admin est l'utilisateur avec id 1
('Team B', 2);  -- admin est l'utilisateur avec id 2

-- Insérer des membres d'équipe
INSERT INTO team_member (id_group, id_user) VALUES
(1, 1),  -- John Doe dans Team A
(1, 2),  -- Jane Smith dans Team A
(2, 3),  -- Alice Johnson dans Team B
(2, 4);  -- Bob Brown dans Team B

-- Insérer des tâches
INSERT INTO tasks (titre, description, deadline, statut, type, id_group) VALUES
('Fix login bug', 'Fix the login issue on the website', '2024-12-30', 'Todo', 'Bug', 1),
('Design new homepage', 'Design the new homepage layout for the website', '2024-12-25', 'Doing', 'Feature', 1),
('Write documentation', 'Write the technical documentation for the API', '2024-12-28', 'Todo', 'Basic', 2),
('Test payment system', 'Test the payment gateway integration for bugs', '2024-12-29', 'Done', 'Bug', 2);

-- Assigner des tâches aux utilisateurs
INSERT INTO task_user (id_task, id_user) VALUES
(1, 1),  -- John Doe sur 'Fix login bug'
(2, 2),  -- Jane Smith sur 'Design new homepage'
(3, 3),  -- Alice Johnson sur 'Write documentation'
(4, 4);  -- Bob Brown sur 'Test payment system'

