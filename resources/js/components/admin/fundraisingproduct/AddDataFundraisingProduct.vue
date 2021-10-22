b<template>
    <div class="wrapper-nav-side">
        <h3><b>Add Fundraising Product</b></h3>
        <div class="add-product">
            <table>
                <tr>
                    <td>Nama Barang</td>
                    <td><input type="text" id="stokbarang" v-model="nama" class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><textarea id="deskripsi" v-model="deskripsi" class="product-description form-control form-control-sm"></textarea></td>
                </tr> 
                <tr v-if='!fundraisingattributecolour.length && !fundraisingattributesize.length'>
                    <td>Harga</td>
                    <td><input type="text" id="hargabarang"  v-model="harga" class="form-control form-control-sm"></td>
                </tr> 
                <tr v-if='!fundraisingattributecolour.length && !fundraisingattributesize.length'>
                    <td>Stok</td>
                    <td><input type="text"  v-model="stok" class="form-control form-control-sm"></td>
                </tr>
                <tr>
                    <td>Warna</td>
                    <td>
                        <div v-for="(item,i) in fundraisingattributecolour">
                            <div class="fundraising-color-attr">
                                <input placeholder="Masukkan Warna, Contoh : Merah" v-model="fundraisingattributecolour[i].colour" :id="`warna${item}`" style="margin:0px 0px 5px 0px" type="text" class="form-control form-control-sm">
                                <img  v-on:click="deleteColourVariation(i)" src="/images/icon/icon_delete.png">
                            </div>
                        </div>
                        <div class="box-variasi"  v-on:click='addColourVariation'>
                            <i data-v-6236d21b="" class="hope-icon-upload">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.387 5.807a.387.387 0 1 0-.774 0v5.806H5.806a.387.387 0 1 0 0 .774h5.807v5.807a.387.387 0 1 0 .774 0v-5.807h5.807a.387.387 0 1 0 0-.774h-5.807V5.807z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24c6.627 0 12-5.373 12-12S18.627 0 12 0 0 5.373 0 12s5.373 12 12 12zm0-.774c6.2 0 11.226-5.026 11.226-11.226C23.226 5.8 18.2.774 12 .774 5.8.774.774 5.8.774 12 .774 18.2 5.8 23.226 12 23.226z"></path></svg>
                            </i> Tambah Warna
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Ukuran</td>
                    <td>
                        <div v-for="(item,i) in fundraisingattributesize">
                            <div class="fundraising-color-attr">
                                <input placeholder="Masukkan Ukuran, Contoh : XL" v-model="fundraisingattributesize[i].size" :id="`size${item}`" style="margin:0px 0px 5px 0px" type="text" class="form-control form-control-sm">
                                <img  v-on:click="deleteSizeVariation(i)" src="/images/icon/icon_delete.png">
                            </div>
                        </div>
                        <div  class="box-variasi" v-on:click='addSizeVariation'>
                            <i data-v-6236d21b="" class="hope-icon-upload">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.387 5.807a.387.387 0 1 0-.774 0v5.806H5.806a.387.387 0 1 0 0 .774h5.807v5.807a.387.387 0 1 0 .774 0v-5.807h5.807a.387.387 0 1 0 0-.774h-5.807V5.807z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24c6.627 0 12-5.373 12-12S18.627 0 12 0 0 5.373 0 12s5.373 12 12 12zm0-.774c6.2 0 11.226-5.026 11.226-11.226C23.226 5.8 18.2.774 12 .774 5.8.774.774 5.8.774 12 .774 18.2 5.8 23.226 12 23.226z"></path></svg>
                            </i> Tambah Ukuran
                        </div>
                    </td>
                </tr>     
            </table>

            <div class="list-variation" v-if='fundraisingattributecolour.length || fundraisingattributesize.length'>
                <h5>Daftar Variasi</h5>
                <table class="table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col" v-if='fundraisingattributecolour.length'>Warna</th>
                            <th scope="col" v-if='fundraisingattributesize.length'>Size</th>
                            <th class="col-harga" scope="col">Harga (Rp)</th>
                            <th class="col-stok" scope="col">Stok</th>
                        </tr>
                    </thead>
                    <tbody v-if='fundraisingattributecolour.length && !fundraisingattributesize.length' v-for="(item,i) in fundraisingattributecolour">
                        <tr>
                            <td>{{fundraisingattributecolour[i].colour}}</td>
                            <td class="col-harga"><input class="text-center" v-model="fundraisingattributecolour[i].harga" type="number" min="0" value="0" id="hargabarangvariation"></td>
                            <td class="col-stok"><input class="text-center" v-model="fundraisingattributecolour[i].stok" type="number" min="0" value="0" id="stokbarangvariation"></td>
                        </tr>
                    </tbody>

                    <tbody v-if='!fundraisingattributecolour.length && fundraisingattributesize.length' v-for="(item,i) in fundraisingattributesize">
                        <tr>
                            <td>{{fundraisingattributesize[i].size}}</td>
                            <td class="col-harga"><input class="text-center" v-model="fundraisingattributesize[i].harga" type="number" min="0" value="0" id="hargabarangvariation"></td>
                            <td class="col-stok"><input class="text-center" v-model="fundraisingattributesize[i].stok" type="number" min="0" value="0" id="stokbarangvariation"></td>
                        </tr>
                    </tbody>

                    <tbody v-if='fundraisingattributecolour.length && fundraisingattributesize.length'>
                        <template v-for="(itemC,i) in fundraisingattributecolour.length">
                            <template v-for="(itemS,j) in fundraisingattributesize.length">
                                <tr>
                                    <td v-if="!j" :rowspan="fundraisingattributesize.length">{{fundraisingattributecolour[i].colour}}</td>
                                    <td>{{fundraisingattributesize[j].size}}</td>
                                    <td class="col-harga"><input class="text-center" v-model="fundraisingproducts[(i*fundraisingattributesize.length)+j].harga" type="number" min="0" value="0" id="hargabarangvariation"></td>
                                    <td class="col-stok"><input class="text-center" v-model="fundraisingproducts[(i*fundraisingattributesize.length)+j].stok" type="number" min="0" value="0" id="stokbarangvariation"></td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="upload-image">
                <h5>Gambar Produk</h5>
                <div class="box-upload-container">
                    <span v-for="(item,i) in selectedImg">
                    {{item}}
                    <div  class="box-image" v-bind:style="{'background-image':'url(' + item + ')'}">
                        <i v-if="!selectedImg[i]" data-v-6236d21b="" class="hope-icon-upload">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.387 5.807a.387.387 0 1 0-.774 0v5.806H5.806a.387.387 0 1 0 0 .774h5.807v5.807a.387.387 0 1 0 .774 0v-5.807h5.807a.387.387 0 1 0 0-.774h-5.807V5.807z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24c6.627 0 12-5.373 12-12S18.627 0 12 0 0 5.373 0 12s5.373 12 12 12zm0-.774c6.2 0 11.226-5.026 11.226-11.226C23.226 5.8 18.2.774 12 .774 5.8.774.774 5.8.774 12 .774 18.2 5.8 23.226 12 23.226z"></path></svg>
                        </i>
                        <input type="file" @change="uploadImage($event)" name="file" accept="image/*" multiple="multiple" aspect="1" class="input_file">
                    </div>
                    </span>
                </div>
            </div>

            <button v-on:click='handleImageAdded' class="btn btn-primary mt-4">Upload Produk</button>

        </div>
    </div>
</template>

<script>
import GlobalMethod from './../mixins/globalmethod'

export default {
    mixins: [ GlobalMethod ],
    data(){
        return{
            nama:"",
            deskripsi: "",
            harga: "",
            stok:"",
            fundraisingproducts: [],
            fundraisingattributecolour: [],
            fundraisingattributesize: [],
            selectedImg : [null,null,null,null]
        }
    },
    components:{
    },
    methods : {
        addColourVariation(){
            let product = {
                colour:"",
                harga:0,
                stok:0
            }
            this.fundraisingattributecolour.push(product);
            this.addProductComplete()
        },
        deleteColourVariation(index){
            this.fundraisingattributecolour.splice(index, 1);
            this.addProductComplete()
        },
        addSizeVariation(){
            let product = {
                size:"",
                harga:0,
                stok:0
            }
            this.fundraisingattributesize.push(product);
            this.addProductComplete()
        },
        deleteSizeVariation(index){
            this.fundraisingattributesize.splice(index, 1);
            this.addProductComplete()
        },
        addProductComplete(){
            this.fundraisingproducts = []
            for(let i=0;i<this.fundraisingattributecolour.length;i++){
                for(let j=0;j<this.fundraisingattributesize.length;j++){
                    let product = {
                        colour:this.fundraisingattributecolour[i].colour,
                        size:this.fundraisingattributesize[j].size,
                        harga:0,
                        stok:0
                    }
                    this.fundraisingproducts.push(product);
                }
            }
        },
        uploadImage(event){
            this.selectedImg[0] = URL.createObjectURL(event.target.files[0])
            this.image = event.target.files[0];
            console.log(this.selectedImg)
            this.selectedImg[0] = "null"
        }, 
        handleImageAdded() 
        {
            var formData = new FormData();
            for(let i=0;i<this.image.length;i++){

            }
            formData.append("image", this.image[0]);
        
            axios({
                url: "/api/imagesfundraisingonupload",
                method: "POST",
                data: formData,
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            })
            .then(result => {
                let url = result.data.data.url; // Get url from response
                Editor.insertEmbed(cursorLocation, "image", url);
                resetUploader();
            })
            .catch(err => {
                this.handlerException(err)
            });
        },
        uploadProduct() {
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('nama',this.nama);
            bodyParameters.append('deskripsi', this.deskripsi);
            bodyParameters.append('harga', this.harga);
            bodyParameters.append('stok', this.stok);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/addfundraisingproduct',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.nama = "";
                this.deskripsi = "";
                this.stok = "";
                this.harga= "";
                this.handleImageAdded() 
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    },
    mounted() {
        
    }

}
</script>

