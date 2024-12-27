<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ModulesController extends Controller
{

    public function index()
    {
        $modulesPath =  base_path('modules');

        $modules = [];

//        Scan Modules
        foreach (File::directories($modulesPath) as $module){
            $configFile = $module . '/module.json';

            if(File::exists($configFile)){
                $config = json_decode(File::get($configFile), true);

                $modules[] = [
                    'name'=> $config['name'] ?? basename($module),
                    'description' => $config['description'] ?? 'No description available',
                    'status' => $config['status'] ?? 'inactive',
                    'path' => $module,
                ];

            }
        }




        return view('modules.index', compact('modules'));
    }


    public function toggle(Request $request, $moduleName)
    {
        $modulePath = base_path("modules/$moduleName/module.json");

        if(File::exists($modulePath)){
            $config = json_decode(File::get($modulePath), true);
            $config["status"] = ($config["status"] === "active"? "inactive": "active");
            File::put($modulePath, json_encode($config, JSON_PRETTY_PRINT));
        }

        return redirect()->back()->with("success", "$moduleName status updated!");
    }
}
