const logoutBtn = document.querySelector('.logout-btn');
const speciesFilter = document.getElementById('filter-species');
const tbody = document.querySelector('#animalsTable tbody');
const searchName = document.getElementById('search-name');
const searchId = document.getElementById('search-id');
const searchNameBtn = document.getElementById('search-name-btn');
const searchIdBtn = document.getElementById('search-id-btn');
const successMessage = document.querySelector('.success-notification');
const createAnimalBtn = document.getElementById('create-animal-btn');
const createAnimalFormWrapper = document.querySelector('[data-form="create"]');
const tableContainer = document.querySelector('.table-container');
const createAnimalForm = document.getElementById('create-animal-form');
const addTaskBtn = document.getElementById('create-tasks-btn');
const showTasksBtn = document.getElementById('show-tasks-btn');
const formWrapper = document.getElementById('form-wrapper-schedule');
const tableWrapper = document.getElementById('table-wrapper-schedule');
const addWrapper = document.getElementById('add-wrapper-schedule');
const addSchdeuleBtn = document.getElementById('add-schedule-btn');
const candidatesDiv = document.getElementById('candidates');
const adoptionDiv = document.getElementById('adoption_tickets');
const contractsDiv = document.getElementById('contracts');
const buttons = document.querySelectorAll('.sidebar-btn');
const views = document.querySelectorAll('.view');
const updateAnimalFormWrapper = document.querySelector('[data-form="update"]');
const updateAnimalForm = document.getElementById('update-animal-form');
const returnBtn = document.querySelector('.return-btn');

logoutBtn.addEventListener('click', () => {
    window.location.href = '../backend/logout.php';
});

function displayAnimals() {
    readAnimals().then(animals => {
        renderTable(animals);
    })
}

function renderTable(animals) {
    tbody.innerHTML = animals.map(animal => `
        <tr>
            <td>${animal.id}</td>
            <td>${animal.name}</td>
            <td>${animal.species}</td>
            <td>${animal.adoption_date}</td>
            <td>${animal.arrival_date}</td>
            <td>${animal.loosebox}</td>
            <td>${animal.description}</td>
            <td>${animal.sex}</td>
            <td>${animal.status}</td>
            <td><i class="bi bi-pencil" data-id="${animal.id}"></i></td>
            <td><i class="bi bi-trash" data-id="${animal.id}"></i></td>
        </tr>
    `).join('');

    attachUpdateDeleteEventListeners();
}

function readAnimals() {
    return fetch('../backend/animals_crud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=read'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            return data.data;
        }
    })
    .catch(error => console.error('Błąd:', error));
}

function showCreateAnimalForm() {
    createAnimalFormWrapper.classList.toggle('hidden');
    tableContainer.classList.toggle('hidden');
    createAnimalBtn.style.background == 'rgb(77, 168, 79)' ? createAnimalBtn.style.removeProperty('background') : createAnimalBtn.style.background = '#4da84f';
}

function deleteAnimal(id) {
    fetch('../backend/animals_crud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=delete&id=${id}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayAnimals();
            successMessage.textContent = `Pomyślnie usunięto zwierzę o numerze ID: ${id}`;
            successMessage.style.display = 'block';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }
    })
    .catch(error => console.error('Błąd:', error));
}

function createAnimal(e) {
    e.preventDefault();
            
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    fetch('../backend/animals_crud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=create&${new URLSearchParams(data).toString()}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            successMessage.textContent = 'Pomyślnie dodano nowe zwierzę!';
            successMessage.style.display = 'block';
            
            e.target.reset();
            displayAnimals();
            
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        } else {
            alert('Błąd: ' + (result.message || 'Nie udało się dodać zwierzęcia'));
        }
    })
    .catch(error => {
        console.error('Błąd:', error);
        alert('Wystąpił błąd podczas dodawania zwierzęcia');
    });
}

function updateAnimal(e) {
    e.preventDefault();
            
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    fetch('../backend/animals_crud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=update&${new URLSearchParams(data).toString()}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            successMessage.textContent = 'Pomyślnie edytowano zwierzę!';
            successMessage.style.display = 'block';
            
            updateAnimalFormWrapper.classList.add('hidden');
            tableContainer.classList.remove('hidden');
            displayAnimals();
            
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        } else {
            alert('Błąd: ' + (result.message || 'Nie udało się edytować zwierzęcia'));
        }
    })
    .catch(error => {
        console.error('Błąd:', error);
        alert('Wystąpił błąd podczas edycji zwierzęcia');
    });
}

function filterBySpecies() {
    const selectedValue = speciesFilter.value;
    if (!selectedValue) {
        displayAnimals();
        return;
    }
    
    readAnimals().then(animals => {
        const filtered = animals.filter(animal => animal.species == selectedValue);
        renderTable(filtered);
    })
}

function searchByName() {
    const searchValue = searchName.value.toLowerCase();

    readAnimals().then(animals => {
        const filtered = animals.filter(animal => 
            animal.name.toLowerCase().includes(searchValue)
        );
        renderTable(filtered);
    });
}

function searchById() {
    const searchValue = searchId.value;

    readAnimals().then(animals => {
        const filtered = animals.filter(animal => 
            animal.id.toString().includes(searchValue)
        );
        renderTable(filtered);
    });
}

function attachUpdateDeleteEventListeners() {
    document.querySelectorAll('.bi.bi-pencil').forEach(icon => {
        icon.addEventListener('click', e => {
            const iconElement = e.target.closest('.bi.bi-pencil');
            const id = iconElement.dataset.id;
            tableContainer.classList.add('hidden');
            updateAnimalFormWrapper.classList.remove('hidden');

            fetch('../backend/form_autofill.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}`
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    let inputId = document.createElement('input');
                    inputId.type = 'text';
                    inputId.name = 'id';
                    inputId.value = id;
                    inputId.style.display = 'none';
                    updateAnimalForm.appendChild(inputId);

                    updateAnimalForm.querySelector('[name="name"]').value = result.data.name;
                    updateAnimalForm.querySelector('[name="species"]').value = result.data.species;
                    updateAnimalForm.querySelector('[name="arrival_date"]').value = result.data.arrival_date;
                    updateAnimalForm.querySelector('[name="loosebox"]').value = result.data.loosebox;
                    updateAnimalForm.querySelector('[name="description"]').value = result.data.description;
                    updateAnimalForm.querySelector('[name="sex"]').value = result.data.sex;
                    updateAnimalForm.querySelector('[name="status"]').value = result.data.status;
                } else {
                    alert('Błąd: ' + (result.message || 'Nie udało się pobrać danych zwierzęcia'));
                }
            })
            .catch(error => {
                console.error('Błąd:', error);
                alert('Wystąpił błąd podczas wypełniania formularza edycji zwierzęcia');
            });
        });
    });

    document.querySelectorAll('.bi.bi-trash').forEach(icon => {
        icon.addEventListener('click', e => {
            const iconElement = e.target.closest('.bi.bi-trash');
            const id = iconElement.dataset.id;
            if (confirm('Czy na pewno chcesz usunąć?')) {
                deleteAnimal(id);
            }
        });
    });
}
document.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'create-task-btn') {
        formWrapper.classList.remove('hidden');
        addWrapper.classList.add('hidden');
        tableWrapper.classList.add('hidden');
        loadEmployeesIntoSelect();
    }
    if (e.target && e.target.id === 'show-tasks-btn') {
        readTasks();
        formWrapper.classList.add('hidden');
        addWrapper.classList.add('hidden');
        tableWrapper.classList.remove('hidden');
    }
    if (e.target && e.target.id === 'add-schedule-btn') {
        formWrapper.classList.add('hidden');
        addWrapper.classList.remove('hidden');
        tableWrapper.classList.add('hidden');
    }
 
    const btn = e.target.closest('.sidebar-btn');
    if (!btn) return;
    const targetId = btn.dataset.target;
    views.forEach(view => view.classList.add('hidden'));
    document.getElementById(targetId)?.classList.remove('hidden');
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    if (e.target?.id === 'add-adoption_tickets-btn') loadCandidatesIntoSelect();
    if (e.target?.id === 'adoption_tickets-btn') renderTicketsTable();
    
});

function renderTicketsTable(){
    const ticketsTable = document.getElementById('tickets_body');
    return fetch('../backend/tickets_crud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=read'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            ticketsTable.innerHTML = data.data.map(ticket => `
                <tr>
                    <td>${ticket.id}</td>
                    <td>${ticket.creation_date}</td>
                    <td>${ticket.animal_preferences}</td>
                    <td>${ticket.status}</td>
                    <td>${ticket.first_name}</td>
                    <td>${ticket.surname}</td>
                    <td>${ticket.animal_id ?? 'Brak'}</td>
                    <td><i class="bi bi-pencil" data-id="${ticket.id}"></i></td>
                    <td>
                        <button class="delete-btn" data-id="${ticket.id}">Usuń</button>
                    </td>
                </tr>
            `).join('');

            ticketsTable.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => deleteTicket(btn.dataset.id));
            });
        }
    })
    .catch(error => console.error('Błąd:', error));
}

function deleteTicket(id){

}

function readTasks() {
    const scheduleTable = document.getElementById('scheduleTable');
    return fetch('../backend/schedule_crud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=read_tasks'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            scheduleTable.innerHTML = data.data.map(task => `
                <tr>
                    <td>${task.id}</td>
                    <td>${task.first_name}</td>
                    <td>${task.surname}</td>
                    <td>${task.position}</td>
                    <td>${task.date}</td>
                    <td>${task.opis}</td>
                    <td>
                        <button class="delete-btn" data-id="${task.id}">Usuń</button>
                    </td>
                </tr>
            `).join('');

            scheduleTable.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => deleteTask(btn.dataset.id));
            });
        }
    })
    .catch(error => console.error('Błąd:', error));
}

function deleteTask(id) {
    if (!confirm('Czy na pewno chcesz usunąć to zadanie?')) return;

    fetch('../backend/schedule_crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=delete_task&id=${id}`
    })
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            readTasks();
            if (successMessage) {
                successMessage.textContent = `Pomyślnie usunięto zadanie o ID: ${id}`;
                successMessage.style.display = 'block';
                setTimeout(() => successMessage.style.display = 'none', 5000);
            }
        } else {
            alert('Nie udało się usunąć zadania: ' + (result.message || ''));
        }
    })
    .catch(err => console.error('Błąd usuwania zadania', err));
}

document.addEventListener('submit', function(e) {
    if (e.target && e.target.id === 'add-schedule-form') {
        e.preventDefault();
        createSchedule(e);
    }
     if (e.target && e.target.id === 'create-task-form') {
        e.preventDefault();
        addTask(e);
    }
     if (e.target && e.target.id === 'add-candidate-form') {
        e.preventDefault();
        addCandidate(e);
    }
      if (e.target && e.target.id === 'add-ticket-form') {
        e.preventDefault();
        addTicket(e);
    }

});

function addTicket(e){
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    fetch('../backend/tickets_crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=add&${new URLSearchParams(data).toString()}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            if(successMessage){
                successMessage.textContent = result.message;
                successMessage.style.display = 'block';
                setTimeout(() => successMessage.style.display = 'none', 5000);
            } else {
                alert(result.message);
            }
            e.target.reset();
        } else {
            alert('Błąd: ' + (result.message || 'Nie udało się dodać zgłoszenia'));
        }
    })
    .catch(error => {
        console.error('Błąd:', error);
        alert('Wystąpił błąd podczas dodawania zgłoszenia');
    }); 
}

function addCandidate(e){
      e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    fetch('../backend/candidates_crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=add&${new URLSearchParams(data).toString()}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            if(successMessage){
                successMessage.textContent = result.message;
                successMessage.style.display = 'block';
                setTimeout(() => successMessage.style.display = 'none', 5000);
            } else {
                alert(result.message);
            }
            e.target.reset();
        } else {
            alert('Błąd: ' + (result.message || 'Nie udało się dodać kandydata'));
        }
    })
    .catch(error => {
        console.error('Błąd:', error);
        alert('Wystąpił błąd podczas dodawania kandydata');
    }); 
}

function addTask(e){
     e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    fetch('../backend/schedule_crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=add_task&${new URLSearchParams(data).toString()}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            if(successMessage){
                successMessage.textContent = result.message;
                successMessage.style.display = 'block';
                setTimeout(() => successMessage.style.display = 'none', 5000);
            } else {
                alert(result.message);
            }
            e.target.reset();
        } else {
            alert('Błąd: ' + (result.message || 'Nie udało się dodać zadania'));
        }
    })
    .catch(error => {
        console.error('Błąd:', error);
        alert('Wystąpił błąd podczas dodawania zadania');
    });
}

function loadEmployeesIntoSelect() {
    const employeeSelect = document.getElementById('employee-select');
    if (!employeeSelect) return;

    fetch('../backend/employees_crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=read'
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            employeeSelect.innerHTML = '';
            data.data.forEach(emp => {
                const option = document.createElement('option');
                option.value = emp.id;
                option.textContent = emp.first_name + ' ' + emp.surname + ' ' +emp.position;
                employeeSelect.appendChild(option);
            });
        }
    })
    .catch(err => console.error('Błąd pobierania pracowników', err));
}
function loadCandidatesIntoSelect() {
    const candidates = document.getElementById('candidate_id');
    if (!candidates) return;

    fetch('../backend/candidates_crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=loadSelect'
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            candidates.innerHTML = '';
            data.data.forEach(can => {
                const option = document.createElement('option');
                option.value = can.id;
                option.textContent = can.first_name + ' ' + can.surname;
                candidates.appendChild(option);
            });
        }
    })
    .catch(err => console.error('Błąd pobierania knadydatów', err));
}
function createSchedule(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    fetch('../backend/schedule_crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=add_schedule&${new URLSearchParams(data).toString()}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            if(successMessage){
                successMessage.textContent = result.message;
                successMessage.style.display = 'block';
                setTimeout(() => successMessage.style.display = 'none', 5000);
            } else {
                alert(result.message);
            }
            e.target.reset();
        } else {
            alert('Błąd: ' + (result.message || 'Nie udało się dodać planu'));
        }
    })
    .catch(error => {
        console.error('Błąd:', error);
        alert('Wystąpił błąd podczas dodawania planu');
    });
}

returnBtn.addEventListener('click', () => {
    updateAnimalFormWrapper.classList.add('hidden');
    tableContainer.classList.remove('hidden');
});

speciesFilter.addEventListener('change', filterBySpecies);
searchIdBtn.addEventListener('click', searchById);
searchNameBtn.addEventListener('click', searchByName);
createAnimalBtn.addEventListener('click', showCreateAnimalForm);
createAnimalForm.addEventListener('submit', e => createAnimal(e));
updateAnimalForm.addEventListener('submit', e => updateAnimal(e));
document.addEventListener('DOMContentLoaded', displayAnimals);