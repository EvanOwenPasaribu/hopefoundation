<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Verifikasi Saldo</b></h3>
        <table id="example9" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Informasi Rekening Tujuan Transfer</th>
                    <th>Nominal Transaksi</th>
                    <th>Kode Unik</th>
                    <th>Total Nominal Transaksi</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</template>

<script>
import JQuery from 'jquery'
import {datatableboots} from './../../../../../../public/js/jquery.dataTables.min.js'
import {datatableboots2} from './../../../../../../public/js/dataTables.bootstrap4.min.js'
import GlobalMethod from './../../mixins/globalmethod'

let $ = JQuery

export default {
    mixins: [ GlobalMethod ],
    data () {
        return {
            isActive:this.$route.path,
            auth: localStorage.loggedin,
            datasaldo: [],
            dataTable:null,
        }
    },
    components:{
    },
    created(){
        window.openModalTerima=this.openModalTerima
        window.openModalTolak=this.openModalTolak
    },
    mounted() {
        this.showDataIsiSaldo()
        this.dataTable = $('#example9').DataTable({
            "scrollX": true
        })
    },
    methods:{
        showDataIsiSaldo(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/dataisisaldo',config).then((res) => 
            {
                var i = 1;
                app.datasaldo = res.data.data
                app.datasaldo.forEach(ds=>{
                    app.dataTable.row.add([
                        i,
                        ds.transaction_code,
                        ds.paymentmethoddetails.description_payment_detail + '<br>' + ds.paymentmethoddetails.method_detail_name + '<br>' + 'A.N. ' + ds.paymentmethoddetails.atasnama,
                        'Rp. ' + app.formatPrice(ds.nominaltransaction),
                        ds.kodeunik,
                        'Rp. ' + app.formatPrice(+ds.nominaltransaction + +ds.kodeunik),
                        '<a href="#" onclick="openModalTolak(' + ds.id_transactionbalance + ')"><i class="fas fa-fw fa-times"></i><span>Tolak</span></a>',
                        '<a href="#" onclick="openModalTerima(' + ds.id_transactionbalance + ')"><i class="fas fa-fw fa-check"></i><span>Terima</span></a>',
                    ]).draw(false) 
                    i++
                }) 
            })
            .catch((res) => {
                 this.handlerException(res)
            })
        },
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        openModalTerima(id)
        {
            this.$swal({
                title: "Verifikasi penerimaan isi saldo?",
                text: "Apabila tombol terima ditekan, maka saldo user akan bertambah",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Terima",
                closeOnConfirm: false,
            }).then((result) => { 
                if (result.value) 
                { 
                    this.terimaData(id)
                }
            });
        },
        terimaData(id){
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/dataisisaldo/' + id + '/terimaisisaldo',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear().draw()
                this.showDataIsiSaldo()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        openModalTolak(id)
        {
             this.$swal({
                title: "Verifikasi penolakan isi saldo?",
                text: "Apabila tombol tolak ditekan, maka status isi saldo akan berubah",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Tolak",
                closeOnConfirm: false,
            }).then((result) => { 
                if (result.value) 
                { 
                    this.tolakData(id)
                }
            });
        },
        tolakData(id){
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/dataisisaldo/' + id + '/tolakisisaldo',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear().draw()
                this.showDataIsiSaldo()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },

    }
}
</script>

