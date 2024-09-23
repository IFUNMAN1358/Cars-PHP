import {getCookie} from "../../core/cookie.js";

export async function getUser() {
    try {
        const accessToken = getCookie('accessToken');
        const response = await axios.get('http://localhost:8000/api/account/user', {
            headers: {
                'Authorization': `Bearer ${accessToken}`
            }
        });
        return response.data.user;
    } catch (error) {
        console.error(error.response.data);
    }
}

export async function getMUser(userId) {
    const data = {
        userId: userId
    }
    try {
        const accessToken = getCookie('accessToken');
        const response = await axios.post('http://localhost:8000/api/m/user', data, {
            headers: {
                'Authorization': `Bearer ${accessToken}`
            }
        });
        return response.data.user;
    } catch (error) {
        console.error(error.response.data);
    }
}