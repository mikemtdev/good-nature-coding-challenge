<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class ModuleHelper
{

    /**
     * Check if a module is loaded (active).
     *
     * @param string $moduleName
     * @return bool
     */

    public static function getModuleMetada(string $moduleName)
    {
        $modulePath = base_path("modules/$moduleName/module.json");


        if (File::exists($modulePath)) {
            $config = json_decode(File::get($modulePath), true);
            return [
                'name' => $config['name'] ?? $moduleName,
                'status' => $config['status'] ?? 'inactive',
            ];
        }

        return null;
    }
    public static function getAllModulesMetadata()
    {
        $modulePath = base_path("modules");
        $modules = [];

        if (File::isDirectory($modulePath)) {
            foreach (File::directories($modulePath) as $module) {
                $configPath = $module . '/module.json';

                if (File::exists($configPath)) {
                    $config = json_decode(File::get($configPath), true);
                    $modules[] = [
                        'name' => $config['name'] ?? basename($module),
                        "href" => $config['href'] ?? "",
                        'status' => $config['status'] ?? 'inactive',
                        'description' => $config['description'] ?? 'No description available',
                        'path' => $module,
                    ];
                }
            }
        }

        return $modules;
    }
}
