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

Route::get('/', function () {
    return view('apps.pages.login');
});

Auth::routes(['register' => false]);
/* Route::group(['prefix' => 'apps', 'middleware' => ['auth']], function() {
    Route::get('login/locked','Auth\LoginController@locked')->name('login.locked');
    Route::post('login/locked','Auth\LoginController@unlock')->name('login.unlock'); 
}); */
Route::group(['prefix' => 'apps', 'middleware' => ['auth']], function() {
    
    Route::resource('dashboard','Apps\DashboardController');
    /*-----------------------User Management-----------------------------*/
    Route::get('users','Apps\UserManagementController@userIndex')->name('user.index');
    Route::post('users/create','Apps\UserManagementController@userStore')->name('user.store');
    Route::post('users/upload','Apps\UserManagementController@userUpload')->name('userUpload.store');
    Route::get('users/edit/{id}','Apps\UserManagementController@userEdit')->name('user.edit');
    Route::get('users/show/{id}','Apps\UserManagementController@userShow')->name('user.show');
    Route::post('users/update/{id}','Apps\UserManagementController@userUpdate')->name('user.update');
    Route::post('users/suspend/{id}','Apps\UserManagementController@userSuspend')->name('user.suspend');
    Route::post('users/delete/{id}','Apps\UserManagementController@userDestroy')->name('user.destroy');
    Route::get('users/profile', 'Apps\UserManagementController@userProfile')->name('user.profile');
    Route::post('users/profile/avatar', 'Apps\UserManagementController@updateAvatar')->name('user.avatar');
    Route::post('users/profile/password', 'Apps\UserManagementController@updatePassword')->name('user.password');
    Route::get('users/roles','Apps\UserManagementController@roleIndex')->name('role.index');
    Route::get('users/roles/create','Apps\UserManagementController@roleCreate')->name('role.create');
    Route::post('users/roles/store','Apps\UserManagementController@roleStore')->name('role.store');
    Route::get('users/roles/edit/{id}','Apps\UserManagementController@roleEdit')->name('role.edit');
    Route::get('users/roles/show/{id}','Apps\UserManagementController@roleShow')->name('role.show');
    Route::post('users/roles/update/{id}','Apps\UserManagementController@roleUpdate')->name('role.update');
    Route::post('users/roles/delete/{id}','Apps\UserManagementController@roleDestroy')->name('role.destroy');
    Route::get('users/divisi','Apps\UserManagementController@ukerIndex')->name('uker.index');
    Route::post('users/divisi/create','Apps\UserManagementController@ukerStore')->name('uker.store');
    Route::get('users/divisi/edit/{id}','Apps\UserManagementController@ukerEdit')->name('uker.edit');
    Route::get('users/divisi/show/{id}','Apps\UserManagementController@ukerShow')->name('uker.show');
    Route::post('users/divisi/update/{id}','Apps\UserManagementController@ukerUpdate')->name('uker.update');
    Route::post('users/divisi/delete/{id}','Apps\UserManagementController@ukerDestroy')->name('uker.destroy');
    Route::get('users/departemen','Apps\UserManagementController@departIndex')->name('depart.index');
    Route::post('users/departemen/create','Apps\UserManagementController@departStore')->name('depart.store');
    Route::get('users/departemen/edit/{id}','Apps\UserManagementController@departEdit')->name('depart.edit');
    Route::post('users/departemen/update/{id}','Apps\UserManagementController@departUpdate')->name('depart.update');
    Route::post('users/departemen/delete/{id}','Apps\UserManagementController@departDestroy')->name('depart.destroy');
    Route::get('users/log-activities','Apps\LogActivityController@index')->name('user.log');
    /*-----------------------End User Management-----------------------------*/

    /*-----------------------Config Management-----------------------------*/
    Route::get('settings/facilitator','Apps\TrainingManagementController@facilitatorIndex')->name('facilitator.index');
    Route::post('settings/facilitator/create','Apps\TrainingManagementController@facilitatorStore')->name('facilitator.store');
    Route::get('settings/facilitator/edit/{id}','Apps\TrainingManagementController@facilitatorEdit')->name('facilitator.edit');
    Route::post('settings/facilitator/update/{id}','Apps\TrainingManagementController@facilitatorUpdate')->name('facilitator.update');
    Route::post('settings/facilitator/delete/{id}','Apps\TrainingManagementController@facilitatorDestroy')->name('facilitator.destroy');
    Route::get('settings/training/level','Apps\TrainingManagementController@trainingLevelIndex')->name('level.index');
    Route::post('settings/training/level/create','Apps\TrainingManagementController@trainingLevelStore')->name('level.store');
    Route::get('settings/training/level/edit/{id}','Apps\TrainingManagementController@trainingLevelEdit')->name('level.edit');
    Route::post('settings/training/level/update/{id}','Apps\TrainingManagementController@trainingLevelUpdate')->name('level.update');
    Route::post('settings/training/level/delete/{id}','Apps\TrainingManagementController@trainingLevelDestroy')->name('level.destroy');
    Route::get('settings/training/category','Apps\TrainingManagementController@trainingCategoryIndex')->name('category.index');
    Route::post('settings/training/category/create','Apps\TrainingManagementController@trainingCategoryStore')->name('category.store');
    Route::get('settings/training/category/edit/{id}','Apps\TrainingManagementController@trainingCategoryEdit')->name('category.edit');
    Route::post('settings/training/category/update/{id}','Apps\TrainingManagementController@trainingCategoryUpdate')->name('category.update');
    Route::post('settings/training/category/delete/{id}','Apps\TrainingManagementController@trainingCategoryDestroy')->name('category.destroy');
    Route::get('settings/questioner','Apps\TrainingManagementController@questionerIndex')->name('question.index');
    Route::get('settings/questioner/create','Apps\TrainingManagementController@questionCreate')->name('question.create');
    Route::get('settings/employees','Apps\UserManagementController@employeeIndex')->name('employee.index');

    /*-----------------------Training Management--------------------------------*/
    Route::get('training_hour/training','Apps\TrainingManagementController@trainingIndex')->name('training.index');
    Route::post('training_hour/training/create','Apps\TrainingManagementController@trainingStore')->name('training.store');
    Route::get('training_hour/training/edit/{id}','Apps\TrainingManagementController@trainingEdit')->name('training.edit');
    Route::post('training_hour/training/start/{id}','Apps\TrainingManagementController@trainingStart')->name('training.start');
    Route::post('training_hour/training/stop/{id}','Apps\TrainingManagementController@trainingStop')->name('training.stop');
    Route::post('training_hour/training/update/{id}','Apps\TrainingManagementController@trainingUpdate')->name('training.update');
    Route::post('training_hour/training/delete/{id}','Apps\TrainingManagementController@trainingDestroy')->name('training.destroy');
    Route::get('training_hour/training/detail/show/{id}','Apps\TrainingManagementController@trainingDetailShow')->name('trainingPeople.show');
    Route::get('training_hour/training/people/add/{id}','Apps\TrainingManagementController@trainingPeopleCreate')->name('people.create');
    Route::post('training_hour/training/people/store/{id}','Apps\TrainingManagementController@peopleAdd')->name('people.store');
    Route::get('training_hour/training/score/create/{id}','Apps\TrainingManagementController@trainingScore')->name('score.create');
    Route::post('training_hour/training/score/store/{id}','Apps\TrainingManagementController@trainingScoreStore')->name('score.store');
    Route::get('training_hour/training/score/individual/{id}','Apps\TrainingManagementController@trainingScoreEdit')->name('peopleScore.create');
    Route::post('training_hour/training/score/individual/update/{id}','Apps\TrainingManagementController@trainingScoreUpdate')->name('peopleScore.update');
    /*-----------------------End Training Management-----------------------------*/


    Route::get('training_hour/my_training','Apps\TrainingManagementController@employeeTrainingView')->name('myTraining.index');
    Route::post('training_hour/my_training/search','Apps\TrainingManagementController@employeeTrainingSearch')->name('myTraining.search');
    /*-----------------------Report Management--------------------------------*/
    Route::get('reports/training','Apps\ReportManagementController@trainingTable')->name('reportTraining.index');

    Route::get('training_hour/data','Apps\TrainingManagementController@trainingHourIndex')->name('hour.index');
    /*-----------------------End Config Management-----------------------------*/
});
