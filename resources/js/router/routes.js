import Home from "../pages/Home.vue";
import AccountAlbums from "../pages/AccountAlbums.vue";
import AccountAlbumObjects from "../pages/AccountAlbumObjects.vue";
import AccountSettings from "../pages/AccountSettings.vue"
import AccountHelps from "../pages/AccountHelps.vue"

/*
import AccountNotification from "../pages/AccountNotification.vue"
import AdminPanel from "@/pages/AdminPanel.vue";
*/


export default [
    /* Страницы доступны всем пользователям */
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/account/albums',
        component: AccountAlbums,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/account/albums/:album_id',
        component: AccountAlbumObjects,
        name: "Objects",
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/account/settings',
        component: AccountSettings,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/account/helps',
        component: AccountHelps,
        meta: {
            requiresAuth: true
        }
    }
]
