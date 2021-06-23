<template>
    <div class="rating-wrapper">
        <star-rating
            @rating-selected="handleRatingSelected"
        />
    </div>
</template>
<script>
import StarRating from 'vue-star-rating';
import library from '../library';
export default {
    name : 'Rating',
    components: {
        StarRating
    },
    props: {
           skill: {
                type: Object,
                default: () => {}
            },
    },
    data() {
        return {
            rating: 0,
        }
    },
    methods : {
        /**
         * get the raring
         */
        handleRatingSelected (value) {
            let tempSkill = this.skill;
            tempSkill.rating = value;
            library.func.addRatingToGlobalState('selectedSkills', tempSkill);
        }
    }
}
</script>
