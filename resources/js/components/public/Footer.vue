<template>
        <!-- Footer -->
        <footer class="bg-[#0f1925] sm:px-12 pt-14 sm:pt-20">
          <div class="h-1 max-w-[1300px] border-gray-600 mx-auto border-t-2 border-dashed"></div>
          <div class="grid md:grid-cols-3 grid-cols-1 pt-10 sm:pt-20">
            <div class="bg-[#0f1925]">
              <h1 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl xl:text-4xl font-sansita mb-5 text-center sm:text-left">Chata Travná</h1>
              <div class="grid grid-cols-3 md:grid-cols-none">
                <div class="ml-2">
                  <h1 class="text-sm tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 sm:inline-flex">Telefon :</h1>
                  <p :contenteditable="editableTexts.phone.editable" :class="[editableTexts.phone.editable ? 'border border-white focus:border-none' : 'border-none','text-xs tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 inline-flex ml-5']" id="phone">{{editableTexts.phone.text}}</p>
                  <Editable :editable="editableTexts.phone.editable" :editableID="'phone'"></Editable>
                </div>
                <div class="ml-2">
                  <h1 class="text-sm tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 sm:inline-flex">Email   :</h1>
                  <p :contenteditable="editableTexts.email.editable" :class="[editableTexts.email.editable ? 'border border-white focus:border-none' : 'border-none','text-xs tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 inline-flex ml-5']" id="email">{{editableTexts.email.text}}</p>
                  <Editable :editable="editableTexts.email.editable" :editableID="'email'"></Editable>
                </div>
                <div class="ml-2">
                  <h1 class="text-sm tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 sm:inline-flex">Adresa  :</h1>
                  <p :contenteditable="editableTexts.address.editable" :class="[editableTexts.address.editable ? 'border border-white focus:border-none' : 'border-none','text-xs tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 inline-flex ml-5']" id="address">{{editableTexts.address.text}}</p>
                  <Editable :editable="editableTexts.address.editable" :editableID="'address'"></Editable>
                </div>
              </div>
            </div>
            <div class="bg-[#0f1925]">
              <h1 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl xl:text-4xl font-sansita mb-5 text-center sm:text-left mt-10 sm:mt-0">Důležité odkazy</h1>
              <div class="grid grid-cols-3 md:grid-cols-none text-center sm:text-left">
                <div class="ml-2"><router-link :to="{ name : 'reservationsForm'}" class="text-sm tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 inline-flex hover:text-gray-400 cursor-pointer">Rezervace</router-link></div>
                <div class="ml-2"><router-link :to="{ name : 'contact'}" class="text-sm tracking-tight text-white sm:text-lg xl:text-lg font-sansita text-center mb-2 inline-flex hover:text-gray-400 cursor-pointer">Kontaktujte nás</router-link></div>
              </div>
            </div>
            <div>
              <iframe class="w-full h-64 mt-10 sm:mt-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10178.653730612807!2d16.923471041812693!3d50.37283002143402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4711e1eead70b3e3%3A0x8173e26478689831!2zVHJhdm7DoSwgNzkwIDcwIEphdm9ybsOtaw!5e0!3m2!1scs!2scz!4v1647603094173!5m2!1scs!2scz" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
          </div>
          <div class="h-1 max-w-[1300px] border-gray-600 my-5 sm:my-20 mx-auto border-t-2 border-dashed"></div>
          <div class="text-center py-2">
            <h1 class="text-md font-extrabold tracking-tight text-white sm:text-md xl:text-md font-sansita py-5 text-center">© Copyright MJ-WEBSITE. All right reserved.</h1>
            <router-link v-if="!loggedIn" class="text-md font-extrabold tracking-tight text-white sm:text-md xl:text-md font-sansita text-center mx-auto" :to="{ name : 'login'}">Přihlásit se</router-link>
            <Logout v-else class="text-md font-extrabold tracking-tight text-white sm:text-md xl:text-md font-sansita text-center mx-auto"></Logout>
          </div>
        </footer>
        <!-- End Footer -->
</template>
<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import Editable from '../Editable.vue'
import Logout from '../auth/Logout'
export default {
  components: {
    Editable,
    Logout
  },
  setup() {
    const store = useStore();
    const editableTexts = computed(()=> store.getters['editableModule/content']);
    const loggedIn = computed(() => store.getters['userModule/loggedIn']);

    return {
      editableTexts,
      loggedIn
    }
  },
}
</script>

<style scoped>
</style>

