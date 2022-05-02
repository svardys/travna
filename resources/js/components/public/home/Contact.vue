<template>
<div class="px-4 sm:px-8 bg-[#0f1925] relative">
  <div class="absolute -top-1 sm:-top-5 bg-[#0f1925] z-10 w-full h-4 sm:h-10 left-0"></div>
  <div class="relative bg-white">
    <div class="absolute inset-0">
      <div class="absolute inset-y-0 left-0 w-1/2 bg-gray-50" />
    </div>
    <div class="relative max-w-7xl mx-auto lg:grid lg:grid-cols-5">
      <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
        <div class="max-w-lg mx-auto">
          <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl font-sansita">Kontaktujte nás</h2>
          <p class="mt-3 text-lg leading-6 text-gray-500 font-sansita">Po vypnění a odeslání formuláře Váši zprávu obdržíme a pokusíme se jí co nejdříve vyřídit.</p>
          <dl class="mt-8 text-base text-gray-500">
            <div class="mt-6">
              <dt class="sr-only font-sansita">Phone number</dt>
              <dd class="flex">
                <PhoneIcon class="flex-shrink-0 h-6 w-6 text-gray-400" aria-hidden="true" />
                <span class="ml-3 font-sansita"> {{editableTexts.phone.text}} </span>
              </dd>
            </div>
            <div class="mt-3">
              <dt class="sr-only">Email</dt>
              <dd class="flex">
                <MailIcon class="flex-shrink-0 h-6 w-6 text-gray-400" aria-hidden="true" />
                <span class="ml-3 font-sansita"> {{editableTexts.email.text}} </span>
              </dd>
            </div>
            <div class="mt-8">
              <dt class="sr-only font-sansita">Adress</dt>
              <dd>
                <p class="font-sansita">{{editableTexts.address.text}}</p>
              </dd>
            </div>
          </dl>
        </div>
      </div>
      <div class="bg-white py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
        <div class="max-w-lg mx-auto lg:max-w-none">
          <form action="#" method="POST" class="grid grid-cols-1 gap-y-6">
            <div>
              <label for="full-name" class="sr-only">Jméno a Příjmení</label>
              <input type="text" name="full-name" id="full-name" autocomplete="name" class="font-sansita block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" placeholder="Jméno a Příjmení" />
            </div>
            <div>
              <label for="email" class="sr-only">Email</label>
              <input id="email" name="email" type="email" autocomplete="email" class="font-sansita block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" placeholder="Email" />
            </div>
            <div>
              <label for="phone" class="sr-only">Telefonní číslo</label>
              <input type="text" name="phone" id="phone" autocomplete="tel" class="font-sansita block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" placeholder="Telefonní číslo" />
            </div>
            <div>
              <label for="message" class="sr-only">Zpráva</label>
              <textarea id="message" name="message" rows="4" class="font-sansita block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md" placeholder="Zpráva" />
            </div>
            <div>
              <button type="submit" class="font-sansita inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Odeslat</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import { MailIcon, PhoneIcon } from '@heroicons/vue/outline'
import {computed} from 'vue'
import {useStore} from 'vuex'
export default {
  components: {
    MailIcon,
    PhoneIcon,
  },
  setup() {
    const store = useStore();
    const editableTexts = computed(()=> store.getters['editableModule/content']);

    return {
      editableTexts 
    }
  },
}
</script>