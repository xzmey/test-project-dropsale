<template>
    <button type="button" style="background-color: purple; color: white;" class="btn btn-lg-192 btn-primary mb-4"
            @click="getResult()">Импортировать пользователей
    </button>
    <p style="color: black;">Всего: </p>
    <input
        type="number"
        :value="result.total"
        v-model="result"
        :disabled=true
    />
    <p style="color: black;">Добавлено: </p>
    <input
        type="number"
        :value="result.inserted"
        v-model="result"
        :disabled=true
    />
    <p style="color: black;">Обновлено: </p>
    <input
        type="number"
        :value="result.updated"
        v-model="result"
        :disabled=true
    />
</template>

<script>
import axios from 'axios'
import {reactive} from "vue";

const state = reactive({
    result: {
        total: null,
        inserted: null,
        updated: null,
    }
})

export default {
    methods: {
        getResult() {
            let uri = `http://localhost:81/api/import`;
            axios.get(uri).then(response => {
                state.result = response.data.result;
            });
        },
    },

    computed: {
        result() {
            return state.result
        },
    }
};
</script>
