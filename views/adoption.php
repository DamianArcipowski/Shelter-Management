                <aside class="sidebar">
                    <div class="sidebar-section">
                        <button class="sidebar-btn" data-target="candidates" id="form-adoption-btn">Kandydaci</button>
                        <button class="sidebar-btn" data-target="add-candidate" id="add-adoption-btn">Dodaj Kandydata</button>
                        <button class="sidebar-btn" data-target="adoption_tickets" id="adoption_tickets-btn">Zgłoszenia</button>
                        <button class="sidebar-btn" data-target="add-adoption_tickets" id="add-adoption_tickets-btn">Dodaj Zgłoszenie</button>
                        <button class="sidebar-btn" data-target="contracts" id="contracts-btn">Kontrakty</button>
                        <button class="sidebar-btn" data-target="add-contract" id="add-contract-btn">Dodaj Kontrakt</button>
                    </div>
                </aside>
                <main>
                   <div id="candidates" class="view hidden">
        
                   </div>
                   <div id="add-candidate" class="view hidden">
                        <div class="form-content">
                           <form id="add-candidate-form">
                                 <div class="form-row">
                                     <label class="form-label">Imie</label>
                                     <input type="text" name="first_name" class="form-input" required>
                                 </div>
                                <div class="form-row">
                                     <label class="form-label">Nazwisko</label>
                                     <input type="text" name="surname" class="form-input" required>
                                 </div>
                                 <div class="form-row">
                                     <label class="form-label">Adres</label>
                                     <input type="text" name="address" class="form-input" required>
                                 </div>
                                 <div class="form-row">
                                     <label class="form-label">Email</label>
                                     <input type="email" name="email" class="form-input" required>
                                 </div>
                                 <div class="form-row">
                                     <label class="form-label">Numer telefonu</label>
                                     <input type="text" name="phone_number" class="form-input" required>
                                 </div>
                                 <div class="form-row">
                                     <label class="form-label">Warunki mieszkalne</label>
                                     <textarea name="house_conditions" class="form-input" required></textarea>
                                 </div>
                                 <div class="form-row">
                                 <label class="form-label">Płeć</label>
                                <select class="form-input" name="sex" id="sex" required>
                                    <option value="">-- wybierz --</option>
                                    <option value="mezczyzna">Mężczyzna</option>
                                    <option value="kobieta">Kobieta</option>
                                </select>
                                </div>
                                 <button type="submit" class="submit-btn">Dodaj kandydata</button>
                            </form>
                        </div>
                   </div>
                   <div id="adoption_tickets" class="view hidden">
                            <div class="table-container">
                        <table id="ticketsTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Data</th>
                                    <th>Opis</th>
                                    <th>Status</th>
                                    <th>Imie</th>
                                    <th>Nazwisko</th>
                                    <th>Zwierze</th>
                                    <th>Edytuj</th>
                                    <th>Usun</th>
                                </tr>
                            </thead>
                            <tbody id="tickets_body" ></tbody>
                        </table>
                        </div>
                   </div>
                    <div id="add-adoption_tickets" class="view hidden">
                          <div class="form-content">
                           <form id="add-ticket-form">
                                 <div class="form-row">
                                     <label class="form-label">Preferowane zwierzę</label>
                                     <textarea name="animal_preferences" class="form-input" required></textarea>
                                 </div>
                                 <div class="form-row">
                                 <label class="form-label">Kandydat</label>
                                <select class="form-input" name="candidate_id" id="candidate_id" required>
                                </select>
                                </div>
                                 <button type="submit" class="submit-btn">Dodaj zgłoszenie</button>
                            </form>
                        </div>
                   </div>
                   <div id="contracts" class="view hidden">
                
                   </div>
                   <div id="add-contract" class="view hidden">
                           <div class="form-content">
                           <form id="add-contract-form">
                                 <div class="form-row">
                                     <label class="form-label">Opis</label>
                                     <textarea name="content" class="form-input" required></textarea>
                                 </div>
                                 <div class="form-row">
                                 <label class="form-label">Nr zgłoszenia</label>
                                <select class="form-input" name="ticket_id" id="ticket_id" required>
                                </select>
                                 </div>
                                  <div class="form-row">
                                 <label class="form-label">Czy podspisany</label>
                                <select class="form-input" name="is_signed" id="signed" required>
                                    <option value="">-- wybierz --</option>
                                    <option value="true">Tak</option>
                                    <option value="false">Nie</option>
                                </select>
                                </div>
                                </div>
                                 <button type="submit" class="submit-btn">Dodaj kontrakt</button>
                            </form>
                        </div>
                   </div>
                </main>