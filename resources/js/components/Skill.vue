<template>
    <div
        class="skill-wrapper"
        :style="{backgroundColor: backgroundcolor, color: textcolor}"
        @click="handleSkillClick"
    >
        {{ skill.title }}
    </div>
</template>
<script>
import library from '../library';
export default {
    name : 'Skill',
    props: {
        skill: {
            type: Object,
            default: () => {}
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
    data() {
        return {
            backgroundcolor: '',
            textcolor: '',
        }
    },
    methods : {
        /**
         * get random for text and background colors
         */
        getColors() {
            const rgb = [255, 0, 0];
            rgb[0] = Math.round(Math.random() * 255);
            rgb[1] = Math.round(Math.random() * 255);
            rgb[2] = Math.round(Math.random() * 255);

            const brightness = Math.round(((parseInt(rgb[0]) * 299) +
                                (parseInt(rgb[1]) * 587) +
                                (parseInt(rgb[2]) * 114)) / 1000);
            this.textcolor = (brightness > 125) ? 'black' : 'white';
            this.backgroundcolor = 'rgb(' + rgb[0] + ',' + rgb[1] + ',' + rgb[2] + ')';
        },
        /**
         * handle click on a skill button
         */
        handleSkillClick () {
            if (this.addable) {
                if (this.$store.state.state.selectedSkills.length > 9) {
                    alert('remove existing rating to continue');
                    return
                }
                library.func.updateGlobalState('selectedSkills', this.skill);
                return;
            }
            if (this.removeable) {
                library.func.removeFromGlobalState('selectedSkills', this.skill);
            }
        }
    },
    mounted () {
        this.getColors();
    }
}
</script>
<style scoped>
    .skill-wrapper {
        max-width: 7rem;
        text-align: center;
        margin: 1rem;
        border-radius: .5rem;
        padding: 1rem;
    }
    .skill-wrapper:hover {
        cursor:pointer;
    }
</style>
