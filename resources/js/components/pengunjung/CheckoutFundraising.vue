<template>
    <div class="container addpaddingtop addpaddingbottom">
        <div class="checkout-fund-cont">
            <div class="row">
                <div class="checkout col-md-8">

                    <div class="checkout-inner">
                        <h3 class="checkout-title">Checkout</h3>
                        <h5 class="checkout-address-title">Alamat Pengiriman</h5>

                        <div class = "address-box">
                            <table>
                                <tr>
                                    <td>Nama Penerima</td> 
                                    <td>:</td> 
                                    <td><input class="form-control form-control-sm" type="text"></td>
                                </tr>
                                <tr>
                                    <td>Nomor HP</td>
                                    <td>:</td> 
                                    <td><input class="form-control form-control-sm" type="text"></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td> 
                                    <td><textarea class="form-control form-control-sm"></textarea></td>
                                </tr>
                            </table>
                        </div>

                        <h5 class="checkout-orders-title">Pesanan</h5>
                        
                        <div class="one-item-checkout">
                            <label class="checkbox-all">
                                <div class="image-wrap">
                                    <h5 class="item-number">1. </h5>
                                    <img class="img-fluid img-cart" :src="'/images/testing/hope.jpg'">
                                    <div class="text-image">
                                        <p class="text-name"> Baju Dengan Motif Hope </p>
                                        <p class="text-sum"> 1 Barang </p>
                                        <p class="text-price"> Rp. 50000 </p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="one-item-checkout">
                            <label class="checkbox-all">
                                <div class="image-wrap">
                                    <h5 class="item-number">2. </h5>
                                    <img class="img-fluid img-cart" :src="'/images/testing/hope2.jpg'">
                                    <div class="text-image">
                                        <p class="text-name"> Baju Dengan Motif Batak </p>
                                        <p class="text-sum"> 1 Barang </p>
                                        <p class="text-price"> Rp. 30000 </p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="one-item-checkout">
                            <label class="checkbox-all">
                                <div class="image-wrap">
                                    <h5 class="item-number">3. </h5>
                                    <img class="img-fluid img-cart" :src="'/images/testing/hope3.jpg'">
                                    <div class="text-image">
                                        <p class="text-name"> Baju Dengan Motif Batak </p>
                                        <p class="text-sum"> 1 Barang </p>
                                        <p class="text-price"> Rp. 40000 </p>
                                    </div>
                                </div>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="detail-checkout col-md-4">
                    <div class="detail-checkout-inner">
                        <h4> Ringkasan Belanja </h4>

                        <div class="detail-total">
                            <p> Total Tagihan</p>
                            <p> Rp. 110000 </p>
                        </div>

                        <div class="detail-pengiriman">
                            <p> Total Ongkos Kirim</p>
                            <p> Rp. 50000 </p>
                        </div>

                        <select class="form-select" aria-label="Default select example">
                            <option selected>Metode Pengiriman</option>
                            <option value="jnt">J&T</option>
                            <option value="jne">JNE</option>
                            <option value="pos">Pos</option>
                            <option value="sicepat">Sicepat</option>
                          </select>

                        <a class='detail-button btn btn-primary'> Pilih Pembayaran </a>

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
                checkedProducs : [],
                totalHarga : 0,
                fundraisingproducts: [],
                fundraisingproductimages: [],
                cartproducts: [],
                data : [],
            }
        },
        methods:{
            hitungTotal() {
                for(let i=0;i<this.checkedProducs.length;i++) {
                    console.log("YE");
                    this.totalHarga += parseInt(this.checkedProducs[i]);
                }
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/fundraisingproduct/my/cart').then(function (res) {
                app.cartproducts = res.data.data[0];
                console.log((app.cartproducts[0]));
            })
            .catch(function (res) {
                console.log(res);
            });
        }
        
    }
</script>