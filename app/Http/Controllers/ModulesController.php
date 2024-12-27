<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use ZipArchive;

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

    public function show()
    {
        return view('modules.upload');
    }

    public function uploadModule(Request $request)
    {
        $request->validate([
            'module' => 'required|mimes:zip|max:20480', // Allow .zip files only, max size 20MB
        ]);


        $uploadedFile = $request->file('module');
        $moduleName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $modulePath = base_path("modules/$moduleName");


        // Check if the module already exists
        if (File::exists($modulePath)) {
            return redirect()->back()->withErrors(['Module already exists.']);
        }

        // Create a temporary directory for extraction
        $tempPath = storage_path("app/tmp/$moduleName");

//        dd($tempPath);
//        dd(File::exists($tempPath));
            File::makeDirectory($tempPath, 0755, true);

        // Move the uploaded file to the temporary path
        $uploadedFile->move($tempPath, $uploadedFile->getClientOriginalName());

        // Extract the .zip file
        $zip = new ZipArchive;
        $zipFilePath = "$tempPath/{$uploadedFile->getClientOriginalName()}";
        if ($zip->open($zipFilePath) === true) {
            $zip->extractTo(base_path('modules'));
            $zip->close();
        } else {
            File::deleteDirectory($tempPath);
            return redirect()->back()->withErrors(['Failed to extract the module.']);
        }

        // Clean up temporary files
        File::deleteDirectory($tempPath);

        Artisan::call("optimize");

        return redirect()->route('modules.index')->with('success', "Module '$moduleName' uploaded and installed successfully.");

    }

    /**
     * Delete a module.
     *
     * @param string $moduleName
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($moduleName)
    {
        $modulePath = base_path("modules/$moduleName");

        // Check if the module exists
        if (!File::exists($modulePath)) {
            return redirect()->route('modules.index')->withErrors(['Module not found.']);
        }

        // Delete the module directory
        File::deleteDirectory($modulePath);

        // Optional: Run database rollback for the module's migrations
        $migrationPath = "$modulePath/Migrations";
        if (File::isDirectory($migrationPath)) {
             $db_rollback  = Artisan::call('migrate:rollback', ['--path' => $migrationPath]);
        }

        return redirect()->route('modules.index')->with('success', "Module '$moduleName' has been deleted successfully.");
    }

}
