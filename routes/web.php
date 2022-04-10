<?php

use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Auth;

//Route::group(['middleware' => 'forbid-banned-user',], function () {      //раскоменть и бан начнет работать
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['middleware' => ['restrictedToDayLight']], function () {

//***************************** Панель администратора ****************************************
            Route::get('/admin', 'AdminController@log_view')->name('admin'); // Главная админка логи
            Route::get('/check_journal_full', 'AdminController@check_journal_full'); // проверка заполненности журналов
            Route::get('/admin/config_safety', 'AdminController@config_edit')->name('config_safety'); // Редактирование конфигурации безопасности
            Route::post('/admin/update_config_safety', 'AdminController@config_update')->name('update_config_safety'); // Сохранение конфигурации безопасности
            Route::get('pdf_logs', 'AdminController@pdf_logs')->name('pdf_logs')->middleware('password.confirm'); // скачать журнал логов
            Route::get('clear_logs', 'AdminController@clear_logs')->name('clear_logs')->middleware('password.confirm'); // очистить журнал логов
            Route::get('admin/ban/{id}', 'AdminController@ban1_user');  //Блокировка пользователя
            Route::get('admin/unban/{id}', 'AdminController@unban_user');  //Разблокировка пользователя
            Route::get('/admin/perm', 'AdminController@perm_view'); //Отображение привелегий
            Route::resource('roles', RoleController::class);    //Работа с ролями
            Route::resource('users', UserController::class);    //Работа с пользователями
            //********************* Смена пароля ****************************************
            Route::get('/change-password', 'ChangePasswordController@index')->name('changepwd');
            Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
            //********************* SUMCHECKER ******************************************
            Route::get('/sumcontroller/get_tree', 'SumCheckerController@get_tree');
            Route::get('/sumcontroller/test', 'SumCheckerController@test');
            Route::get('/sumcontroller/test2', 'SumCheckerController@test_view');
            Route::get('/sumcontroller/get_choiced', 'SumCheckerController@get_choiced');
            Route::post('/sumcontroller/set_paths', 'SumCheckerController@set_paths');
            Route::get('/sumcontroller/cmd', 'SumCheckerController@sumchecker_cmd');
            Route::get('/sumcontroller/get_all_logs', 'SumCheckerController@get_all_logs');
//******************************* Технологический блок ******************************************
            //********************* Главная ***********************************************
            Route::get('/', ['as' => 'gazprom', 'uses' => 'MenuController@view_menu']);
            //********************* Страница ОПО ******************************************
            Route::get('/opo', 'OpoController@view_opo');













//********************* Технологический блок ****************************************
            Route::get('/opo/{id}', 'OpoController@view_opo_id');  //страница опо с графиками
            Route::get('/opo_params/{id}', 'OpoController@get_opo_params'); //Данные для опо
            Route::get('/opo/{id}/data/{db_count}', 'OpoController@get_opo_data');
            Route::get('/opo/{id}/main', 'OpoController@view_opo_main_shema');   // страница опо со схемой расположения елементов ОПО
            Route::get('/min_opo', 'OpoController@min_ip_of_opo'); // вытягиваем минимальное значение ИП по ОПО
            Route::get('/mini_graphics_opo/{id}', 'OpoController@mini_graphics_opo'); // вытягиваем минимальное значение ИП по ОПО

            //********************* Данные ручного ввода ****************************************
            Route::resource('operational', OperationalSafetyController::class);   //ручной ввод показателя безопасности
            Route::get('/opo/{id}/main/new_safety', 'OpoController@new');   // cоздание новой записи
            Route::get('/opo/{id}/main/new_ready', 'OpoController@new_ready');   // cоздание новой записи
            Route::resource('failure_free', FailureFreeController::class);   //ручной ввод показателя безаварийности
            Route::get('/opo/{id}/main/new_failure_free', 'OpoController@new_failure_free');   // cоздание новой записи


            Route::get('/jas_full', "JasController@showJas"); // страница Журнала событий полная

//    Route::get('/opo/getjas1/', 'OpoController@get_jas1'); //Достаем данные из базы данных для таблицы
            Route::get('/opo/getjas1/{count}', 'OpoController@get_jas1');
            Route::get('/opo/get_sum/all', 'OpoController@get_sum');
            Route::post('/opo/set_check_for_opo', 'OpoController@set_check');

//****************** Документарный блок *************************************
            Route::get('/docs/glossary', ['as' => 'glossary', 'uses' => 'GlossaryControllers@showHelp']); // страница Справки
            Route::get('/docs/events', "MatrixControllers@showEvent"); // страница Возможных событий матрицы
            Route::get('/docs/koef', "MatrixControllers@showkoef"); // страница справочника коэфициетов
            Route::get('/docs/calendar_event', "MatrixControllers@show_calendar_event"); // страница справочника типов событий календаря
//****************** Предписания РТН *************************************
            Route::get('/docs/predRTN', "MatrixControllers@show_RTN_all"); // страница справочника предписаний РТН
            Route::get('/docs/predRTN/{id}/edit', "MatrixControllers@edit_RTN")->name('edit_RTN'); // редактирование предписания РТН
            Route::post('/docs/predRTN/{id}/update', "MatrixControllers@update_RTN")->name('update_RTN'); // обновление предписания РТН
            Route::get('/docs/predRTN/{id}/show', "MatrixControllers@show_RTN")->name('show_RTN'); // просмотр предписания РТН
            Route::get('/docs/predRTN/{id}/delete', "MatrixControllers@delete_RTN")->name('delete_RTN'); // удаление предписания РТН
            Route::get('/docs/predRTN/create', "MatrixControllers@create_RTN")->name('create_RTN'); // создание предписания РТН
            Route::post('/docs/predRTN/store', "MatrixControllers@store_RTN")->name('store_RTN'); // сохранение предписания РТН
//****************** Справочник ОПО *************************************
//****************** Справочник элементов ОПО *************************************
//****************** Справочник ТБ *************************************


            Route::get('/docs/rtn', ['as' => 'rtn', 'uses' => 'MatrixControllers@Showrtn']); // страница справочника коэфициетов
            Route::get('/docs/reglament', ['as' => 'reglament', 'uses' => 'MatrixControllers@Showregl']); // страница справочника регламентных значений
            Route::get('/docs/matrix', ['as' => 'matrix', 'uses' => 'MatrixControllers@Showmatrix']); // страница справочника регламентных значений

            Route::get('docs/upload', ['as' => 'upload_form', 'uses' => 'UploadController@getForm']); //Отображение списка файлов
            Route::post('docs/upload', ['as' => 'upload_file', 'uses' => 'UploadController@upload']); // Загрузка файла на сервер
            Route::get('docs/open/{id}', ['as' => 'open_file', 'uses' => 'UploadController@open']); // Просмотр файла
            Route::get('docs/upload/delete/{id}', ['as' => 'upload_delete', 'uses' => 'UploadController@delete']); //Удаление файла



            //ИЗМЕНЕНИЕ ДАННЫХ В ТАБЛИЦЕ!!!!
            Route::post('/docs/changeparam', 'MatrixControllers@change_param');


            //**************** Ситуационный план ***************************************************
//    Route::get('/opo/{id}/plan', function ($id) {
//        return view('web.maps.plan', ['id' => $id]);
//    }); // страница ситуационного плана ОПО
            Route::get('/opo/{id}/plan', 'OpoController@view_plan');// страница ситуационного плана ОПО


            //**************** Все остальное *******************************************************
            Route::get('/opo_plan/{opo}', function ($opo) {
                return view('opo_plan', ['opo' => $opo]);
            })->name('opo')->middleware('auth');  // Уровень ОПО план
            Route::get('/element/{elem}', function ($elem) {
                return view('element', ['elem' => $elem]);
            })->name('element')->middleware('auth');  // Уровень Элемента главная
            Route::get('/element/{elem_id}/oto/{oto}', function ($elem_id, $oto) {
                return view('oto', ['elem_id' => $elem_id, 'oto' => $oto]);
            })->name('oto')->middleware('auth');  // Уровень Элемента декомпозиция на ОТО
            Route::get('/ref_opo', 'ElemController@view_tu')->name('ref_opo');
            Route::view('/tests', 'ref_opo');

            //*****************   Данные  **************************
            Route::get('charts/fetch-data/{id}', 'OpoController@view_ip_last'); //вывод текущего показателя ИП ОПО 30 последних
            Route::get('charts/fetch-data/{id}/data/{data}', 'OpoController@view_ip_last_test'); //вывод текущего показателя ИП ОПО за данную дату ТЕКУЩАЯ
            Route::get('charts/fetch-data-hour/{id}/data/{data}', 'OpoController@view_ip_last_test_hour'); //вывод показателя ИП ОПО за данную дату ЧАСОВАЯ
            Route::get('charts/fetch-data-day/{id}/data/{data}', 'OpoController@view_ip_last_test_day'); //вывод показателя ИП ОПО за данную дату СУТОЧНАЯ
            Route::get('charts/fetch-data-prognoz/{id}', 'OpoController@view_ip_pro_last'); //вывод прогнозного показателя ИП ОПО 30 последних
            Route::get('charts/fetch-data-prognoz/{id}/data/{data}', 'OpoController@view_ip_pro_date'); //вывод прогнозного показателя ИП ОПО за данную дату ЧАСОВАЯ
            Route::get('charts/fetch-data-prognoz-day/{id}/data/{data}', 'OpoController@view_ip_pro_date_day'); //вывод прогнозного показателя ИП ОПО за данную дату СУТОЧНАя
            Route::get('charts/fetch-data-prognoz-month/{id}/data/{data}', 'OpoController@view_ip_pro_date_month'); //вывод прогнозного показателя ИП ОПО за данную дату МЕСЯЧНАЧ
            Route::get('charts/fetch-data_elem/{id_obj}', 'ObjController@calc_elem_all');          // вывод интегрального показателя элемента ОПО
            Route::get('charts/fetch-data_elem_op_m/{id_obj}', 'ObjController@calc_elem_op_m');    //вывод Обобщенного показателя по матричным сценариям
            Route::get('charts/fetch-data_elem_op_r/{id_obj}', 'ObjController@calc_elem_op_r');    //вывод Обобщенного показателя по регламентным значениям
            Route::get('charts/fetch-data_elem_op_el/{id_obj}', 'ObjController@calc_elem_op_el');    //вывод Обобщенного показателя по елементу

            ///////////********************  Отчеты  ***********************************




            ///////////************** Отчеты PDF **************************************/////////////////////////
            Route::get('pdf/{start}/{finish}', 'PdfReportController@pdf_xml_journal');     // пример формирования Pdf

            ////////////******************** Отчеты XML**************************************
            Route::get('xml', 'XMLController@automatic_event');     //пример формирования Xml



            //*******************************************************

            Route::get('/jas_up_chek', function () {
                App\Jas::updated_check(5);
            })->name('trend');
            Route::get('/php', function () {
                phpinfo();
            });

            Route::get('/opo_day', function () {
                return view('opo_day');
            })->name('opo_day');
//Route::get('charts/chart_1', function () {return view('charts/chart_1');})->name('chart_1');
            Route::get('/charts/chart_ip_opo', function () {
                return view('charts/chart_ip_opo');
            })->name('chart_ip_opo');


//Route::group(['middleware' => ['auth']], function() {


            //----------КАЛЕНДАРЬ СОБЫТИЙ--------------//
            Route::get('/eventsCal/{opo_id}', 'EventsCalendarController@index');
            Route::post('/full-calendar/action', 'EventsCalendarController@action');
//    Route::get('/full-calendar/test', 'EventsCalendarController@test');  // Тест




            //----------------КАЛЕНДАРЬ ТЕХНИЧЕСКОГО ОБСЛУЖИВАНИЯ--------------//
            Route::get('/maintenance/{obj_id}', 'MaintenanceCalendarController@index_elem');
            Route::post('/maintenance/action', 'MaintenanceCalendarController@action');
            Route::get('/opo/{opo_id}/maintenances', 'MaintenanceCalendarController@index_opo');

        });
    });
//});
//*******************************************
Auth::routes();
Route::get('/logout', function () {    Auth::logout();    return Redirect::to('login');});




Route::get('/search/{id_s}', function ($id_s){
    $data = [
        ['id' => 1, 'name' => 'Admin'],
        ['id' => 2, 'name' => 'Truehero'],
        ['id' => 3, 'name' => 'Truecoder'],
    ];

       return view('web.opo_shema_main', ['name' => $id_s, 'data'=>$data]);
});






