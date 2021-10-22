<template>
    <div class="wrapper-nav-side">
        <h3><b>Detail Program Kerja</b></h3>
        <ProgramKerjaLayout
            v-bind:programkerja="programkerja"
        />
    </div>
</template>

<script>
import ProgramKerjaLayout from './../../layouts/content/ProgramKerja.vue'
import GlobalMethod from './../mixins/globalmethod'

export default{
    mixins: [ GlobalMethod ],
    components:{
        'ProgramKerjaLayout': ProgramKerjaLayout
    },
    data(){
        return{
            path: this.$route.params.id_programkerja,
            programkerja: []
        }
    },
    mounted() {
        this.showData()
    },
    methods: {
        showData(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/programkerjas/' + app.path,config).then((res) => 
            {
                app.programkerja = res.data.data
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
    }
}
    
</script>