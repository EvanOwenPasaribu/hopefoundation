<template>
    <div>
        <div class="backgroundcolorwhite addpaddingtop">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img :src="'/images/sample/logo.jpg'" class="img-fluid-border">
                    </div>
                    <div class="col-md-10 paddingtop10px">
                        <h4 class="text-black-100"><b>Nama Campaign</b> <i class="fa fa-check-circle blue"></i></h4>
                        <h6 class="text-black-100"><i class="fa fa-lock"></i> Terakhir Online: 29-05-2019</h6>
                        <h6 class="text-black-100"><i class="fa fa-user"></i> Mulai Aktif: 17-11-2015</h6>
                    </div>
                    <div class="row biografifundraiser">
                        <p>Informasi Biografi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h4 class="margintop15px">Campaign Yang Digalang (15)</h4>
            <hr>
            <div class="contentcampaign">
                <CardCampaignStandar/>
            </div>
        </div>
    </div>
</template>

<script>
    import CardCampaignStandar from './CardCampaignStandar.vue'

    export default{
        components:{
            'CardCampaignStandar': CardCampaignStandar
        }
    }
</script>