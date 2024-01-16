<template>
    <q-layout>
        <q-page-container>
            <div class="row q-mt-lg">
                <div class="col-12">
                    <div class="q-gutter-y-md" style="width: fit-content;">
                        <q-tabs v-model="tab" class="text-01 text-m" indicator-color="primary" no-caps>
                            <q-route-tab name="profile" to="/account" label="Мой профиль" />
                            <q-route-tab name="security" to="/account/account_security" label="Безопасность" />
                            <q-route-tab name="payments" to="/account/account_payment" label="Платежи" />
                            <q-route-tab name="notifications" to="/account/account_notification" label="Уведомления" />
                        </q-tabs>
                    </div>
                </div>
            </div>
            <slot />
        </q-page-container>
    </q-layout>
</template>

<script>
export default {
    data() {
        return {
            tab: ""
        };
    },
}

</script>