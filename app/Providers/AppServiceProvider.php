<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\ProgramKerjaCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $programkerjacategory = ProgramKerjaCategory::get();
		view()->composer('*', function($view) use($programkerjacategory){
        	$view->with(['programkerjacategory'=>$programkerjacategory]);
    	});
    }
}
