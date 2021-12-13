<template>
    <div class="container addpaddingtop addpaddingbottom">

        <form v-on:submit.prevent="changeType">
             <div class="search-donation-wrapper">
                <input type="text" class="search-donation" v-model="keywords" placeholder="Masukkan Kata Kunci Penggalangan">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <div class="donation-menu">
            <div class="wrapper-box">
                <div v-on:click="changeKategori('0')" class="donasi-menu-wrapper">
                    <div class="img-menu">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="title-menu">
                        <p>Semua</p>
                    </div>
                </div>
                <div v-on:click="changeKategori('1')" class="donasi-menu-wrapper">
                    <div class="img-menu center">
                        <i class="fas fa-mountain"></i>
                    </div>
                    <div class="title-menu">
                        <p>Bencana Alam</p>
                    </div>
                </div>
                <div v-on:click="changeKategori('2')" class="donasi-menu-wrapper">
                    <div class="img-menu center">
                        <i class="fas fa-blind"></i>
                    </div>
                    <div class="title-menu">
                        <p>Difabel</p>
                    </div>
                </div>
                <div v-on:click="changeKategori('3')" class="donasi-menu-wrapper">
                    <div class="img-menu center">
                        <i class="fas fa-baby"></i>
                    </div>
                    <div class="title-menu">
                        <p>Balita dan Anak Sakit</p>
                    </div>
                </div>
                <div v-on:click="changeKategori('4')" class="donasi-menu-wrapper">
                    <div class="img-menu center">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                    <div class="title-menu">
                        <p>Kegiatan Sosial</p>
                    </div>
                </div>
                <div v-on:click="changeKategori('5')" class="donasi-menu-wrapper">
                    <div class="img-menu center">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <div class="title-menu">
                        <p>Pengobatan Pasien</p>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
        <div class="row">
            <div class="col-md-3 margintop15px" v-for="(campaign, cf) in campaigns" :key="cf">
                <DetailCardCampaign v-bind:campaign="campaign"/>
            </div>
            <div class="col-md-12 text-center">  
                <no-ssr>
                    <infinite-loading spinner="spiral" :identifier="infiniteId" @infinite="infiniteHandler" ref="infintite-loading">
                        <div slot="no-results" class="text-black-100">{{messages}}</div>
                        <div slot="no-more" class="text-black-100"></div>
                    </infinite-loading>
                </no-ssr>
            </div>  
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
                kategori: this.$route.query.kategori,
                keywords: this.$route.query.keywords,
                campaigns: [],
                category: [],
                page: 1,
                infiniteId: +new Date(),
                messages: ''
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/category').then(function (res) {
                app.category = res.data.data
            })
            .catch(function (res) {
                console.log(res);
            });
        },
        methods: {
            changeKategori(kategori) {
                this.page = 1;
                this.campaigns = [];
                this.kategori = kategori;
                this.infiniteId += 1;
            },
            changeType() {
                this.page = 1;
                this.campaigns = [];
                this.infiniteId += 1;
            },
            infiniteHandler($state) {
                let app = this;
                axios.get('/api/campaigns/all/search?kategori=' + app.kategori + '&keywords=' + app.keywords + '&page=' + app.page).then(function (res) {
                    $.each(res.data.data, function(key, value) {
                        app.campaigns.push(value);
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
                    app.campaigns = []
                    app.page = 1
                    app.messages = res.response.data.message
                    this.infiniteId += 1;
                });
                this.$router.replace({ path: "campaign", query: {kategori:app.kategori,keywords: app.keywords} })
            },
        }
        
    }
</script>