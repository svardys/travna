<template>
    <div class="px-4 sm:px-8 bg-[#0f1925] relative">
        <!-- First Slide Section -->
        <div class="absolute -top-1 sm:-top-5 bg-[#0f1925] z-10 w-full h-4 sm:h-10 left-0"></div>
        <div class="relative">
          <div aria-hidden="true" class="hidden absolute w-1/2 h-full bg-white lg:block" />
          <div class="relative bg-white lg:bg-transparent">
            <div class="max-w-7xl mx-auto lg:grid lg:grid-cols-2">
              <div class="max-w-2xl ml-5 mr-auto py-10 sm:py-24 lg:py-64 lg:max-w-none">
                <div class="lg:pr-16 text-left">
                  <h1 :contenteditable="editableTexts.infoTitle.editable" :class="[editableTexts.infoTitle.editable ? 'border border-gray-600 focus:border-none' : 'border-none','text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl xl:text-6xl font-sansita inline-block pt-2']" id="infoTitle">{{editableTexts.infoTitle.text}}</h1>
                  <Editable :editable="editableTexts.infoTitle.editable" :editableID="'infoTitle'"></Editable>
                  <p :contenteditable="editableTexts.infoText.editable" :class="[editableTexts.infoText.editable ? 'border border-gray-600 focus:border-none' : 'border-none','mt-4 px-2 md:px-0 text-md md:text-xl text-gray-600 font-sansita']" id="infoText">{{editableTexts.infoText.text}}</p>
                  <Editable :editable="editableTexts.infoText.editable" :editableID="'infoText'"></Editable>
                  <div class="mt-6">
                    <a href="#" class="inline-block border border-transparent py-3 px-8 rounded-md font-medium text-white bg-red-700 hover:bg-red-800 font-sansita">Pokračovat na galerii</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full h-48 sm:h-64 lg:absolute lg:top-0 lg:right-0 lg:w-1/2 lg:h-full">
            <img src="/storage/images/secondImage.jpg" alt="" class="w-full h-full object-center object-cover" />
          </div>
        </div>
        <!-- End first slide section -->
        <!-- Mini Gallery Section -->
        <div class="bg-white px-8 pt-20 py-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl xl:text-6xl font-sansita text-center mb-3">___ Galerie ___</h1>
            <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-3xl xl:text-3xl font-sansita text-center mb-5">Na co se můžete těšit</h1>
            <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 xl:gap-x-8">
                <li v-for="file in files" :key="file.source" class="relative hover:z-40">
                    <div class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                        <img :src="file.source" alt="" class="object-cover pointer-events-none group-hover:opacity-75" />
                        <button type="button" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">View details for {{ file.title }}</span>
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Mini Gallery Section -->
        <!-- Items Section -->
        <div class="bg-[#0f1925] px-12 pt-20">
          <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl xl:text-6xl font-sansita text-center mb-3">___ Služby ___</h1>
          <h1 class="text-xl font-extrabold tracking-tight text-white sm:text-3xl xl:text-3xl font-sansita text-center mb-12">Co vám můžeme nabídnout</h1>
            <div class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 xl:gap-x-8 mt-5">
              <div class="flex">
                <div><WifiIcon class="h-20 md:w-20 w-10 text-red-700 inline-flex"></WifiIcon></div>
                <div class="mx-auto text-left ml-5">
                  <h1 class="text-lg font-bold tracking-tight text-white sm:text-lg xl:text-lg font-sansita">Wifi</h1><br>
                  <p class="text-md font-medium tracking-tight text-white  sm:text-md xl:text-md font-sansita mb-5">Možnost připojení k internetové síti pomocí wifi z jakéhokoli zařízení.</p>
                </div>
              </div>
              <div class="flex">
                <div><img  class="h-20 md:w-20 text-red-700 inline-flex" src="/storage/images/car.svg" /></div>
                <div class="mx-auto text-left ml-5">
                  <h1 class="text-lg font-bold tracking-tight text-white sm:text-lg xl:text-lg font-sansita">Parkování</h1><br>
                  <p class="text-md font-medium tracking-tight text-white  sm:text-md xl:text-md font-sansita mb-5">V areálu chaty je dostatek místa pro zaparkování Vašeho vozidla.</p>
                </div>
              </div>
              <div class="flex">
                <div><img  class="h-20 md:w-20 text-red-700 inline-flex" src="/storage/images/shower.svg" /></div>
                <div class="mx-auto text-left ml-5">
                  <h1 class="text-lg font-bold tracking-tight text-white sm:text-lg xl:text-lg font-sansita">Sprchový kout</h1><br>
                  <p class="text-md font-medium tracking-tight text-white  sm:text-md xl:text-md font-sansita mb-5">Možnost osprchování se na chatě ve sprchovém koutě.</p>
                </div>
              </div>
              <div class="flex">
                <div><img  class="h-20 md:w-20 w-10 text-red-700 inline-flex" src="/storage/images/tv.svg" /></div>
                <div class="mx-auto text-left ml-5">
                  <h1 class="text-lg font-bold tracking-tight text-white sm:text-lg xl:text-lg font-sansita">Televizor</h1><br>
                  <p class="text-md font-medium tracking-tight text-white  sm:text-md xl:text-md font-sansita mb-5">Na chatě je dostupný televizor.</p>
                </div>
              </div>
            </div>
        </div>
        <!-- End items section -->
    </div>
</template>

<script>
const files = [
  {
    title: 'IMG_4985.HEIC',
    size: '3.9 MB',
    source:
      '/storage/images/bg.jpg',
  },
  {
    title: 'IMG_4985.HEIC',
    size: '3.9 MB',
    source:
      '/storage/images/secondImage.jpg',
  },
  {
    title: 'IMG_4985.HEIC',
    size: '3.9 MB',
    source:
      '/storage/images/cottage.jpg',
  },
  {
    title: 'IMG_4985.HEIC',
    size: '3.9 MB',
    source:
      '/storage/images/cottage2.jpg',
  },
  {
    title: 'IMG_4985.HEIC',
    size: '3.9 MB',
    source:
      '/storage/images/cottage3.png',
  },
  {
    title: 'IMG_4985.HEIC',
    size: '3.9 MB',
    source:
      '/storage/images/bg.jpg',
  },
]

import { WifiIcon } from '@heroicons/vue/outline'
import {computed} from 'vue'
import {useStore} from 'vuex'
import Editable from '../../Editable.vue'
export default {
  components: {
    WifiIcon,
    Editable
  },
  setup() {
    const store = useStore();
    const editableTexts = computed(()=> store.getters['editableModule/content']);

    return {
      files,  
      editableTexts 
    }
  },
}
</script>

<style scoped>
</style>
