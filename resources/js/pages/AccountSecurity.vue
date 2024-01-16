<template>
    <AccountContainer>
        <div class="row">
            <div class="col-lg-7 col-md-12 col-xs-12 q-mt-md q-mr-auto">
                <div class="text-m-b text-01">Пароль</div>
                <div class="text-xs text-02">Последний раз изменён: 10 дней назад</div>
                <q-btn label="Изменить пароль" class="link q-mt-sm" style="width: fit-content" outline unelevated no-caps />
                <div class="q-mt-lg">
                    <div class="text-m-b text-01">Двухфакторная аутентификация</div>
                    <div class="text-xs text-02">Вы будете получать код подтверждения для входа в аккаунт</div>
                    <q-btn label="Подключить" class="link q-mt-sm" style="width: fit-content" outline unelevated no-caps />
                </div>
                <div class="q-mt-lg">
                    <div class="text-m-b text-01">Уведомления о входе в аккаунт</div>
                    <div class="text-xs text-02">Вы будете получать код подтверждения для входа в аккаунт</div>
                    <div>
                        <q-toggle label="Электронная почта" v-model="value1" color="primary" keep-color
                            style="wight: fit-content" />
                    </div>
                    <div>
                        <q-toggle label="Номер телефона" v-model="value2" color="primary" keep-color />
                    </div>
                </div>
                <div class="q-mt-lg">
                    <div class="text-m-b text-01">История авторизации</div>
                    <div class="flex items-center q-mt-sm">
                        <q-icon name="computer" class="q-mr-md" size="24px" />
                        <div>
                            <div class="text-m text-01">Windows 10</div>
                            <div class="text-s text-02">14.04.2023 в 10:18</div>
                        </div>
                    </div>
                    <div class="flex items-center q-mt-sm">
                        <q-icon name="computer" class="q-mr-md" size="24px" />
                        <div>
                            <div class="text-m text-01">Windows 10</div>
                            <div class="text-s text-02">14.04.2023 в 10:18</div>
                        </div>
                        <q-badge align="middle" class="q-ml-md">Текущая сессия</q-badge>
                    </div>
                </div>
                <div class="q-mt-lg">
                    <div class="text-m-b text-01">Удаление аккаунта</div>
                    <div class="text-xs text-02">Данное действие необратимо</div>
                    <q-btn label="Удалить аккаунт" class="negative q-mt-sm" style="width: fit-content" outline unelevated
                        no-caps />
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-xs-12 q-mt-md flex column">
                <div class="info-card">
                    <q-img src="/assets/images/OTP-amico-1.svg" no-spinner/>
                    <span class="text-m-b text-01">Повысьте безопасность аккаунта</span>
                    <span class="text-s text-01">Безопасность нашего сообщества в приоритете. По этой причине мы проверяем
                        степень защиты всех аккаунтов.</span>
                </div>
            </div>
        </div>
    </AccountContainer>
</template>
<script>
import { ref } from 'vue';
import AccountContainer from '../components/AccountContainer.vue';

export default {
    data() {
        return {
            value1: ref(false),
            value2: ref(false)
        };
    },
    name: "Home",
    components: { AccountContainer }
}


</script>

<style scoped></style>
