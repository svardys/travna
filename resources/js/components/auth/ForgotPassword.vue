<template>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 m-auto">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-32 w-auto" src="/storage/images/icon.png" alt="Workflow"/>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Zapomenuté heslo</h2>
            </div>
            <form @submit.prevent="sendEmail" class="mt-8 space-y-6">
                <div class="rounded-md shadow-sm">
                    <div>
                        <label for="email-address" class="sr-only">Email</label>
                        <input v-model="form.email" id="email-address" name="email" type="email" autocomplete="email"
                               required=""
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Zadejte svůj email"/>
                        <div class="mt-1 text-sm text-red-600" id="email-error"
                             v-if="form.errors.has('email')"
                             v-text="form.errors.get('email')"></div>
                    </div>
                </div>
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Odeslat
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {reactive} from "vue"
import {useStore} from "vuex"
import Form from "../../utilities/form";
import router from "../../router";

export default {
    setup() {
        const store = useStore();
        const form =
            reactive(new Form({
                email: ''
            }));

        async function sendEmail() {
            try {
                const response = await store.dispatch('userModule/forgotPassword', form.objectToFormData());
                form.onSuccess();
                await store.dispatch('messagesModule/showSuccess', response.data.message);
                await router.push({name: 'homeIndex'});
            } catch (e) {
                if (e.response) {
                    if (e.response.status === 422) {
                        form.onFail(e.response.data.errors);
                    } else {
                        await store.dispatch('messagesModule/showException', e.response.data.message);
                    }
                }
            }
        }

        return {
            form,
            sendEmail
        }
    }
}
</script>
