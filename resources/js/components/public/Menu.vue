<template>
    <div :class="[$route.meta.hideHeader ? 'h-[60vw] sm:h-[25vw]' : 'h-screen','relative w-full bg-cover bg-[url(/storage/images/bg.jpg)]']">
        <div class="absolute w-full h-full bg-black opacity-40"></div>
            <Disclosure as="nav" class="bg-white w-full max-w-[90vw] mx-auto z-50 rounded-b-xl min-h-[50px] sm:min-h-[80px] sticky shadow-sm shadow-white" v-slot="{ open }">
                <div class="sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <DisclosureButton class="inline-flex items-center justify-center p-2 rounded-md text-black hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Open main menu</span>
                            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                            <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
                        </DisclosureButton>
                        </div>
                        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="hidden lg:block h-12 w-auto" src="/storage/images/icon.png" alt="Workflow" />
                        </div>
                        <div class="hidden sm:block mx-auto">
                            <div class="flex space-x-4">
                                <router-link v-for="item in navigation" :key="item.name" :to="{ name: item.href }" class="text-black px-3 py-2 rounded-md text-md font-medium uppercase hover:underline-offset-1 hover:underline">
                                    {{ item.name }}
                                </router-link>
                                <router-link v-show="loggedIn" :to="{ name: 'reservations' }" class="text-black px-3 py-2 rounded-md text-md font-medium uppercase hover:underline-offset-1 hover:underline">
                                    Admin Prostředí
                                </router-link>
                                <Logout v-show="loggedIn" class="text-base text-red-900 text-center mt-2"></Logout>
                            </div>
                        </div>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                            <button type="button" class="p-1 rounded-full text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white cursor-default">
                                <span class="sr-only">View notifications</span>
                                <DeviceMobileIcon class="h-8 w-8 inline-flex" aria-hidden="true" /><span class="inline-flex font-bold">{{menuTexts.phone.text}}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <DisclosurePanel class="sm:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <router-link v-for="item in navigation" :key="item.name" :to="{ name: item.href }" class="text-gray-800 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">{{ item.name }}</router-link>
                    <router-link v-show="loggedIn" :to="{ name: 'reservations' }" class="text-gray-800 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Admin Prostředí</router-link>
                    <Logout v-show="loggedIn" class="text-base text-red-900 text-center mt-2"></Logout>
                </div>
                </DisclosurePanel>
            </Disclosure>
            <!-- Title and Subtitle -->
            <div :class="[$route.meta.hideHeader ? 'top-24 sm:top-40' : 'top-40 sm:top-10', 'absolute left-10 sm:left-0 right-0 sm:bottom-0 max-w-full sm:w-full sm:h-full m-auto z-10 sm:max-w-7xl max-h-40 sm:max-h-80']">
                <h1 class="text-white text-[50px] sm:text-[120px] mb-1 font-sansita">{{$route.meta.showValue}}</h1>
                <!-- Tady začíná editace -->
                <h1 :contenteditable="menuTexts.subTitle.editable" id="subTitle" :class="[$route.meta.hideHeader ? 'hidden' : 'inline-block',menuTexts.subTitle.editable ? 'border border-gray-600 focus:border-none' : 'border-none','text-white text-[20px] sm:text-5xl mb-10 font-sansita relative']">
                    {{menuTexts.subTitle.text}}
                </h1>
                <Editable :editable="menuTexts.subTitle.editable" :editableID="'subTitle'"></Editable>
                <!-- Tady končí editace -->
                <div :class="[$route.meta.hideHeader ? 'hidden' : 'block', 'relative']">
                    <button type="button" class="inline-flex items-center px-8 py-2 border border-transparent font-medium rounded-md shadow-sm text-white text-lg bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white font-sansita">Rezervace</button>
                </div>
            </div>
            <!-- ALERT -->
            <div :class="[$route.meta.hideHeader ? 'hidden' : 'absolute', 'left-0 right-0 bottom-20 sm:mx-auto max-w-3xl max-h-64 rounded-xl shadow-xl break-words mx-8']">
                <div class="my-auto text-black font-medium p-8 py-5 bg-white break-words rounded-xl font-sansita">
                <h1 :contenteditable="menuTexts.alertTitle.editable" id="alertTitle" :class="[menuTexts.alertTitle.editable ? 'border border-gray-600 focus:border-none' : 'border-none','max-auto text-center text-[15px] sm:text-2xl mb-2 inline-block']">{{menuTexts.alertTitle.text}}</h1>
                <Editable :editable="menuTexts.alertTitle.editable" :editableID="'alertTitle'"></Editable>
                    <div class="flex">
                        <p :contenteditable="menuTexts.alertText.editable" id="alertText" :class="[menuTexts.alertText.editable ? 'border border-gray-600 focus:border-none' : 'border-none','text-[10px] sm:text-base inline-block']">{{menuTexts.alertText.text}}</p>
                        <Editable :editable="menuTexts.alertText.editable" :editableID="'alertText'"></Editable>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { BellIcon, MenuIcon, XIcon, DeviceMobileIcon } from '@heroicons/vue/outline'
import Editable from '../Editable.vue'
import {useStore} from 'vuex'
import {computed} from 'vue'
import Logout from '../auth/Logout'

const navigation = [
  { name: 'Domů', href: 'homeIndex', current: true },
  { name: 'Kontaktujte nás', href: 'contact', current: false },
  { name: 'Rezervace', href: 'reservationsForm', current: false },
]

export default {
  components: {
      Logout,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    MenuIcon,
    XIcon,
    DeviceMobileIcon,
    Editable
  },
  setup() {
    const store = useStore();
    const menuTexts = computed(()=> store.getters['editableModule/content']);
    const loggedIn = computed(() => store.getters['userModule/loggedIn']);

    return {
      navigation,
      menuTexts,
      loggedIn
    }
  },
}
</script>
