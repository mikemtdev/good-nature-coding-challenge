# Documentation: Farmer Management System 

## Overview

This documentation provides a comprehensive guide for the Farmer Management System with dynamic modules. The Farmer Management System includes a module management feature that allows uploading, activating, deactivating, listing, and deleting modules. Each module is self-contained, with its routes, views, controllers, and configuration stored in the `modules/` directory.

---


## Setup Laravel

**1. Install Related packages to running a laravel project**

**2. Configure .env for Database**

Edit the .env file in the project root to set up database variables:

``` env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password 
```

Run the following command to apply the configuration and generate the application key:
``` bash
php artisan config:clear
php artisan key:generate
```
**3. Set Up the Database**

Create the database specified in the .env file, then run migrations:

```bash
php artisan migrate
```
**4. Serve the Application**

Start the development server:

```bash 
php artisan serve
```

Your Laravel application will be available at http://127.0.0.1:8000.

Tech Stack

The module management system is built using the following technologies:

Backend Framework: Laravel

Frontend Templating: Blade + TailwindCSS

Database: MySQL


----

## Features

1. **Module Upload**: Upload `.zip` files containing module definitions and extract them into the `modules/` directory.
2. **Module Activation/Deactivation**: Toggle module availability dynamically through the user interface.
3. **Module Listing**: Display all modules and their statuses on an admin dashboard.
4. **Module Deletion**: Remove a module and optionally rollback related migrations.
5. **Dynamic Loading**: Load active modules during application runtime.

---

## Directory Structure

### Base Directory

The base `modules/` directory contains subdirectories for each module.

```
modules/
├── LoanManagement/
│   ├── Controllers/
│   ├── Models/
│   ├── Migrations/
│   ├── Views/
│   ├── routes.php
│   └── module.json
├── FarmerSupport/
│   ├── Controllers/
│   ├── Models/
│   ├── Migrations/
│   ├── Views/
│   ├── routes.php
│   └── module.json
```

### `module.json`

Each module contains a `module.json` file with metadata:

```json
{
    "name": "Loan Management",
    "description": "Manage loans for farmers.",
    "href": "/loan",
    "status": "active"
}
```

- **name**: The display name of the module.
- **description**: A short description of the module.
- **href**: This is the route to rendered in the side navigation.
- **status**: `active` or `inactive`.

---

## Module Management Features

### 1. Upload Module

#### **Routes**

```php
Route::get('/modules/upload', [ModuleController::class, 'showUploadForm'])->name('modules.upload.form');
Route::post('/modules/upload', [ModuleController::class, 'uploadModule'])->name('modules.upload');
```

#### **Controller Methods**

```php
public function showUploadForm()
{
    return view('modules.upload');
}

public function uploadModule(Request $request)
{
    $request->validate([
        'module' => 'required|mimes:zip|max:20480',
    ]);

    $uploadedFile = $request->file('module');
    $moduleName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
    $modulePath = base_path("modules/$moduleName");

    if (File::exists($modulePath)) {
        return redirect()->back()->withErrors(['Module already exists.']);
    }

    $tempPath = storage_path("app/tmp/$moduleName");
    File::makeDirectory($tempPath, 0755, true);

    $uploadedFile->move($tempPath, $uploadedFile->getClientOriginalName());

    $zip = new ZipArchive;
    $zipFilePath = "$tempPath/{$uploadedFile->getClientOriginalName()}";
    if ($zip->open($zipFilePath) === true) {
        $zip->extractTo(base_path('modules'));
        $zip->close();
    } else {
        File::deleteDirectory($tempPath);
        return redirect()->back()->withErrors(['Failed to extract the module.']);
    }

    File::deleteDirectory($tempPath);

    return redirect()->route('modules.index')->with('success', "Module '$moduleName' uploaded and installed successfully.");
}
```

#### **Blade Template**

`resources/views/modules/upload.blade.php`

```blade
<form action="{{ route('modules.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="module" accept=".zip" required>
    <button type="submit">Upload Module</button>
</form>
```

---

### 2. Activate/Deactivate Module

#### **Route**

```php
Route::post('/modules/toggle/{moduleName}', [ModuleController::class, 'toggleModule'])->name('modules.toggle');
```

#### **Controller Method**

```php
public function toggleModule($moduleName)
{
    $modulePath = base_path("modules/$moduleName/module.json");

    if (File::exists($modulePath)) {
        $config = json_decode(File::get($modulePath), true);
        $config['status'] = $config['status'] === 'active' ? 'inactive' : 'active';
        File::put($modulePath, json_encode($config, JSON_PRETTY_PRINT));
    }

    return redirect()->route('modules.index')->with('success', "$moduleName status updated!");
}
```

---

### 3. Delete Module

#### **Route**

```php
Route::delete('/modules/{moduleName}', [ModuleController::class, 'deleteModule'])->name('modules.delete');
```

#### **Controller Method**

```php
public function deleteModule($moduleName)
{
    $modulePath = base_path("modules/$moduleName");

    if (!File::exists($modulePath)) {
        return redirect()->route('modules.index')->withErrors(['Module not found.']);
    }

    File::deleteDirectory($modulePath);

    $migrationPath = "$modulePath/Migrations";
    if (File::isDirectory($migrationPath)) {
        \Artisan::call('migrate:rollback', ['--path' => $migrationPath]);
    }

    return redirect()->route('modules.index')->with('success', "Module '$moduleName' has been deleted successfully.");
}
```

---

## Loan Module Integration

A prebuilt loan management module can be added to the project directly via the dashboard. It allows managing loans and integrates seamlessly into the existing module management system.

### Loan Module Overview

- **Name**: Loan Management

- **Description**: Provides functionalities for managing loans for farmers, including creating, updating, and tracking loans.

- **Key Features**:

  - CRUD operations for loans

  - Integration with farmer data

  - Loan status tracking (e.g., pending, approved, rejected)

### Adding the Loan Module

1. Navigate to the Modules Upload section in the dashboard. 
2. Download the LoanManagement.zip module package from the provided source.

```
Note: The loan module is in the route directory of this project named: LoanManagement.zip
```

3. Upload the LoanManagement.zip file through the upload form. 
4. Activate the module from the Modules List section.


---

## Dynamic Loading of Modules

### 1. Service Provider

Automatically load active modules during application runtime.

#### **Code**

```php
namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modulePath = base_path('modules');
        $modules = File::directories($modulePath);

        foreach ($modules as $module) {
            $configPath = $module . '/module.json';

            if (File::exists($configPath)) {
                $config = json_decode(File::get($configPath), true);

                if ($config['status'] === 'active') {
                    $this->loadModule($module);
                }
            }
        }
    }

    private function loadModule($modulePath)
    {
        if (File::exists($modulePath . '/routes.php')) {
            $this->loadRoutesFrom($modulePath . '/routes.php');
        }

        if (File::isDirectory($modulePath . '/Views')) {
            $this->loadViewsFrom($modulePath . '/Views', basename($modulePath));
        }

        if (File::isDirectory($modulePath . '/Migrations')) {
            $this->loadMigrationsFrom($modulePath . '/Migrations');
        }
    }
}
```

---

## Testing the Module Management System

1. **Upload a Module**:
    - Use the upload form to upload a `.zip` file containing a module.
    - Verify that the module appears in the modules list.

2. **Activate/Deactivate a Module**:
    - Toggle the status of a module using the provided buttons.
    - Verify that active modules are loaded dynamically.

3. **Delete a Module**:
    - Delete a module and ensure its directory and database changes are removed.

4. **Check Sidebar Integration**:
    - Verify that only active modules appear in the navigation sidebar.

---

## Conclusion

This modular management system ensures scalability and flexibility for Laravel applications by allowing developers to dynamically manage features without directly modifying the core codebase. The modular approach promotes clean architecture and better maintainability.

----
By Mike M.T Njovu

[Send Email](mailto:mikemtnjovu@gmail.com)
