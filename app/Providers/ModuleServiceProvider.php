<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $modulesPath = base_path('modules');
        $modules = File::directories($modulesPath);

        foreach ($modules as $module){
            $moduleConfig = $module . '/module.json';


            if(File::exists($moduleConfig)){
                $config = json_decode(File::get($moduleConfig), true);


                if(isset($config["status"]) && $config['status'] === "active" ){
                    $this->loadModule($module);
                }
            }

        }

    }

    public function loadModule($modulePath)
    {
//        Load routes
        $routesFile = $modulePath . '/routes.php';
        if(File::exists($routesFile)){
            $this->loadRoutesFrom($routesFile);
        }

//        Load Views
        $viewsPath = $modulePath . '/Views';
        if (File::isDirectory($viewsPath)){
            $this->loadViewsFrom($viewsPath, basename($modulePath));
        }

//  load Models

        $migrationsPath = $modulePath . '/Migrations';
        if(File::isDirectory($migrationsPath)){
            $this->loadMigrationsFrom($migrationsPath);
        }


    }


}
