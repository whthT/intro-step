<template>
    <div v-if="showItem.name">
        <router-link tag="button" class="btn btn-success" :to="'/steps/'+showItem.id+'/edit'">
            <i class="fa fa-pencil"></i> Edit
        </router-link>
        <table class="table mt-2">
            <tbody>
                <tr>
                    <td style="width:120px">Name:</td>
                    <td>{{showItem.name}}</td>
                </tr>

                <tr>
                    <td style="width:120px">View Path:</td>
                    <td>{{showItem.view_path}}</td>
                </tr>
                <tr>
                    <td style="width:120px">Auth Only:</td>
                    <td>{{showItem.auth_only ? 'Yes' : 'No'}}</td>
                </tr>
            </tbody>
        </table>
        <h6>Options</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(val, key) in showItem.step_info.options" :key="key">
                    <td v-text="key"></td>
                    <td v-text="val"></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <h6>Step List</h6>
            <ul class="list-group">
                <li class="list-group-item" v-for="step in showItem.step_info.steps">
                    <b>Element:</b> <span v-text="step.element"></span> <br />
                    <b>Intro:</b> <span v-text="step.intro"></span> <br />
                    <b>Positions:</b> <span v-text="step.position.join(', ')"></span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import {mapState} from "vuex";
export default{
    data: () => ({
        showItem: {}
    }),
    computed: {
        ...mapState({
            showList: state => state.showList
        })
    },
    mounted() {
        this.getInfo(this.$route.params.id);
    },
    methods: {
        getInfo(id) {
            let match = this.showList.filter(v => v.id == id);
            if(match.length) {
                this.showItem = match.slice().shift();
            } else {
                Api.getStepInfoById(id).then(resp => {
                    this.showItem = resp.data;
                    this.$store.commit("appendShowList", {item: resp.data});
                }).catch(err => window.alert(err.toString()));
            }
        }
    }
}
</script>
