<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Helpers/ProductHelper.php';
        require_once __DIR__ . '/../Helpers/DashboardHelper.php';
        require_once __DIR__ . '/../Helpers/GlobalFunctions.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive( 'currency' , function ( $expression ) {
            return "Rp <?php echo number_format( $expression, 0, ',', '.' ); ?>";
        });

        Blade::directive( 'status_indonesia' , function ( $expression ) {
            if( $expression == "Active" ):
                return "Aktif";
            else:
                return "Tidak Aktif";
            endif;
        });
    }
}
