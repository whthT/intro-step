<template>
    <div v-if="showItem.name">
        <router-link tag="button" class="btn btn-success" :to="'/steps/'+showItem.id+'/edit'">
            <i class="fa fa-pencil"></i> {{$t('Edit')}}
        </router-link>
        <table class="table mt-2">
            <tbody>
                <tr>
                    <td style="width:120px">{{$t('name')}}:</td>
                    <td>{{showItem.name}}</td>
                </tr>

                <tr>
                    <td style="width:120px">{{$t('view_path')}}:</td>
                    <td>{{showItem.view_path}}</td>
                </tr>
                <tr>
                    <td style="width:120px">{{$t('auth_only')}}:</td>
                    <td>{{showItem.auth_only ? 'Yes' : 'No'}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th>{{$t('name')}}</th>
                    <th>{{$t('value')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(val, key) in showItem.step_info.options" :key="key">
                    <td v-text="$t(key+'Label')"></td>
                    <td v-text="val"></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <ul class="list-group">
                <li class="list-group-item" v-for="step in showItem.step_info.steps">
                    <b>{{$t('elementSelectorText')}}:</b> <span v-text="step.element"></span> <br />
                    <b>{{$t('introText')}}:</b> <span v-text="step.intro"></span> <br />
                    <b>{{$t('position')}}:</b> <span v-text="step.position.join(', ')"></span>
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
