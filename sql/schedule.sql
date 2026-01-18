CREATE TABLE IF NOT EXISTS employees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    hire_date DATE NOT NULL,
    password VARCHAR(255) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    position ENUM('opiekun', 'weterynarz', 'pracownik_biurowy', 'magazynier', 'kierownik') NOT NULL
);

CREATE TABLE IF NOT EXISTS schedule (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_from DATE NOT NULL,
    date_to DATE NOT NULL,
    CHECK (date_to >= date_from)
);

CREATE TABLE IF NOT EXISTS scheduled_tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATE NOT NULL,
    content TEXT NOT NULL,
    position ENUM('opiekun', 'weterynarz', 'pracownik_biurowy', 'magazynier', 'kierownik') NOT NULL,
    employee_id INT NOT NULL,
    schedule_id INT NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE,
    FOREIGN KEY (schedule_id) REFERENCES schedule(id) ON DELETE CASCADE
);