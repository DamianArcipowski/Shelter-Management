<?php

session_start();
if (!isset($_SESSION['signed_in']) || $_SESSION['role'] != 'pracownik_biurowy') {
    header('Location: ../login.php?access=false');
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
    <link rel="stylesheet" type="text/css" href="../css/views.css">
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
                        <button class="sidebar-btn" onclick="showAddAnimalForm()">Wyświetl zwierzęta</button>
                    </div>
                    <div class="sidebar-section">
                        <button class="sidebar-btn" onclick="showAddAnimalForm()">Dodaj zwierzę</button>
                    </div>
                    <div class="sidebar-section">
                        <button class="sidebar-btn" onclick="goBack()">Wróć</button>
                    </div>
                </aside>
                <main>
                    <div class="search-section">
                        <div class="search-grid">
                            <div class="search-group">
                                <label>Szukaj po nazwie</label>
                                <input type="text" placeholder="Text" id="searchName">
                            </div>
                            <button class="search-btn" onclick="searchByName()">Szukaj</button>
                            <div class="search-group">
                                <label>Szukaj po id</label>
                                <input type="text" placeholder="Text" id="searchId">
                            </div>
                            <button class="search-btn" onclick="searchById()">Szukaj</button>
                            <div class="search-group">
                                <label>Szukaj po gatunku</label>
                                <select id="filterSpecies">
                                    <option value="">Pies</option>
                                    <option value="kot">Kot</option>
                                    <option value="pies">Pies</option>
                                    <option value="krolik">Królik</option>
                                    <option value="inne">Inne</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table id="animalsTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>nazwa</th>
                                    <th>gatunek</th>
                                    <th>płeć</th>
                                    <th>data_przybycia</th>
                                    <th>opis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>23</td>
                                    <td>Łajka</td>
                                    <td>pies</td>
                                    <td>samiec</td>
                                    <td>20.5.2024</td>
                                    <td>wytrośowany, potrzebuje dużo aktywności fizycznej</td>
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td>Mruczek</td>
                                    <td>kot</td>
                                    <td>samiec</td>
                                    <td>15.6.2024</td>
                                    <td>spokojny, lubi się przytulać</td>
                                </tr>
                                <tr>
                                    <td>25</td>
                                    <td>Bela</td>
                                    <td>pies</td>
                                    <td>samica</td>
                                    <td>03.7.2024</td>
                                    <td>energiczna, dobra z dziećmi</td>
                                </tr>
                                <tr>
                                    <td>26</td>
                                    <td>Puszek</td>
                                    <td>królik</td>
                                    <td>samiec</td>
                                    <td>12.8.2024</td>
                                    <td>łagodny, potrzebuje przestrzeni</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <div class="footer">2026 | Damian Arcipowski & Dawid Lewandowski | All rights reserved &copy</div>
</body>
</html>