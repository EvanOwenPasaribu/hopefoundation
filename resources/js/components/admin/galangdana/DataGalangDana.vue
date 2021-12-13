<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Galang Dana</b></h3>
        <a :href="$router.resolve({ name: 'addgalangdanas' }).href" class="btn btn-primary marginbottom10px" style="width:max-content"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
        <table id="example4" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Judul Penggalangan</th>
                    <th>Deskripsi Singkat</th>
                    <th>Biaya Target</th>
                    <th>Jumlah Donatur</th>
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
            galangdanas: [],
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
        this.showGalangDanas()
        this.dataTable = $('#example4').DataTable({
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
            axios.delete('/api/admin/campaigns/' + id + '/delete',config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.dataTable.clear().draw()
                this.showGalangDanas()
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        pushUrl(id)
        {
            this.$router.push({
                name: 'editcampaigns', 
                params: { id_campaigns: id }
            });
        },
        pushUrlShowDetail(id)
        {
            this.$router.push({
                name: 'admindetailcampaigns', 
                params: { id_campaigns: id }
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
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        showGalangDanas(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/campaigns',config).then((res) => 
            {
                var i = 1;
                app.galangdanas = res.data.data
                app.galangdanas.forEach(galangdana=>{
                    app.dataTable.row.add([
                        i,
                        galangdana.category.category_description,
                        galangdana.campaigns_title,
                        galangdana.short_invitation,
                        this.formatPrice(galangdana.target_funds),
                        galangdana.donations.length,
                        '<a href="/admin/dashboard/campaigns/' + galangdana.raising_link + '"><i class="fas fa-fw fa-eye"></i><span>Lihat</span></a>',
                        '<a href="/admin/dashboard/campaigns/update/' + galangdana.id_campaigns + '"><i class="fas fa-fw fa-edit"></i><span>Ubah</span></a>',
                        '<a href="#" onclick="openModalDelete(' + galangdana.id_campaigns + ')"><i class="fas fa-fw fa-trash"></i><span>Hapus</span></a>',
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

