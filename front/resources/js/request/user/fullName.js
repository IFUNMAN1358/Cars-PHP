import {getCookie} from "../../core/cookie.js";

export async function updateFullName() {

    const fullNameInput = document.getElementById('fullNameInput').value.trim();
    const nameParts = fullNameInput.split(' ');

    const fullNameError = document.getElementById('fullNameError');
    fullNameError.textContent = '';
    fullNameError.style.display = 'none';

    if (nameParts.length < 2) {
        fullNameError.textContent = 'Введите полные имя и фамилию.';
        fullNameError.style.display = 'block';
        return;
    }

    try {
        const response = await axios.patch(`http://localhost:8000/api/account/user/full-name`, {
            firstName: nameParts[0],
            lastName: nameParts.slice(1).join(' ')
        }, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        window.location.reload();
    } catch (error) {
        fullNameError.textContent = 'Ошибка обновления имени. Попробуйте снова.';
        fullNameError.style.display = 'block';
        console.error("Ошибка обновления имени:", error);
    }
}