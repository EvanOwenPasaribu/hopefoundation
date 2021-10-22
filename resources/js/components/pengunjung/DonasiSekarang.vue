<template>
    <div class="d-flex justify-content-center h-100 paddingkhusustanpaatas25px">
        <div class="donasi_sekarang_card col-md-4 margintopdonasisekarang">
            <div class="justify-content-center donasi_container">
                <div class="row">
                    <div class="col-3 text-center">
                        <img :src="campaigns.user.logo" class="img-fluid-border">
                    </div>
                    <div class="col-9">
                        <h6 class="text-black-100">Lakukan Donasi Untuk:</h6>
                        <h5 class="text-black-100"><b>{{ campaigns.campaigns_title }}</b></h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <form class="form-group width100percent paddingkhusustanpaatasbawah15px" v-on:submit.prevent="donation">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">Rp. </span>
                            </div>
                            <input type="number" class="form-control input_user" placeholder="Masukkan Jumlah Donasi" name="jumlahdonasi" v-model="jumlahdonasi">
                        </div>
                        <span v-if="errors.jumlahdonasi" :class="['label label-danger']">{{ errors.jumlahdonasi[0] }}</span>
                        <hr>
                        <h6>Pilih Metode Pembayaran:</h6>
                        <div class="input-group mb-3">
                            <select class="form-control" name="paymentmethod" v-model="paymentmethod">
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <optgroup v-for="(paymentmethod, pm) in paymentmethods" :key="pm" :label="paymentmethod.method_name">
                                    <option v-for="(paymentmethoddetail, pmd) in paymentmethod.paymentmethoddetails" :key="pmd" :value="paymentmethoddetail.id_paymentmethoddetail">{{paymentmethoddetail.method_detail_name}}</option>
                                </optgroup>
                            </select>
                        </div>
                        <span v-if="errors.paymentmethod" :class="['label label-danger']">{{ errors.paymentmethod[0] }}</span>
                        <hr>
                        <h5 class="text-black-100"><b>Nama Donatur</b></h5>
                        <h6>{{user.name}}</h6>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="checked">
                            <label class="form-check-label" for="anonim"><h6 class="text-black-100"> Sembunyikan nama saya (Anonim)</h6></label>
                        </div>
                        <div class="form-group">
                            <label for="doaanda"><h6 class="text-black-100">Tuliskan doa anda:</h6></label>
                            <textarea class="form-control" rows="2" name="doa" v-model="doa"></textarea>
                        </div>
                        <div class="row project-button">
                            <button type="submit" class="btn btn-primary py-3 px-4" style="padding:10px">LANJUTKAN PEMBAYARAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                checked : false,
                path: this.$route.params.raising_link,
                jumlahdonasi: '',
                paymentmethod: '',
                doa: '',
                campaigns: [],
                paymentmethods: [],
                errors: [],
                messages: ''
            }
        },
        props: ['user'],
        mounted() {
            var app = this;
            axios.get('/api/campaigns/' + app.path).then(function (res) {
                app.campaigns = res.data.data
            })
            .catch(function (res) {
                console.log(res);
            });
            axios.get('/api/paymentmethods').then(function (res) {
                app.paymentmethods = res.data.data
            })
            .catch(function (res) {
                console.log(res);
            });
        },
        methods: {
            donation(){
                var app = this;
                this.errors = [];
                this.messages = '';
                let bodyParameters = new FormData();
                var config = {
                    headers: {
                        'Authorization': "Bearer " + localStorage.usertoken,
                        'Content-Type': "multipart/form-data"
                    }
                };
                bodyParameters.append('paymentmethod',this.paymentmethod);
                bodyParameters.append('jumlahdonasi', this.jumlahdonasi);
                bodyParameters.append('doa', this.doa);
                if(this.checked)
                    bodyParameters.append('useranonim', 'Y');
                else
                    bodyParameters.append('useranonim', 'N');
                this.$swal({
                    title: "Harap Menunggu",
                    text: "Sedang Memproses Permintaan",
                    imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                    imageHeight: 100,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                axios.post('/api/campaigns/' + app.path + '/donasisekarang',bodyParameters,config).then((res) => 
                {
                    this.$swal({
                        title: 'Berhasil!',
                        text: res.data.message,
                        type: 'success'
                    }).then((result) => { 
                        if (result.value) 
                        { 
                            location.reload();
                        }
                    });
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                    if(err.response.data.status == 1)
                        this.messages = 'Terjadi Kesalahan Pada Inputan Anda';
                    else
                        this.messages = err.response.data.message;
                    this.$swal({
                        position: 'top-end',
                        type: 'error',
                        title: this.messages,
                        showConfirmButton: false,
                        timer: 5000,
                        toast: true
                    });
                })
            }
        }
    }
</script>