CREATE TABLE IF NOT EXISTS employees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    hire_date DATE,
    password VARCHAR(255) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    position ENUM('opiekun', 'weterynarz', 'pracownik_biurowy', 'magazynier', 'kierownik') NOT NULL
);

CREATE TABLE schedule (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_from DATE NOT NULL,
    date_to DATE NOT NULL,
    CHECK (date_to >= date_from)
);

CREATE TABLE scheduled_tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATE NOT NULL,
    content TEXT NOT NULL,
    position ENUM('opiekun', 'weterynarz', 'pracownik_biurowy', 'magazynier', 'kierownik') NOT NULL,
    employee_id INT NOT NULL,
    schedule_id INT NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES Pracownik(id) ON DELETE CASCADE,
    FOREIGN KEY (schedule_id) REFERENCES Harmonogram(id) ON DELETE CASCADE
);