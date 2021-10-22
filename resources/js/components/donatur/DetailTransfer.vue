<template>
    <div class="container addpaddingtop">
        <div class="row profile">
            <SideBarProfil/>
            <div class="col-md-9">
                <div class="profile-content">
                    <h4 class="text-black-100"><b>Instruksi Pembayaran</b></h4>
                    <hr>
                    <center>
                         <div class="row">
                            <div class="col-md-10">
                                <h5>Transfer sesuai nominal di bawah ini:</h5>
                            </div>
                            <div class="col-md-2">
                            </div>
                         </div>
                        <div class="row">
                            <div class="col-md-10">
                                <h3>Rp. {{ formatPrice(+detailtransfer.nominaltransaction + +detailtransfer.kodeunik) }}</h3>
                                <h3 id="myInput" style="position: absolute;left: -999em;" aria-hidden="true">{{+detailtransfer.nominaltransaction + +detailtransfer.kodeunik}}</h3>
                            </div>
                            <div class="col-md-2">
                                <h6 @click="copy('myInput')"><a>Salin</a></h6>
                            </div>
                        </div>
                    </center>
                    <div class="row kotakkuning">
                        <h6><b>PENTING!</b> Mohon transfer tepat sampai 3 angka terakhir agar isi saldo terverifikasi otomatis</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Jumlah:
                        </div>
                        <div class="col-md-6 text-right">
                            Rp. {{ formatPrice(detailtransfer.nominaltransaction) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Kode Unik (*):
                        </div>
                        <div class="col-md-6 text-right">
                            {{ detailtransfer.kodeunik }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                         <div class="col-md-12">
                            <h6>* 3 angka terakhir akan dimasukkan ke saldo elektronik.</h6>
                         </div>
                    </div>
                    <hr>
                    <center>
                        <div class="row">
                            <div class="col-md-10">
                                <h5>Pembayaran dilakukan ke rekening a/n</h5>
                                <h5>{{detailtransfer.paymentmethoddetails.atas_nama}}</h5>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <img :src="detailtransfer.paymentmethoddetails.payment_detail_logo" style="width:100%"/>
                            </div>
                            <div class="col-md-8">
                                <h5 id="myInput2">{{detailtransfer.paymentmethoddetails.description_payment_detail    }}</h5>
                            </div>
                            <div class="col-md-2">
                                <h6 @click="copy('myInput2')"><a>Salin</a></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <a href="" class="btn btn-primary">Batalkan Isi Saldo</a>
                        </div>
                    </center>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SideBarProfil from './../layouts/SideBarProfil.vue'

    export default{
        mounted(){
            this.showDetailTransfer()
        },
        data(){
            return{
                path: this.$route.params.id_transactionbalance,
                detailtransfer: []
            }
        },
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            showDetailTransfer(){
                var app = this;
                var config = {
                    headers: {
                        'Authorization': "Bearer " + localStorage.usertoken,
                        'Content-Type': "multipart/form-data"
                    }
                };
                axios.get('/api/instruksipembayaran/' + app.path,config).then((res) => 
                {
                    app.detailtransfer = res.data.data
                })
                .catch((res) => {
                    this.handlerException(res)
                })
            },
            copy(element) {
                var range, selection, worked;
                var element = document.getElementById(element); 

                if (document.body.createTextRange) {
                    range = document.body.createTextRange();
                    range.moveToElementText(element);
                    range.select();
                } else if (window.getSelection) {
                    selection = window.getSelection();        
                    range = document.createRange();
                    range.selectNodeContents(element);
                    selection.removeAllRanges();
                    selection.addRange(range);
                }
                
                try {
                    document.execCommand('copy');
                    this.$swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'Berhasil menyalin nominal',
                        showConfirmButton: false,
                        timer: 5000,
                        toast: true
                    });
                }
                catch (err) {
                    this.$swal({
                        position: 'top-end',
                        type: 'error',
                        title: 'Tidak bisa menyalin nominal',
                        showConfirmButton: false,
                        timer: 5000,
                        toast: true
                    });
                }
            }
        },
        components:{
            'SideBarProfil': SideBarProfil
        }
    }
</script>