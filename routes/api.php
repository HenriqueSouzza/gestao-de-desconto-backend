<?php

use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api' /*, 'check.user.acl'*/]], function(){
    
    Route::resources([
        'permissions'                 => 'Api\PermissionController',
        'permission-roles'            => 'Api\PermissionRoleController',
        'roles'                       => 'Api\RoleController',        
        'role-users'                  => 'Api\RoleUserController',
        'student-schoolarships'       => 'Api\StudentSchoolarshipController',
        'users'                       => 'Api\UserController',
        'totvs-queries'               => 'Api\TotvsQuerySqlController'
    ]);

    Route::get('/permissions/update/all', 'Api\PermissionController@updateAllPermissions');
    Route::post('/concession-periods/list', 'Api\ConcessionPeriodController@listPeriods'); // lista de periodos letivos dado filial, e modalidade
    Route::post('/discount-margin-schoolarships/list', 'Api\DiscountMarginSchoolarshipController@listMargins'); // lista de periodos letivos dado filial, e modalidade
    Route::post('/student-schoolarships/list-students', 'Api\StudentSchoolarShipController@getStudents');
    Route::post('/student-schoolarships/list-local-students', 'Api\StudentSchoolarShipController@getLocalStudents');
    Route::post('/student-schoolarships/students', 'Api\StudentSchoolarShipController@postSchoolarship');
    Route::post('/student-schoolarships/profit', 'Api\StudentSchoolarShipController@getProfitCourse');
    Route::post('/student-schoolarships/reject', 'Api\StudentSchoolarShipController@rejectScholarships');
    Route::get('/log', 'Api\StudentSchoolarShipController@getLog');


    Route::post('/totvs-queries/query', 'Api\TotvsQuerySqlController@totvsQuery');
    Route::post('/totvs-queries/read', 'Api\TotvsQuerySqlController@read');
    Route::post('/totvs-queries/save', 'Api\TotvsQuerySqlController@save');
    
});
    
Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::get('redirect-google', 'Api\UserController@redirectToProvider');
Route::post('callback', 'Api\UserController@callback');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout', 'Api\UserController@logout');
    Route::get('user', 'Api\UserController@user');
});



