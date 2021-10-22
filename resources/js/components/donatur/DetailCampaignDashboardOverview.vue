<template>
    <div class="container addpaddingtop">
        <div class="row profile">
            <SideBarCampaign/>
            <div class="col-md-9">
                <div class="profile-content">
                    <h4 class="text-black-100"><b>Overview</b></h4>
                    <hr>
                    <div class="row w-100">
                        <div class="col-md-4">
                            <div class="card border-info mx-sm-1 p-3">
                                <div class="text-info text-center mt-3"><h5>Pageviews</h5></div>
                                <div class="text-info text-center mt-2"><h4><b>6</b></h4></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success mx-sm-1 p-3">
                                <div class="text-success text-center mt-3"><h5>Donatur</h5></div>
                                <div class="text-success text-center mt-2"><h4><b>0</b></h4></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-danger mx-sm-1 p-3">
                                <div class="text-danger text-center mt-3"><h5>Update</h5></div>
                                <div class="text-danger text-center mt-2"><h4><b>3</b></h4></div>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-black-100 text-center margintop15px"><b>Rincian Donasi</b></h4>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SideBarCampaign from './../layouts/SideBarCampaign.vue'

    export default{
        components:{
            'SideBarCampaign': SideBarCampaign
        }
    }
</script>