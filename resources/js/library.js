import store from '../js/store';
export default {
    func: {
        /**
         * push an item to a global state array
         * @param {String} key
         * @param {Mixed} value
         */
        updateGlobalState (key, value) {
            store.commit({
                type: 'state/push',
                item: key,
                value: value
            })
        },
        /**
         * remove an item from global state
         * @param {String} key
         * @param {Mixed} value
         */
        removeFromGlobalState (key, value) {
            store.commit({
                type: 'state/removeItem',
                item: key,
                value: value
            })
        },
        /**
         * add a rating to a skill
         * @param {String} key
         * @param {Mixed} value
         */
        addRatingToGlobalState (key, value) {
            store.commit({
                type: 'state/addRatingKeyToSkill',
                item: key,
                value: value
            })
        },
        /**
         * fetch search string from state
         * @returns String  the search params
         */
        getSearchString () {
            if (store.state.state.selectedSkills !== 'undefined' &&
                store.state.state.selectedSkills.length
            ) {
                return JSON.stringify(store.state.state.selectedSkills);
            }
            return '';
        }
    }
}
