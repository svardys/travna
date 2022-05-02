import axios from "axios";
import store from "../store";
import router from "../router";

class Api {
    constructor() {
        let axiosInstance = axios.create({
            withCredentials: true
        });
        axiosInstance.interceptors.request.use((config) => {
            store.commit('loadingModule/setLoading', true);
            return config;
        }, function (error) {
            store.commit('loadingModule/setLoading', false);
            return Promise.reject(error);
        });
        axiosInstance.interceptors.response.use(this.handleSuccess, this.handleError);
        this.api = axiosInstance;
    }

    handleSuccess(response) {

        store.commit('loadingModule/setLoading', false);
        return response;

    }

    handleError = async (error) => {
        store.commit('loadingModule/setLoading', false);
        if ([401, 403, 419].includes(error.response.status)) {
            try {
                if (store.getters['userModule/loggedIn']) {
                    await store.dispatch('userModule/logout');
                    await router.push({name: 'homeIndex'});
                }
                await router.push({name: 'homeIndex'});
            } catch (error) {
                if (error.response) {
                   store.commit('messagesModule/showException', error.response.data.message)
                } else {
                    console.log(error);
                }
            }
        }
        return Promise.reject(error);
    }

    get(path, parameters) {
        return this.api.request({
            method: 'GET',
            url: path,
            responseType: 'json',
            params: parameters
        })
    }

    patch(path, payload) {
        return this.api.request({
            method: 'PATCH',
            url: path,
            responseType: 'json',
            data: payload
        })
    }

    post(path, payload, parameters, headers) {
        return this.api.request({
            method: 'POST',
            url: path,
            responseType: 'json',
            data: payload,
            params: parameters,
            headers: headers
        })
    }

    put(path, payload, parameters) {
        return this.api.request({
            method: 'PUT',
            url: path,
            responseType: 'json',
            data: payload,
            params: parameters
        })
    }

    delete(path, payload) {
        return this.api.request({
            method: 'DELETE',
            url: path,
            responseType: 'json',
            data: payload
        })
    }
}

export default new Api;
