<template>
    <q-layout>
        <div style="padding: 20px 32px 0 32px">
            <div class="flex items-center">
                <router-link to="/" class="flex" style="color: inherit; text-decoration: none">
                    <q-img src="/assets/images/favicon.png" width="48px" height="48px" no-spinner/>
                    <div class="q-pl-sm">
                        <h4>ARMedia</h4>
                        <h6 class="text-body-2" style="font-weight: 500">Сервис дополненной реальности для всех</h6>
                    </div>
                </router-link>
                <div class="flex no-wrap q-ml-auto items-center">
                    <div>
                        <q-btn icon="apps" flat style="width: 36px" dense/>
                        <q-menu style="border-radius: .4rem; width: 300px; padding: 16px">
                            <div class="text-body2">AR/VR Ресурсы</div>
                            <q-separator class="q-my-sm"/>
                            <div class="row q-col-gutter-y-md">
                                <a v-for="service in services" class="col-6 column items-center" style="text-decoration: none"
                                   :href="service.link">
                                    <q-img :src="service.logo" no-spinner width="64px" height="64px"/>
                                    <div>{{ service.name }}</div>
                                </a>
                            </div>
                        </q-menu>
                    </div>
                    <div class="q-ml-sm">
                        <q-btn round flat>
                            <q-avatar size="32px">
                                <q-img src="/assets/images/user-avatar-icon.png" alt="Иконка аватара" no-spinner/>
                            </q-avatar>
                        </q-btn>
                        <q-menu style="border-radius: .4rem; width: 200px;">
                            <q-list style="min-width: 100px">
                                <q-item>
                                    <q-item-section>
                                        <div class="flex items-baseline no-wrap">
                                            <q-icon name="person" class="q-pr-sm"/>
                                            <div>
                                                <div style="font-weight: 500">{{ USER_STORE.user.name }}</div>
                                                <div class="text-subtitle2">{{ USER_STORE.user.email }}</div>
                                            </div>
                                        </div>
                                    </q-item-section>
                                </q-item>
                                <q-separator/>
                                <q-item to="/">
                                    <q-item-section>
                                        <div class="flex items-center">
                                            <q-icon name="home" class="q-pr-sm"/>
                                            Главная
                                        </div>
                                    </q-item-section>
                                </q-item>
                                <q-item @click="logout" clickable v-close-popup>
                                    <q-item-section>
                                        <div class="flex items-center">
                                            <q-icon name="logout" class="q-pr-sm"/>
                                            Выйти
                                        </div>
                                    </q-item-section>
                                </q-item>
                            </q-list>
                        </q-menu>
                    </div>
                </div>
            </div>
            <q-tabs align="left" class="q-mt-sm" no-caps active-color="primary" active-class="selected-tab">
                <q-route-tab to="/account/albums" label="Альбомы"/>
                <template v-if="$route.name === 'Objects'">
                    <q-route-tab :to="$route.href" label="Метки"/>
                </template>
                <q-route-tab to="/account/settings" label="Настройка"/>
                <q-route-tab to="/account/helps" label="Помощь"/>
            </q-tabs>
        </div>
        <q-separator/>
        <main style="padding: 24px 32px">
            <slot/>
        </main>
    </q-layout>
</template>

<script>
import {useUserStore} from "../stores/user";

export default {
    name: "AccountLayout",
    data() {
        return {
            USER_STORE: useUserStore(),
            services: [
                {
                    name: "Hi-News",
                    logo: "/assets/images/services/vr.png",
                    link: "https://hi-news.ru/tag/dopolnennaya-virtualnaya-realnost"
                },
                {
                    name: "Habrhabr",
                    logo: "/assets/images/services/habr.png",
                    link: "https://habr.com/ru/hubs/virtualization/articles/"
                },
                {
                    name: "Sber AR/VR Lab",
                    logo: "/assets/images/services/sber.png",
                    link: "https://developers.sber.ru/portal/categories/ar-vr"
                },
                {
                    name: "AR Conference",
                    logo: "/assets/images/services/ar_conference.ico",
                    link: "https://conferenceindex.org/conferences/augmented-reality"
                },
            ]
        }
    },
    methods: {
        logout() {
            this.USER_STORE.logout()
                .then(() => {
                    this.$q.notify({type: "positive", message: "Вы вышли из своей учётной записи"});
                    if (this.$route.meta.requiresAuth) {
                        this.$router.push("/");
                    }
                });
        },
    }
}
</script>

<style scoped>
.user-panel {
    display: flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    border: 1px solid #0000001f;
    cursor: pointer;
    transition: box-shadow 0.2s ease;
}

.user-panel:hover {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.18);
}

.border-radius-lg :deep(.q-field__control),
.border-radius-lg :deep(.q-btn--rectangle) {
    border-radius: 8px;
}

h1, h2, h3, h4, h5, h6 {
    margin: 0;
}

</style>

<style>
.q-tab__label {
    font-weight: 400 !important;
}
</style>
