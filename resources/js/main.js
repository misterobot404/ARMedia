import {createApp} from 'vue';
import router from "./router";
import App from "./App.vue";
import {createPinia} from 'pinia'
import {useUserStore} from "./stores/user";
import axios from "axios";
import {Notify, Quasar} from 'quasar';
import langRu from 'quasar/lang/ru';
import 'quasar/dist/quasar.prod.css';
import 'quasar/dist/quasar.addon.prod.css';
//import 'quasar/dist/quasar.addon.rtl.prod.css';
import './global.css'


createApp(App)
    .use(router)
    .use(createPinia())
    .use(Quasar, {lang: langRu, plugins: {Notify}})
    .mount('#app');


// Обращение к защищенному ресурсу без прав удаляет авторизацию
axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            useUserStore().removeAuth();
        } else return Promise.reject(error);
    });