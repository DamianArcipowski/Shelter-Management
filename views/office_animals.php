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
    <div class="form-content hidden" data-form="create">
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
    <div class="form-content hidden" data-form="update">
        <form id="update-animal-form">
            <div class="form-row">
                <label class="form-label">Nazwa</label>
                <input type="text" name="name" class="form-input" data-name="name" required>
            </div>
            <div class="form-row">
                <label class="form-label">Gatunek</label>
                <select name="species" class="form-input" data-name="species" required>
                    <option value="">Wybierz gatunek</option>
                    <option value="Pies">Pies</option>
                    <option value="Kot">Kot</option>
                    <option value="Królik">Królik</option>
                </select>
            </div>
            <div class="form-row">
                <label class="form-label">Data adopcji</label>
                <input type="date" name="adoption_date" class="form-input">
            </div>
            <div class="form-row">
                <label class="form-label">Data przybycia</label>
                <input type="date" name="arrival_date" class="form-input" data-name="arrival_date" required>
            </div>
            <div class="form-row">
                <label class="form-label">Numer boksu</label>
                <input type="number" name="loosebox" class="form-input" min="1" data-name="loosebox" required>
            </div>
            <div class="form-row">
                <label class="form-label">Opis</label>
                <textarea name="description" class="form-input" data-name="description" required></textarea>
            </div>
            <div class="form-row">
                <label class="form-label">Płeć</label>
                <select name="sex" class="form-input" data-name="sex" required>
                    <option value="">Wybierz płeć</option>
                    <option value="samiec">Samiec</option>
                    <option value="samica">Samica</option>
                </select>
            </div>
            <div class="form-row">
                <label class="form-label">Status</label>
                <select name="status" class="form-input" data-name="status" required>
                    <option value="kwarantanna">Kwarantanna</option>
                    <option value="dostepne">Dostępne</option>
                    <option value="zaadoptowane">Zaadoptowane</option>
                    <option value="niedostepne">Niedostepne</option>
                    <option value="w_trakcie_adopcji">W trakcie adopcji</option>
                </select>
            </div>
            <button type="button" class="return-btn">Cofnij</button>
            <button type="submit" class="submit-btn">Edytuj zwierzę</button>     
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