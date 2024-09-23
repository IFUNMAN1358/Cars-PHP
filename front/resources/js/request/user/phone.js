import {getCookie} from "../../core/cookie.js";

export async function updatePhone() {
    const phoneInput = document.getElementById('phoneInput').value.trim();

    const phoneError = document.getElementById('phoneError');
    phoneError.textContent = '';
    phoneError.style.display = 'none';

    const phoneRegex = /^\+?[1-9]\d{1,14}$/;
    if (!phoneRegex.test(phoneInput)) {
        phoneError.textContent = 'Введите корректный номер телефона.';
        phoneError.style.display = 'block';
        return;
    }

    try {
        const response = await axios.patch(`http://localhost:8000/api/account/user/phone`, {
            phone: phoneInput
        }, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        window.location.reload();
    } catch (error) {
        phoneError.textContent = 'Ошибка обновления телефона. Попробуйте снова.';
        phoneError.style.display = 'block';
        console.error("Ошибка обновления телефона:", error);
    }
}