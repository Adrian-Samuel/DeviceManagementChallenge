import * as axios from 'axios';
export const Fetcher = axios.create({
    headers: new Headers({
        'Accept':'application/json'
    }),
    baseURL:'http://localhost:8000',
    timeout:'3000'
})