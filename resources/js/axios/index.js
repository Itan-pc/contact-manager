import axios from "axios";

export default () => {
  return axios.create({
    baseURL: 'http://contact-manager.loc/api/v1',
    withCredentials: true,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json"
    }
  });
};
