import Api from "../../services/api";

const user = {
    namespaced: true,
    state: {
        user: {
            name: null
        },
    },
    getters: {
        user(state) {
            return state.user;
        },
        loggedIn(state) {
            return !!state.user.name;
        }
    },
    mutations: {
        createSession(state, user) {
            state.user.name = user.name;
        },
        destroySession(state) {
            Object.keys(state.user).forEach(k => state.user[k] = null);
        }
    },
    actions: {
        async login({commit}, payload) {
            try {
                await Api.get('/sanctum/csrf-cookie');
                const response = await Api.post('/login', payload);
                commit('createSession', response.data);
                return response;
            } catch (error) {
                throw(error);
            }
        },
        async forgotPassword({commit}, payload) {
            try {
                await Api.get('/sanctum/csrf-cookie');
                return Api.post('/forgot-password', payload);
            } catch (error) {
                throw(error);
            }
        },
        async resetPassword({commit}, payload) {
            try {
                await Api.get('/sanctum/csrf-cookie');
                return Api.post('/reset-password', payload);
            } catch (error) {
                throw(error);
            }
        },
        async updatePassword({commit}, payload) {
            try {
                await Api.get('/sanctum/csrf-cookie');
                return Api.post('/user/password', payload, { _method: 'PUT' });
            } catch (error) {
                throw(error);
            }
        },
        async logout({commit}) {
            try {
                await Api.post('/logout');
                commit('destroySession');
            } catch (error) {
                throw(error);
            }
        }
    }
};

export default user;
