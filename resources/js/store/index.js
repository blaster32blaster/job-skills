import Vue from 'vue';
import Vuex from 'vuex';
import state from  './modules/state';
Vue.use(Vuex)
const debug = process.env.NODE_ENV !== 'production'
export default new Vuex.Store({
  modules: {
    state
  },
  strict: debug
})
