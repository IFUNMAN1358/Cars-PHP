import {setCookie} from "../../core/cookie.js";
import {openMainPage} from "../../core/redirect.js";

export async function submitLogin() {
    const loginInput = document.getElementById('login').value;
    const password = document.getElementById('password').value;

    let loginType = '';
    let hasError = false;

    document.querySelectorAll('.error').forEach(errorElement => errorElement.style.display = 'none');

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const phonePattern = /^\+?[78][-(]?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{2}[-.\s]?\d{2}$/;

    if (emailPattern.test(loginInput)) {
        loginType = 'email';
    } else if (phonePattern.test(loginInput)) {
        loginType = 'phone';
    } else {
        document.getElementById('login_error').textContent = 'Некорректный email или номер телефона';
        document.getElementById('login_error').style.display = 'block';
        hasError = true;
    }

    if (password === '') {
        document.getElementById('password_error').textContent = 'Пароль не может быть пустым';
        document.getElementById('password_error').style.display = 'block';
        hasError = true;
    }

    if (hasError) return;

    const data = {
        [loginType]: loginInput,
        password: password
    };

    try {
        const response = await axios.post(`http://localhost:8000/api/auth/login`, data);
        console.log(response.data);

        const jwt = response.data.jwt;
        setCookie('accessToken', jwt.accessToken)
        setCookie('refreshToken', jwt.refreshToken)

        openMainPage();
    } catch (error) {
        console.error(error.response.data);
    }
}