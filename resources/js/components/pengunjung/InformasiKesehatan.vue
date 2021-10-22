<template>
    <div class="container addpaddingtop addpaddingbottom">
        <h2 class="text-center">Informasi Kesehatan</h2>
        <hr>
        <section id="tabs" class="project-tab" style="margin-top:0px;padding-top:0px">
            <div class="row">
                <div class="col-md-12">
                    <nav class="borderbottomcolorgray">
                        <div class="nav nav-tabs container" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-fw fa-list"></i> Artikel</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-fw fa-user-md"></i> Dokter</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-fw fa-medkit"></i> RS & Klinik</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active text-black-100" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row margintop15px">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="inputkeywords" v-model="keywords" placeholder="Masukkan Judul atau Isi Informasi" v-on:input="changeType"> 
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <article class="col-md-6 padding0px margintop15px" v-for="(informasikesehatan, ik) in informasikesehatans" :key="ik">
                                    <figure class="col-lg-12">
                                        <a href=""><img class="img img-responsive article-img" :src="informasikesehatan.informasi_kesehatan_foto"></a>
                                        <figcaption class="article-caption"><h4 class="article-title">{{informasikesehatan.informasi_kesehatan_title}}</h4>
                                        </figcaption>
                                    </figure>
                                    <div class="article-intro col-lg-12" style="padding-top: 10px;">
                                        <p>{{informasikesehatan.informasi_kesehatan_short_description}}<router-link :to="{ name: 'detailinformasikesehatan', params: { id_informasikesehatan: informasikesehatan.id_informasikesehatan }}" style="color:#7bba43"> Lihat Selengkapnya</router-link></p>
                                    </div>
                                </article>
                            </div>
                            <div class="col-md-12 text-center">  
                                <infinite-loading spinner="spiral" :identifier="infiniteId" @infinite="infiniteHandler" ref="infintite-loading">
                                    <div slot="no-results" class="text-black-100">{{messages}}</div>
                                    <div slot="no-more" class="text-black-100"></div>
                                </infinite-loading>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row margintop15px">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="inputkeywords" v-model="keywordsdokter" placeholder="Masukkan Nama Dokter atau Tempat Praktek" v-on:input="changeTypeDokter"> 
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
                                        <p>Tempat Praktek: <router-link :to="{ name: 'detailrumahsakit', params: { id_rumahsakit: dokter.id_rumahsakit }}">{{dokter.rumahsakit.namarumahsakit}}</router-link></p>
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
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                             <gmap-map
                                :center="center"
                                :zoom="15"
                                style="width:100%;  height: 500px;margin-top:20px;margin-bottom:20px">
                                <gmap-marker
                                    :icon="{ url:'/images/icon/person.png'}"
                                    :key="index"
                                    :position="center">
                                </gmap-marker>
                                <gmap-marker
                                    :clickable="true"
                                    :key="index2"
                                    v-for="(m, index2) in rumahsakits"
                                    @click="toggleInfoWindow(m,index2)"
                                    :position="{ lat: parseFloat(m.latituders), lng: parseFloat(m.longituders) }">
                                   
                                </gmap-marker>
                                <gmap-info-window
                                    :options="infoOptions"
                                    :position="infoWindowPos"
                                    :opened="infoWinOpen"
                                    @closeclick="infoWinOpen=false">
                                    <div v-html="infoContent"></div>
                                </gmap-info-window>
                               
                            </gmap-map>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                keywords: '',
                informasikesehatans: [],
                page: 1,
                infiniteId: +new Date(),
                messages: '',

                keywordsdokter: '',
                dokters: [],
                pagedokter: 1,
                infiniteIdDokter: +new Date(),
                messagesdokter: '',

                center: { lat: 3.597031, lng: 98.678513 },

                rumahsakits: [],

                infoContent: '',
                infoWindowPos: {
                    lat: 0,
                    lng: 0
                },
                infoWinOpen: false,
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35
                    },
                }
            }
        },
        mounted() {
            this.geolocate()
            this.showRumahSakit()
        },
        methods: {
            toggleInfoWindow: function (marker, idx) {
                this.infoWindowPos = { lat: parseFloat(marker.latituders), lng: parseFloat(marker.longituders) };
                this.infoContent = this.getInfoWindowContent(marker);
                

                //check if its the same marker that was selected if yes toggle
                if (this.currentMidx == idx) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                //if different marker set infowindow to open and reset current marker index
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = idx;
                }
            },
            getInfoWindowContent: function (marker) {
                return (
                        `<div class="card">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <h3>${marker.namarumahsakit}</h3>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5>${marker.alamatrumahsakit}</h5>
                                    <a href="/rumahsakit/${marker.id_rumahsakit}" target="_blank">Lihat Selengkapnya</a>
                                </div>
                            </div>
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="${marker.rumah_sakit_foto}" alt="Placeholder image">
                                </figure>
                            </div>
                        </div>`
                    );
                },
            geolocate: function() {
                navigator.geolocation.getCurrentPosition(position => {
                    this.center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                });
            },
            changeType() {
                this.page = 1;
                this.informasikesehatans = [];
                this.infiniteId += 1;
            },
            changeTypeDokter() {
                this.pagedokter = 1;
                this.dokters = [];
                this.infiniteIdDokter += 1;
            },
            infiniteHandler($state) {
                let app = this;
                axios.get('/api/informasikesehatan?keywords=' + app.keywords + '&page=' + app.page).then(function (res) {
                    $.each(res.data.data, function(key, value) {
                        app.informasikesehatans.push(value);
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
                    app.informasikesehatans = []
                    app.page = 1
                    app.messages = res.response.data.message
                    this.infiniteId += 1;
                });
                
            },
            infiniteHandlerDokter($state) {
                let app = this;
                var hilang = document.getElementById('hilang');
                hilang.remove();
                axios.get('/api/dokter?keywords=' + app.keywordsdokter + '&page=' + app.pagedokter).then(function (res) {
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
            showRumahSakit(){
                var app = this;
                axios.get('/api/rumahsakit?latitude=' + app.center.lat + '&longitude=' + app.center.lng).then(function (res) {
                    app.rumahsakits = res.data.data
                })
                .catch(function (res) {
                    console.log(res)
                });
            },
            
        }
        
    }
</script>

