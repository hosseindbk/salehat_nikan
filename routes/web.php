<?php

use Illuminate\Support\Facades\Route;

Route::get('/'          , 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin' , 'middleware' => ['auth:web' , 'checkAdmin'], 'prefix' => 'admin'],function (){
    Route::resource('panel'                               , 'PanelController');
    Route::resource('users'                               , 'UserController');
    Route::resource('permissions'                         , 'PermissionController');
    Route::resource('roles'                               , 'RoleController');
    Route::resource('levelAdmins'                         , 'LevelManageController');
    Route::resource('profile'                             , 'ProfileController');
    Route::resource('menudashboards'                      , 'MenudashboardController');
    Route::resource('submenudashboards'                   , 'SubmenudashboardController');
    Route::resource('siteusers'                           , 'SiteuserController');
    Route::resource('acountnumber'                        , 'AcountnumberController');
    Route::resource('deposits'                            , 'DepositController');
    Route::resource('user-experts'                        , 'UserexpertController');
    Route::resource('costs'                               , 'CostController');
    Route::resource('rollcalls'                           , 'RollcallController');
    Route::resource('salaris'                             , 'SalaryController');
    Route::post('acountnumber/number'                       , 'AcountnumberController@acountnumber')->name('acountnumber');

});

Route::group(['namespace' => 'Auth' , 'prefix' => 'admin'] , function (){
    // Authentication Routes...
    Route::get('login'      , 'LoginController@showLoginForm')->name('login');
    Route::post('login'     , 'LoginController@login');
    Route::get('logout'     , 'LoginController@logout')->name('logout');
});
