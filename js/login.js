const resetPassword = document.getElementById('reset-password');
const errorField = document.querySelector('.error-field');

resetPassword.addEventListener('click', () => {
    alert('Skontaktuj się z administratorem');
});

function displayLoginError() {
    const urlParams = new URLSearchParams(window.location.search);
    const userExist = urlParams.get('user_exist');
    const passwordMatch = urlParams.get('password_match');
    const pageAccess = urlParams.get('access');

    if (userExist == 'false') {
        errorField.style.display = 'block';
        errorField.textContent = 'Użytkownik o podanym loginie nie istnieje w systemie!'
    } else if (passwordMatch == 'false') {
        errorField.style.display = 'block';
        errorField.textContent = 'Wprowadzono niepoprawne hasło! Spróbuj ponownie.'
    } else if (pageAccess == 'false') {
        errorField.style.display = 'block';
        errorField.textContent = 'Nie posiadasz uprawnień do wyświetlenia tej strony!'
    }
}

displayLoginError();