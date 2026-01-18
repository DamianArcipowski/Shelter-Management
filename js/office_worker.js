const logoutBtn = document.querySelector('.logout-btn');
const speciesFilter = document.getElementById('filter-species');
const tbody = document.querySelector('#animalsTable tbody');
const searchName = document.getElementById('search-name');
const searchId = document.getElementById('search-id');
const searchNameBtn = document.getElementById('search-name-btn');
const searchIdBtn = document.getElementById('search-id-btn');
const successMessage = document.querySelector('.success-notification');
const createAnimalBtn = document.getElementById('create-animal-btn');
const createAnimalFormWrapper = document.querySelector('.form-content');
const tableContainer = document.querySelector('.table-container');
const createAnimalForm = document.getElementById('create-animal-form');

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
            /* Update logic todo */
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

speciesFilter.addEventListener('change', filterBySpecies);
searchIdBtn.addEventListener('click', searchById);
searchNameBtn.addEventListener('click', searchByName);
createAnimalBtn.addEventListener('click', showCreateAnimalForm);
createAnimalForm.addEventListener('submit', e => createAnimal(e));
document.addEventListener('DOMContentLoaded', displayAnimals);