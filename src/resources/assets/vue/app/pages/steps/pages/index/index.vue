<template>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>View Path</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in stepList">
                <td v-text="item.id"></td>
                <td v-text="item.name"></td>
                <td v-text="item.view_path"></td>
                <td v-text="item.created_at"></td>
                <td>
                    <ul class="inline-ul">
                        <li><a href="#" @click="redirectEdit(item, $event)" class="text-success"><i class="fa fa-pencil"></i> Edit</a></li>
                        <li><a href="#" @click="redirectShow(item, $event)" class="text-info"><i class="fa fa-info"></i> Info</a></li>
                        <li><a href="#" @click="removeStep(item, $event)" class="text-danger"><i class="fa fa-times"></i> Remove</a></li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
</template>
<script>
import { mapState, mapMutations } from 'vuex';
export default{
    data: () => ({

    }),
    mounted() {
        this.getSteps();
    },
    computed: {
        ...mapState({
            stepList: state => state.stepList
        })
    },
    methods: {
        getSteps() {
            Api.getAllSteps().then(resp => this.$store.commit("setStepList", {list: resp.data})).catch(err => window.alert(err.toString()));
        },
        removeStep(step, e) {
            e.preventDefault();
            if(window.confirm("Are you sure about this action?")) {
                Api.deleteStepById(step.id).then(resp => {
                    this.getSteps();
                    this.$toasted.show(resp.data.message, { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 5000
                    });
                }).catch(console.log);
            }
        },
        redirectEdit(item, e) {
            e.preventDefault();
            this.$router.push({
                path: "/steps/"+item.id+"/edit",
                params: {...item}
            })
        },
        redirectShow(item, e) {
            e.preventDefault();
            this.$router.push({
                path: "/steps/"+item.id,
                params: {...item}
            })
        }
    }
}
</script>
