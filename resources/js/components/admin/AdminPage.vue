<template>
  <div>
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog as="div" class="fixed inset-0 flex z-40 md:hidden" @close="sidebarOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>
        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
          <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-[#0f1925]">
            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
              <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                  <span class="sr-only">Close sidebar</span>
                  <XIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </button>
              </div>
            </TransitionChild>
            <div class="flex-shrink-0 flex items-center px-4">
              <h1 class="h-8 w-auto font-sansita text-white text-xl">Chata Travná</h1>
            </div>
            <div class="mt-5 flex-1 h-0 overflow-y-auto">
              <nav class="px-2 space-y-1">
                <router-link v-for="(item, index) in navigation" :key="index" :to="{ name: item.href }" class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                  <component :is="item.icon" class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" aria-hidden="true" />
                  {{ item.name }}
                </router-link>
                <a class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                  <LogoutIcon class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300" aria-hidden="true" ></LogoutIcon>
                  <Logout class="w-full"></Logout>
                </a>
              </nav>
            </div>
          </div>
        </TransitionChild>
        <div class="flex-shrink-0 w-14" aria-hidden="true">
          <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex flex-col flex-grow pt-5 bg-[#0f1925] overflow-y-auto">
        <div class="flex items-center flex-shrink-0 px-4">
          <h1 class="h-8 w-auto font-sansita text-white text-4xl">Chata Travná</h1>
        </div>
        <div class="mt-5 flex-1 flex flex-col">
          <nav class="flex-1 px-2 pb-4 space-y-1">
            <router-link v-for="(item, index) in navigation" :key="index" :to="{ name: item.href }" class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <component :is="item.icon" class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" aria-hidden="true" />
              {{ item.name }}
            </router-link>
            <a class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <LogoutIcon class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" aria-hidden="true" ></LogoutIcon>
              <Logout class="w-full"></Logout>
            </a>
          </nav>
        </div>
      </div>
    </div>
    <div class="md:pl-64 flex flex-col flex-1">
      <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow md:hidden">
        <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden" @click="sidebarOpen = true">
          <span class="sr-only">Open sidebar</span>
          <MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
        </button>
      </div>

      <main>
        <div class="py-6">
          <div class="max-w-full px-4 md:px-8">
            <!-- Replace with your content -->
            <router-view></router-view>
            <!-- /End replace -->
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import Logout from '../auth/Logout'
import {
  Dialog,
  DialogOverlay,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  BellIcon,
  CalendarIcon,
  ChartBarIcon,
  MenuAlt2Icon,
  XIcon,
  UserIcon,
  HomeIcon,
  LogoutIcon
} from '@heroicons/vue/outline'
import { SearchIcon } from '@heroicons/vue/solid'

export default {
  components: {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
    Logout,
    BellIcon,
    MenuAlt2Icon,
    SearchIcon,
    XIcon,
    UserIcon,
    HomeIcon,
    LogoutIcon
  },
  setup() {
    const sidebarOpen = ref(false)
    const navigation = [
      { name: 'Rezervace', href: 'reservations', icon: CalendarIcon },
      { name: 'Nastavení rezervací', href: 'settings', icon: ChartBarIcon },
      { name: 'Nastavení uživatele', href: 'userSettings', icon: UserIcon },
      { name: 'Zpět na úvodní stránku', href: 'homeIndex', icon: HomeIcon },
    ]

    return {
      navigation,
      sidebarOpen
    }
  },
}
</script>
<style scoped>
  .router-link-active {
    color: white;
    background-color: #4f46e5;
  }
</style>