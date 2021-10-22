<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Dokter</b></h3>
        <router-link :to="{name:'adddokters'}" class="btn btn-primary marginbottom10px" style="width:max-content"><i class="fas fa-fw fa-plus"></i> Tambah Data</router-link>
        <table id="example8" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Rumah Sakit/Klinik</th>
                    <th>Nama Dokter</th>
                    <th>Informasi Dokter</th>
                    <th></th>
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
            dokters: [],
            dataTable:null,
        }
    },
    components:{
    },
    created(){
        window.pushUrl=this.pushUrl
        window.openModalDelete=this.openModalDelete
        window.pushUrlShowDetail=this.pushUrlShowDetail
    },
    mounted() {
        this.showDokters()
        this.dataTable = $('#example8').DataTable({
            "scrollX": true
        })
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
            axios.delete('/api/admin/dokters/' + id + '/delete',config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear().draw()
                this.showDokters()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        pushUrl(id)
        {
            this.$router.push({
                name: 'editdokters', 
                params: { id_dokter: id }
            });
        },
        pushUrlShowDetail(id)
        {
            this.$router.push({
                name: 'admindetaildokters', 
                params: { id_dokter: id }
            });
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
        showDokters(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/dokters',config).then((res) => 
            {
                var i = 1;
                app.dokters = res.data.data
                app.dokters.forEach(dokter=>{
                    app.dataTable.row.add([
                        i,
                        dokter.rumahsakit.namarumahsakit,
                        dokter.namadokter,
                        dokter.spesialist + '<br>' + dokter.jadwalpraktek,
                        '<a href="#" onclick="pushUrlShowDetail(' + dokter.id_dokter + ')"><i class="fas fa-fw fa-eye"></i><span>Lihat</span></a>',
                        '<a href="#" onclick="pushUrl(' + dokter.id_dokter + ')"><i class="fas fa-fw fa-edit"></i><span>Ubah</span></a>',
                        '<a href="#" onclick="openModalDelete(' + dokter.id_dokter + ')"><i class="fas fa-fw fa-trash"></i><span>Hapus</span></a>',
                    ]).draw(false) 
                    i++
                }) 
            })
            .catch((res) => {
                 this.handlerException(res)
            })
        }
    }
}
</script>

