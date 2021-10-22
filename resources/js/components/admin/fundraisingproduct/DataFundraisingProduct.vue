<template>
    <div class="wrapper-nav-side">
        <h3><b>Data Fundraising Product</b></h3>
        <div class="search-admin-fundraising input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2">Cari</button>
        </div>

        <table class="table table-sm table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                  <tbody v-for="(fundraisingproduct, fp) in fundraisingproducts" :key="fp">
                    <tr>
                      <th scope="row">{{fp+1}}</th>
                      <td>{{fundraisingproduct.product_name}}</td>
                      <td>{{fundraisingproduct.created_at}}</td>
                      <td class="text-center"><img class="img-produk-thumb" :src="fundraisingproduct.fundraisingproductimages[0].fundraising_product_images_thumb"></td>
                      <td class="text-center"><a class="btn btn-primary">Edit</a>&nbsp;<a class="btn btn-danger">Delete</a></td>
                    </tr>
                  </tbody>
            </table>

            <div class="admin-add-product">
                <router-link class="navbar-brand" :to="{name:'adminaddfundraisingproducts'}"">
                    <a class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> Tambah Produk</a>
                </router-link>
            </div>

    </div>
</template>

<script>
export default {
    data(){
        return{
            fundraisingproducts: [],
            no:1
        }
    },
    components:{
    },
    mounted() {
        var app = this;
        axios.get('/api/fundraisingproduct').then(function (res) {
            app.fundraisingproducts = res.data.data
        })
        .catch(function (res) {
            console.log(res);
        });
    }
}
</script>

