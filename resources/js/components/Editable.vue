<template>
<div v-show="loggedIn" class="inline-block h-5 w-5 sm:h-12 sm:w-10">
    <button class="h-4 w-4 sm:h-8 sm:w-8 absolute rounded-full bg-blue-700 text-white z-50 inline-block ml-3" @click="edit()" v-show="!editable && loggedIn">
        <PencilIcon class="w-2 h-2 sm:w-4 sm:h-4 text-white mx-auto"></PencilIcon>
    </button>
    <button class="h-4 w-4 sm:h-8 sm:w-8 absolute rounded-full bg-green-700 text-white z-50 inline-block ml-3" @click="save()" v-show="editable && loggedIn">
        <CheckIcon class="w-2 h-2 sm:w-4 sm:h-4 text-white mx-auto"></CheckIcon>
    </button>
    <button class="h-4 w-4 sm:h-8 sm:w-8 absolute rounded-full bg-red-700 text-white z-50 inline-block mt-6 sm:mt-10 my-auto ml-3" @click="discard()" v-show="editable && loggedIn">
        <XIcon class="w-2 h-2 sm:w-4 sm:h-4 text-white mx-auto"></XIcon>
    </button>
</div>
</template>

<script>
import { toRefs, computed } from 'vue'
import { XIcon, PencilIcon, CheckIcon } from '@heroicons/vue/outline'
import {useStore} from 'vuex'
export default {
    components: {
        XIcon,
        PencilIcon,
        CheckIcon
    },
    props: {
        editable: {
            type: Boolean,
            required: true
        },
        editableID: {
            type : String,
            required: true
        }
    },
    setup (props) {
        const {editable} = toRefs(props);
        const store = useStore();
        const loggedIn = computed(() => store.getters['userModule/loggedIn']);

        function edit(){
            store.commit('editableModule/setEditable', props.editableID);
        }
        function save(){
            store.dispatch('editableModule/saveData', props.editableID);
        }
        function discard(){
            store.dispatch('editableModule/discardChanges', props.editableID);
        }
        return {
            editable,
            edit,
            save,
            discard,
            loggedIn
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
