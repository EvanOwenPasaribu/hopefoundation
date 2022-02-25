<template>
    <div class="container addpaddingtop addpaddingbottom">
        <h2 class="text-center">Fundraising Product</h2>
        <h6 class="text-center">Silahkan Beli Produk-Produk Yang Dijual Hope Foundation</h6>
        <hr>

        <div class="search-user-fundraising input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2">Cari</button>
        </div>

        <div class="row">
            <div style="padding:10px" class="col-md-4">
                <div style="border:2px solid #7BBA43;height:400px">
                    <h4>Video 1</h4>
                </div>
            </div>
            <div style="padding:10px" class="col-md-4">
                <div style="border:2px solid #7BBA43;height:400px">
                    <h4>Video 2</h4>
                </div>
            </div>
            <div style="padding:10px" class="col-md-4">
                <div style="border:2px solid #7BBA43;height:400px">
                    <h4>Video 3</h4>
                </div>
            </div>
        </div>

        <div class="row fundraising-product">
            <div class="col-md-2 col-sm-3 col-4 d-inline-block" v-for="(fundraisingproduct, fp) in fundraisingproducts" :key="fp"">
                <FundraisingCardProduct v-bind:fundraisingproduct="fundraisingproduct"/>
            </div>
        </div>
    </div>
</template>

<script>
    import FundraisingCardProduct from './FundraisingCardProduct.vue'

    export default{
        components:{
            'FundraisingCardProduct': FundraisingCardProduct
        },
        data(){
            return{
                fundraisingproducts: []
            }
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