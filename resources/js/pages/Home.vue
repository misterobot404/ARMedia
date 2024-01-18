<template>
    <div class="container">
        <div id="container-1">
            <q-img fit="cover" style="min-height: 100vh" src="/assets/images/home_bg_1.png" no-spinner/>
            <div class="container-1_content">
                <div class="flex items-center" style="height: 72px">
                    <div class="text-body-1" style="margin: 24px 44px 24px auto">
                        <template v-if="USER_STORE.user">
                            <router-link to="/account/albums">Личный кабинет</router-link>
                        </template>
                        <template v-else>
                            <a @click="USER_STORE.show_signin_dialog = true" class="cursor-pointer">Войти в личный кабинет</a>
                        </template>
                    </div>
                </div>

                <div class="flex column" style="padding: 170px 0 140px">
                    <div style="margin-left: 16%">
                        <div class="title">
                            Новая<br>реальность<br>у вас в телефоне
                        </div>
                        <div class="subtitle q-mt-lg">
                            Конструктор дополненной реальности для тех,<br>кто идёт в ногу со временем
                        </div>
                    </div>
                    <router-link to="/account/albums" class="action-button q-mx-auto text-center" style="margin-top: 120px">
                        Попробовать
                    </router-link>
                </div>

                <div class="text-center q-mb-sm">
                    <div class="text-body-1">Подробнее</div>
                    <q-img src="/assets/images/arrow_bot.gif" height="46px" width="64px" no-spinner/>
                </div>

                <div id="container-1_subcontent" class="flex column items-center" style="margin-top: 68px">
                    <h1>Как это работает?</h1>
                    <div class="subtitle">От вас потребуется всего два элемента, чтобы сделать свою дополненную реальность</div>
                    <div style="margin-top: 140px" class="flex no-wrap">
                        <div class="flex column" style="margin-right: 100px">
                            <h3 class="text-center">Маркер</h3>
                            <div class="card text-body-1" style="flex-grow: 1">
                                <div>Объект, при наведении на который
                                    отобразиться ваш контент:
                                </div>
                                <div class="flex no-wrap" style="margin-top: 12px">
                                    <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                    <div class="q-ml-sm">Ваш логотип</div>
                                </div>
                                <div class="flex no-wrap" style="margin-top: 12px">
                                    <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                    <div class="q-ml-sm">Рисунок на плакате</div>
                                </div>
                                <div class="flex no-wrap" style="margin-top: 12px">
                                    <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                    <div class="q-ml-sm">Фирменный слоган</div>
                                </div>
                                <div class="text-center q-mt-lg text-body-2">
                                    Или абсолютно любой текст или картинка
                                </div>
                            </div>
                        </div>
                        <div class="flex column" style="margin-left: 100px">
                            <h3 class="text-center">Контент</h3>
                            <div class="card text-body-1" style="flex-grow: 1">
                                <div>Объект, который отобразиться</div>
                                <div class="flex no-wrap" style="margin-top: 12px">
                                    <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                    <div class="q-ml-sm">Фото или видео</div>
                                </div>
                                <div class="flex no-wrap" style="margin-top: 12px">
                                    <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                    <div class="q-ml-sm">Адрес или контактные данные</div>
                                </div>
                                <div class="flex no-wrap" style="margin-top: 12px">
                                    <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                    <div class="q-ml-sm">Фирменный слоган или логотип</div>
                                </div>
                                <div class="text-center q-mt-lg text-body-2">
                                    Или абсолютно любой текст или картинка
                                </div>
                            </div>
                        </div>
                    </div>
                    <router-link to="/account/albums" class="action-button q-mx-auto text-center" style="margin-top: 120px">
                        Создать свою реальность
                    </router-link>
                </div>
            </div>
        </div>
        <div id="container-2">
            <q-img fit="cover" style="max-width: 1334px" src="/assets/images/home_bg_2.png" no-spinner/>
            <div class="container-2_content">
                <h1 style="margin-top: 120px">Кому это подойдет?</h1>
                <div class="q-mt-md subtitle">Для всех, кто хочет внести что-то новое и современное в свою работу</div>
                <div class="flex q-mt-auto justify-center">
                    <div class="flex column">
                        <h3 class="text-center">Образование</h3>
                        <div class="card text-body-1" style="flex-grow: 1">
                            <div>Добавьте интерактивности вашим занятиям, например:</div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Интерактивные учебники</div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Исторические события на карте</div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Дополнительные пояснения к учебным материалам</div>
                            </div>
                            <div class="text-center q-mt-lg text-body-2">
                                Или придумайте своё
                            </div>
                        </div>
                    </div>
                    <div class="flex column">
                        <h3 class="text-center">Культура</h3>
                        <div class="card text-body-1" style="flex-grow: 1">
                            <div>Сделайте из обычного музея интерактивный , например:</div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Добавьте описание к объектам
                                    искусства
                                </div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Прикрепите голосовые
                                    комментарии
                                </div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Оживите картины</div>
                            </div>
                            <div class="text-center q-mt-lg text-body-2">
                                Или придумайте своё
                            </div>
                        </div>
                    </div>
                    <div class="flex column">
                        <h3 class="text-center">Туризм</h3>
                        <div class="card text-body-1" style="flex-grow: 1">
                            <div>Привлекайте людей к объектам культуры новыми технологиями:</div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Добавьте к памятникам
                                    историческую справку
                                </div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Расскажите об истории зданий</div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Сделайте обычную карту
                                    интерактивной
                                </div>
                            </div>
                            <div class="text-center q-mt-lg text-body-2">
                                Или придумайте своё
                            </div>
                        </div>
                    </div>
                    <div class="flex column">
                        <h3 class="text-center">Бизнес</h3>
                        <div class="card text-body-1" style="flex-grow: 1">
                            <div>Расскажите о своём бизнесе по новому, например:</div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Прикрепите к визиткам
                                    виртуальные кнопки
                                </div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Сделайте интерактивный каталог</div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Расскажите о своём бренде</div>
                            </div>
                            <div class="text-center q-mt-lg text-body-2">
                                Или придумайте своё
                            </div>
                        </div>
                    </div>
                    <div class="flex column">
                        <h3 class="text-center">Повседневные дела</h3>
                        <div class="card text-body-1" style="flex-grow: 1">
                            <div>Адаптируйте новые технологии
                                под бытовые задачи:
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Подпишите бирки для стирки
                                    на одежде
                                </div>
                            </div>
                            <div class="flex no-wrap" style="margin-top: 12px">
                                <q-img src="/assets/images/li_point.png" no-spinner style="min-width: 16px; width: 16px; height: 16px"/>
                                <div class="q-ml-sm">Сделайте любую книгу
                                    интерактивной и развлекайтесь
                                    вместе с детьми
                                </div>
                            </div>
                            <div class="text-center q-mt-lg text-body-2">
                                Или придумайте своё
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="stepper">
            <div v-for="step in [1, 2, 3]" class="q-my-sm">
                <q-img v-if="step === current_step"
                       @click="selectStep(step)"
                       src=" /assets/images/current_step.png"
                       width="48px" class="cursor-pointer" no-spinner/>
                <q-img v-else
                       @click="selectStep(step)"
                       src=" /assets/images/step.png"
                       width="16px" class="cursor-pointer" no-spinner/>
            </div>
        </div>

        <!-- Global components -->
        <SigninDialog/>
        <SignupDialog/>
    </div>
</template>

<script>
import SigninDialog from "@/components/SigninDialog.vue";
import SignupDialog from "@/components/SignupDialog.vue";
import {useUserStore} from "@/stores/user";

export default {
    name: "Home",
    components: {SignupDialog, SigninDialog},
    data() {
        return {
            current_step: 1,
            disable_scroll_event: false,

            USER_STORE: useUserStore(),
        }
    },
    methods: {
        selectStep(step) {
            this.current_step = step;
            this.disable_scroll_event = true;

            switch (this.current_step) {
                case 1:
                    document.getElementsByClassName('container-1_content ')[0].scrollTo({top: 0});
                    document.getElementById('container-1').scrollIntoView({behavior: 'smooth'});
                    break;
                case 2:
                    document.getElementById('container-1_subcontent').scrollIntoView({behavior: 'smooth'});
                    break;
                case 3:
                    document.getElementById('container-2').scrollIntoView({behavior: 'smooth'});
                    break;
            }

            setTimeout(function () {
                this.disable_scroll_event = false;
            }, 140);
        },
    },
    beforeMount() {
        document.addEventListener("scroll", (event) => {
            if (!this.disable_scroll_event) {

                if (window.scrollY < document.getElementById('container-1_subcontent').offsetTop) {
                    this.current_step = 1;
                } else {
                    this.current_step = 3;
                }
            }
        });
    }
}
</script>

<style scoped>
a {
    text-decoration: none;
    color: inherit;
}

a:hover {
    text-decoration: underline;
}

::-webkit-scrollbar {
    display: none;
}

.container {
    background: linear-gradient(270deg, #121758 0%, #081645 30.7%, #080E31 51.54%, #0C0724 65.15%, #0F0523 81.46%, #140626 100%);
    color: #FFFFFF;
}

#container-1 {
    max-width: 100vw;
    min-height: 100vh;
}

.container-1_content {
    height: 100vh;
    width: calc(100vw - 20px);
    position: absolute;
    display: flex;
    flex-direction: column;
    top: 0;
    overflow-y: auto;
}

.title {
    max-width: 600px;
    font-size: 64px;
    font-weight: 500;
    line-height: 77px;
    text-transform: uppercase;
}

.subtitle {
    font-size: 22px;
    font-weight: 400;
    line-height: 30px;
}

#container-2 {
    max-width: 100vw;
    min-height: 100vh;
    padding: 60px 0;
    display: flex;
    justify-content: center;
    position: relative;
}

.container-2_content {
    height: 100vh;
    overflow-y: auto;
    width: calc(100vw - 20px);
    position: absolute;
    display: flex;
    flex-direction: column;
    top: 0;
    align-items: center;
}

.action-button {
    background: rgba(123, 29, 242, 0.2);
    border-radius: 8px;
    border-style: solid;
    border-color: rgba(255, 255, 255, 0.1);
    border-width: 1px;
    padding: 16px 64px 16px 64px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    width: 300px;
    backdrop-filter: blur(6px);
    font-size: 24px;
    font-weight: 400;
    transition-duration: 0.4s;
    cursor: pointer;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    text-shadow: 0 0 1px rgba(249, 249, 249, 0.83);
}

.action-button:hover {
    box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.4);
    text-decoration: none;
}

.stepper {
    position: fixed;
    right: 30px;
    top: 50%;
    transform: translateY(-60%);
    background: transparent;
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 100000;
}

.card {
    width: 300px;
    margin: 16px;
    border: 1px solid #FFFFFF1A;
    background: linear-gradient(0deg, rgba(250, 250, 250, 0.1), rgba(250, 250, 250, 0.1)),
    linear-gradient(0deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.1));
    border-radius: 8px;
    padding: 16px;
    white-space: normal;
}
</style>
