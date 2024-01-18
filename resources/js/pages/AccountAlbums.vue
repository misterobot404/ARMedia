<template>
    <AccountLayout>
        <template v-if="!loading">
            <template v-if="!albums?.length">
                <div style="width: 100%; height: 600px">
                    <div class="text-center q-mt-lg">
                        <q-img src="/assets/images/no-data.svg" style="width: 400px" no-spinner/>
                        <div>
                            <q-btn label="Создать альбом" color="primary" class="q-mt-lg" @click="show_create_dialog = true"/>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="flex justify-between items-center" style="margin-bottom: 12px">
                    <h4 class="q-my-none text-weight-regular">Ваши альбомы:</h4>
                    <q-btn label="Добавить альбом" style="height: 36px" @click="show_create_dialog = true"/>
                </div>
                <div v-for="album in albums">
                    <q-card class="full-width q-mb-md">
                        <q-card-section class="flex full-width">
                            <div>
                                <q-img src="/assets/images/no-img.png" no-spinner width="200px"/>
                            </div>
                            <div class="q-ml-md flex column" style="flex-grow: 1">
                                <div>
                                    <h5 class="q-my-none">{{ album.title }}</h5>
                                    <div>{{ album.description }}</div>
                                </div>
                                <div class="q-mt-auto flex justify-between q-pb-xs">
                                    <div class="q-mt-auto text-grey-8">
                                        <span>Количество меток: {{ album.object_count }}</span>
                                        <span class="q-pl-md">Дата создания: {{ new Date(album.created_at).toLocaleDateString('ru') }}</span>
                                    </div>
                                    <div>
                                        <q-btn flat label="Удалить" color="red" class="q-mr-xs" @click="deleteAlbum(album.id)"/>
                                        <q-btn :to="'/account/albums/' + album.id" label="Открыть" color="primary"/>
                                    </div>
                                </div>
                            </div>
                        </q-card-section>
                    </q-card>
                </div>
            </template>
        </template>

        <q-dialog v-model="show_create_dialog">
            <q-card>
                <q-card-section class="row items-center">
                    <div class="text-h6">Создание альбома</div>
                    <q-space/>
                    <q-btn icon="close" flat round dense v-close-popup/>
                </q-card-section>

                <q-separator/>

                <q-card-section class="q-gutter-y-md">
                    <q-input v-model="create_dialog_title" label="Введите название" filled type="text">
                        <template v-slot:prepend>
                            <q-icon name="title"/>
                        </template>
                    </q-input>
                    <q-input v-model="create_dialog_description" label="Введите описание" filled type="textarea">
                        <template v-slot:prepend>
                            <q-icon name="edit_note"/>
                        </template>
                    </q-input>
                </q-card-section>

                <q-separator/>
                <q-card-section class="flex justify-end q-gutter-x-xs">
                    <q-btn flat label="Закрыть" v-close-popup/>
                    <q-btn @click="createAlbum()" label="Подтвердить" color="primary" type="submit"/>
                </q-card-section>
            </q-card>
        </q-dialog>
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
            loading: true,
            albums: null,

            show_create_dialog: false,
            create_dialog_title: null,
            create_dialog_description: null
        };
    },
    computed: {
        ...mapState(useUserStore, ["user"])
    },
    methods: {
        getAlbums() {
            axios.get('/api/albums')
                .then(response => {
                    this.albums = response.data.albums;
                    this.loading = false;
                })
        },
        createAlbum() {
            if (!this.create_dialog_title) {
                this.$q.notify({type: "negative", message: "Введите название"});
                return;
            }

            axios.post('/api/albums', {title: this.create_dialog_title, description: this.create_dialog_description})
                .then(response => {
                    this.albums = response.data.albums;
                    this.$q.notify({type: "positive", message: "Альбом создан"});

                    this.show_create_dialog = false;
                    this.create_dialog_title = null;
                    this.create_dialog_description = null;
                })
        },
        deleteAlbum(album_id) {
            if (!confirm("Вы уверены что хотите удалить этот альбом? Все закрепленные метки также будут удалены")) {
                return
            }

            axios.delete('/api/albums/' + album_id)
                .then(response => {
                    this.albums = response.data.albums;
                    this.$q.notify({type: "positive", message: "Альбом удалён"});
                })
        },
    },
    beforeMount() {
        this.getAlbums();
    }
}

</script>

<style scoped>

</style>
