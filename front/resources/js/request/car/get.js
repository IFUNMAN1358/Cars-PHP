export async function getCars() {
    try {
        const response = await axios.get(`http://localhost:8000/api/cars`);
        return response.data.cars;
    } catch (error) {
        console.error(error.response.data);
        throw error;
    }
}

export async function getCar(carId) {
    try {
        const response = await axios.get(`http://localhost:8000/api/car`, {
            params: {
                carId: carId
            }
        });
        return response.data.car;
    } catch (error) {
        console.error(error.response.data);
        throw error;
    }
}