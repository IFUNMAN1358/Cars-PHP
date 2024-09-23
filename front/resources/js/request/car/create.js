import {getCookie} from "../../core/cookie.js";
import { openCarPage } from "../../core/redirect.js";

export async function createCar() {

    const photo1 = document.getElementById('photo1').files[0];
    const photo2 = document.getElementById('photo2').files[0];
    const photo3 = document.getElementById('photo3').files[0];
    const photo4 = document.getElementById('photo4').files[0];

    const name = document.getElementById('name').value.trim();
    const price = document.getElementById('price').value.trim();
    const description = document.getElementById('description').value.trim();
    const transmission = document.getElementById('transmission').value.trim();
    const seatsNumber = document.getElementById('seats').value.trim();
    const issueYear = document.getElementById('year').value.trim();
    const color = document.getElementById('color').value.trim();
    const steeringWheel = document.getElementById('steering').value.trim();
    const enginePower = document.getElementById('power').value.trim();
    const status = document.getElementById('status').value.trim();

    const formData = new FormData();
    formData.append('name', name);
    formData.append('description', description);
    formData.append('price', price);
    formData.append('enginePower', enginePower);
    formData.append('transmission', transmission);
    formData.append('seatsNumber', seatsNumber);
    formData.append('issueYear', issueYear);
    formData.append('color', color);
    formData.append('steeringWheel', steeringWheel);
    formData.append('status', status);
    formData.append('photo1', photo1);
    formData.append('photo2', photo2);
    formData.append('photo3', photo3);
    formData.append('photo4', photo4);

    try {
        const response = await axios.post(`http://localhost:8000/api/car`, formData, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`,
                'Content-Type': 'multipart/form-data'
            }
        });
        console.log(response.data);
        openCarPage(response.data.car.id);
    } catch (error) {
        console.error(error.response.data);
    }
}
