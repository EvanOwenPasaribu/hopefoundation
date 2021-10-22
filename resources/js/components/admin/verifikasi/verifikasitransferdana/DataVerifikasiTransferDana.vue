<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Verifikasi Transfer Dana</b></h3>
        <h3>Under Construction</h3>
    </div>
</template>

<script>

export default {
    data () {
        return {
            isActive:this.$route.path,
            auth: localStorage.loggedin
        }
    },
    components:{
        
    },
    props: ['user'],
}
</script>
