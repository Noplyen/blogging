<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/hello', 'Home::index');

$routes->set404Override(function (){
    return view('errors/custom-error/error_404');
});

// ERROR
$routes->group('/error',['namespace'=>'App\Controllers\ErrorPages'],
    function ($routes) {
        $routes->get('404', 'ErrorPages::errorNotFound404');
        $routes->get('500', 'ErrorPages::errorServer500');
    });

// READER
$routes->group('/',['namespace'=>'App\Controllers\Reader'],function ($routes){
    $routes->get('', 'ReaderContent::index');
    $routes->get('post/(:any)', 'ReaderContent::contentArticle/$1');
    $routes->get('category/(:any)', 'ReaderContent::categoryContent/$1');
    $routes->get('profile', 'ReaderContent::profile');
});

// USER PROFILE
$routes->group('/admin/profiles',['filter'=>'auth','namespace'=>'App\Controllers\Admin'],
    function ($routes){
        $routes->get('','UserProfiles::index');
        $routes->put('','UserProfiles::profileUpdate');
});

// USER MEDIA SOCIAL
$routes->group('/admin/social',['filter'=>'auth','namespace'=>'App\Controllers\Admin'],
    function ($routes){
        $routes->get('','MediaSocialController::index');
        $routes->post('','MediaSocialController::create');
        $routes->delete('','MediaSocialController::delete');
});

// AUTHENTICATION
$routes->group('/user',['filter'=>'csrf'],
    function ($routes){
        // logout
        $routes->get('logout','Auth\Logout::logout');
        // login
        $routes->get('login', 'Auth\Login::viewLogin');
        $routes->post('login', 'Auth\Login::postLogin');
        // register
        $routes->get('register', 'Auth\Register::viewRegister');
        $routes->post('register', 'Auth\Register::postRegister');
});

// MAIN ADMIN
$routes->get('/admin','Admin\MainDashboard::index',['filter'=>'auth']);

// IMAGE
$routes->group('/admin/images',['filter'=>'auth','namespace'=>'App\Controllers\Admin'],function ($routes) {
    $routes->get('','ImageController::index');
    $routes->post('','ImageController::savingImage');
    $routes->post('delete','ImageController::deleteImage');
});

// CATEGORY
$routes->group('/admin/categories',['filter'=>'auth'],function ($routes) {

    // view
    $routes->group('', ['namespace' => 'App\Controllers\Admin\View'],function ($routes) {
        $routes->get('','CategoryController::index');
        $routes->get('update/(:any)','CategoryController::updateCategory/$1');

    });

    // action
    $routes->group('', ['namespace' => 'App\Controllers\Admin\Action'],function ($routes) {
        $routes->post('','CategoryController::index');
        $routes->put('update/(:any)','CategoryController::updateCategory/$1');
        $routes->delete('delete/(:any)','CategoryController::deleteCategory/$1');

    });

});

// ARTICLE
$routes->group('/admin/articles',['filter'=>'auth'], function ($routes) {

    $routes->group('', ['namespace' => 'App\Controllers\Admin\View'],function ($routes) {
        $routes->get('', 'ArticleController::index');
        $routes->get('list', 'ArticleController::listArticle');
        $routes->get('preview/(:any)', 'ArticleController::previewArticle/$1');
        $routes->get('(:any)', 'ArticleController::updateArticle/$1');

    });

    $routes->group('', ['namespace' => 'App\Controllers\Admin\Action'],function ($routes) {
        $routes->post('', 'ArticleController::index');
        $routes->post('preview', 'ArticleController::previewArticle');
        $routes->post('update', 'ArticleController::updateArticle');

    });
});