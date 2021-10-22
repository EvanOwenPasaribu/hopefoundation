<template>
    <div class="container addpaddingtop addpaddingbottom">
        <div class="row">
            <div class="col-md-8">
                <h5 class="text-black-100">Semua Program Kerja Hope Foundation<br><b>{{category}}</b></h5>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputkeywords" v-model="keywords" placeholder="Masukkan Judul atau Isi Program Kerja" v-on:input="changeType">  
            </div>
        </div>
        <hr>
        <div class="row">
		    <article class="col-md-6 padding0px" v-for="(programkerja, pk) in programkerjas" :key="pk">
    			<figure class="col-lg-12">
				    <a :href="programkerja.program_kerja_foto" target="_blank"><img class="img img-responsive article-img" :src="programkerja.program_kerja_foto"></a>
				    <figcaption class="article-caption"><h4 class="article-title">{{programkerja.program_kerja_title}}</h4>
				    </figcaption>
				</figure>
				<div class="article-intro col-lg-12" style="padding-top: 10px;">
				    <p>{{programkerja.program_kerja_short_description}}<router-link :to="{ name: 'detailprogramkerja', params: { program_kerja_url: programkerja.programkerjacategory.program_kerja_url, id_programkerja: programkerja.id_programkerja  }}"> Lihat Selengkapnya</router-link></p>
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
                path: this.$route.params.program_kerja_url,
                programkerjas: [],
                category: '',
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
                this.programkerjas = [];
                this.infiniteId += 1;
            },
            infiniteHandler($state) {
                let app = this;
                axios.get('/api/programkerja/' + app.path + '?keywords=' + app.keywords + '&page=' + app.page).then(function (res) {
                    $.each(res.data.data, function(key, value) {
                        app.programkerjas.push(value);
                    });
                    $state.loaded()
                    app.category = res.data.category
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
                    app.programkerjas = []
                    app.page = 1
                    app.messages = res.response.data.message
                    app.category = res.response.data.category
                    this.infiniteId += 1;
                });
                
            },
        }
        
    }
</script>