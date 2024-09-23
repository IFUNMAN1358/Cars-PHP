import {getCookie} from "../../core/cookie.js";

export async function updateEmail() {
    const emailInput = document.getElementById('emailInput').value.trim();

    const emailError = document.getElementById('emailError');
    emailError.textContent = '';
    emailError.style.display = 'none';

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput)) {
        emailError.textContent = 'Введите корректный email.';
        emailError.style.display = 'block';
        return;
    }

    try {
        const response = await axios.patch(`http://localhost:8000/api/account/user/email`, {
            email: emailInput
        }, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        window.location.reload();
    } catch (error) {
        emailError.textContent = 'Ошибка обновления email. Попробуйте снова.';
        emailError.style.display = 'block';
        console.error("Ошибка обновления email:", error);
    }
}