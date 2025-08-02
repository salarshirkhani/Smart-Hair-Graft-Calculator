-- Create Database 
CREATE DATABASE IF NOT EXISTS hair_estimator
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE hair_estimator;

-- users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('male','female') NOT NULL,
    age INT NOT NULL,
    mobile VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- usermeta
CREATE TABLE usermeta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    meta_key VARCHAR(100) NOT NULL,
    meta_value TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- hair_pics
CREATE TABLE hair_pics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    file VARCHAR(255) NOT NULL,
    position VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- diagnosis
CREATE TABLE diagnosis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    method VARCHAR(50) NOT NULL,
    graft_count INT NOT NULL,
    branch VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
