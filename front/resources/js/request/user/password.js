import { getCookie } from "../../core/cookie.js";

export async function updatePassword() {
    const currentPasswordInput = document.getElementById('currentPasswordInput').value.trim();
    const newPasswordInput = document.getElementById('newPasswordInput').value.trim();
    const confirmNewPasswordInput = document.getElementById('confirmNewPasswordInput').value.trim();

    const currentPasswordError = document.getElementById('currentPasswordError');
    currentPasswordError.textContent = '';
    currentPasswordError.style.display = 'none';
    const newPasswordError = document.getElementById('newPasswordError');
    newPasswordError.textContent = '';
    newPasswordError.style.display = 'none';
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    confirmPasswordError.textContent = '';
    confirmPasswordError.style.display = 'none';


    if (!currentPasswordInput) {
        currentPasswordError.textContent = 'Введите текущий пароль.';
        currentPasswordError.style.display = 'block';
        return;
    }

    if (newPasswordInput.length < 6) {
        newPasswordError.textContent = 'Новый пароль должен содержать не менее 6 символов.';
        newPasswordError.style.display = 'block';
        return;
    }

    if (newPasswordInput !== confirmNewPasswordInput) {
        confirmPasswordError.textContent = 'Пароли не совпадают.';
        confirmPasswordError.style.display = 'block';
        return;
    }

    try {
        const response = await axios.patch(`http://localhost:8000/api/account/user/password`, {
            oldPassword: currentPasswordInput,
            newPassword: newPasswordInput
        }, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        window.location.reload();
    } catch (error) {
        currentPasswordError.textContent = 'Ошибка при смене пароля. Попробуйте снова.';
        currentPasswordError.style.display = 'block';
        console.error("Ошибка при смене пароля:", error);
    }
}