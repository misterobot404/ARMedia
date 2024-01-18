<template>
    <AccountLayout>
        <div class="q-px-lg q-pb-md q-mt-md">
            <h5 class="q-my-none">Настройка уведомлений</h5>
            <div class="q-mt-lg flex">
                <div>
                    <div class="text-body2 q-mb-sm">Уведомления об использовании альбома</div>
                    <div>
                        <q-toggle label="Электронная почта" v-model="v1" color="primary" keep-color/>
                    </div>
                    <div>
                        <q-toggle label="SMS" v-model="v2" color="primary" keep-color/>
                    </div>
                </div>

                <div class="q-ml-xl">
                    <div class="text-01 q-mb-sm">Уведомления об акциях и скидках</div>
                    <div>
                        <q-toggle label="Электронная почта" v-model="v3" color="primary" keep-color/>
                    </div>
                    <div>
                        <q-toggle label="SMS" v-model="v4" color="primary" keep-color/>
                    </div>
                </div>

                <div class="q-ml-xl">
                    <div class="text-01 q-mb-sm">Рекламные уведомления</div>
                    <div>
                        <q-toggle label="Электронная почта" v-model="v5" color="primary" keep-color/>
                    </div>
                </div>
            </div>
        </div>
    </AccountLayout>
</template>

<script>
import {mapState} from "pinia";
import {useUserStore} from "../stores/user";
import axios from "axios";
import AccountLayout from "../components/AccountLayout.vue";

export default {
    components: {AccountLayout},
    data() {
        return {
            v1: false,
            v2: false,
            v3: false,
            v4: false,
            v5: false
        };
    },
    computed: {
        ...mapState(useUserStore, ["user"])
    },
    methods: {}
}

</script>

<style scoped>

</style>
