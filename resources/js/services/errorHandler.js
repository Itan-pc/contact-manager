import toast from "./toast";
import {clearAuthorization} from "../helper/auth";

export default (axios, store, router) => {
  const isHandlerEnabled = (config = {}) => {
    return !(
      {}.hasOwnProperty.call(config, "errorHandle") && !config.errorHandle
    );
  };

  const errorResponseHandler = async error => {
    store.commit("setLoading", false);

    if (error.response.status === 422) {
      toast.error(JSON.stringify(error.response.data.errors));
    } else if(isHandlerEnabled(error.config)) {
      toast.error(error.response.data.message);
    }

    if (
      error.response.status === 401 &&
      error.config.url !== "login"
    ) {
        store.dispatch('logout').then(res=> {
            router.push({ name: "login" })
        });
    }

    return Promise.reject({ ...error });
  };

  const successResponseHandler = response => {
    store.commit("setLoading", false);

    if (isHandlerEnabled(response.config)) {
      if (response.config.method !== "get") {
        toast.success(
          response.data.message ? response.data.message : response.statusText
        );
      }
    }

    return response;
  };

  const successRequestHandler = request => {
    store.commit("setLoading", true);

    return request;
  };

  const errorRequestHandler = error => {
    store.commit("setLoading", false);

    return Promise.reject({ ...error });
  };

  axios.interceptors.response.use(
    response => successResponseHandler(response),
    error => errorResponseHandler(error)
  );

  axios.interceptors.request.use(
    request => successRequestHandler(request),
    error => errorRequestHandler(error)
  );
};
