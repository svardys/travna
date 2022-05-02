<template>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 m-auto">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-32 w-auto" src="/storage/images/icon.png" alt="Workflow"/>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Přihlášení</h2>
            </div>
            <form @submit.prevent="login" class="mt-8 space-y-6">
                <div class="rounded-md shadow-sm">
                    <div>
                        <label for="email-address" class="sr-only">Email</label>
                        <input v-model="form.email" id="email-address" name="email" type="email" autocomplete="email"
                               required
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="email"/>
                        <div class="mt-1 text-sm text-red-600" id="email-error"
                             v-if="form.errors.has('email')"
                             v-text="form.errors.get('email')"></div>
                    </div>
                    <div class="mt-5">
                        <label for="password" class="sr-only">Heslo</label>
                        <input v-model="form.password" id="password" name="password" type="password"
                               autocomplete="current-password" required
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="heslo"/>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <router-link :to="{name : 'forgotPassword'}"
                                     class="font-medium text-indigo-600 hover:text-indigo-500"> Zapomněli jste své
                            heslo?
                        </router-link>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true"/>
            </span>
                        Přihlásit se
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {reactive} from "vue";
import {useStore} from "vuex";
import Form from "../../utilities/form";
import router from "../../router";
import {LockClosedIcon} from "@heroicons/vue/solid";

export default {
    components: {
        LockClosedIcon,
    },
    setup() {
        const store = useStore();
        const form =
            reactive(new Form({
                email: '',
                password: '',
                remember: true
            }));

        async function login() {
            try {
                await store.dispatch('userModule/login', form.objectToFormData());
                form.onSuccess();
                await router.push({name: 'reservations'});
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
            login
        }
    }
}
</script>
