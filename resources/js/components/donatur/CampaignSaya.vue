<template>
    <div class="container addpaddingtop">
        <div class="row profile">
            <SideBarProfil/>
            <div class="col-md-9">
                <div class="profile-content">
                    <h4 class="text-black-100"><b>Campaign Saya</b></h4>
                    <hr>
                    <div class="row project-button-without-padding">
                        <a href="" class="btn btn-primary py-3 px-4" style="width:max-content">+ TAMBAH CAMPAIGN</a>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <DetailCardCampaign/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SideBarProfil from './../layouts/SideBarProfil.vue'
    import DetailCardCampaign from './../pengunjung/DetailCardCampaign.vue'

    export default{
        components:{
            'SideBarProfil': SideBarProfil,
            'DetailCardCampaign': DetailCardCampaign
        }
    }
</script>