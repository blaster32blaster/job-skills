<template>
    <div class="container">
        <div class="row justify-content-center">
            <Search
                @searchClicked="getJobs"
            />
        </div>
        <div class="row justify-content-center">
            <SkillCurrentDashboard
                :skills="skills"
            >
            </SkillCurrentDashboard>
            <JobList
                :jobs="jobs"
            >
            </JobList>
            <SkillAddDashboard
                :skills="skills"
            >
            </SkillAddDashboard>
        </div>
    </div>
</template>
<script>
import request from '../requests';
import JobList from './JobList.vue';
import SkillAddDashboard from './SkillAddDashboard.vue';
import SkillCurrentDashboard from './CurrentSkillsDashboard.vue';
import Search from './Search.vue';
export default {
    name: 'Dashboard',
    components: {
        JobList,
        SkillAddDashboard,
        SkillCurrentDashboard,
        Search
    },
    data() {
        return {
            jobs: [],
            companies: [],
            skills: [],
        }
    },
    methods : {
        /**
         * get the jobs
         */
        getJobs () {
            request.func.fetchJobs()
            .then(response => {
                    this.jobs = [];
                    this.jobs = response.response;
                }
            )
        },
        /**
         * get the skills
         */
        getSkills () {
            request.func.fetchSkills()
            .then(response => {
                    this.skills = [];
                    this.skills = response.response;
                }
            )
        },
    },
    mounted() {
            this.getJobs();
            // this.getCompanies();
            this.getSkills();
        }
}
</script>
