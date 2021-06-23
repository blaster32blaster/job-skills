import library from './library';
export default {
    func: {
        /**
         * fetch the jobs with potential search string
         * @returns Array
         */
        fetchJobs: function () {
            let searchString = library.func.getSearchString();
            let url = '/api/jobs?s=' + searchString;

            return axios.get(url)
            .then((response) => {
                return {
                    response: response.data
                }
            })
            .catch(error => {
                console.log('fetching jobs error');
                console.log(error);
            });
        },
        /**
         * fetch available skills
         * @returns Array
         */
        fetchSkills: function () {
            let url = '/api/skills'

            return axios.get(url)
            .then((response) => {
                return {
                    response: response.data
                }
            })
            .catch(error => {
                console.log('fetching skills error');
                console.log(error);
            });
        }
    }
}
