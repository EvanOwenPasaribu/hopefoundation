<template>
    <div class="container addpaddingtop addpaddingbottom">
        <RumahSakitLayout
            v-bind:rumahsakit="rumahsakit"
        />
    </div>
</template>

<script>
import RumahSakitLayout from './../layouts/content/RumahSakit.vue'
import GlobalMethod from './../admin/mixins/globalmethod'

export default{
    mixins: [ GlobalMethod ],
    components:{
        'RumahSakitLayout': RumahSakitLayout
    },
    data(){
        return{
            path: this.$route.params.id_rumahsakit,
            rumahsakit: []
        }
    },
    mounted() {
        this.showData()
    },
    methods: {
        showData(){
            var app = this;
            axios.get('/api/rumahsakit/' + app.path).then((res) => 
            {
                app.rumahsakit = res.data.data
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
    }
}
    
</script>