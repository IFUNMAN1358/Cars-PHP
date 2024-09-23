import {setCookie} from "../../core/cookie.js";
import {openMainPage} from "../../core/redirect.js";

export async function submitRegistration() {
    const firstName = document.getElementById('first_name').value;
    const lastName = document.getElementById('last_name').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    document.querySelectorAll('.error').forEach(errorElement => errorElement.style.display = 'none');

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        document.getElementById('email_error').textContent = 'Некорректный email';
        document.getElementById('email_error').style.display = 'block';
        return;
    }

    const phonePattern = /^\+?[78][-(]?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{2}[-.\s]?\d{2}$/;
    if (!phonePattern.test(phone)) {
        document.getElementById('phone_error').textContent = 'Некорректный номер телефона';
        document.getElementById('phone_error').style.display = 'block';
        return;
    }

    if (password.length < 6) {
        document.getElementById('password_error').textContent = 'Новый пароль должен содержать не менее 6 символов.';
        document.getElementById('password_error').style.display = 'block';
        return;
    }

    if (password !== confirmPassword) {
        document.getElementById('confirm_password_error').textContent = 'Пароли не совпадают';
        document.getElementById('confirm_password_error').style.display = 'block';
        return;
    }

    const data = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        phone: phone,
        password: password
    };

    try {
        const response = await axios.post(`http://localhost:8000/api/auth/registration`, data);
        console.log(response.data);

        const jwt = response.data.jwt;
        setCookie('accessToken', jwt.accessToken)
        setCookie('refreshToken', jwt.refreshToken)

        openMainPage();
    } catch (error) {
        console.error(error.response.data);
    }
}