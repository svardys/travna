<template>
    <div v-show="loading" class="flex justify-center items-center space-x-2 fixed inset-0 z-50 w-[95%] sm:max-w-7xl mx-auto">
        <div class="spinner-grow inline-block w-8 h-8 bg-current rounded-full animate-bounce text-blue-900" role="status"></div>
        <div class="spinner-grow inline-block w-8 h-8 bg-current rounded-full animation-delay-100 animate-bounce text-blue-800" role="status"></div>
        <div class="spinner-grow inline-block w-8 h-8 bg-current rounded-full animation-delay-200 animate-bounce text-blue-700" role="status"></div>
        <div class="spinner-grow inline-block w-8 h-8 bg-current rounded-full animation-delay-300 animate-bounce text-blue-600" role="status"></div>
        <div class="spinner-grow inline-block w-8 h-8 bg-current rounded-full animation-delay-400 animate-bounce text-blue-500" role="status"></div>
        <div class="spinner-grow inline-block w-8 h-8 bg-current rounded-full animation-delay-500 animate-bounce text-blue-400" role="status"></div>
        <div class="spinner-grow inline-block w-8 h-8 bg-current rounded-full animation-delay-600 animate-bounce text-blue-300" role="status"></div>
    </div>
</template>

<script>
import {computed} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const store = useStore();
        const loading = computed(() => store.getters['loadingModule/loading']);

        return {
            loading
        }
    }
}
</script>
