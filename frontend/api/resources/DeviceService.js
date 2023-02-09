export default {
  index() {
    return fetch("http://localhost:8000/devices", {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    })
      .then((response) => response.json().then((response) => response))
      .catch((e) => {
        console.log(e);
      });
  },
  get(id) {
    fetch(`http://localhost:8000/device/${id}`, {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    })
      .then((response) => response.json().then((response) => response))
      .catch((e) => {
        console.log(e);
      });
  },
  post(requestBody) {
    fetch("http://localhost:8000/device", {
      method: "POST",
      headers: {
        Accept: "application/json",
      },
      body: JSON.stringify(requestBody),
    })
      .then((response) => response.json().then((response) => response))
      .then((response) => {
        return response;
      })
      .catch((e) => {
        console.log(e);
      });
  },
  put(modelName, id) {
    fetch(`http://localhost:8000/device/${id}`, modelName)
      .then((response) => response.json().then((response) => response))
      .catch((e) => {
        console.log(e);
      });
  },

  delete(id) {
    fetch(`http://localhost:8000/device/${id}`, { method: "DELETE" })
      .then((response) => response.json().then((response) => response))
      .catch((e) => {
        console.log(e);
      });
  },
};
