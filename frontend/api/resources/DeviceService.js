import { Fetcher } from "../config";

export default {
    index(){
        return Fetcher.get('/devices')
            .then(response => response.data)
            .catch(e => {
                console.log(e)
            })
    },
    get(id){
        Fetcher.get(`/device/${id}`)
            .then(response => response.data)
            .catch(e => {
            console.log(e)
        })
    },
    post(requestBody){
        Fetcher.post('/device', requestBody)
            .then(response => response.data)
            .catch(e => {
                console.log(e)
            })
    },
    put(modelName, id){
        Fetcher.post(`/device/${id}`, modelName)
            .then(response => response.data)
            .catch(e => {
                console.log(e)
            })
    },

    delete(id){
        Fetcher.post(`/device/${id}`)
            .then(response => response.data)
            .catch(e => {
                console.log(e)
            })
    }
}