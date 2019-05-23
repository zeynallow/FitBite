<?php

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

#Page
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/page/{page_slug}', 'PageController@index');

#Blog
Route::get('/blogs', 'BlogController@index');
Route::get('/blog/{blog_slug}', 'BlogController@getBlog');

#Meal Plans
Route::get('/meal-plans', 'MealPlanController@index');
Route::get('/meal-plans/{plan_slug}', 'MealPlanController@index');
Route::post('/meal-plans/{plan_id}/order', 'MealPlanController@orderPlanGenerate');
Route::get('/order/{order_id}', 'MealPlanController@orderPlan');
Route::post('/confirm-order/{order_id}', 'MealPlanController@confirmOrderPlan');


#Profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/my-orders', 'ProfileController@myOrders');
    Route::get('/profile/my-profile', 'ProfileController@myProfile');
});

#Auth
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@doLogin');
Route::get('/profile/logout', 'Auth\LoginController@doLogout');


/*=========== Admin ============*/

Route::get('/admin/login', 'Admin\LoginController@index');
Route::post('/admin/login', 'Admin\LoginController@doLogin');

Route::group(['middleware' => 'auth'], function () {

  Route::get('/admin', 'Admin\DashboardController@index');
  Route::get('/admin/logout', 'Admin\LoginController@logout');
  Route::get('/admin/dashboard', 'Admin\DashboardController@index');

  #Pages
  Route::get('/admin/page/all', 'Admin\PageController@allPages');
  Route::get('/admin/page/add', 'Admin\PageController@addPage');
  Route::post('/admin/page/add', 'Admin\PageController@storePage');
  Route::get('/admin/page/edit/{id}', 'Admin\PageController@editPage');
  Route::post('/admin/page/update/{id}', 'Admin\PageController@updatePage');
  Route::post('/admin/delete/page/{id}', 'Admin\PageController@deletePage');

  #MealPlans
  Route::get('/admin/meal-plan/all', 'Admin\MealPlanController@allPlans');
  Route::get('/admin/meal-plan/add', 'Admin\MealPlanController@addPlan');
  Route::post('/admin/meal-plan/add', 'Admin\MealPlanController@storePlan');
  Route::get('/admin/meal-plan/edit/{id}', 'Admin\MealPlanController@editPlan');
  Route::post('/admin/meal-plan/update/{id}', 'Admin\MealPlanController@updatePlan');
  Route::post('/admin/delete/meal-plan/{id}', 'Admin\MealPlanController@deletePlan');

    #Ajax
    Route::post('/admin/meal-plan/add-include', 'Admin\MealPlanController@addInclude');
    Route::get('/admin/meal-plan/delete-include', 'Admin\MealPlanController@deleteInclude');

  #Blogs
  Route::get('/admin/blog/all', 'Admin\BlogController@allBlogs');
  Route::get('/admin/blog/add', 'Admin\BlogController@addBlog');
  Route::post('/admin/blog/add', 'Admin\BlogController@storeBlog');
  Route::get('/admin/blog/edit/{id}', 'Admin\BlogController@editBlog');
  Route::post('/admin/blog/update/{id}', 'Admin\BlogController@updateBlog');
  Route::post('/admin/delete/blog/{id}', 'Admin\BlogController@deleteBlog');

  #User
  Route::get('/admin/user/all', 'Admin\UserController@allUsers');
  Route::get('/admin/user/edit/{id}', 'Admin\UserController@editUser');
  Route::post('/admin/user/update/{id}', 'Admin\UserController@updateUser');
  Route::post('/admin/delete/user/{id}', 'Admin\UserController@deleteUser');

  #Order
  Route::get('/admin/orders/all', 'Admin\OrderController@index');

});
