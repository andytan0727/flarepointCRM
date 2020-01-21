<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Login/Logout Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth']], function () {
    /*
     * Main
     */
    Route::get('/', 'PagesController@dashboard');
    Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');

    /*
     * DataTables
     */
    Route::group(['prefix' => 'datatables'], function () {
        /*
         * Users DataTables
         */
        Route::group(['prefix' => 'users'], function () {
            $controller = 'DataTables\UsersDataTablesController@';

            Route::get('/', $controller.'allUsers')->name('dt.users');
            Route::get('/tasks/{user}', $controller.'tasks')->name('dt.users.tasks');
            Route::get('/leads/{user}', $controller.'leads')->name('dt.users.leads');
            Route::get('/clients/{user}', $controller.'clients')->name('dt.users.clients');
        });

        /*
         * Clients DataTables
         */
        Route::group(['prefix' => 'clients'], function () {
            $controller = 'DataTables\ClientsDataTablesController@';

            Route::get('/', $controller.'allClients')->name('dt.clients');
            Route::get('/me', $controller.'myClients')->name('dt.myClients');
        });


        /*
         * Contacts DataTables
         */
        Route::group(['prefix' => 'contacts'], function () {
            $controller = 'DataTables\ContactsDataTablesController@';

            Route::get('/', $controller.'allContacts')->name('dt.contacts');
            Route::get('/me', $controller.'myContacts')->name('dt.myContacts');
        });

        /*
         * Leads DataTables
         */
        Route::group(['prefix' => 'leads'], function () {
            $controller = 'DataTables\LeadsDataTablesController@';

            Route::get('/', $controller.'allLeads')->name('dt.leads');
            Route::get('/me', $controller.'myLeads')->name('dt.myLeads');
        });

        /*
         * Tasks DataTables
         */
        Route::group(['prefix' => 'tasks'], function () {
            $controller = 'DataTables\TasksDataTablesController@';

            Route::get('/', $controller.'allTasks')->name('dt.tasks');
            Route::get('/me', $controller.'myTasks')->name('dt.myTasks');
        });
    });

    /*
     * Users
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/users', 'UsersController@users')->name('users.users');
    });
    Route::resource('users', 'UsersController');

    /*
    * Roles
    */
    Route::resource('roles', 'RolesController');

    /*
     * Clients
     */
    Route::group(['prefix' => 'clients'], function () {
        Route::post('/create/cvrapi', 'ClientsController@cvrapiStart');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'ClientsController@updateAssign');
        Route::get('/me', 'ClientsController@me')->name('clients.me');
    });
    Route::resource('clients', 'ClientsController');
    Route::resource('documents', 'DocumentsController');

    /*
     * Contacts
     */
    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/me', 'ContactsController@me')->name('contacts.me');
    });
    Route::resource('contacts', 'ContactsController');

    /*
     * Tasks
     */
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/me', 'TasksController@me')->name('tasks.me');
        Route::patch('/updatestatus/{id}', 'TasksController@updateStatus');
        Route::patch('/updateassign/{id}', 'TasksController@updateAssign');
        Route::post('/updatetime/{id}', 'TasksController@updateTime');
    });
    Route::resource('tasks', 'TasksController');

    /*
     * Leads
     */
    Route::group(['prefix' => 'leads'], function () {
        Route::get('/me', 'LeadsController@me')->name('leads.me');
        Route::patch('/updateassign/{id}', 'LeadsController@updateAssign');
        Route::patch('/updatestatus/{id}', 'LeadsController@updateStatus');
        Route::patch('/updatefollowup/{id}', 'LeadsController@updateFollowup')->name('leads.followup');
    });
    Route::resource('leads', 'LeadsController');
    Route::post('/comments/{type}/{id}', 'CommentController@store');
    /*
     * Settings
     */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingsController@index')->name('settings.index');
        Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
        Route::patch('/overall', 'SettingsController@updateOverall');
    });

    /*
     * Departments
     */
    Route::resource('departments', 'DepartmentsController');

    /*
     * Integrations
     */
    Route::group(['prefix' => 'integrations'], function () {
        Route::get('Integration/slack', 'IntegrationsController@slack');
    });
    Route::resource('integrations', 'IntegrationsController');

    /*
     * Notifications
     */
    Route::group(['prefix' => 'notifications'], function () {
        Route::post('/markread', 'NotificationsController@markRead')->name('notification.read');
        Route::get('/markall', 'NotificationsController@markAll');
        Route::get('/{id}', 'NotificationsController@markRead');
    });

    /*
     * Invoices
     */
    Route::group(['prefix' => 'invoices'], function () {
        Route::post('/updatepayment/{id}', 'InvoicesController@updatePayment')->name('invoice.payment.date');
        Route::post('/reopenpayment/{id}', 'InvoicesController@reopenPayment')->name('invoice.payment.reopen');
        Route::post('/sentinvoice/{id}', 'InvoicesController@updateSentStatus')->name('invoice.sent');
        Route::post('/newitem/{id}', 'InvoicesController@newItem')->name('invoice.new.item');
    });
    Route::resource('invoices', 'InvoicesController');
});
