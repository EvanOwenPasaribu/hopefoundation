<template>
    <router-link :to="{ name: 'detailfundraising', params: { id_fundraisingproduct: fundraisingproduct.id_fundraisingproduct }}">
        <div>
            <div class="card product">
                <a>
                    <div class="card-header p-0 product-header">
                        <img class="img-fluid img-product" :src="fundraisingproduct.fundraisingproductimages[0].fundraising_product_images_thumb">
                    </div>
                    <div class="card-body product-body">
                        <p>{{fundraisingproduct.product_name}}</p>
                        <p>Rp. {{ formatPrice(fundraisingproduct.fundraisingproductattributes[0].product_price_netto) }}</p>
                    </div>
                </a>
            </div>
        </div>
    </router-link>
</template>

<script>
    export default{
        mounted() {
            
        },
        props: ['fundraisingproduct'],
        methods:{
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
        }
    }
</script>