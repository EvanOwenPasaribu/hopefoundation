<template>
    <div class="container addpaddingtop addpaddingbottom">
        <form v-on:submit.prevent="changeType">
            <div class="row">
                <div class="col-md-4 paddingtop10px">
                    <select class="form-control" name="kategori" v-model="kategori">
                        <option value="0" :selected="kategori == 0">Semua Kategori</option>
                        <option v-for="(item, idx) in category" :key="idx" :value="item.id_category" :selected="kategori == item.id_category">
                            {{ item.category_description }}
                        </option>
                    </select>
                </div>
                <div class="col-md-4 paddingtop10px">
                    <input type="text" class="form-control" v-model="keywords" placeholder="Masukkan Kata Kunci Penggalangan"> 
                </div>
                <div class="col-md-2 paddingtop10px">
                    <button type="submit" class="btn btn-primary py-3 px-4">CARI</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="row">
            <div class="col-md-4 margintop15px" v-for="(campaign, cf) in campaigns" :key="cf">
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