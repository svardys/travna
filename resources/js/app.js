import router from './router'
import store from './store'
import Loading from './components/Loading';
import Success from './components/Success';
import Exception from './components/Exception';
import {onMounted} from "vue";
import {useStore} from "vuex";
import Api from "./services/api";

window.Vue = require('vue')
window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const app = Vue.createApp({
    el: '#app',
    components: {
        'App': {
            template:
                '<loading></loading>' +
                '<router-view></router-view>' +
                '<success></success>' +
                '<exception></exception>'
        },
    },
    setup() {
        const store = useStore();

        onMounted(async () => {
            try {
                const response = await Api.get('/api/fields');
                store.commit('editableModule/setFields', response.data);
            } catch (e) {
                store.commit('messagesModule/setException', e);
            }
        })
    }
})

app.component('loading', Loading);
app.component('success', Success);
app.component('exception', Exception);
app.use(router);
app.use(store);
app.mount('#app');
