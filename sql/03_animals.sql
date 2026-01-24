CREATE TABLE IF NOT EXISTS animals (
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

CREATE TABLE IF NOT EXISTS vets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    hire_date DATE,
    password VARCHAR(255) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    position ENUM('opiekun', 'weterynarz', 'pracownik_biurowy', 'magazynier', 'kierownik') NOT NULL DEFAULT 'weterynarz'
);

CREATE TABLE IF NOT EXISTS animal_records (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATE NOT NULL,
    medical_history TEXT,
    animal_id INT NOT NULL,
    prescriptions TEXT,
    FOREIGN KEY (animal_id) REFERENCES animals(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS medical_entries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATE NOT NULL,
    content TEXT NOT NULL,
    record_id INT NOT NULL,
    vet_id INT NOT NULL,
    FOREIGN KEY (record_id) REFERENCES animal_records(id) ON DELETE CASCADE,
    FOREIGN KEY (vet_id) REFERENCES vets(id) ON DELETE CASCADE
);