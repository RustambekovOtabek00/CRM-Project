import axios from "axios";

export const authorizedClient = axios.create({
    baseURL: "http://localhost:9999/api",
    headers: {
        "Content-Type": "application/ld+json",
        "Accept": "application/ld+json",
        "Authorization": `Bearer ${localStorage.getItem('token')}`
    }
})

authorizedClient.interceptors.request.use(config => {
    const token = localStorage.getItem('token');

    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    if (config.method === 'patch') {
        config.headers['Content-Type'] = 'application/merge-patch+json';
    }

    return config;
})
