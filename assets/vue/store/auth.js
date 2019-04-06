import axios from 'axios';

export default {
    namespaced: true,

    state: {
        isLoading: false,
        isAuthenticated: false,
        error: null,
    },
    getters: {
        isAuthenticated (state) {
            return state.isAuthenticated;
        },
        hasError (state) {
            return !!state.error;
        },
    },
    mutations: {
        AUTHENTICATION_LOADING(state) {
            state.isLoading = true;
        },
        AUTHENTICATION_SUCCESS(state, token) {
            localStorage.token = token;

            //set auth header for future requests
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

            state.isLoading = false;
            state.isAuthenticated = true;
        },
        AUTHENTICATION_ERROR(state, error) {
            state.isLoading = false;
            state.error = error;
        },
        AUTHENTICATION_RESET(state) {
            state.isLoading = false;
            state.isAuthenticated = false;
            state.error = null;

            delete localStorage.token;
            delete axios.defaults.headers.common['Authorization'];
        },
    },
    actions: {
        init({commit}) {
            localStorage.token
                ? commit('AUTHENTICATION_SUCCESS', localStorage.token)
                : commit('AUTHENTICATION_RESET');
        },
        login({commit}, {username, password}) {
            commit('AUTHENTICATION_RESET');
            commit('AUTHENTICATION_LOADING');
            return axios.post('/api/login', {username, password})
                .then(res => commit('AUTHENTICATION_SUCCESS', res.data.token))
                .catch(e => commit('AUTHENTICATION_ERROR', e));
        },
        logout({commit}) {
            commit('AUTHENTICATION_RESET');
        }
    }
}
