<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundraisingProduct;
use App\FundraisingProductAttributes;
use App\FundraisingProductImages;
use JWTAuth;
class FundraisingProductController extends Controller
{
    public function index()
    {
        $data = FundraisingProduct::with(['fundraisingproductattributes','fundraisingproductimages'])->orderby('id_fundraisingproduct','DESC')->get();
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => $data
        ], 200);
    }

    public function addProduct(Request $request) {
        $this->user = JWTAuth::parseToken()->authenticate();
        $produk = new FundraisingProduct();
        $produk->id = $this->user->id;
        $produk->product_name = $request->nama;
        $produk->description_product = $request->deskripsi;
        $produk->is_active = "Y";
        $produk->fundraising_product_is_deleted = "N";
        $produk->save();

        $produkAttr = new FundraisingProductAttributes();
        $idFundraisingProduct = FundraisingProduct::orderby('id_fundraisingproduct','DESC')->first()->id_fundraisingproduct;
        $produkAttr->id_fundraisingproduct = $idFundraisingProduct;
        $produkAttr->product_price_netto =  $request->harga;
        $produkAttr->product_price_gross = $request->harga;
        $produkAttr->disc_percentage = 0;
        $produkAttr->product_weight = 0;
        $produkAttr->stock = $request->stok;
        $produkAttr->min_order = 1;
        $produkAttr->attribute_string = "";
        $produkAttr->attribute_string_value = "";
        $produkAttr->is_default= "Y";
        $produkAttr->fundraising_product_attributes_is_deleted= "N";   
        $produkAttr->save();

        return response()->json([
            'code' => 200,
            'message' => 'Data Produk Berhasil  Di Insert',
            'status' => 0,
            'data' => (object) array()
        ], 200);
    }

    public function uploadImage(Request $request) {
        $idFundraisingProduct = FundraisingProduct::orderby('id_fundraisingproduct','DESC')->first()->id_fundraisingproduct;
        $this->user = JWTAuth::parseToken()->authenticate();
        $tujuan_upload = 'images/fundraisingproduct/';
        $tujuan_upload2 = 'images/fundraisingproduct/thumbs/';

        $namafile = $idFundraisingProduct . date('Ymdhis') . '.jpg';
        //$request->file('image')->move($tujuan_upload2,$namafile);
        $request->file('image')->move($tujuan_upload,$namafile);
        copy($tujuan_upload.$namafile, $tujuan_upload2.$namafile);

        $fundraisingImage = new FundraisingProductImages();
        $fundraisingImage->id_fundraisingproduct = $idFundraisingProduct;
        $fundraisingImage->fundraising_product_images = "/".$tujuan_upload . $namafile;
        $fundraisingImage->fundraising_product_images_thumb = "/".$tujuan_upload2 . $namafile;
        $fundraisingImage->is_default = "Y";
        $fundraisingImage->fundraising_product_images_is_deleted = "N";
        $fundraisingImage->save();
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => [
                'url' =>  '/' . $tujuan_upload . '/' . $this->user->id . date('Ymdhis') . '.jpg'
            ]
        ], 200);
    }


}
