<template>
    <div class="container addpaddingtop addpaddingbottom">
        <DokterLayout
            v-bind:dokter="dokter"
        />
    </div>
</template>

<script>
import DokterLayout from './../layouts/content/Dokter.vue'
import GlobalMethod from './../admin/mixins/globalmethod'

export default{
    mixins: [ GlobalMethod ],
    components:{
        'DokterLayout': DokterLayout
    },
    data(){
        return{
            path: this.$route.params.id_dokter,
            dokter: []
        }
    },
    mounted() {
        this.showData()
    },
    methods: {
        showData(){
            var app = this;
            axios.get('/api/dokter/' + app.path).then((res) => 
            {
                app.dokter = res.data.data
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
    }
}
    
</script>