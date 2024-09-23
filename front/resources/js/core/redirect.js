export function openMainPage() {
    window.location.href = "../../index.html";
}

export function openRegistrationPage() {
    window.location.href = "../../registration.html";
}

export function openLoginPage() {
    window.location.href = "../../login.html";
}

export function openCatalogPage() {
    window.location.href = "../../catalog.html";
}

export function openCarPage(carId) {
    window.location.href = `../../car_page.html?id=${carId}`;
}

export function openProfilePage() {
    window.location.href = "../../profile.html";
}

export function openAccountDataPage() {
    window.location.href = "../../account_data.html";
}

export function openCreateRentPage(carId) {
    window.location.href = `../../create_rent.html?id=${carId}`;
}

export function openCreateCarPage() {
    window.location.href = `../../create_car.html`;
}
export function openCreateCarPageWithId(carId) {
    window.location.href = `../../create_car.html?id=${carId}`;
}

export function openDeleteAccountPage() {
    window.location.href = "../../delete_account.html";
}

export function openUserOrdersPage() {
    window.location.href = "../../user_orders.html";
}

export function openManagerOrdersPage() {
    window.location.href = "../../manager_orders.html";
}