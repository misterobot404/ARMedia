<template>
    <AccountLayout>
        <template v-if="!loading">
            <div class="flex items-center justify-between q-mb-md">
                <div class="flex items-center">
                    <q-btn icon="arrow_back" to="/account/albums" round flat/>
                    <h4 class="q-mt-none q-mb-xs text-weight-regular">{{ album.title }}</h4>
                </div>
                <template v-if="objects?.length">
                    <q-btn label="Добавить метку" style="height: 36px" @click="show_create_object = true"/>
                </template>
            </div>

            <template v-if="!objects?.length">
                <div style="width: 100%; height: 600px">
                    <div class="text-center q-mt-lg">
                        <q-img src="/assets/images/no-objects.svg" style="width: 400px" no-spinner/>
                        <div>
                            <q-btn label="Создать метку" color="primary" class="q-mt-lg" @click="show_create_object = true"/>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div v-for="object in objects">
                    <q-card class="full-width q-mb-md">
                        <q-card-section class="flex full-width">
                            <div class="flex items-center">
                                <q-img :src="object.marker" no-spinner width="160px" height="100%" fit="contain">
                                    <div class="absolute-bottom text-center" style="padding: 4px 0 !important; height: 30px">
                                        <div>Метка</div>
                                    </div>
                                </q-img>
                            </div>
                            <div class="q-ml-md flex items-center">
                                <q-img :src="object.object" no-spinner width="160px" height="100%" fit="contain">
                                    <div class="absolute-bottom text-center" style="padding: 4px 0 !important; height: 30px">
                                        Объект
                                    </div>
                                </q-img>
                            </div>
                            <div class="q-ml-md flex column" style="flex-grow: 1">
                                <div class="flex justify-between">
                                    <div>
                                        <h5 class="q-my-none">{{ object.name }}</h5>
                                        <div class="q-mt-xs">Дата создания: {{ new Date(object.created_at).toLocaleDateString('ru') }}</div>
                                    </div>
                                    <div>
                                        <q-btn flat label="Удалить" color="red" class="q-mr-xs" @click="deleteObject(object.id)"/>
                                    </div>
                                </div>
                            </div>
                        </q-card-section>
                    </q-card>
                </div>
            </template>
        </template>

        <q-dialog
            v-model="show_create_object"
            persistent
            maximized
            transition-show="slide-up"
            transition-hide="slide-down"
        >
            <q-card>
                <q-card-section class="row items-center">
                    <div class="text-h6">Создание метки</div>
                    <q-space/>
                    <q-btn icon="close" flat round dense v-close-popup/>
                </q-card-section>

                <q-separator/>

                <q-card-section class="q-gutter-y-md">
                    <div class="flex justify-center">
                        <div class="column col-grow justify-center relative-position">
                            <div class="position-absolute-center">
                                <q-file
                                    v-model="new_marker"
                                    borderless
                                    bg-color="#FAFAFA"
                                    accept=".jpeg, .png, .svg"
                                    :input-style="{ height: '500px', width: '800px', borderRadius: '1rem' }"
                                />
                            </div>
                            <div class="position-absolute-center load-file-placeholder">
                                <h6 style="position: absolute; top: -76px; left: 10px">Маркер:</h6>
                                <template v-if="!new_marker">
                                    <q-img src="/assets/images/load-file-placeholder.svg" width="248px" no-spinner/>
                                    <div class="text-weight-medium q-mt-md">Загрузите маркер</div>
                                    <div class="q-mt-sm">Выберите или перенесите сюда файл,<br>который будет маркером</div>
                                    <q-btn flat color="primary" label="Инструкция по работе" href="/assets/manual.pdf" target="_blank" class="example_excel_btn" no-caps/>
                                </template>
                                <template v-else>
                                    <q-img :src="new_marker_base64" width="248px" no-spinner/>
                                    <div class="text-weight-medium q-mt-md">Метка загружена</div>
                                    <q-chip :label="new_marker.name" removable @remove="new_marker = null" class="q-mt-md" style="pointer-events: all"/>
                                </template>
                            </div>
                        </div>
                        <div class="column col-grow justify-center relative-position">
                            <div class="position-absolute-center">
                                <q-file
                                    v-model="new_object"
                                    borderless
                                    bg-color="#FAFAFA"
                                    accept=".jpeg, .png, .svg"
                                    :input-style="{ height: '500px', width: '800px', borderRadius: '1rem' }"
                                />
                            </div>
                            <div class="position-absolute-center load-file-placeholder">
                                <h6 style="position: absolute; top: -76px; left: 10px">Объект:</h6>
                                <template v-if="!new_object">
                                    <q-img src="/assets/images/load-file-placeholder.svg" width="248px" no-spinner/>
                                    <div class="text-weight-medium q-mt-md">Загрузите объект</div>
                                    <div class="q-mt-sm">Выберите или перенесите сюда файл,<br>который будет выводиться при наведении</div>
                                    <q-btn flat color="primary" label="Инструкция по работе" href="/assets/manual.pdf" target="_blank" class="example_excel_btn" no-caps/>
                                </template>
                                <template v-else>
                                    <q-img :src="new_object_base64" width="248px" no-spinner/>
                                    <div class="text-weight-medium q-mt-md">Объект загружен</div>
                                    <q-chip :label="new_object.name" removable @remove="new_object = null" class="q-mt-md" style="pointer-events: all"/>
                                </template>
                            </div>
                        </div>
                    </div>
                </q-card-section>

                <q-card class="create-object-btn">
                    <q-card-section>
                        <q-input v-model="new_name" label="Введите название" filled type="text">
                            <template v-slot:prepend>
                                <q-icon name="title"/>
                            </template>
                        </q-input>
                        <div class="flex q-mt-sm">
                            <q-btn @click="createObject()" label="Сохранить" class="q-ml-auto full-width" color="primary"/>
                        </div>
                    </q-card-section>
                </q-card>
            </q-card>
        </q-dialog>
    </AccountLayout>
</template>

<script>
import axios from "axios";
import AccountLayout from "../components/AccountLayout.vue";

export default {
    props: ["album_id"],
    components: {AccountLayout},
    data() {
        return {
            loading: true,
            album: null,
            objects: null,

            show_create_object: false,

            new_name: null,
            new_object: null,
            new_object_base64: null,
            new_marker: null,
            new_marker_base64: null,
        }
    },
    watch: {
        new_marker(v) {
            if (v) {
                this.getMarkerBase64(this);
            } else this.new_marker_base64 = null;
        },
        new_object(v) {
            if (v) {
                this.getObjectBase64(this);
            } else this.new_object_base64 = null;
        },
    },
    methods: {
        getObjects() {
            axios.get(`/api/albums/${this.album_id}/objects`)
                .then(response => {
                    this.objects = response.data.objects;
                    this.album = response.data.album;
                    this.loading = false;
                })
        },
        createObject() {
            if (!this.new_object || !this.new_marker || !this.new_name) {
                this.$q.notify({type: "negative", message: "Введите название, выберите метку и объект"});
                return;
            }

            const formData = new FormData();
            formData.append('name', this.new_name);
            formData.append('album_id', this.album_id);
            formData.append('marker', this.new_marker);
            formData.append('object', this.new_object);

            axios.post(`/api/albums/${this.album_id}/objects`, formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                    this.objects = response.data.objects;
                    this.$q.notify({type: "positive", message: "Метка создана"});

                    this.show_create_object = false;
                    this.new_object = null;
                    this.new_marker = null;
                    this.new_name = null;
                })
        },
        deleteObject(object_id) {
            if (!confirm("Вы уверены что хотите удалить эту метку?")) {
                return
            }

            axios.delete(`/api/albums/${this.album_id}/objects/${object_id}`)
                .then(response => {
                    this.objects = response.data.objects;
                    this.$q.notify({type: "positive", message: "Метка удалёна"});
                })
        },

        getMarkerBase64(context) {
            let reader = new FileReader();
            reader.readAsDataURL(this.new_marker);
            reader.onload = function () {
                context.new_marker_base64 = reader.result;
            };
        },
        getObjectBase64(context) {
            let reader = new FileReader();
            reader.readAsDataURL(this.new_object);
            reader.onload = function () {
                context.new_object_base64 = reader.result;
            };
        }
    },
    beforeMount() {
        this.getObjects();
    }
}

</script>

<style scoped>
.example_excel_btn {
    pointer-events: all;
    margin-top: 16px;
}

.position-absolute-center {
    position: absolute;
    top: 350px;
    left: 50%;
    transform: translate(-50%, -50%);
}

.load-file-placeholder {
    width: 100%;
    max-width: 850px;
    height: 520px;
    pointer-events: none;
    background-color: #FAFAFA;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 2px dashed #1976d2;
    border-radius: 1rem;
    text-align: center;
}

.create-object-btn {
    position: absolute;
    bottom: 60px;
    left: 50%;
    transform: translateX(-50%);
    width: 400px;
    border-radius: 8px;
    background-color: #FAFAFA;
}
</style>

<style>
.q-img__content > div {
    padding: 0;
}
</style>
