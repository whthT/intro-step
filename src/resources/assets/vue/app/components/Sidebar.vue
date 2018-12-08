<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item" v-for="nav in list">
                    <router-link class="nav-link" class-active="active" :to="nav.path">
                        <span :data-feather="nav.icon"></span>
                        {{$t(nav.label)}}
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    data:() => ({
        list: []
    }),
    mounted() {
        this.list = this.$router.options.routes.slice().filter(v => v.showOnSidebar);
        this.$nextTick(() => {
            feather.replace();
        }); 
    }
}
</script>