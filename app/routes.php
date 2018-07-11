<?php

#Route::get('/', 'App\Controllers\Common\IndexController@index');

#Route::get('/index', 'App\Controllers\Common\IndexController@index');

Route::get('/', function(){
    return Redirect::to('/dashboard');
});

Route::get('/dashboard', 'App\Controllers\Dashboard\IndexController@index');

Route::get('/login', 'AuthenticationController@create');
Route::post('/auth-check', array('as' => 'user.login', 'uses' =>'AuthenticationController@store'));
Route::get('/logout', 'AuthenticationController@destroy');

Route::get('/signup', 'App\Controllers\Common\CustomersController@signup');

Route::post('/customers/store', 'App\Controllers\Common\CustomersController@store');
Route::get('/success', 'App\Controllers\Common\CustomersController@success');

Route::get('/profile', 'App\Controllers\Dashboard\UsersController@profile');

Route::post('/user/update-profile', 'App\Controllers\Dashboard\UsersController@updateProfile');

Route::get('/dashboard/add-client', 'App\Controllers\Dashboard\ClientsController@createClient');

Route::post('/client/store', 'App\Controllers\Dashboard\ClientsController@storeClient');

Route::get('/dashboard/clients', 'App\Controllers\Dashboard\ClientsController@getAllClients');

Route::post('/user/change-password', 'App\Controllers\Dashboard\UsersController@changePassword');
Route::post('/user/change-avatar', 'App\Controllers\Dashboard\UsersController@changeAvatar');

Route::get('password/reset', array('uses' => 'RemindersController@getRemind','as' => 'password.remind'));
Route::post('password/reset', array('uses' => 'RemindersController@postRemind','as' => 'password.request'));
Route::get('password/reset/{token}', array('uses' => 'RemindersController@getReset','as' => 'password.reset'));
Route::post('password/reset/{token}', array('uses' => 'RemindersController@postReset','as' => 'password.update'));

Route::get('events', array('uses' => 'App\Controllers\Dashboard\EventsController@index','as' => 'event.index'));
Route::get('events/create', array('uses' => 'App\Controllers\Dashboard\EventsController@createEvent','as' => 'create.event'));
Route::post('events/create', array('uses' => 'App\Controllers\Dashboard\EventsController@saveEvent','as' => 'save.event'));
Route::get('/events/create/{id}', array('uses' => 'App\Controllers\Dashboard\EventsController@editEvent','as' => 'edit.edit'));
Route::post('events/get-all', array('uses' => 'App\Controllers\Dashboard\EventsController@getAllEvents','as' => 'get.events'));
Route::get('events/get-event-details', array('uses' => 'App\Controllers\Dashboard\EventsController@getEventDetails','as' => 'get.event'));
Route::get('events/get-clients-suggeston', array('uses' => 'App\Controllers\Dashboard\EventsController@getClientsSuggestion','as' => 'get.clients.suggestion'));
Route::get('event/delete/{id}', array('uses' => 'App\Controllers\Dashboard\EventsController@deleteEvent','as' => 'delete.events'));
Route::get('/events/settings', 'App\Controllers\Dashboard\EventsController@settings');
Route::post('/dashboard/events/save-settings', 'App\Controllers\Dashboard\EventsController@saveSettings');

Route::get('/dashboard/client/{id}', 'App\Controllers\Dashboard\ClientsController@getClientDetail');
Route::post('/dashboard/client/update-client/{id}', 'App\Controllers\Dashboard\ClientsController@updateClient');
Route::post('/dashboard/client/update-client-note/{id}', 'App\Controllers\Dashboard\ClientsController@updateClientNote');
Route::post('/dashboard/client/destroy', 'App\Controllers\Dashboard\ClientsController@destroy');
Route::post('/dashboard/client-avatar', 'App\Controllers\Dashboard\ClientsController@updateClientPhoto');
Route::post('/dashboard/client/file-store/', 'App\Controllers\Dashboard\ClientsController@storeClientFiles');
Route::post('/dashboard/client-file/destroy', 'App\Controllers\Dashboard\ClientsController@destroyClientFiles');

Route::get('/dashboard/add-admin', 'App\Controllers\Dashboard\UsersController@createAdmin');
Route::post('/dashboard/user/store-admin', 'App\Controllers\Dashboard\UsersController@storeAdmin');
Route::get('/dashboard/admins', 'App\Controllers\Dashboard\UsersController@getAllAdmins');
Route::get('/dashboard/admin/{id}', 'App\Controllers\Dashboard\UsersController@adminProfile');
Route::post('/admin/change-password/{id}', 'App\Controllers\Dashboard\UsersController@changeAdminPassword');
Route::post('/dashboard/admin/destroy', 'App\Controllers\Dashboard\UsersController@destroy');
Route::get('/dashboard/customers', 'App\Controllers\Dashboard\UsersController@getAllCustomers');
Route::get('/dashboard/customer/{id}', 'App\Controllers\Dashboard\UsersController@getCustomer');

Route::get('/dashboard/faqs/create', 'App\Controllers\Dashboard\FaqsController@create');
Route::post('/dashboard/faqs/store', 'App\Controllers\Dashboard\FaqsController@storeFaq');
Route::get('/dashboard/faqs', 'App\Controllers\Dashboard\FaqsController@getAllFaqs');
Route::get('/dashboard/faq/{id}', 'App\Controllers\Dashboard\FaqsController@editFaq');
Route::post('/dashboard/faq/update/{id}', 'App\Controllers\Dashboard\FaqsController@updateFaq');
Route::post('/dashboard/faq/destroy', 'App\Controllers\Dashboard\FaqsController@destroy');

Route::get('/contact-us', 'App\Controllers\Common\ContactUsController@index');
Route::post('/question/process/', 'App\Controllers\Common\ContactUsController@process');

Route::get('/dashboard/marketing-material/create', 'App\Controllers\Dashboard\MarketingMaterialsController@create');
Route::post('/dashboard/marketing-material/store', 'App\Controllers\Dashboard\MarketingMaterialsController@store');
Route::get('/dashboard/marketing-materials', 'App\Controllers\Dashboard\MarketingMaterialsController@getAllMarketingMaterials');
Route::get('/dashboard/marketing-material/{id}', 'App\Controllers\Dashboard\MarketingMaterialsController@edit');
Route::post('/dashboard/marketing-material/update', 'App\Controllers\Dashboard\MarketingMaterialsController@update');
Route::post('/dashboard/marketing-material/destroy', 'App\Controllers\Dashboard\MarketingMaterialsController@destroy');
Route::get('/marketing-materials', 'App\Controllers\Common\MarketingMaterialsController@getAllMarketingMaterials');

Route::get('/dashboard/videos', array('uses' => 'App\Controllers\Dashboard\VideosController@index','as' => 'videos.index'));
Route::get('/dashboard/video/add', array('uses' => 'App\Controllers\Dashboard\VideosController@addVideo','as' => 'videos.index'));
Route::post('/dashboard/video/add', array('uses' => 'App\Controllers\Dashboard\VideosController@saveVideo','as' => 'videos.add'));
Route::get('/dashboard/video/{id}', array('uses' => 'App\Controllers\Dashboard\VideosController@editVideo','as' => 'video.edit'));
Route::post('/dashboard/video/delete', array('uses' => 'App\Controllers\Dashboard\VideosController@deleteVideo','as' => 'video.delete'));
Route::get('/videos/{type?}', array('uses' => 'App\Controllers\Dashboard\VideosController@show','as' => 'videos.show'));

Route::get('/goals/create', 'App\Controllers\Dashboard\ReportsController@create');
Route::post('/goals/store', 'App\Controllers\Dashboard\ReportsController@store');
Route::post('/goals/update', 'App\Controllers\Dashboard\ReportsController@update');

Route::get('/dashboard/monthly-goal', 'App\Controllers\Dashboard\ReportsController@showMonthlyChart');
Route::get('/dashboard/monthly-cost', 'App\Controllers\Dashboard\ReportsController@getMonthlyData');
Route::get('/dashboard/yearly-goal', 'App\Controllers\Dashboard\ReportsController@showYearlyChart');
Route::get('/dashboard/yearly-cost', 'App\Controllers\Dashboard\ReportsController@getYearlyData');

Route::get('/dashboard/settings', 'App\Controllers\Dashboard\SettingsController@index');
Route::post('/dashboard/settings/update', 'App\Controllers\Dashboard\SettingsController@update');

Route::get('/dashboard/business/tool/add', 'App\Controllers\Dashboard\BusinessToolsController@create');
Route::post('/dashboard/business/tool/store', 'App\Controllers\Dashboard\BusinessToolsController@store');
Route::get('/dashboard/business/tools', 'App\Controllers\Dashboard\BusinessToolsController@index');
Route::post('/dashboard/business/tool/destroy', 'App\Controllers\Dashboard\BusinessToolsController@destroy');
Route::get('/dashboard/business/tool/edit/{id}', 'App\Controllers\Dashboard\BusinessToolsController@edit');
Route::post('/dashboard/business/tool/update', 'App\Controllers\Dashboard\BusinessToolsController@update');
Route::get('/dashboard/business/tools/type/{type?}', array('uses' => 'App\Controllers\Dashboard\BusinessToolsController@show','as' => 'business-tools.show'));

Route::get('/send-email-179123', function(){
    Schedule::sendReminderEmails();
});

Route::get('/dashboard/todo', 'App\Controllers\Dashboard\TodolistController@index');
Route::get('/dashboard/todo/tags', 'App\Controllers\Dashboard\TodolistController@getTags');
Route::post('/dashboard/todo/store', 'App\Controllers\Dashboard\TodolistController@saveTask');
Route::get('/dashboard/todo/task/{id}', 'App\Controllers\Dashboard\TodolistController@getTaskById');
Route::post('/dashboard/todo/update', 'App\Controllers\Dashboard\TodolistController@updateTask');
Route::get('/dashboard/todo/remove/{id}', 'App\Controllers\Dashboard\TodolistController@removeTaskById');
Route::get('/dashboard/todo/complete/{id}', 'App\Controllers\Dashboard\TodolistController@markTaskAsComplete');