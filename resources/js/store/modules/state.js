const state = {
    selectedSkills: [],
}
const mutations = {
    update (state, payload) {
        state[payload.item] = payload.value;
    },
    push (state, payload) {
        state[payload.item].push(payload.value);
    },
    removeItem (state, payload) {
        var index = state.selectedSkills.indexOf(payload.value);
        if (index !== -1) {
            state.selectedSkills.splice(index, 1);
        }
    },
    addRatingKeyToSkill (state, payload) {
        var index = state.selectedSkills.indexOf(payload.value);
        if (index !== -1) {
            state.selectedSkills[index].rating = payload.value.rating;
        }
    }
}
const actions = {
}
const getters = {

}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
