import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";
import {Notify} from "quasar";
import {useUserStore} from "../stores/user";

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    const user_store = useUserStore();

    // Если пытаемся перейти на защищенную страницу
    if (to.meta.requiresAuth && !user_store.token) {
        user_store.show_signin_dialog = true;

        Notify.create({
            icon: "info",
            message: "Для продолжения необходимо авторизоваться"
        })

        if (from.meta.requiresAuth === false) {
            next(false);
        }
        else {
            next("/");
        }
    }
    else if (to.meta.requiresAdmin && !user_store.user.is_admin) {
        Notify.create({icon: "info", message: "Ошибка доступа к защищенному ресурсу"});
        next("/");
    }
    // Все проверки пройдены, страницу можно открыть
    else {
        next()
    }
})

export default router