<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'cors'], function () {
    Route::post('login', 'LoginRegisterController@login');
    Route::post('register', 'LoginRegisterController@register');    
    Route::post('logout', 'LoginRegisterController@logout');
    Route::get('user', 'LoginRegisterController@getAuthUser');
    Route::get('verifyemail/{token}', 'LoginRegisterController@verifyEmail');
    Route::post('resend', 'LoginRegisterController@resend');
    Route::post('resetpassword', 'LoginRegisterController@resetpassword');
    Route::post('resetpassword/{tokenresetpassword}', 'LoginRegisterController@postresetpassword');
    Route::post('contactus', 'AnotherNotImportantController@postContactUs');  
    Route::get('category', 'CategoryController@index');
    Route::get('programkerjacategory', 'ProgramKerjaCategoryController@index');
    Route::get('campaigns/{raising_link}', 'CampaignsController@show');
    Route::post('campaigns/registration', 'CampaignsController@store');
    Route::get('campaigns/all/frontimportant', 'CampaignsController@frontImportantCampaign');
    Route::get('paymentmethods', 'PaymentMethodController@index');
    Route::post('campaigns/{raising_link}/donasisekarang', 'DonationController@donation');
    Route::get('fundraisingproduct', 'FundraisingProductController@index');
    Route::post('addfundraisingproduct', 'FundraisingProductController@addProduct');
    Route::post('imagesfundraisingonupload', 'FundraisingProductController@uploadImage');
    Route::get('event', 'EventController@index');
    Route::get('event/{id_event}', 'EventController@getdetaileventpengunjung');
    Route::get('campaigns/all/search', 'CampaignsController@search');
    Route::get('programkerja/{program_kerja_url}', 'ProgramKerjaController@showByCategory');
    Route::get('programkerja/{program_kerja_url}/{id_programkerja}', 'ProgramKerjaController@getdetailprogramkerjapengunjung');
    Route::get('informasikesehatan', 'InformasiKesehatanController@index');
    Route::get('informasikesehatan/{id_informasikesehatan}', 'InformasiKesehatanController@getdetailinformasikesehatanpengunjung');
    Route::get('welcomecount', 'AnotherNotImportantController@welcomecount');

    Route::get('dokter', 'DokterController@index');
    Route::get('dokter/{id_dokter}', 'DokterController@getdetaildokterpengunjung');
    Route::get('dokter/{id_rumahsakit}/show', 'DokterController@indexbyid');


    Route::get('rumahsakit', 'RumahSakitController@index');
    Route::get('rumahsakit/{id_rumahsakit}', 'RumahSakitController@getdetailrumahsakitpengunjung');

    Route::post('isisaldo', 'TransaksiController@isisaldo');
    Route::get('instruksipembayaran/{id_transactionbalance}', 'TransaksiController@instruksipembayaran');
    

    Route::get('kotas', 'KotaController@index');

    Route::post('vaksinasi', 'VaksinasiController@postVaksinasi');
    
    Route::post('cektanggalvaksin', 'VaksinasiController@postCekTanggalVaksin');

    Route::prefix('admin')->group(function () {
        Route::get('events', 'EventController@adminindex');
        Route::post('events/imagesdescriptionupload', 'EventController@eventuploadimage');
        Route::post('events/add', 'EventController@addevent');
        Route::get('events/{id}/edit', 'EventController@geteditevent');
        Route::post('events/{id}/edit', 'EventController@editevent');
        Route::delete('events/{id}/delete', 'EventController@deleteevent');
        Route::get('events/{id}', 'EventController@getdetailevent');
        Route::get('templates', 'AnotherNotImportantController@templateWebsite');
        Route::post('templates', 'AnotherNotImportantController@postTemplateWebsite');
        Route::post('templates/imagesdescriptionupload', 'AnotherNotImportantController@templatesuploadimage');
        
        Route::get('programkerjas', 'ProgramKerjaController@adminindex');
        Route::post('programkerjas/imagesdescriptionupload', 'ProgramKerjaController@programkerjauploadimage');
        Route::post('programkerjas/add', 'ProgramKerjaController@addprogramkerja');
        Route::get('programkerjas/{id}/edit', 'ProgramKerjaController@geteditprogramkerja');
        Route::post('programkerjas/{id}/edit', 'ProgramKerjaController@editprogramkerja');
        Route::delete('programkerjas/{id}/delete', 'ProgramKerjaController@deleteprogramkerja');
        Route::get('programkerjas/{id}', 'ProgramKerjaController@getdetailprogramkerja');
        
        Route::get('programkerjacategorys', 'ProgramKerjaCategoryController@adminindex');
        Route::post('programkerjacategorys/add', 'ProgramKerjaCategoryController@addprogramkerjacategory');
        Route::get('programkerjacategorys/{id}/edit', 'ProgramKerjaCategoryController@geteditprogramkerjacategory');
        Route::patch('programkerjacategorys/{id}/edit', 'ProgramKerjaCategoryController@editprogramkerjacategory');
        Route::delete('programkerjacategorys/{id}/delete', 'ProgramKerjaCategoryController@deleteprogramkerjacategory');
        
        Route::get('campaigns', 'CampaignsController@adminindex');
        Route::post('campaigns/imagesdescriptionupload', 'CampaignsController@campaignuploadimage');
        Route::delete('campaigns/{id}/delete', 'CampaignsController@deletecampaigns');

        Route::get('donaturs', 'DonaturController@adminindex');
        Route::get('donaturs/{id}/terimavoucher', 'DonaturController@terimavoucher');
        Route::delete('donaturs/{id}/delete', 'DonaturController@deletedonatur');
        
        Route::get('informasikesehatans', 'InformasiKesehatanController@adminindex');
        Route::post('informasikesehatans/imagesdescriptionupload', 'InformasiKesehatanController@informasikesehatanuploadimage');
        Route::post('informasikesehatans/add', 'InformasiKesehatanController@addinformasikesehatan');
        Route::get('informasikesehatans/{id}/edit', 'InformasiKesehatanController@geteditinformasikesehatan');
        Route::post('informasikesehatans/{id}/edit', 'InformasiKesehatanController@editinformasikesehatan');
        Route::delete('informasikesehatans/{id}/delete', 'InformasiKesehatanController@deleteinformasikesehatan');
        Route::get('informasikesehatans/{id}', 'InformasiKesehatanController@getdetailinformasikesehatan');
       
        Route::get('rumahsakits', 'RumahSakitController@adminindex');
        Route::post('rumahsakits/add', 'RumahSakitController@addrumahsakit');
        Route::get('rumahsakits/{id}/edit', 'RumahSakitController@geteditrumahsakit');
        Route::post('rumahsakits/{id}/edit', 'RumahSakitController@editrumahsakit');
        Route::delete('rumahsakits/{id}/delete', 'RumahSakitController@deleterumahsakit');

        Route::get('dokters', 'DokterController@adminindex');
        Route::post('dokters/add', 'DokterController@adddokter');
        Route::get('dokters/{id}/edit', 'DokterController@geteditdokter');
        Route::post('dokters/{id}/edit', 'DokterController@editdokter');
        Route::delete('dokters/{id}/delete', 'DokterController@deletedokter');
        Route::get('dokters/{id}', 'DokterController@getdetaildokter');

        Route::get('dataisisaldo', 'TransaksiController@adminindex');
        Route::post('dataisisaldo/{id_transactionbalance}/terimaisisaldo', 'TransaksiController@terimaisisaldo');
        Route::post('dataisisaldo/{id_transactionbalance}/tolakisisaldo', 'TransaksiController@tolakisisaldo');
    
        Route::get('pendonors', 'PendonorController@adminindex');
        Route::post('pendonors/add', 'PendonorController@addpendonor');
        Route::get('pendonors/{id}/edit', 'PendonorController@geteditpendonor');
        Route::post('pendonors/{id}/edit', 'PendonorController@editpendonor');
        Route::delete('pendonors/{id}/delete', 'PendonorController@deletependonor');
        Route::get('pendonors/{id}', 'PendonorController@getdetailpendonor');

    });
});
