<aside class="sidebar">
    <div class="sidebar-section">
        <button class="sidebar-btn" id="create-task-btn">Dodaj zadanie</button>
        <button class="sidebar-btn" id="show-tasks-btn">Wyswietl zadania</button>
        <button class="sidebar-btn" id="add-schedule-btn">Dodaj plan</button>
    </div>
</aside>
<main>
   <div id="form-wrapper-schedule" class="form-content hidden">
    <form id="create-task-form">
        <div class="form-row">
            <label class="form-label">Pracownik</label>
            <select name="employee_id" id="employee-select" class="form-input" required>
                <option value="">Wybierz pracownika</option>
            </select>
        </div>
        <div class="form-row">
            <label class="form-label">Data zadania</label>
            <input type="date" name="task_date" class="form-input" required>
        </div>
        <div class="form-row">
            <label class="form-label">Opis</label>
            <textarea name="opis" class="form-input" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Dodaj zadanie</button>
    </form>
</div>
    <div id="table-wrapper-schedule" class="table-container hidden">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Imie</th>
                    <th>Nazwisko</th>
                    <th>Funkcja</th>
                    <th>Data zadania</th>
                    <th>Opis</th>
                    <th>Usuń</th>
                </tr>
            </thead>
            <tbody id="scheduleTable"></tbody>
        </table>
    </div>
     <div id="add-wrapper-schedule" class="table hidden">
         <div class="form-content">
            <form id="add-schedule-form">
                <div class="form-row">
                    <label class="form-label">Data rozpoczecia planu</label>
                    <input type="date" name="start_date" class="form-input" required>
                </div>
                <div class="form-row">
                    <label class="form-label">Data zakonczenia planu</label>
                    <input type="date" name="finish_date" class="form-input" required>
                </div>
                 <button id="add_new_schedule" type="submit" class="submit-btn">Dodaj plan</button>
            </form>
        </div>
    </div>
</main>