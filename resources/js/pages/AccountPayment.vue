<template>
    <AccountContainer>
        <div class="row">
            <div class="col-lg-7 col-md-12 col-xs-12 q-mt-md q-mr-auto">
                <div class="column ">
                    <span class="text-m-b text-01">Способы оплаты и получения средств</span>
                    <div class="flex items-center q-mt-sm">
                        <q-img src="/assets/images/logos_mir.svg" alt="Мир" style="width: 32px;" class="q-mr-md" no-spinner/>
                        <div class="flex justify-between items-center">
                            <span class="text-m text-01">4276 •••• •••• 8990</span>
                            <q-btn flat color="negative" label="Удалить" />
                        </div>
                    </div>
                    <q-btn label="Добавить способ оплаты" class="link q-mt-sm" style="width: fit-content" outline unelevated
                        no-caps />
                </div>
                <div class="column q-mt-lg">
                    <span class="text-m-b text-01">История платежей</span>
                    <div class="flex items-center q-mt-sm">
                        <q-img src="/assets/images/solar_ruble-broken.svg" style="width: 32px;" class="q-mr-md" no-spinner/>
                        <div class="flex column">
                            <span class="text-m text-01">Поступление: “Столица-Холл” 1500 ₽ </span>
                            <span class="text-s text-02">10.04.2023 в 10:01</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-xs-12 q-mt-md flex column">
                <div class="info-card">
                    <q-img src="/assets/images/E-Wallet-amico-1.svg" no-spinner/>
                    <span class="text-m-b text-01">Совершайте все платежи через CreativeHub</span>
                    <span class="text-s text-01">Всегда платите и общайтесь только на платформе CreativeHub, чтобы на вас
                        распространялись наши <a href="#" class="link">Условия предоставления услуг</a>, <a href="#"
                            class="link">Условия оплаты</a>, <a href="#" class="link">Правила отмены</a> и другие гарантии.
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

        };
    },
    name: "Home",
    components: { AccountContainer }
}


</script>

<style scoped></style>
