<?php

session_start();
if (!isset($_SESSION['signed_in']) || $_SESSION['role'] != 'pracownik_biurowy') {
    header('Location: ../index.php?access=false');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Damian Arcipowki, Dawid Lewandowski">
    <title>Schronisko</title>
    <link rel="icon" type="image/x-icon" href="../images/paws.ico">
    <link rel="stylesheet" type="text/css" href="../css/views.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="../js/office_worker.js" defer></script>
</head>
<body>
    <div class="container">
        <nav class="nav-tabs">
            <button class="nav-tab">Plan</button>
            <button class="nav-tab">Adopcja</button>
            <button class="nav-tab active">Zwierzęta</button>
            <button class="nav-tab logout-btn">Wyloguj</button>
        </nav>
        <div class="content">
            <div class="layout">
                <aside class="sidebar">
                    <div class="sidebar-section">
                        <button class="sidebar-btn" id="create-animal-btn">Dodaj zwierzę</button>
                    </div>
                </aside>
                <main>
                    <div class="search-section">
                        <div class="search-grid">
                            <div class="search-group">
                                <label>Szukaj po nazwie</label>
                                <input type="text" placeholder="Nazwa" id="search-name">
                            </div>
                            <button class="search-btn" id="search-name-btn">Szukaj</button>
                            <div class="search-group">
                                <label>Szukaj po id</label>
                                <input type="text" placeholder="ID" id="search-id">
                            </div>
                            <button class="search-btn" id="search-id-btn">Szukaj</button>
                            <div class="search-group">
                                <label>Szukaj po gatunku</label>
                                <select id="filter-species">
                                    <option value="">Wybierz</option>
                                    <option value="Kot">Kot</option>
                                    <option value="Pies">Pies</option>
                                    <option value="Królik">Królik</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <p class="success-notification"></p>
                    <div class="form-content hidden">
                        <form id="create-animal-form">
                            <div class="form-row">
                                <label class="form-label">Nazwa</label>
                                <input type="text" name="name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Gatunek</label>
                                <select name="species" class="form-input" required>
                                    <option value="">Wybierz gatunek</option>
                                    <option value="Pies">Pies</option>
                                    <option value="Kot">Kot</option>
                                    <option value="Królik">Królik</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Data przybycia</label>
                                <input type="date" name="arrival_date" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Numer boksu</label>
                                <input type="number" name="loosebox" class="form-input" min="1" required>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Opis</label>
                                <textarea name="description" class="form-input" required></textarea>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Płeć</label>
                                <select name="sex" class="form-input" required>
                                    <option value="">Wybierz płeć</option>
                                    <option value="samiec">Samiec</option>
                                    <option value="samica">Samica</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-input" required>
                                    <option value="kwarantanna">Kwarantanna</option>
                                </select>
                            </div>
                            <button type="submit" class="submit-btn">Dodaj zwierzę</button>
                        </form>
                    </div>
                    <div class="table-container">
                        <table id="animalsTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nazwa</th>
                                    <th>Gatunek</th>
                                    <th>Data adopcji</th>
                                    <th>Data przybycia</th>
                                    <th>Numer boksu</th>
                                    <th>Opis</th>
                                    <th>Płeć</th>
                                    <th>Status</th>
                                    <th>Edytuj</th>
                                    <th>Usuń</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <div class="footer">2026 | Damian Arcipowski & Dawid Lewandowski | All rights reserved &copy</div>
</body>
</html>