<template>
    <div class="card">
        <div class="card-header job-card-header">
            <span>
                {{ job.title }} - {{ job.company.name }}
            </span>
            <span v-show="job.score">
                Relevance : {{ job.score }}
            </span>
        </div>
        <div class="card-body">
            <SkillList
                :skills="job.skills"
            >
            </SkillList>
        </div>
    </div>
</template>
<script>
import SkillList from './SkillList.vue';
export default {
    name : 'Job',
    components: {
        SkillList
    },
    props: {
           job: {
                type: Object,
                default: () => {}
            },
        },
}
</script>
<style scoped>
    .job-card-header {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
</style>
