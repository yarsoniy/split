import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import auth from './auth'

export default new Vuex.Store({
    modules: {
        auth,
    },
    state: {
        currentGroup: undefined
    },
    mutations: {
        CHANGE_CURRENT_GROUP(state, group) {
            state.currentGroup = group;
        }
    },
    actions: {
        changeCurrentGroup({commit}, newGroup) {
            commit('CHANGE_CURRENT_GROUP', newGroup);
        }
    }
});
