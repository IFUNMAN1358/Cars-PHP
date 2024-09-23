import {getCookie} from "./cookie.js";
import {openCreateCarPage, openCreateCarPageWithId, openManagerOrdersPage, openProfilePage} from "./redirect.js";
import {parseJwt} from "./jwt.js";
import {deleteCar} from "../request/car/delete.js";

export function updateAuthButtons() {
    const accessToken = getCookie('accessToken');
    const authDiv = document.querySelector('.auth');
    const nav = document.querySelector('nav');

    if (accessToken) {
        const decodedToken = parseJwt(accessToken);

        authDiv.innerHTML = '<span id="profilePageLink">Личный кабинет</span>';
        document.getElementById('profilePageLink').addEventListener('click', openProfilePage);

        if (decodedToken && decodedToken.roles && Array.isArray(decodedToken.roles)) {
            if (decodedToken.roles.includes('ROLE_MANAGER')) {
                const requestsButton = document.createElement('span');
                requestsButton.innerText = 'Заявки';
                requestsButton.id = 'requestPageLink';
                requestsButton.addEventListener('click', openManagerOrdersPage);
                nav.appendChild(requestsButton);

                const createCarButton = document.createElement('span');
                createCarButton.innerText = 'Создать';
                createCarButton.id = 'createCarPageLink';
                createCarButton.addEventListener('click', openCreateCarPage);
                nav.appendChild(createCarButton);
            }
        }
    }
}

export function checkManagerRoleAndAddButtonsToCarPage(carId) {
    const accessToken = getCookie('accessToken');
    const decodedToken = parseJwt(accessToken);

    if (decodedToken && decodedToken.roles && decodedToken.roles.includes('ROLE_MANAGER')) {
        const buttonContainer = document.querySelector('.button-container');

        const updateButton = document.createElement('button');
        updateButton.classList.add('apply-button');
        updateButton.innerText = 'Обновить';
        updateButton.addEventListener('click', () => openCreateCarPageWithId(carId));
        buttonContainer.appendChild(updateButton);

        const deleteButton = document.createElement('button');
        deleteButton.classList.add('apply-button');
        deleteButton.innerText = 'Удалить';
        deleteButton.addEventListener('click', () => deleteCar(carId));
        buttonContainer.appendChild(deleteButton);
    }
}