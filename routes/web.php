<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Users\UserController;
use App\Http\Controllers\Backend\Users\AdminUserController;
use App\Http\Controllers\Backend\Certificates\CertificateController;
use App\Http\Controllers\Backend\Badges\BadgeController;
use App\Http\Controllers\Backend\Courses\CourseController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InstitutionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('admin/image_url/{id}', [BadgeController::class, 'imageUrl'])->name('image_url');

//Institution Routes
Route::get('institution/index', [InstitutionController::class, 'index'])->name('institution.index');
Route::get('institution/create', [InstitutionController::class, 'create'])->name('institution.create');
Route::post('institution/store', [InstitutionController::class, 'store'])->name('institution.store');
Route::get('institution/edit/{id}', [InstitutionController::class, 'edit'])->name('institution.edit');
Route::put('update/{id}', [InstitutionController::class, 'update'])->name('institution.update');
Route::get('institution/show/{id}', [InstitutionController::class, 'show'])->name('institution.show');
Route::get('destroy/delete/{id}', [InstitutionController::class, 'delete'])->name('institution.delete');

Route::get('new_certificate', [InstitutionController::class, 'sample_certificate'])->name('sample_certificate.index');


//Certificate Routes
Route::get('newcertificatesss/index', [CertificateController::class,'index'])->name('certificatess.index');

Route::get('assigncertificateindex/{id}',[BadgeController::class,'assign_index'])->name('admin.badges.assigncertificate.index');
Route::get('assigncertificate/{id}',[BadgeController::class,'assign_create'])->name('admin.badges.assigncertificate.create');
Route::post('assignstore/{id}',[BadgeController::class,'assign_store'])->name('admin.badges.assigncertificate.store');

Route::get('assign/certificateshow/{id}', [BadgeController::class, 'assign_show'])->name('admin.badges.assigncertificate.show');
Route::get('certificate/image/{id}', [BadgeController::class, 'image'])->name('admin.badges.image');










Route::group(
    ['exculde' => ['admin.check_mail', 'store']],
    function () {
        Route::get('admin/forgot_password', [ForgotPasswordController::class, 'forgotPassword'])->name('admin.forgot_password');
        Route::post('admin/check_mail', [ForgotPasswordController::class, 'checkMail'])->name('admin.check_mail');
        Route::get('reset/{id}', [ForgotPasswordController::class, 'reset'])->name('admin.reset');
        Route::post('password_change', [ForgotPasswordController::class, 'passwordChange'])->name('admin.password_change');
        Route::get('register', [RegisterController::class, 'register'])->name('register');
        Route::get('create_password/{id}', [RegisterController::class, 'createPassword'])->name('password');
        Route::post('save_password', [RegisterController::class, 'savePassword'])->name('password_save');
        Route::post('store', [RegisterController::class, 'store'])->name('store');
    }
);

Route::group(['middleware' => ['web', 'auth', 'check-userstatus'], 'roles' => ''], function () {

    Route::group(['middleware' => ['check-roles']], function () {
        Route::group(
            ['prefix' => 'admin', 'as' => 'admin.', 'exculde' => ['admin.store']],
            function () {

                Route::get('student/create', [RegisterController::class, 'register'])->name('register');
                Route::post('student/store', [RegisterController::class, 'store'])->name('store');

                Route::group(
                    ['prefix' => 'certificates', 'as' => 'certificates.', 'exculde' => ['admin.certificates.update', '']],
                    function () {
                        Route::get('/', [CertificateController::class, 'index'])->name('index');
                        Route::get('create', [CertificateController::class, 'create'])->name('create');

                        Route::get('create1', [CertificateController::class, 'create1'])->name('create1');
                        Route::get('edit/{id}', [CertificateController::class, 'edit'])->name('edit');
                        Route::post('store', [CertificateController::class, 'store'])->name('store');
                        Route::put('update/{id}', [CertificateController::class, 'update'])->name('update');
                    }
                );

                Route::group(
                    ['prefix' => 'courses', 'as' => 'courses.', 'exculde' => ['admin.courses.store', '']],
                    function () {
                        Route::get('/', [CourseController::class, 'index'])->name('index');
                        Route::get('create', [CourseController::class, 'create'])->name('create');
                        Route::post('store', [CourseController::class, 'store'])->name('store');
                    }
                );

                Route::group(
                    ['prefix' => 'user_lists', 'as' => 'user_lists.', 'exculde' => ['', '']],
                    function () {
                        Route::any('/', [AdminUserController::class, 'index'])->name('index');
                        Route::get('show/{id}', [AdminUserController::class, 'show'])->name('show');
                    }
                );

                Route::group(
                    ['prefix' => 'badges', 'as' => 'badges.', 'exculde' => ['admin.badges.store', 'admin.badges.nft_store']],
                    function () {
                        Route::get('/{id}', [BadgeController::class, 'index'])->name('index');
                        Route::post('store', [BadgeController::class, 'store'])->name('store');
                        Route::post('nft_store/{id}', [BadgeController::class, 'nftStore'])->name('nft_store');
                        Route::get('show/{id}', [BadgeController::class, 'show'])->name('show');
                        Route::delete('{user}/{id}', [BadgeController::class, 'destroy'])->name('destroy');
                    }
                );
                Route::get('badges/create/{id}', [BadgeController::class, 'create'])->name('badges.create');
            }
        );

        Route::group(['prefix' => 'admin/users', 'exculde' => ['users.filter', 'users.store', 'users.update', 'users.bulkdestroy', 'users.assignrole_store']], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::post('/', [UserController::class, 'index'])->name('users.filter');
            Route::get('create', [UserController::class, 'create'])->name('users.create');
            Route::post('create', [UserController::class, 'store'])->name('users.store');
            Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('{user}', [UserController::class, 'update'])->name('users.update');
            Route::get('{user}', [UserController::class, 'show'])->name('users.show');
            Route::delete('{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::delete('/', [UserController::class, 'bulkdestroy'])->name('users.bulkdestroy');
            Route::get('{user}/roles', [UserController::class, 'assignRoleCreate'])->name('users.assignrole_create');
            Route::post('{user}/roles', [UserController::class, 'assignRoleStore'])->name('users.assignrole_store');
            Route::get('user_list', [UserController::class, 'userIndex'])->name('users.user_index');
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**** LARASNAP ROUTES START ****/

Route::group(['namespace' => '\LaraSnap\LaravelAdmin\Controllers', 'prefix' => 'admin', 'middleware' => ['web', 'auth', 'check-userstatus'], 'roles' => ''], function () {

    Route::group(['middleware' => ['check-roles']], function () {

        /** DASHBOARD ROUTES **/
        Route::get('/', 'DashboardController')->name('dashboard');
        /** DASHBOARD ROUTES **/

        /** USER ROUTES **/
        // Route::group(['prefix' => 'users', 'exculde' => ['users.filter', 'users.store', 'users.update', 'users.bulkdestroy', 'users.assignrole_store']], function(){
        //     Route::get('/','UserController@index')->name('users.index');
        //     Route::post('/','UserController@index')->name('users.filter');
        //     Route::get('create','UserController@create')->name('users.create');
        //     Route::post('create','UserController@store')->name('users.store');
        //     Route::get('{user}/edit','UserController@edit')->name('users.edit');
        //     Route::put('{user}','UserController@update')->name('users.update');
        //     Route::get('{user}','UserController@show')->name('users.show');
        //     Route::delete('{user}','UserController@destroy')->name('users.destroy');
        //     Route::delete('/','UserController@bulkdestroy')->name('users.bulkdestroy');
        //     Route::get('{user}/roles','UserController@assignRoleCreate')->name('users.assignrole_create');
        //     Route::post('{user}/roles','UserController@assignRoleStore')->name('users.assignrole_store');
        // });
        /** USER ROUTES **/

        /** PROFILE ROUTES **/
        Route::group(['prefix' => 'profile', 'exculde' => ['profile.edit', 'profile.update']], function () {
            Route::get('/', 'ProfileController@edit')->name('profile.edit');
            Route::put('{user}', 'ProfileController@update')->name('profile.update');
        });
        /** PROFILE ROUTES **/

        /** ROLE ROUTES **/
        Route::group(['prefix' => 'roles', 'exculde' => ['roles.filter', 'roles.store', 'roles.update', 'roles.assignpermission_store', 'roles.assignscreen_store']], function () {
            Route::get('/', 'RoleController@index')->name('roles.index');
            Route::post('/', 'RoleController@index')->name('roles.filter');
            Route::get('create', 'RoleController@create')->name('roles.create');
            Route::post('create', 'RoleController@store')->name('roles.store');
            Route::get('{role}/edit', 'RoleController@edit')->name('roles.edit');
            Route::put('{role}', 'RoleController@update')->name('roles.update');
            Route::delete('{role}', 'RoleController@destroy')->name('roles.destroy');
            Route::get('{role}/permissions', 'RoleController@assignPermissionCreate')->name('roles.assignpermission_create');
            Route::post('{role}/permissions', 'RoleController@assignPermissionStore')->name('roles.assignpermission_store');
            Route::get('{role}/screens', 'RoleController@assignScreenCreate')->name('roles.assignscreen_create');
            Route::post('{role}/screens', 'RoleController@assignScreenStore')->name('roles.assignscreen_store');
        });
        /** ROLE ROUTES **/

        /** PERMISSION ROUTES **/
        Route::group(['prefix' => 'permissions', 'exculde' => ['permissions.filter', 'permissions.store', 'permissions.update']], function () {
            Route::get('/', 'PermissionController@index')->name('permissions.index');
            Route::post('/', 'PermissionController@index')->name('permissions.filter');
            Route::get('create', 'PermissionController@create')->name('permissions.create');
            Route::post('create', 'PermissionController@store')->name('permissions.store');
            Route::get('{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
            Route::put('{permission}', 'PermissionController@update')->name('permissions.update');
            Route::delete('{permission}', 'PermissionController@destroy')->name('permissions.destroy');
        });
        /** PERMISSION ROUTES **/

        /** SCREEN ROUTES **/
        Route::group(['prefix' => 'screens', 'exculde' => ['screens.filter', 'screens.store', 'screens.update', 'screens.assignrole_store', 'screens.modules', 'screens.modules_store', 'screens.modules_destroy']], function () {
            Route::get('/', 'ScreenController@index')->name('screens.index');
            Route::post('/', 'ScreenController@index')->name('screens.filter');
            Route::get('create', 'ScreenController@create')->name('screens.create');
            Route::post('create', 'ScreenController@store')->name('screens.store');
            Route::get('{screen}/edit', 'ScreenController@edit')->name('screens.edit');
            Route::put('{screen}', 'ScreenController@update')->name('screens.update');
            Route::delete('{screen}', 'ScreenController@destroy')->name('screens.destroy');
            Route::get('{screen}/roles', 'ScreenController@assignRoleCreate')->name('screens.assignrole_create');
            Route::post('{screen}/roles', 'ScreenController@assignRoleStore')->name('screens.assignrole_store');
            Route::get('modules', 'ScreenController@getModules')->name('screens.modules');
            Route::post('modules', 'ScreenController@storeModule')->name('screens.modules_store');
            Route::delete('modules/{module}', 'ScreenController@destroyModule')->name('screens.modules_destroy');
        });
        /** SCREEN ROUTES **/

        /** MODULE ROUTES **/
        Route::group(['prefix' => 'modules', 'exculde' => ['modules.filter', 'modules.store', 'modules.update']], function () {
            Route::get('/', 'ModuleController@index')->name('modules.index');
            Route::post('/', 'ModuleController@index')->name('modules.filter');
            Route::get('create', 'ModuleController@create')->name('modules.create');
            Route::post('create', 'ModuleController@store')->name('modules.store');
            Route::get('{module}/edit', 'ModuleController@edit')->name('modules.edit');
            Route::put('{module}', 'ModuleController@update')->name('modules.update');
            Route::delete('{module}', 'ModuleController@destroy')->name('modules.destroy');
        });
        /** MODULE ROUTES **/

        /** MENU ROUTES **/
        Route::group(['prefix' => 'menus', 'exculde' => ['menus.filter', 'menus.store', 'menus.update', 'menus.order', 'menus.item_store', 'menus.item_update', 'menus.item.destory']], function () {
            Route::get('/', 'MenuController@index')->name('menus.index');
            Route::post('/', 'MenuController@index')->name('menus.filter');
            Route::get('create', 'MenuController@create')->name('menus.create');
            Route::post('create', 'MenuController@store')->name('menus.store');
            Route::get('{menu}/edit', 'MenuController@edit')->name('menus.edit');
            Route::put('{menu}', 'MenuController@update')->name('menus.update');
            Route::delete('{menu}', 'MenuController@destroy')->name('menus.destroy');
            Route::get('{menu}/builder', 'MenuController@builder')->name('menus.builder');
            Route::post('{menu}/order', 'MenuController@orderItem')->name('menus.order');
            Route::post('{menu}/item', 'MenuController@itemStore')->name('menus.item_store');
            Route::put('{menu}/item', 'MenuController@itemUpdate')->name('menus.item_update');
            Route::delete('{menu}/item', 'MenuController@itemDestroy')->name('menus.item.destory');
        });
        /** MENU ROUTES **/

        /** CATEGORY ROUTES **/
        Route::group(['prefix' => 'categories', 'exculde' => ['p_categories.filter', 'p_categories.store', 'p_categories.update', 'categories.filter', 'categories.store', 'categories.update']], function () {
            Route::get('/', 'CategoryParentController@index')->name('p_categories.index');
            Route::post('/', 'CategoryParentController@index')->name('p_categories.filter');
            Route::get('create', 'CategoryParentController@create')->name('p_categories.create');
            Route::post('create', 'CategoryParentController@store')->name('p_categories.store');
            Route::get('{p_category}/edit', 'CategoryParentController@edit')->name('p_categories.edit');
            Route::put('{p_category}', 'CategoryParentController@update')->name('p_categories.update');
            Route::delete('{p_category}', 'CategoryParentController@destroy')->name('p_categories.destroy');

            Route::get('{p_category}', 'CategoryController@index')->name('categories.index');
            Route::post('{p_category}', 'CategoryController@index')->name('categories.filter');
            Route::get('{p_category}/create', 'CategoryController@create')->name('categories.create');
            Route::post('{p_category}/create', 'CategoryController@store')->name('categories.store');
            Route::get('/{p_category}/{category}/edit', 'CategoryController@edit')->name('categories.edit');
            Route::put('{p_category}/{category}', 'CategoryController@update')->name('categories.update');
            Route::delete('{p_category}/{category}', 'CategoryController@destroy')->name('categories.destroy');
        });
        /** CATEGORY ROUTES **/

        /** SETTING ROUTES **/
        Route::group(['prefix' => 'settings', 'exculde' => ['settings.store']], function () {
            Route::get('/', 'SiteSettingController@create')->name('settings.create');
            Route::post('/', 'SiteSettingController@store')->name('settings.store');
        });
        /** SETTING ROUTES **/

        /** DOCUMENT ROUTES **/
        Route::get('guide', 'DocsController@index')->name('docs.index');
        Route::get('/icons', 'DocsController@icons')->name('docs.icons');
    });

    /** ERROR ROUTES **/
    Route::group(['prefix' => 'error'], function () {
        Route::get('/401', 'ErrorController@noPermission')->name('errors.401');
    });
    /** ERROR ROUTES **/
});

/**** LARASNAP ROUTES END ****/
