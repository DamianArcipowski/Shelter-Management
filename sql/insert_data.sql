INSERT INTO animals (name, species, adoption_date, arrival_date, loosebox, description, sex, status)
VALUES ('Burek', 'Pies', NULL, '2026-01-13', 3, 'Kundel o brązowym umaszczeniu, bardzo przyjaźnie usposobiony', 'samiec', 'kwarantanna'),
VALUES ('Mruczek', 'Kot', NULL, '2026-01-10', 5, 'Kot o czarnym futrze z białą plamką przy nosie, krępej postury', 'samiec', 'kwarantanna'),
VALUES ('Bela', 'Królik', NULL, '2026-01-02', 1, 'Królik z raną lewego ucha, wymaga dalszego odrobaczania', 'samica', 'dostepne');

--decoded password for all users: secret1!
INSERT INTO employees (first_name, surname, hire_date, password, login, position) 
VALUES ('Jan', 'Kowalski', '2026-01-17', '$2y$10$MxLkTp4C38Ie8zCkiNsoX.ZbtyDETWFta7yhG02GH7Kd/X4Rj6uhC', 'jkowalski', 'pracownik_biurowy'),
('Adam', 'Mickiewicz', '2022-01-17', '$2y$10$MxLkTp4C38Ie8zCkiNsoX.ZbtyDETWFta7yhG02GH7Kd/X4Rj6uhC', 'amickiewicz', 'magazynier'),
('Stefan', 'Rogowski', '2020-01-17', '$2y$10$MxLkTp4C38Ie8zCkiNsoX.ZbtyDETWFta7yhG02GH7Kd/X4Rj6uhC', 'srogowski', 'weterynarz');