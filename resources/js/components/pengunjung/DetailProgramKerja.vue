<template>
    <div class="container addpaddingtop addpaddingbottom">
        <ProgramKerjaLayout
            v-bind:programkerja="programkerja"
        />
    </div>
</template>

<script>
import ProgramKerjaLayout from './../layouts/content/ProgramKerja.vue'
import GlobalMethod from './../admin/mixins/globalmethod'

export default{
    mixins: [ GlobalMethod ],
    components:{
        'ProgramKerjaLayout': ProgramKerjaLayout
    },
    data(){
        return{
            path: this.$route.params.id_programkerja,
            program_kerja_url: this.$route.params.program_kerja_url,
            programkerja: []
        }
    },
    mounted() {
        this.showData()
    },
    methods: {
        showData(){
            var app = this;
            axios.get('/api/programkerja/' + app.program_kerja_url + '/' + app.path).then((res) => 
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