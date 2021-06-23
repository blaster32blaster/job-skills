<template>
    <div class="col-md-3">
        <SkillList
            :skills="theSkills"
            :removeable=true
        >
        </SkillList>
    </div>
</template>
<script>
import SkillList from './SkillList.vue';
export default {
    name : 'SkillCurrentDashboard',
    components: {
        SkillList
    },
    computed: {
        theSkills: function () {
            return this.$store.state.state.selectedSkills
        }
    },
}
</script>
