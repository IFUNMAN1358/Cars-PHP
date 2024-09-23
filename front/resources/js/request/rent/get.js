import {getCookie} from "../../core/cookie.js";

export async function getAllUserRents() {
    try {
        const response = await axios.get(`http://localhost:8000/api/rents`, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        return response.data.rents;
    } catch (error) {
        console.error(error.response.data);
    }
}

export async function getAllRents() {
    try {
        const response = await axios.get(`http://localhost:8000/api/m/rents`, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        return response.data.rents;
    } catch (error) {
        console.error(error.response.data);
    }
}