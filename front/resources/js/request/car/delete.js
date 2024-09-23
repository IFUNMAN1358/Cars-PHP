import {openCatalogPage} from "../../core/redirect.js";
import {getCookie} from "../../core/cookie.js";

export async function deleteCar(carId) {
    try {
        const response = await axios.delete(`http://localhost:8000/api/car`, {
            params: {
                carId: carId
            },
            headers: {
                'Authorization': `Bearer ${getCookie('accessToken')}`
            }
        });
        console.log(response.data);
        openCatalogPage();
    } catch (error) {
        console.error(error.response.data);
        throw error;
    }
}