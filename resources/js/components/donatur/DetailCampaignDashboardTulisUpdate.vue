<template>
    <div class="container addpaddingtop">
        <div class="row profile">
            <SideBarCampaign/>
            <div class="col-md-9">
                <div class="profile-content">
                    <h4 class="text-black-100"><b>Update Galang Dana</b></h4>
                    <hr>
                    <form>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label text-black-100">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJudul" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label text-black-100">Update+Foto</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputDeskripsi" rows="10"></textarea>
                                <p class="text-black-100 text-justify">Catatan: Update Anda akan otomatis terkirim ke semua email donatur. Tulis update hanya untuk:</p>
                                <p class="text-black-100 text-justify">1. Memberi ucapan terimakasih kepada donatur</p>
                                <p class="text-black-100 text-justify">2. Mengabarkan progres, bukti & dokumentasi penggunaan dana yang terkumpul (beserta foto)</p>
                                <div class="row project-button-without-padding float-right">
                                    <button type="submit" class="btn btn-primary py-3 px-4" style="width:max-content">KIRIM UPDATE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <h4 class="text-black-100"><b>Update Sebelumnya</b></h4>
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