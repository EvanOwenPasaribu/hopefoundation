<template>
    <div class="container addpaddingtop addpaddingbottom">
        <div class="row">
            <div class="col-md-8">
                <h5 class="text-black-100">Semua Kegiatan Yang Diselenggarakan<br><b>Hope Foundation</b></h5>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputkeywords" v-model="keywords" placeholder="Masukkan Judul atau Isi Kegiatan" v-on:input="changeType"> 
            </div>
        </div>
        <hr>
        <div class="row">
		    <article class="col-md-6 padding0px" v-for="(event, es) in events" :key="es">
    			<figure class="col-lg-12">
				    <a :href="event.event_foto" target="_blank"><img class="img img-responsive article-img" :src="event.event_foto"></a>
				    <figcaption class="article-caption"><h4 class="article-title">{{event.event_title}}</h4>
				    </figcaption>
				</figure>
				<div class="article-intro col-lg-12" style="padding-top: 10px;">
				    <p>{{event.event_short_description}}<router-link :to="{ name: 'detailevent', params: { id_event: event.id_event }}"> Lihat Selengkapnya</router-link></p>
				</div>
			</article>
            <div class="col-md-12 text-center">  
                <infinite-loading spinner="spiral" :identifier="infiniteId" @infinite="infiniteHandler" ref="infintite-loading">
                    <div slot="no-results" class="text-black-100">{{messages}}</div>
                    <div slot="no-more" class="text-black-100"></div>
                </infinite-loading>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                keywords: '',
                events: [],
                page: 1,
                infiniteId: +new Date(),
                messages: ''
            }
        },
        mounted() {
            
        },
        methods: {
            changeType() {
                this.page = 1;
                this.events = [];
                this.infiniteId += 1;
            },
            infiniteHandler($state) {
                let app = this;
                axios.get('/api/event?keywords=' + app.keywords + '&page=' + app.page).then(function (res) {
                    $.each(res.data.data, function(key, value) {
                        app.events.push(value);
                    });
                    $state.loaded()
                    if(res.data.last_page == app.page)
                    {
                        $state.complete()
                        app.page = 1
                    }
                    else
                        app.page = app.page + 1
                })
                .catch(function (res) {
                    $state.complete()
                    app.events = []
                    app.page = 1
                    app.messages = res.response.data.message
                    this.infiniteId += 1;
                });
                
            },
        }
        
    }
</script>