CREATE TABLE animals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    species VARCHAR(100) NOT NULL,
    adoption_date DATE,
    arrival_date DATE NOT NULL,
    loosebox INT NOT NULL,
    description TEXT,
    sex ENUM('samiec', 'samica') NOT NULL,
    status ENUM('dostepne', 'zaadoptowane', 'w_trakcie_adopcji', 'kwarantanna', 'niedostepne') NOT NULL
);

CREATE TABLE adoption_candidates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    house_conditions TEXT,
    sex ENUM('mezczyzna', 'kobieta')
);

CREATE TABLE adoption_tickets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATE NOT NULL,
    animal_preferences TEXT,
    status ENUM('nowe', 'w_trakcie_rozpatrywania', 'zatwierdzone', 'odrzucone', 'anulowane') NOT NULL,
    candidate_id INT NOT NULL,
    animal_id INT,
    FOREIGN KEY (candidate_id) REFERENCES adoption_candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (animal_id) REFERENCES animals(id) ON DELETE SET NULL
);

CREATE TABLE adoption_contracts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATE NOT NULL,
    content TEXT NOT NULL,
    is_signed BOOLEAN DEFAULT FALSE,
    ticket_id INT NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES adoption_tickets(id) ON DELETE CASCADE
);

CREATE TABLE office_workers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20)
);

CREATE TABLE office_worker_to_ticket (
    employee_id INT NOT NULL,
    ticket_id INT NOT NULL,
    assignment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (employee_id, ticket_id),
    FOREIGN KEY (employee_id) REFERENCES office_workers(id) ON DELETE CASCADE,
    FOREIGN KEY (ticket_id) REFERENCES adoption_tickets(id) ON DELETE CASCADE
);