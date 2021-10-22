<template>
    <div class="container addpaddingtop">
        <div class="row profile">
            <SideBarProfil/>
            <div class="col-md-9">
                <div class="profile-content">
                    <h4 class="text-black-100"><b>Donasi Saya</b></h4>
                    <hr>
                    <h4 class="text-black-100"><b>Rp. 0</b></h4>
                    <small>Total donasi saya</small>
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