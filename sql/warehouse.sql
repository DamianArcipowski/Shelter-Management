CREATE TABLE warehouse (
    id INT PRIMARY KEY DEFAULT 1,
    warehouse_name VARCHAR(100) NOT NULL DEFAULT 'Magazyn Główny',
    location VARCHAR(255),
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CHECK (id = 1)
);

INSERT INTO warehouse (id, warehouse_name, location) VALUES (1, 'Magazyn Główny', 'Olsztyn, WMII');

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    expiration_date DATE,
    amount DECIMAL(10,2) NOT NULL DEFAULT 0,
    unit ENUM('kg', 'szt', 'l', 'opakowanie', 'porcja', 'worek') NOT NULL,
    category ENUM('karma', 'lekarstwa', 'akcesoria', 'srodki_czystosci', 'inne') NOT NULL,
    warehouse_id INT NOT NULL DEFAULT 1,
    FOREIGN KEY (warehouse_id) REFERENCES warehouse(id) ON DELETE CASCADE,
    CHECK (amount >= 0)
);

CREATE TABLE warehouse_reports (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATE NOT NULL,
    quarter INT NOT NULL,
    year INT NOT NULL,
    warehouse_id INT NOT NULL DEFAULT 1,
    FOREIGN KEY (warehouse_id) REFERENCES warehouse(id) ON DELETE CASCADE,
    CHECK (quarter BETWEEN 1 AND 4),
    CHECK (year >= 2025 AND year <= 2050)
);

CREATE TABLE warehouse_report_products (
    report_id INT NOT NULL,
    product_id INT NOT NULL,
    product_amount DECIMAL(10,2) NOT NULL,
    worth DECIMAL(10,2),
    comments TEXT,
    PRIMARY KEY (report_id, product_id),
    FOREIGN KEY (report_id) REFERENCES warehouse_reports(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS warehouse_workers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    position VARCHAR(100) DEFAULT 'Magazynier',
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20),
    hire_date DATE,
    warehouse_id INT NOT NULL DEFAULT 1,
    FOREIGN KEY (warehouse_id) REFERENCES Magazyn(id) ON DELETE CASCADE
);

CREATE TABLE warehouse_operations_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    type ENUM('przyjecie', 'wydanie', 'zwrot', 'korekta', 'usuniecie') NOT NULL,
    product_id INT NOT NULL,
    amount_change DECIMAL(10,2) NOT NULL,
    amount_after DECIMAL(10,2) NOT NULL,
    employee_id INT,
    description TEXT,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (employee_id) REFERENCES warehouse_workers(id) ON DELETE SET NULL
);