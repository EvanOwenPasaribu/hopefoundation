<template>
    <div class="container addpaddingtop">
        <div class="row profile">
            <SideBarProfil/>
            <div class="col-md-9">
                <div class="profile-content">
                    <h4 class="text-black-100"><b>Isi Saldo/Balance</b></h4>
                    <hr>
                     <form class="form-group" v-on:submit.prevent="isisaldo">
                        <div class="form-group row">
                            <label for="jumlahtopup" class="col-sm-2 col-form-label text-black-100">Masukkan Nominal Top Up</label>
                            <div class="col-sm-10">
                                 <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="number" id="jumlahtopup" class="form-control input_user" placeholder="Masukkan Jumlah Nominal Top Up" name="jumlahtopup" v-model="jumlahtopup">
                                </div>
                                <span v-if="errors.jumlahtopup" :class="['label label-danger']">{{ errors.jumlahtopup[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="metodepembayaran" class="col-sm-2 col-form-label text-black-100">Metode Pembayaran</label>
                            <div class="col-sm-10">
                                 <div class="input-group mb-3">
                                    <select class="form-control" name="paymentmethod" v-model="paymentmethod">
                                        <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                        <optgroup v-for="(paymentmethod, pm) in paymentmethods" :key="pm" :label="paymentmethod.method_name">
                                            <option v-for="(paymentmethoddetail, pmd) in paymentmethod.paymentmethoddetails" :key="pmd" :value="paymentmethoddetail.id_paymentmethoddetail">{{paymentmethoddetail.method_detail_name}}</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <span v-if="errors.paymentmethod" :class="['label label-danger']">{{ errors.paymentmethod[0] }}</span>
                               <div class="row project-button-without-padding float-right">
                                    <button type="submit" class="btn btn-primary py-3 px-4" style="width:max-content">ISI SALDO</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SideBarProfil from './../layouts/SideBarProfil.vue'

    export default{
        mounted(){
            var app = this;
            axios.get('/api/paymentmethods?payment_code=BL').then(function (res) {
                app.paymentmethods = res.data.data
            })
            .catch(function (res) {
                console.log(res);
            });
        },
        data(){
            return{
                jumlahtopup: '',
                paymentmethod: '',
                paymentmethods: [],
                errors: [],
                messages: ''
            }
        },
        methods: {
            isisaldo(){
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
                bodyParameters.append('jumlahtopup', this.jumlahtopup);
                this.$swal({
                    title: "Harap Menunggu",
                    text: "Sedang Memproses Permintaan",
                    imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                    imageHeight: 100,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                axios.post('/api/isisaldo',bodyParameters,config).then((res) => 
                {
                    this.$swal({
                        title: 'Berhasil!',
                        text: res.data.message,
                        type: 'success'
                    }).then((result) => { 
                        if (result.value) 
                        { 
                            this.paymentmethod = "";
                            this.jumlahtopup = "";
                            this.$router.push({
                                name: 'detailtransfer', 
                                params: { id_transactionbalance: res.data.data.id_transactionbalance }
                            });
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
        },
        components:{
            'SideBarProfil': SideBarProfil
        }
    }
</script>