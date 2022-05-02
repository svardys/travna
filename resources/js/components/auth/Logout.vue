<template>
    <p @click="logout" class="cursor-pointer">
        Odhlásit se
    </p>
</template>

<script>
import {useStore} from "vuex";
import router from "../../router";

export default {
    setup() {
        const store = useStore();

        async function logout() {
            try {
                await store.dispatch('userModule/logout');
                await router.push({name: 'homeIndex'});
            } catch (e) {
                await store.dispatch('messagesModule/showException', e.response.data.message);
            }
        }

        return {
            logout
        }
    }
};
</script>
