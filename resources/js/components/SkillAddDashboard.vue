<template>
    <div class="col-md-3">
        <SkillList
            :skills="skills"
            :addable=true
        >
        </SkillList>
    </div>
</template>
<script>
import SkillList from './SkillList.vue';
export default {
    name : 'SkillAddDashboard',
    components: {
        SkillList
    },
    props: {
           skills: {
                type: Array,
                default: () => []
            },
        },
}
</script>
