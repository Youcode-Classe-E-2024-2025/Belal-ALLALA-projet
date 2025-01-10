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
    deadline TIMESTAMP NOT NULL,
    statut ENUM('Todo', 'Doing', 'Done') DEFAULT 'Todo',
    type ENUM('Basic', 'Bug', 'Feature') NOT NULL,
    id_group INT DEFAULT NULL,
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

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Nouveau tableau : category_task
CREATE TABLE category_task (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_category INT NOT NULL,
    id_task INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_category_task_category FOREIGN KEY (id_category) REFERENCES categories(id) ON DELETE CASCADE,
    CONSTRAINT fk_category_task_task FOREIGN KEY (id_task) REFERENCES tasks(id) ON DELETE CASCADE,
    UNIQUE (id_category, id_task)
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

INSERT INTO categories (name) VALUES
('Bug Fixing'),
('Feature Development'),
('Documentation'),
('Testing');

-- Associer des catégories aux tâches
INSERT INTO category_task (id_category, id_task) VALUES
(1, 1),  -- 'Fix login bug' dans 'Bug Fixing'
(2, 2),  -- 'Design new homepage' dans 'Feature Development'
(3, 3),  -- 'Write documentation' dans 'Documentation'
(4, 4);  -- 'Test payment system' dans 'Testing'

-- Table roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table permissions
CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table role_permission
CREATE TABLE role_permission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_role_permission_role FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    CONSTRAINT fk_role_permission_permission FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    UNIQUE (role_id, permission_id)
) ENGINE=InnoDB;

-- Table project_user_roles
CREATE TABLE project_user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    team_id INT NOT NULL,
    role_id INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_project_user_roles_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_project_user_roles_team FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE,
    CONSTRAINT fk_project_user_roles_role FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    UNIQUE (user_id, team_id, role_id)
) ENGINE=InnoDB;

-- Insérer des rôles
INSERT INTO roles (name, description) VALUES
('Admin', 'Full access to manage projects, tasks, and users'),
('Project Manager', 'Manage project details, tasks, and team members'),
('Team Member', 'Contribute to tasks assigned within the project');

-- Insérer des permissions
INSERT INTO permissions (name, description) VALUES
('Create Task', 'Permission to create tasks in a project'),
('Edit Task', 'Permission to edit tasks in a project'),
('Delete Task', 'Permission to delete tasks in a project'),
('Assign Role', 'Permission to assign roles to team members');

-- Associer des permissions aux rôles
INSERT INTO role_permission (role_id, permission_id) VALUES
(1, 1), -- Admin: Create Task
(1, 2), -- Admin: Edit Task
(1, 3), -- Admin: Delete Task
(1, 4), -- Admin: Assign Role
(2, 1), -- Project Manager: Create Task
(2, 2), -- Project Manager: Edit Task
(2, 4), -- Project Manager: Assign Role
(3, 1); -- Team Member: Create Task

-- Associer des rôles aux utilisateurs dans des projets
INSERT INTO project_user_roles (user_id, team_id, role_id) VALUES
(1, 1, 1), -- John Doe: Admin dans Team A
(2, 1, 2), -- Jane Smith: Project Manager dans Team A
(3, 2, 3), -- Alice Johnson: Team Member dans Team B
(4, 2, 3); -- Bob Brown: Team Member dans Team B
