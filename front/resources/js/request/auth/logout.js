import {deleteCookie, getCookie} from "../../core/cookie.js";
import {openMainPage} from "../../core/redirect.js";

export async function submitLogout() {
    try {
        const response = await axios.post(`http://localhost:8000/api/auth/logout`, null, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
    } catch (error) {
        console.error(error.response.data);
    }

    deleteCookie('accessToken');
    deleteCookie('refreshToken');

    openMainPage();
}