import {getCookie} from "../../core/cookie.js";

export async function setStatusAccept(rentId) {
    const data = {rentId: rentId};
    try {
        const response = await axios.post(`http://localhost:8000/api/m/rent/accept`, data, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        window.location.reload();
    } catch (error) {
        console.error(error.response.data);
    }
}

export async function setStatusReject(rentId) {
    const data = {rentId: rentId};
    try {
        const response = await axios.post(`http://localhost:8000/api/m/rent/reject`, data, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        window.location.reload();
    } catch (error) {
        console.error(error.response.data);
    }
}