<template>
    <div class="wrapper-nav-side">
        <h3><b>Detail Kegiatan</b></h3>
        <EventLayout
            v-bind:event="event"
        />
    </div>
</template>

<script>
import EventLayout from './../../layouts/content/Event.vue'
import GlobalMethod from './../mixins/globalmethod'

export default{
    mixins: [ GlobalMethod ],
    components:{
        'EventLayout': EventLayout
    },
    data(){
        return{
            path: this.$route.params.id_event,
            event: []
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
            axios.get('/api/admin/events/' + app.path,config).then((res) => 
            {
                app.event = res.data.data
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
    }
}
    
</script>