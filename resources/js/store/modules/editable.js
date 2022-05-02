import Api from "../../services/api";
import {useStore} from "vuex";
const store = useStore();
const editableModule = {
    namespaced: true,
    state: {
        subTitle : {
            text : '',
            editable : false
        },
        alertTitle : {
            text : '',
            editable : false
        },
        alertText : {
            text : '',
            editable : false
        },
        infoTitle : {
            text : '',
            editable : false
        },
        infoText : {
            text : '',
            editable : false
        },
        phone : {
            text : '',
            editable : false
        },
        email : {
            text : '',
            editable : false
        },
        address : {
            text: '',
            editable : false
        }
    },
    getters: {
        content(state) {
            return state;
        },
    },
    mutations: {
        setField(state, data) {
            state[data.name].editable = false;
            state[data.name].text = data.text;
        },
        setEditable(state, id) {
            state[id].editable = true;
        },
        setFields(state, data) {
            data.forEach(element => {
                state[element.name].text = element.value;
            });
        },
        discardChanges(state, id) {
            state[id].editable = false;
        },
    },
    actions: {
        async saveData({commit}, id) {
            try {
                //Set variables
                let textValue = document.getElementById(id).innerText;
                let data = {
                    "name" : id,
                    "text" : textValue
                }
                //Save to database on BE
                await Api.post('/api/admin/fields', data);
                //Save to database on FE (STATE)
                commit('setField', data);
            } catch (e) {
                commit('messagesModule/setException', e, {root: true});
            }
        },
        discardChanges({commit, state}, payload) {
            document.getElementById(payload).innerText = state[payload].text;
            commit('discardChanges', payload);
        }
    }
}

export default editableModule;
