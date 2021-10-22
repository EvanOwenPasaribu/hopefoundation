<template>
    <div class="wrapper-nav-side">
        <h3><b>Detail Informasi Kesehatan</b></h3>
        <InformasiKesehatanLayout
            v-bind:informasikesehatan="informasikesehatan"
        />
    </div>
</template>

<script>
import InformasiKesehatanLayout from './../../layouts/content/InformasiKesehatan.vue'
import GlobalMethod from './../mixins/globalmethod'

export default{
    mixins: [ GlobalMethod ],
    components:{
        'InformasiKesehatanLayout': InformasiKesehatanLayout
    },
    data(){
        return{
            path: this.$route.params.id_informasikesehatan,
            informasikesehatan: []
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
            axios.get('/api/admin/informasikesehatans/' + app.path,config).then((res) => 
            {
                app.informasikesehatan = res.data.data
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
    }
}
    
</script>