import {deleteCookie, getCookie} from "../../core/cookie.js";
import {openMainPage} from "../../core/redirect.js";

export async function deleteAccount() {
    try {
        const response = await axios.delete(`http://localhost:8000/api/account/user`, {
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);

        deleteCookie('accessToken');
        deleteCookie('refreshToken');

        openMainPage();
    } catch (error) {
        console.error(error.response.data);
    }
}