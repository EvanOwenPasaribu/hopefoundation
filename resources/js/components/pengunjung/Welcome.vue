<template>
    <div>
        <section class="hero-wrap js-fullheight" v-bind:style="{ 'background-image': 'url(' + templates.front_picture + ')' }" data-section="home">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
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
                </div>
            </div>
        </section>
        <div class="container">
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
        </div>
        <div class="graybackground">
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
        </div>
    </div>
</template>

<script>
    import DetailCardCampaign from './DetailCardCampaign.vue'

    export default{
        components:{
            'DetailCardCampaign': DetailCardCampaign
        },
        data(){
            return{
                campaigns: [],
                welcomecount: []
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
        }
    }
    
</script>