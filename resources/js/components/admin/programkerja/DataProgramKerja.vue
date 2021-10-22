<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Program Kerja</b></h3>
        <router-link :to="{name:'addprogramkerjas'}" class="btn btn-primary marginbottom10px" style="width:max-content"><i class="fas fa-fw fa-plus"></i> Tambah Data</router-link>
        <table id="example2" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Program Kerja</th>
                    <th>Jenis Program Kerja</th>
                    <th>Deskripsi Singkat</th>
                    <th>Diposting Oleh</th>
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
    data () {
        return {
            mixins: [ GlobalMethod ],
            isActive:this.$route.path,
            auth: localStorage.loggedin,
            programkerjas: [],
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
        this.showProgramkerjas()
        this.dataTable = $('#example2').DataTable({
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
            axios.delete('/api/admin/programkerjas/' + id + '/delete',config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear().draw()
                this.showProgramkerjas()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        pushUrl(id)
        {
            this.$router.push({
                name: 'editprogramkerjas', 
                params: { id_programkerja: id }
            });
        },
        pushUrlShowDetail(id)
        {
            this.$router.push({
                name: 'admindetailprogramkerjas', 
                params: { id_programkerja: id }
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
        showProgramkerjas(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/programkerjas',config).then((res) => 
            {
                var i = 1;
                app.programkerjas = res.data.data
                app.programkerjas.forEach(programkerja=>{
                    app.dataTable.row.add([
                        i,
                        programkerja.program_kerja_title,
                        programkerja.programkerjacategory.program_kerja_category_description,
                        programkerja.program_kerja_short_description,
                        programkerja.user.name,
                        '<a href="#" onclick="pushUrlShowDetail(' + programkerja.id_programkerja + ')"><i class="fas fa-fw fa-eye"></i><span>Lihat</span></a>',
                        '<a href="#" onclick="pushUrl(' + programkerja.id_programkerja + ')"><i class="fas fa-fw fa-edit"></i><span>Ubah</span></a>',
                        '<a href="#" onclick="openModalDelete(' + programkerja.id_programkerja + ')"><i class="fas fa-fw fa-trash"></i><span>Hapus</span></a>',
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

