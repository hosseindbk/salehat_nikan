<?php

use Illuminate\Support\Facades\Route;

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
    Route::post('acountnumber/number'                              , 'AcountnumberController@acountnumber')->name('acountnumber');

});

Route::group(['namespace' => 'Auth' , 'prefix' => 'admin'] , function (){
    // Authentication Routes...
    Route::get('login'      , 'LoginController@showLoginForm')->name('login');
    Route::post('login'     , 'LoginController@login');
    Route::get('logout'     , 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    Route::get('login'      , 'LoginController@showLoginuserForm')->name('loginuser');
    Route::get('remember'   , 'LoginController@showLoginrememberForm')->name('remember');
    Route::post('remember'  , 'LoginController@remember')->name('remember');
    Route::post('login-user', 'LoginController@loginuser')->name('login-user');
    Route::get('logout'     , 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register'   , 'RegisterController@showRegistrationuserForm');
    Route::post('register'  , 'RegisterController@registeruser')->name('register');
    Route::get('token'      , 'TokenController@showToken')->name('phone.token');
    Route::post('token'     , 'TokenController@token')->name('verify.phone.token');
    Route::get('welcome'    , 'WelcomeController@index' )->name('welcome');

});
