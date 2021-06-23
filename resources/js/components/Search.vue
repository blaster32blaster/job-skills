<template>
    <div class="search-wrapper">
        <button
            type="button"
            class="search-button"
            @click="handleSearchClick"
        >
            Match My Skills to Jobs
        </button>
    </div>
</template>
<script>
export default {
    name : 'Search',
    methods : {
        /**
         * handle search being clicked
         */
        handleSearchClick () {
            this.$emit('searchClicked');
        }
    }
}
</script>
<style scoped>
    .search-wrapper {
        margin: 2rem;
    }
    .search-button {
        background-color: cornflowerblue;
        color: white;
        padding: 1.5rem;
    }
    .search-button:hover {
        background-color: blue;
    }
</style>
