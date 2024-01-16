import Home from "../pages/Home.vue";
/*
import Account from "../pages/Account.vue";
import AccountSecurity from "../pages/AccountSecurity.vue"
import AccountPayment from "../pages/AccountPayment.vue"
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
    /*/!* Страницы доступны только авторизованным пользователям *!/
    {
        path: '/account',
        component: Account,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/account/account_security',
        component: AccountSecurity,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/account/account_payment",
        component: AccountPayment,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/account/account_notification",
        component: AccountNotification,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/favorite_objects',
        component: FavoriteObjects,
        meta: {
            requiresAuth: true
        }
    },
    /!* Страница доступны только администратору *!/
    {
        path: '/admin_panel',
        component: AdminPanel,
        meta: {
            requiresAuth: true,
            requiresAdmin: true
        }
    },*/
]
