<template>
    <div class="container addpaddingtop addpaddingbottom">
        <div class="single-product">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="section-heading col-md-3">
                            <div class="line-dec"></div>
                            <h1>Detail Product</h1>
                        </div>
                        <div class="go-to-cart col-md-3">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-slider">
                    <div id="slider" class="flexslider">
                        <ul class="slides">
                        <li>
                            <img :src="'/images/testing/hope.jpg'" />
                        </li>
                        <li>
                            <img :src="'/images/testing/hope2.jpg'" />
                        </li>
                        <li>
                            <img :src="'/images/testing/hope3.jpg'" />
                        </li>
                        </ul>
                    </div>
                    
                    <div id="carousel" class="flexslider">
                        <ul class="slides">
                        <li>
                            <img :src="'/images/testing/hope.jpg'" />
                        </li>
                        <li>
                            <img :src="'/images/testing/hope2.jpg'" />
                        </li>
                        <li>
                            <img :src="'/images/testing/hope3.jpg'" />
                        </li>
                        <!-- items mirrored twice, total of 12 -->
                        </ul>
                    </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="right-content">
                    <h4>Kaos Hope</h4>
                    <h6>50000</h6>
                    <p>Produk Terjamin Bagus Dan Mantap</p>
                    <span>20 Stok Yang Tersedia</span>
                    <form action="" method="get">
                        <label for="quantity">Quantity:</label>
                        <input name="quantity" type="quantity" class="quantity-text" id="quantity" 
                            onfocus="if(this.value == '1') { this.value = ''; }" 
                            onBlur="if(this.value == '') { this.value = '1';}"
                            value="1">
                        <a v-on:click="addToCart()" class="btn btn-primary">Tambah Keranjang</a>
                        <input type="submit" class="button" value="Pesan Sekarang">
                    </form>
                    </div>
                </div>

                </div>
            </div>
            </div>
            <!-- Single Page Ends Here -->

            <!-- Similar Starts Here -->
            <div class="featured-items">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                    <div class="line-dec"></div>
                    <h1>You May Also Like</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">

                        <a href="single-product.html">
                            <div class="featured-item">
                            <img :src="'/images/testing/hope.jpg'" alt="Item 2">
                            <h4>kaos Hope</h4>
                            <h6>Rp. 50000</h6>
                            </div>
                        </a>
                        <a href="single-product.html">
                            <div class="featured-item">
                            <img :src="'/images/testing/hope2.jpg'" alt="Item 3">
                            <h4>kaos Hope</h4>
                            <h6>Rp. 50000</h6>
                            </div>
                        </a>
                        <a href="single-product.html">
                            <div class="featured-item">
                            <img :src="'/images/testing/hope3.jpg'" alt="Item 4">
                            <h4>kaos Hope</h4>
                            <h6>Rp. 50000</h6>
                            </div>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        components:{
            
        },
        data(){
            return{
                id_product: this.$route.params.id_fundraisingproduct,
                fundraisingproducts: [],
                fundraisingproductimages: [],
                datafundraisingproducts: [],
                testing : [],
            }
        },
        methods : {
            addToCart(){
                let bodyParameters = new FormData();
                var config = {
                    headers: {
                        'Authorization': "Bearer " + localStorage.usertoken,
                        'Content-Type': "multipart/form-data"
                    }
                };
                bodyParameters.append('id_product',this.id_product);

                axios.post('/api/addtocartfundraisingproduct',bodyParameters,config).then((res) => 
                {
                    this.$swal({
                        title: 'Berhasil Tambah Ke Keranjang!',
                        text: res.data.message,
                        type: 'success'
                    });
                })
                .catch((res) => {
                    this.handlerException(res)
                })
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/fundraisingproduct/'+app.path).then(function (res) {
                app.testing = res.data.data[0].fundraisingproductimages;
                app.fundraisingproducts = res.data.data;
            })
            .catch(function (res) {
                console.log(res);
            });

        }
        
    }
</script>