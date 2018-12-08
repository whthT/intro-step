<template>
    <div>
        <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>{{$t('name')}}</th>
                <th>{{$t('participant')}}</th>
                <th>{{$t('complete')}}</th>
                <th>{{$t('info')}}</th>
            </thead>
            <tbody>
                <tr v-for="item in stepUserList" :key="item.id">
                    <td v-text="item.id"></td>
                    <td>
                        <router-link :to="'/step-info/'+item.id" v-text="item.name"></router-link>
                    </td>
                    <td v-text="item.participant_count"></td>
                    <td v-text="item.complete_count"></td>
                    <td>
                        <router-link :to="'/step-info/'+item.id">{{$t('info')}}</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import { mapState } from 'vuex';
export default{
    data: () => ({
        
    }),
    computed: {
        ...mapState({
            stepUserList: state => state.stepUserList
        })
    },
    methods: {
        getStepUserList() {
            Api.getStepUserList().then(data => this.$store.commit("setStepUserList", {list: data})).catch(console.log);
        }
    },
    mounted() {
        this.getStepUserList();
    }
}
</script>
