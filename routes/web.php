<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
Auth::routes();
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::get('/assigntocourse',function (){
        $siteTitle = "Assign to course builder";
       return view('admin.assign');
    });
    Route::get('/mail_template',function (){
       return view('admin.email_template');
    });
    Route::get('/email_notification',function (){
       return view('admin.email_notification');
    });

    //admin work

    Route::get('/admin_report','CourseRequestController@adminReport')->name('admin_report');
    Route::post('assignCourseBuilder/{id}','CourseRequestController@assignCourseBuilder')->name('assignCourseBuilder');
    Route::post('assignCourseBuilderTo/{id}','CourseRequestController@assignCourseBuilderTo')->name('assignCourseBuilderTo');
    Route::get('/mail_teemplate','AdminController@adminEmail')->name('adminEmailTemplate');
    Route::get('/admin/helpDesk', 'HelpDeskController@adminHelpDesk')->name('adminHelpDesk');
    Route::get('/admin/helpDesk/view/{id}', 'HelpDeskController@adminHelpView')->name('adminHelpView');


    //admin work

    //add colleges
        Route::get('/collages/create', 'CollagesController@create')->name('createCollageRoute');
        Route::get('/collages','CollagesController@index')->name('AllCollages');
        Route::post('/collages/create','CollagesController@store')->name('collageStore');
        Route::post('/collages/edit/{id}','CollagesController@edit')->name('collageEdit');
        Route::post('/collages/update/{id}','CollagesController@update')->name('collageUpdate');
    //end of collages
    //add Department
        Route::get('/departments/create', 'DepartmentController@create')->name('createDepartmentRoute');
        Route::get('/departments','DepartmentController@index')->name('AllDepartment');
        Route::post('/departments/create','DepartmentController@store')->name('departmentStore');
    //end of Department
    //add courses
        Route::get('/courses/create', 'CoursesController@create')->name('createCourseRoute');
        Route::get('/courses','CoursesController@index')->name('AllCourses');
        Route::post('/courses/create','CoursesController@store')->name('courseStore');
        Route::get('/courses/edit/{id}','CoursesController@edit')->name('editCourse');
        Route::post('/courses/update/{id}','CoursesController@update')->name('courseUpdate');
    //end of courses
    //add workshop
        Route::get('/workshops/create', 'WorkshopController@create')->name('createWorkshopRoute');
        Route::get('/workshops','WorkshopController@index')->name('AllWorkshops');
        Route::get('/workshops/edit/{id}','WorkshopController@edit')->name('workshopEdit');
        Route::get('/workshops/show/{id}','WorkshopController@show')->name('workshopShow');
        Route::post('/workshops/update/{id}','WorkshopController@update')->name('workshopUpadate');
        Route::post('/workshops/create','WorkshopController@store')->name('workshopStore');
    //end of workshop
    //add course request
        Route::get('/ecourserequest', 'CourseRequestController@create')->name('ecourseRequestRoute');
        Route::post('/ecourserequest','CourseRequestController@store')->name('ecourseRequestRouteCreate');

    //end of workshop

    //instructor Dashboard
            Route::get('/instructor/dashboard', 'CourseRequestController@instructorDashboard')->name('insDash');
            Route::get('/instructor/report', 'CourseRequestController@instructorReport')->name('instructorReport');
            Route::get('/instructor/helpDesk', 'HelpDeskController@index')->name('insHelpDash');
            Route::get('/instructor/helpDesk/create', 'HelpDeskController@create')->name('insHelpCreate');
            Route::post('/instructor/helpDesk/create', 'HelpDeskController@store')->name('insHelpStore');
            Route::post('/reactive_request/{id}','CourseRequestController@ecourseRequestReactive')->name('ecourseRequestReactive');
            Route::post('/instructor/edit_request/{id}', 'CourseRequestController@course_edit_instructor')->name('editRequestByInstructor');
    //end instructor dashboard
    //course builder Dashboard
            Route::get('/course_builder/dashboard', 'CourseRequestController@course_builderDashboard')->name('course_builderDashboard');
            Route::post('/course_builder/assigto/{id}', 'CourseRequestController@course_builderAssignTo')->name('course_builderAssignTo');
            Route::post('/course_builder/assigto', 'CourseRequestController@course_builderCourseActivate')->name('course_builderCourseActivate');
            Route::get('/course_builder/report', 'CourseRequestController@course_builderReport')->name('course_builderReport');
    //course builder  dashboard
    //director stuff
    Route::get('/director/dashboard', 'CourseRequestController@directorDashboard')->name('directorDashboard');
    Route::get('/director/report', 'CourseRequestController@directorReport')->name('directorReport');
    Route::post('/director/request/view/{id}', 'CourseRequestController@viewCourseDirector')->name('viewCourseDirector');
    ////end off director stuff

    //other stuff
    Route::get('/profile','AdminController@viewProfile');
    Route::post('/profile/edit','AdminController@updateProfile')->name('updateProfile');


    //year semester
    Route::get('/courses/years','YearController@index')->name('courseYear');
    Route::post('/courses/years/edit/{id}','YearController@editYear')->name('yearEdit');
    Route::post('/courses/years/update/{id}','YearController@updateYear')->name('yearUpdate');
    Route::post('/courses/semester/add','YearController@addSemester')->name('semesterAdd');
    Route::post('/courses/semester/edit/{id}','YearController@editSemester')->name('semesterEdit');
    Route::post('/courses/semester/update/{id}','YearController@updateSemester')->name('semesterUpdate');
    Route::post('/courses/semester/{id}','YearController@deleteSemester')->name('semeterDelete');
    Route::post('/courses/year/add','YearController@addYear')->name('yearAdd');
    Route::post('/courses/year/{id}','YearController@deleteYear')->name('yearDelete');
});

Route::get('/test','CoursesController@test');
