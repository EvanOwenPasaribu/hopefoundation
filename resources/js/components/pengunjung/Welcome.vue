<template>
    <div>
        <section class="hero-wrap" style="height:900px" v-bind:style="{ 'background-image': 'url(' + templates.front_picture + ')' }" data-section="home">
            <div style="height:900px" class="overlay"></div>
            <div class="container">
                <div class="row form-group no-gutters js-fullheight align-items-left justify-content-start">
                    <div class="col-md-3 js-fullheight" style="margin-top:85px;padding-right:20px">
                        <div>
                            <div class="text-center" style="border:2px solid #78EE06;border-radius:5px;padding:10px 20px;justify-content:center;align-item:center">
                                <div class="row">
                                    <a :href="'https://www.youtube.com/channel/' + templates.youtube" target="_blank" class="col-4"><img class="img-fluid" style="width:50px;height:50px" :src="'images/icon/youtube-icon.png'"></a>
                                    <a :href="'https://www.facebook.com/groups/' + templates.facebook" target="_blank" class="col-4"><img class="img-fluid" style="width:50px;height:50px" :src="'images/icon/facebook-icon.png'"></a>
                                    <a :href="'https://www.instagram.com/' + templates.instagram" target="_blank" class="col-4"><img class="img-fluid" style="width:50px;height:50px" :src="'images/icon/instagram-icon.png'"></a>
                                </div>
                            </div>
                        <div class="my-2 text-center" style="border:2px solid #78EE06;border-radius:5px;padding:10px 20px;">
                            <h5 style="color:white;font-weight:bold;text-align:center">Program Kerja</h5>
                            <div v-for="(item,index) in dataProgramKerja" class="my-2" style="background:#78EE06;padding:5px;color:black;font-weight:bold"><a>{{item}}</a></div>
                        </div>
                        <div class="block-23 mb-0 mt-2 text-white">
                            <ul>
                                <li><span style="font-size:40px" class="icon icon-map-marker font-weight-bold"></span><span class="text font-weight-bold text-center">{{templates.address_footer}}</span></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col-md-9" height="900px" style="margin-top:85px;padding-left:20px;overflow:hidden">
                        <div>
                            <template v-if="dataSlider1">
                                <div v-if="dataSlider1.length > 0" class="mb-5" style="border:2px solid #78EE06;border-radius:10px;background-color:#78EE06;height:204px">
                                    <carousel :nav="false" :autoplay="true" :dots="true" :dotsEach="1" :loop="true" :margin="5" :items="3">
                                        <div v-for="(item, index) in dataSlider1">
                                            <img style="height:200px;border-radius:10px" :src="item"/>
                                        </div>
                                    </carousel>
                                </div>
                            </template>
                            <template v-if="dataSlider2">
                                <div v-if="dataSlider2.length > 0" class="mb-5" style="border:2px solid #78EE06;border-radius:10px;background-color:#78EE06;height:204px">
                                    <carousel :nav="false" :autoplay="true" :dots="true" :dotsEach="1" :loop="true" :margin="5" :items="3">
                                        <div v-for="(item, index) in dataSlider2">
                                            <img style="height:200px;border-radius:10px" :src="item"/>
                                        </div>
                                    </carousel>
                                </div>
                            </template>

                            <div style="margin-left:0px;margin:right:0px">
                                <div class="row" style="margin-left:0;margin-right:0">
                                    <div class="col-4 text-center text-white font-weight-bold" style="padding-right:20px;padding-left:0;height:200px">
                                        <div class="" style="border:2px solid #78EE06;border-radius:10px;height:200px;display:flex;justify-content:center;align-items:center">
                                             <img style="height:100%;width:100%;border-radius:10px" :src="templates.picture_info_kesehatan"/>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center text-white font-weight-bold" style="padding-right:0px;padding-left:0;height:200px">
                                        <div style="border:2px solid #78EE06;border-radius:10px;height:200px;display:flex;justify-content:center;align-items:center">
                                             <img style="height:100%;width:100%;border-radius:10px" :src="templates.picture_edukasi_kesehatan"/>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center text-white font-weight-bold" style="padding-right:0px;padding-left:20px;height:200px">
                                        <div style="border:2px solid #78EE06;border-radius:10px;height:200px;display:flex;justify-content:center;align-items:center">
                                             <img style="height:100%;width:100%;border-radius:10px" :src="templates.picture_kerja_sama"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
                    <div class="col-md-6" data-scrollax=" properties: { translateY: '70%' }">
                        <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{templates.caption_front_picture}}</h1>
                        <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{templates.caption_description_front_picture}}</p>
                        <div class="row">
                            <div class="col-md-4 paddingtop10px">
                                <a :href="$router.resolve({ name: 'vaksinisasi' }).href" class="btn btn-primary py-3 px-4 secondarycolorbutton" style="border:1px solid #cc4996 !important">{{templates.button_description_front_picture}}</a>
                            </div>
                            <div class="col-md-5 paddingtop10px">
                                <a :href="$router.resolve({ name: 'cektanggalvaksin' }).href" class="btn btn-primary py-3 px-4" style="border:1px solid #f6993f !important;background-color:#f6993f">Cek Tanggal Vaksin</a>
                            </div>
                            <div class="col-md-3 paddingtop10px">
                                <a :href="'https://wa.me/' + templates.whatsapp" target="_blank" class="btn btn-primary py-3 px-4">Konsultasi</a>
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>
        </section>

        <div class="container my-3">
            <div class="graybackground">
                <div class="row">
                    <div class="col-3 p-2">
                        <div class="font-weight-bold" style="display:flex;justify-content:center;align-items:center;border:3px solid #AEAFAF;border-radius:10px;height:300px">
                            <iframe :src="templates.instagram_page" width="100%" height="100%" style="border:none;overflow:hidden;border-radius:10px" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="font-weight-bold" style="display:flex;justify-content:center;align-items:center;border:3px solid #AEAFAF;border-radius:10px;height:300px">
                            <iframe :src="templates.youtube_page" width="100%" height="100%" style="border:none;overflow:hidden;border-radius:10px" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="font-weight-bold" style="display:flex;justify-content:center;align-items:center;border:3px solid #AEAFAF;border-radius:10px;height:300px">
                            <iframe :src="templates.facebook_page" width="100%" height="100%" style="border:none;overflow:hidden;border-radius:10px" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="font-weight-bold" style="display:flex;justify-content:center;align-items:center;border:3px solid #AEAFAF;border-radius:10px;height:300px">
                            <iframe :src="templates.tiktok_page" width="100%" height="100%" style="border:none;overflow:hidden;border-radius:10px" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--<div class="container">
            <section class="ftco-section ftco-counter ftco-no-pt ftco-no-pb img" id="section-counter">
                <div class="container">
                    <div class="row d-md-flex align-items-center justify-content-end">
                        <div class="col-lg-12">
                            <div class="ftco-counter-wrap">
                                <div class="row no-gutters d-md-flex align-items-center align-items-stretch">
                                    <div class="col-md-3 d-flex justify-content-center counter-wrap">
                                        <a :href="$router.resolve({ name: 'campaign', query: { kategori: 5, keywords: ''}}).href">
                                            <div class="block-18">
                                                <div class="text">
                                                    <div class="icon d-flex justify-content-center align-items-center">
                                                        <span class="flaticon-house"></span>
                                                    </div>
                                                    <strong class="number">{{welcomecount.countcampaignspengobatan}}</strong>
                                                    <span>Pengobatan Pasien</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center counter-wrap">
                                        <a :href="$router.resolve({ name: 'informasikesehatan' }).href">
                                            <div class="block-18">
                                                <div class="text">
                                                    <div class="icon d-flex justify-content-center align-items-center">
                                                        <span class="fas fa-fw fa-eye"></span>
                                                    </div>
                                                    <strong class="number">{{welcomecount.countinformasikesehatan}}</strong>
                                                    <span>Informasi Kesehatan</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center counter-wrap">
                                        <a :href="$router.resolve({ name: 'event' }).href">
                                            <div class="block-18">
                                                <div class="text">
                                                    <div class="icon d-flex justify-content-center align-items-center">
                                                        <span class="flaticon-lawyer"></span>
                                                    </div>
                                                    <strong class="number">{{welcomecount.countevent}}</strong>
                                                    <span>Kegiatan</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center counter-wrap">
                                        <a :href="$router.resolve({ name: 'programkerja', params: { program_kerja_url: 'BaktiSosialPengobatanGratis' }}).href">
                                            <div class="block-18">
                                                <div class="text">
                                                    <div class="icon d-flex justify-content-center align-items-center">
                                                        <span class="flaticon-medal"></span>
                                                    </div>
                                                    <strong class="number">{{welcomecount.countprogramkerja}}</strong>
                                                    <span>Program Kerja</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>-->
        <!--<div class="graybackground">
            <h1 class="text-center mb-3 margintop15px">Berikan Bantuan Anda</h1>
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="container carousel-inner row w-100 mx-auto">
                    <div v-for="(campaign, cf) in campaigns" :key="cf" class="carousel-item col-md-4" v-bind:class="campaign.active">
                        <DetailCardCampaign
                            v-bind:campaign="campaign"
                        />
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
            <center>
                <a :href="$router.resolve({ name: 'campaign', query: { kategori: 0, keywords: ''}}).href" class="btn btn-primary widthauto margintopbottom30px">Lihat Semua</a>
            </center>
        </div>-->
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    import DetailCardCampaign from './DetailCardCampaign.vue'

    export default{
        components:{
            carousel,
            'DetailCardCampaign': DetailCardCampaign
        },
        data(){
            return{
                campaigns: [],
                welcomecount: [],
                dataSlider1 : [],
                dataSlider2 : [],
                dataProgramKerja : [],
            }
        },
        props: ['templates'],
        methods: {
            showFrontImportant(){
                var app = this;
                axios.get('/api/campaigns/all/frontimportant').then(function (res) {
                    app.campaigns = res.data.data
                })
                .catch(function (res) {
                    console.log(res)
                });
            },
            showCountWelcome(){
                var app = this;
                axios.get('/api/welcomecount').then(function (res) {
                    app.welcomecount = res.data.data
                })
                .catch(function (res) {
                    console.log(res)
                });
            }
        },
        mounted() {
            this.showCountWelcome()
            this.showFrontImportant()
        },
        watch : {
            templates: {
                handler () {
                    this.dataSlider1 = JSON.parse(this.templates.picture_slider1)
                    this.dataSlider2 = JSON.parse(this.templates.picture_slider2)
                    this.dataProgramKerja = JSON.parse(this.templates.program_kerja)
                },
                immediate: true // this is the tricky part
            }
        }
    }
    
</script>