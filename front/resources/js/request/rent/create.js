import {getCookie} from "../../core/cookie.js";
import {openUserOrdersPage} from "../../core/redirect.js";

export async function submitCreateRent() {
    const car_id = new URLSearchParams(window.location.search).get('id');
    const address = document.getElementById('address').value;
    const days_rent = document.getElementById('days_rent').value;
    const start_date = document.getElementById('start_date').value;
    const end_date = document.getElementById('end_date').value;
    const total_amount = document.getElementById('totalAmount').textContent;

    const data = {
        carId: car_id,
        address: address,
        daysRent: days_rent,
        totalAmount: total_amount,
        startDate: start_date,
        endDate: end_date,
    };

    try {
        const response = await axios.post(`http://localhost:8000/api/rent`, data, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        openUserOrdersPage();
    } catch (error) {
        console.error(error.response.data);
    }
}