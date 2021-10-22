<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Donatur</b></h3>
        <table id="example5" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor Handphone</th>
                    <th>Status Penerimaan</th>
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
import {datatableboots} from './../../../../../public/js/jquery.dataTables.min.js'
import {datatableboots2} from './../../../../../public/js/dataTables.bootstrap4.min.js'
import GlobalMethod from './../mixins/globalmethod'

let $ = JQuery

export default {
    mixins: [ GlobalMethod ],
    data () {
        return {
            isActive:this.$route.path,
            auth: localStorage.loggedin,
            donaturs: [],
            dataTable:null,
        }
    },
    components:{
    },
    mounted() {
        this.showDonatur()
        this.dataTable = $('#example5').DataTable({
            "scrollX": true
        })
    },
    created(){
        window.terimaVoucher=this.terimaVoucher
        window.openModalDelete=this.openModalDelete
    },
    methods:{
        deleteData(id){
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
            axios.delete('/api/admin/donaturs/' + id + '/delete',config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear().draw()
                this.showDonatur()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        openModalDelete(id)
        {
            this.$swal({
                title: "Hapus data?",
                text: "Data akan hilang dan tidak bisa direstore.",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                closeOnConfirm: false,
            }).then((result) => { 
                if (result.value) 
                { 
                    this.deleteData(id)
                }
            });
            
        },
        terimaVoucher(id){
            var app = this;
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
            axios.get('/api/admin/donaturs/' + id + '/terimavoucher',config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear()
                this.showDonatur()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        showDonatur(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/donaturs',config).then((res) => 
            {
                var i = 1;
                var statuspenerimaan = "";
                var buttonvoucher = "";
                app.donaturs = res.data.data
                app.donaturs.forEach(donatur=>{
                    if(donatur.status_penerimaan == "1")
                    {
                        statuspenerimaan = "Sudah Diterima"
                        buttonvoucher = ''
                    }
                    else
                    {
                        statuspenerimaan = "Belum Diterima"
                        buttonvoucher = '<a href="#" onclick="terimaVoucher(' + donatur.id + ')"><i class="fas fa-fw fa-id-card"></i><span>Terima</span></a>'
                    }
                    app.dataTable.row.add([
                        i,
                        donatur.name,
                        donatur.email,
                        donatur.nomorhp,
                        statuspenerimaan,
                        '<a href="#" onclick="openModalDelete(' + donatur.id + ')"><i class="fas fa-fw fa-trash"></i><span>Hapus</span></a>',
                        buttonvoucher,
                    ]).draw(false) 
                    i++
                }) 
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    },
}
</script>

