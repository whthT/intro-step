<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" v-if="isRouterBackExists">
                <a @click="goBack" href="#">&larr; Back</a>
            </li>
            <li class="breadcrumb-item" v-for="(brd, key) in breadcrumbList" :class="{'active': key+1 == breadcrumbList.length}">
                <router-link v-if="brd.path && key+1 != breadcrumbList.length" :to="brd.path">{{brd.name}}</router-link>
                <span v-else>{{brd.name}}</span>
            </li>
        </ol>
    </nav>
</template>
<script>
import {mapState} from "vuex";
export default{
    data: () => ({
        breadcrumbList: []
    }),
    mounted() {
        this.updateBreadcrumb();
    },
    computed: {
        ...mapState({
            isRouterBackExists: state => state.isRouterBackExists
        })
    },
    methods: {
        updateBreadcrumb() {
            if(this.$route && this.$route.meta && this.$route.meta.breadcrumbs) {
                this.breadcrumbList = this.$route.meta.breadcrumbs;
                this.$store.commit("setRouterBackExists",{bool: true})
            }
        },
        goBack(e) {
            e.preventDefault();
            this.$router.go(-1);
        }
    },
    watch: {
        "$route": {
            handler() {
                this.updateBreadcrumb();
            }, deep: true,
        }
    }
}
</script>
