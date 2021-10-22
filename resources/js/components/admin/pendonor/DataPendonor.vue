<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Pendonor</b></h3>
        <router-link :to="{name:'addpendonors'}" class="btn btn-primary marginbottom10px" style="width:max-content"><i class="fas fa-fw fa-plus"></i> Tambah Data</router-link>
        <table id="example10" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pendonor</th>
                    <th>Golongan Darah</th>
                    <th>Nomor Handphone</th>
                    <th>Alamat Pendonor</th>
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
            pendonors: [],
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
        this.showPendonors()
        this.dataTable = $('#example10').DataTable({
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
            axios.delete('/api/admin/pendonors/' + id + '/delete',config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear().draw()
                this.showPendonors()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        pushUrl(id)
        {
            this.$router.push({
                name: 'editpendonors', 
                params: { id_dokter: id }
            });
        },
        pushUrlShowDetail(id)
        {
            this.$router.push({
                name: 'admindetailpendonors', 
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
        showPendonors(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/pendonors',config).then((res) => 
            {
                var i = 1;
                app.pendonors = res.data.data
                app.pendonors.forEach(pendonor=>{
                    var nomorhandphone2 = (pendonor.nomorhandphone2 == null) ? "" : pendonor.nomorhandphone2
                    app.dataTable.row.add([
                        i,
                        pendonor.namapendonor,
                        pendonor.golongandarah,
                        pendonor.nomorhandphone1 + '<br>' + nomorhandphone2,
                        pendonor.alamatpendonor,
                        '<a href="#" onclick="pushUrlShowDetail(' + pendonor.id_pendonor + ')"><i class="fas fa-fw fa-eye"></i><span>Lihat</span></a>',
                        '<a href="#" onclick="pushUrl(' + pendonor.id_pendonor + ')"><i class="fas fa-fw fa-edit"></i><span>Ubah</span></a>',
                        '<a href="#" onclick="openModalDelete(' + pendonor.id_pendonor + ')"><i class="fas fa-fw fa-trash"></i><span>Hapus</span></a>',
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

