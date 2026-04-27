CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default Posts
INSERT INTO posts (title, content) VALUES 
('My First MVC Post', 'This is coming from the database!'),
('Why PDO is Awesome', 'It protects us from hackers.');

-- Default Admin User (Password: admin123)
INSERT INTO users (username, password) VALUES 
('admin', '$2y$10$8.UnVuG9HHgffUDAlk8qfOuVGkqRzgVymGe07xd00DMp99VvD73XG');