<template>
    <div class="col-md-6">
        <div
            id="job-list-wrapper"
            v-for="job in jobs"
            v-bind:key="job.id"
        >
            <Job
                :job="job"
            >
            </Job>
        </div>
    </div>
</template>
<script>
import Job from './Job.vue';
export default {
    name : 'JobList',
    components: {
        Job
    },
    props: {
           jobs: {
                type: Array,
                default: () => []
            },
        },
}
</script>
