<?php

use Illuminate\Support\Facades\Route;

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
/*
 * Регистрация, вход в ЛК, восстановление пароля
 */
/*
 * Регистрация, вход в ЛК, восстановление пароля
 */
/*
 * Регистрация, вход в ЛК, восстановление пароля
 */
Route::group([
    'as' => 'auth.', // имя маршрута, например auth.index
    'prefix' => 'auth', // префикс маршрута, например auth/index
], function () {
    // форма регистрации
    Route::get('register', 'Auth\RegisterController@register')
        ->name('register');
    // создание пользователя
    Route::post('register', 'Auth\RegisterController@create')
        ->name('create');
    // форма входа
    Route::get('login', 'Auth\LoginController@login')
        ->name('login');
    // аутентификация
    Route::post('login', 'Auth\LoginController@authenticate')
        ->name('auth');
    // выход
    Route::get('logout', 'Auth\LoginController@logout')
        ->name('logout');
    // форма ввода адреса почты
    Route::get('forgot-password', 'Auth\ForgotPasswordController@form')
        ->name('forgot-form');
    // письмо на почту
    Route::post('forgot-password', 'Auth\ForgotPasswordController@mail')
        ->name('forgot-mail');
    // форма восстановления пароля
    Route::get(
        'reset-password/token/{token}/email/{email}',
        'Auth\ResetPasswordController@form'
    )->name('reset-form');
    // восстановление пароля
    Route::post('reset-password', 'Auth\ResetPasswordController@reset')
        ->name('reset-password');
    // сообщение о необходимости проверки адреса почты
    Route::get('verify-message', 'Auth\VerifyEmailController@message')
        ->name('verify-message');
    // подтверждение адреса почты нового пользователя
    Route::get('verify-email/token/{token}/id/{id}', 'Auth\VerifyEmailController@verify')
        ->where('token', '[a-f0-9]{32}')
        ->where('id', '[0-9]+')
        ->name('verify-email');
});
/*
 * Личный кабинет пользователя
 */
Route::group([
    'as' => 'user.', // имя маршрута, например user.index
    'prefix' => 'user', // префикс маршрута, например user/index
    'namespace' => 'User', // пространство имен контроллеров
    'middleware' => ['auth'] // один или несколько посредников
], function () {
    // главная страница
    Route::get('index', 'IndexController')->name('index');
});
Route::get('/profile', 'User/IndexController@')
    ->name('register');
Route::group([
    'as' => 'blog.', // имя маршрута, например blog.index
    'prefix' => 'blog', // префикс маршрута, например blog/index
], function () {
    // главная страница (все посты)
    Route::get('index', 'BlogController@index')
        ->name('index');
    // категория блога (посты категории)
    Route::get('category/{category:slug}', 'BlogController@category')
        ->name('category');
    // тег блога (посты с этим тегом)
    Route::get('tag/{tag:slug}', 'BlogController@tag')
        ->name('tag');
    // страница поста блога
    Route::get('post/{post:slug}', 'BlogController@post')
        ->name('post');
});
