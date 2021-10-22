<template>
    <div class="container addpaddingtop addpaddingbottom">
        <EventLayout
            v-bind:event="event"
        />
    </div>
</template>

<script>
import EventLayout from './../layouts/content/Event.vue'
import GlobalMethod from './../admin/mixins/globalmethod'

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
            axios.get('/api/event/' + app.path).then((res) => 
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