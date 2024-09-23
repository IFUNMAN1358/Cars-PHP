export async function getCarPhoto(photoUrl) {
    try {
        const response = await axios.get(`http://localhost:8000/api/car/photo`, {
            params: {
                photoUrl: photoUrl
            }
        });
        return response.data.imageUrl;
    } catch (error) {
        console.error(error.response.data);
        throw error;
    }
}