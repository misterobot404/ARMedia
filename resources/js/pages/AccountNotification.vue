<template>
    <AccountContainer>
        <div class="row">
            <div class="col-lg-7 col-md-12 col-xs-12 q-mt-md q-mr-auto">
                <div class="text-m-b text-01">Уведомления о бронировании</div>
                <div class="text-xs text-02">По-мимо стандартных уведомлений на сайте</div>
                <div>
                    <q-toggle label="Электронная почта" v-model="value1" color="primary" keep-color />
                </div>
                <div>
                    <q-toggle label="SMS" v-model="value2" color="primary" keep-color><q-tooltip>Может взыматься плата
                            согласно тарифов вашего оператора</q-tooltip></q-toggle>
                </div>
                <div class="q-mt-lg">
                    <div class="text-m-b text-01">Уведомления об акциях и скидках</div>
                    <div class="text-xs text-02">По-мимо стандартных уведомлений на сайте</div>
                    <div>
                        <q-toggle label="Электронная почта" v-model="value1" color="primary" keep-color />
                    </div>
                    <div>
                        <q-toggle label="SMS" v-model="value2" color="primary" keep-color><q-tooltip>Может взыматься плата
                                согласно тарифов вашего оператора</q-tooltip></q-toggle>
                    </div>
                </div>
                <div class="q-mt-lg">
                    <div class="text-m-b text-01">Рекламные уведомления</div>
                    <div class="text-xs text-02">По-мимо стандартных уведомлений на сайте</div>
                    <div>
                        <q-toggle label="Электронная почта" v-model="value1" color="primary" keep-color />
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-xs-12 q-mt-md flex column">
                <div class="info-card">
                    <q-img src="/assets/images/Mail-amico-1.svg" no-spinner/>
                    <span class="text-m-b text-01">Подключайте уведомления и будьте в курсе</span>
                    <span class="text-s text-01">Включив уведомления вы будете моментально получать оповещения о новых
                        бронированиях, акциях
                    </span>
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
