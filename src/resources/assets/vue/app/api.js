
class Api {
    constructor(token, route) {
        this.token = token;
        this.apiUrl = this.withSlashes(route);
    }

    withSlashes(str) {
        return String(str).substr(-1, 1) == "/" ? str : str+"/";
    }

    async getIntroStepOptions() {
        let result = await axios.get(this.apiUrl+"options");
        return result.data;
    }

    combineBody(body) {
        return Object.assign({_token: this.token}, body);
    }

    async createNewStep(form) {
        let result = await axios.post(this.apiUrl+"steps", form)
        return result.data;
    }

    async updateStep(form) {
        let result = await axios.put(this.apiUrl+"steps/"+form.id, form)
        return result.data;
    }

    async getAllSteps() {
        return await axios.get(this.apiUrl+"steps");
    }

    async deleteStepById(id) {
        if(id) {
            return await axios.delete(this.apiUrl+"steps/"+id);
        }
    }

    async getStepInfoById(id) {
        if(id) {
            return await axios.get(this.apiUrl+"steps/"+id);
        }
    }

    async saveDefaultOptions(options) {
        let result = await axios.post(this.apiUrl+"options", options);
        return result.data;
    }

    async getStepUserList() {
        let result = await axios.get(this.apiUrl);
        return result.data;
    }

    async getStepInfo(id) {
        let result = await axios.get(this.apiUrl+"/"+id);
        return result.data;
    }

}

export default Api;