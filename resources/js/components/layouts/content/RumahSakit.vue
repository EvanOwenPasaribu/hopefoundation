<template>
    <div>
        <h2 class="text-center">{{rumahsakit.namarumahsakit}}</h2>
        <h5 class="text-center">Alamat: {{rumahsakit.alamatrumahsakit}}</h5>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <a :href="rumahsakit.rumah_sakit_foto" target="_blank"><img :src="rumahsakit.rumah_sakit_foto" style="width:100%"/></a>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <hr>
        <h4><b>Informasi Dokter Yang Praktek</b></h4>
        <hr>
        <div class="row margintop15px">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputkeywords" v-model="keywordsdokter" placeholder="Masukkan Nama Dokter" v-on:input="changeTypeDokter"> 
            </div>
        </div>
        <hr>
        <div class="row">
            <article class="col-md-6 padding0px margintop15px" v-for="(dokter, dr) in dokters" :key="dr">
                <figure class="col-lg-12">
                    <a href=""><img class="img img-responsive article-img" :src="dokter.dokter_foto"></a>
                    <figcaption class="article-caption"><h4 class="article-title">{{dokter.namadokter}}</h4>
                    </figcaption>
                </figure>
                <div class="article-intro col-lg-12" style="padding-top: 10px;">
                    <p>Spesialist: {{dokter.spesialist}}</p>
                    <p><router-link :to="{ name: 'detaildokter', params: { id_dokter: dokter.id_dokter }}" style="color:#7bba43"> Lihat Selengkapnya</router-link></p>
                </div>
            </article>
        </div>
        <div class="col-md-12 text-center">  
            <p id="hilang">Scroll ke bawah sedikit, jika data belum muncul</p> 
            <infinite-loading spinner="spiral" :identifier="infiniteIdDokter" @infinite="infiniteHandlerDokter" ref="infintite-loading">
                <div slot="no-results" class="text-black-100">{{messagesdokter}}</div>
                <div slot="no-more" class="text-black-100"></div>
            </infinite-loading>
        </div>
    </div>
</template>

<script>
    import GlobalMethod from './../../admin/mixins/globalmethod'
    export default {
        mounted() {
            
        },
        props: ['rumahsakit'],
        data(){
            return{
                path: this.$route.params.id_rumahsakit,
                keywordsdokter: '',
                dokters: [],
                pagedokter: 1,
                infiniteIdDokter: +new Date(),
                messagesdokter: ''
            }
        },
        methods:{
            changeTypeDokter() {
                this.pagedokter = 1;
                this.dokters = [];
                this.infiniteIdDokter += 1;
            },
            infiniteHandlerDokter($state) {
                let app = this;
                var hilang = document.getElementById('hilang');
                hilang.remove();
                axios.get('/api/dokter/' + app.path + '/show?keywords=' + app.keywordsdokter + '&page=' + app.pagedokter).then(function (res) {
                    $.each(res.data.data, function(key, value) {
                        app.dokters.push(value);
                    });
                    $state.loaded()
                    if(res.data.last_page == app.pagedokter)
                    {
                        $state.complete()
                        app.pagedokter = 1
                    }
                    else
                        app.pagedokter = app.pagedokter + 1
                })
                .catch(function (res) {
                    $state.complete()
                    app.dokters = []
                    app.pagedokter = 1
                    app.messagesdokter = res.response.data.message
                    this.infiniteIdDokter += 1;
                });
                
            },

        }
    }
</script>

