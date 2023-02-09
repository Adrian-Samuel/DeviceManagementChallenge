import * as axios from "axios";
export default {
  index() {
    return axios
      .get("/devices")
      .then((response) => response.data)
      .catch((e) => {
        console.log(e);
      });
  },
  get(id) {
    axios
      .get(`/device/${id}`)
      .then((response) => response.data)
      .catch((e) => {
        console.log(e);
      });
  },
  post(requestBody) {
    axios
      .post("/device", requestBody)
      .then((response) => response.data)
      .catch((e) => {
        console.log(e);
      });
  },
  put(modelName, id) {
    axios
      .put(`/device/${id}`, modelName)
      .then((response) => response.data)
      .catch((e) => {
        console.log(e);
      });
  },

  delete(id) {
    axios
      .post(`/device/${id}`)
      .then((response) => response.data)
      .catch((e) => {
        console.log(e);
      });
  },
};
