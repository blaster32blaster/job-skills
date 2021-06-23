<template>
    <div class="skill-list-wrapper">
        <div
            v-for="skill in daSkills"
            v-bind:key="skill.id"
        >
            <Skill
                :skill="skill"
                :addable="addable"
                :removeable="removeable"
            >
            </Skill>
            <Rating
                v-show="removeable"
                :skill="skill"
            >
            </Rating>
        </div>
    </div>
</template>
<script>
import Skill from './Skill.vue';
import Rating from './Rating.vue';
export default {
    name : 'SkillList',
    components: {
        Skill,
        Rating
    },
    props: {
           skills: {
                type: Array,
                default: () => []
            },
            addable: {
                type: Boolean,
                default: false
            },
            removeable: {
                type: Boolean,
                default: false
            }
    },
    computed: {
        daSkills: function () {
            if (this.addable) {
                let newAr = [];
                this.skills.forEach(item => {
                    let keep = true;
                    this.$store.state.state.selectedSkills.forEach(subItem => {
                        if (subItem.title === item.title) {
                            keep = false;
                        }
                    });
                    if (keep) {
                        newAr.push(item);
                    }
                });
                return newAr;
            }
            return this.skills;
        }
    },
}
</script>
<style scoped>
    .skill-list-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }
</style>
