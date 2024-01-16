import {defineStore} from 'pinia'
import axios from "axios";

export const useUserStore = defineStore('user', {
    state: () => {
        return {
            user: JSON.parse(window.localStorage.getItem('user')),
            token: window.localStorage.getItem('token'),
            show_signin_dialog: false,
            show_signup_dialog: false,
        }
    },
    actions: {
        signup(payload) {
            return axios.post('/api/register', payload)
        },
        signin(email, password) {
            return axios.post('/api/login', {email: email, password: password})
                .then(response => this.setAuth(response.data.data.token, response.data.data.user))
        },
        logout() {
            return axios.post('/api/logout')
                .then(() => this.removeAuth())
        },
        setAuth(token, user) {
            this.user = user;
            this.token = token;
            // add token to axios header
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            // saving auth token between sessions
            window.localStorage.setItem('token', token);
            window.localStorage.setItem('user', JSON.stringify(user));
        },
        removeAuth() {
            this.token = null;
            this.user = null;

            window.localStorage.removeItem('token');
            window.localStorage.removeItem('user');

            // remove token to axios header
            delete axios.defaults.headers.common['Authorization'];
        }
    }
})
