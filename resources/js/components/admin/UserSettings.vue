<template>
<div class="lg:grid lg:grid-cols-3">
    <div class="lg:col-span-1">
        <div>
            <form @submit.prevent="updatePassword">
                <label for="email" class="block text-sm font-medium text-gray-700">Změna hesla</label>
                <div class="mt-1 table">
                    <label for="pass" class="block text-sm text-gray-500">Současné heslo</label>
                    <input v-model="form.current_password" type="password" name="pass" id="pass" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md mr-10" required/>
                    <div class="mt-1 text-sm text-red-600" id="email-error"
                         v-if="form.errors.has('current_password')"
                         v-text="form.errors.get('current_password')"></div>
                </div>
                <div class="mt-1 table">
                    <label for="pass1" class="block text-sm text-gray-500">Nové heslo poprvé</label>
                    <input v-model="form.password" type="password" name="pass1" id="pass1" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md mr-10" required/>
                    <div class="mt-1 text-sm text-red-600" id="email-error"
                         v-if="form.errors.has('password')"
                         v-text="form.errors.get('password')"></div>
                </div>
                <div class="mt-2 table">
                    <label for="pass2" class="block text-sm text-gray-500">Nové heslo pro kontrolu podruhé</label>
                    <input v-model="form.password_confirmation" type="password" name="pass2" id="pass2" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md mr-10" required/>
                </div>
                <button type="submit"
                                class="mt-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Uložit
                </button>
            </form>
        </div>
    </div>
    <div class="lg:col-span-2 hidden lg:relative lg:block">
        <div class="absolute right-2 top-[20%]">
            <img class="hidden lg:block w-full md:max-w-[50%] xl:max-w-full opacity-20 text-gray-400 -z-10" src="/storage/images/watterMark2.svg" alt="Workflow" />
        </div>
    </div>
</div>
</template>

<script>
import {reactive} from "vue"
import {useStore} from "vuex"
import Form from "../../utilities/form";

export default {
    setup() {
        const store = useStore();
        const form =
            reactive(new Form({
                current_password: '',
                password: '',
                password_confirmation: '',
            }));

        async function updatePassword() {
            try {
                await store.dispatch('userModule/updatePassword', form.objectToFormData());
                form.onSuccess();
                await store.dispatch('messagesModule/showSuccess', 'Vaše heslo bylo změněno');
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
            updatePassword
        }
    }
}
</script>
