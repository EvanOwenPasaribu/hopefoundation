<template>
    <div class="container addpaddingtop">
        <div class="row profile">
            <SideBarProfil/>
            <div class="col-md-9">
                <div class="profile-content">
                    <h4 class="text-black-100"><b>Overview</b></h4>
                    <hr>
                    <div class="row w-100">
                        <div class="col-md-4">
                            <div class="card border-info mx-sm-1 p-3">
                                <div class="text-info text-center mt-3"><h5>Campaign Dimulai</h5></div>
                                <div class="text-info text-center mt-2"><h4><b>234</b></h4></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success mx-sm-1 p-3">
                                <div class="text-success text-center mt-3"><h5>Donasi</h5></div>
                                <div class="text-success text-center mt-2"><h4><b>9332</b></h4></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-danger mx-sm-1 p-3">
                                <div class="text-danger text-center mt-3"><h5>Donasi Disalurkan</h5></div>
                                <div class="text-danger text-center mt-2"><h4><b>Rp. </b></h4></div>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-black-100 text-center margintop15px"><b>Recent Updates</b></h4>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SideBarProfil from './../layouts/SideBarProfil.vue'

    export default{
        components:{
            'SideBarProfil': SideBarProfil
        }
    }
</script>