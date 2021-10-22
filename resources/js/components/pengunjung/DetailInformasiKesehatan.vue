<template>
    <div class="container addpaddingtop addpaddingbottom">
        <InformasiKesehatanLayout
            v-bind:informasikesehatan="informasikesehatan"
        />
    </div>
</template>

<script>
import InformasiKesehatanLayout from './../layouts/content/InformasiKesehatan.vue'
import GlobalMethod from './../admin/mixins/globalmethod'

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
            axios.get('/api/informasikesehatan/' + app.path).then((res) => 
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