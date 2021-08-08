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

// Route::get('{url}', function ($url) {

//     echo "mishkat";

// })->where(['url' => '"/home"|"/"']);


Route::group(['middleware' => ['auth' , 'checkAvailablity']], function () {

    Route::get('/' , 'HomeController@index');
    Route::get('/home' , 'HomeController@index');


    Route::get('/Dashboard', function () {
        return view('Dashboard.dashboard');
    });
    // project for user
    Route::get('/dashboard/availableProject', 'projectController@myproject');
    Route::post('/dashboard/user/addTask/{id}', 'userTaskController@addTask');
    Route::post('/dashboard/structure/addUserphoto', 'userTaskController@addUserphoto')->name('addUserphoto');

    //add note to task
     Route::post('/dashboard/add_note', 'userTaskController@add_note')->name('add_note');
      Route::get('/dashboard/shownotes', 'userTaskController@shownotes')->name('shownotes');



    // status

    Route::post('/dashboard/status/update' , 'userTaskController@status')->name('statusUpdate');
    Route::get('/dashboard/task/downloadPaper/{destination}', 'userTaskController@getDownload');

    // password

    Route::post('/dashboard/changepassword' , 'profileController@setPassword')->name('setPassword');
    //Families
   Route::get('/dashboard/project/family', 'heyahKaremaController@addFamilyProject');
   Route::post('/dashboard/addFamily', 'heyahKaremaController@addFamilyIndex');
   Route::post('/dashboard/addFamily/add', 'heyahKaremaController@addFamily')->name('addFamily');
   Route::get('/dashboard/Family/project/{project}/show', 'heyahKaremaController@projectShowFamilies');
   Route::get('/dashboard/Family/{family}/show', 'heyahKaremaController@continueFamily');




    //enquirys
    Route::resources(['enquiry' => 'EnquiryController']);
    Route::get('/getenquiry','EnquiryController@getenquiry');
    Route::get('/getenquiryforone',  'EnquiryController@getenquiryforone');
    Route::get('/getenquirySent',  'EnquiryController@getenquirySent');
    Route::apiResources(['comment' => 'CommentController']);
    Route::post('getcomments/{id}', 'CommentController@getcomments');
    Route::post('showComment',  'CommentController@showComment');
    //change Enquery status
    Route::post('changestatus/{id}','EnquiryController@changestatus');
    //Search Enquery status
    Route::post('searchstatus','allenquiryController@searchstatus');
     //allenquirys
    Route::resources(['allenquiry' => 'allenquiryController']);
    Route::get('/getallenquiry','allenquiryController@getallenquiry');

    // check user for enquiry
    Route::get('user' , 'EnquiryController@getUser');




  });



Route::group(['middleware' => ['auth' , 'checkAvailablity' ,'admin']], function () {

   // show profile
    Route::get('/dashboard/profile/{id}', 'profileController@profile');
    // upload extra paper
    Route::post('/dashboard/profile/uploadpaper' , 'structureController@uploadPaper')->name('uploadPaper');


    Route::get('/structure', function () {
        return view('dashboard.structure.user');
    });
        //
    Route::get('/project', function () {
        return view('dashboard.showProject');
    });
    // Strucrure


    Route::get('/dashboard/structure/addBranch', function () {
        return view('Dashboard.addBranch');
    });


    // statistics
    Route::get('/dashboard/structure/statistics', function(){
        return view('Dashboard.statistics');
    });

    // structure
    Route::post('/dashboard/addbranch', 'structureController@addBranch')->name('addBranch');
    Route::post('/dashboard/updatePaper', 'structureController@updatePaper')->name('updatePaper');
    Route::post('/dashboard/deletePaper/{id}', 'structureController@deletePaper')->name('deletePaper');

    // user
    Route::get('/dashboard/structure/addUser', 'structureController@userIndex');
    Route::get('/dashboard/structure/showUsers', 'structureController@showUsers');
    Route::get('/dashboard/structure/user/makeAdmin/{id}', 'structureController@makeAdmin');
    Route::get('/dashboard/structure/user/makeunAdmin/{id}', 'structureController@makeunAdmin');
    Route::get('/dashboard/structure/user/profiles', function(){
        return view('Dashboard.userProfile');
    });

    Route::get('/dashboard/structure/downloadPaper/{destination}', 'structureController@getDownload');
    Route::post('/dashboard/structure/addUser', 'structureController@addUser')->name('addUser');
    Route::post('/dashboard/user/delete', 'structureController@deleteUser')->name('deleteUser');
    Route::post('/dashboard/deleteUserPaper/{id}', 'structureController@deleteUserPaper')->name('deleteUserPaper');
            // changeAvailability
    Route::post('/dashboard/user/Availability' , 'structureController@changeAvailability' )->name('changeAvailability') ;



    // branch
    Route::get('/dashboard/structure/showBranches', 'structureController@showBranches');
    // branch statistics
    Route::get('/dashboard/structure/showBranch/{id}', 'reportController@branchStatistics');
    Route::get('/dashboard/structure/Branch/delete/{id}', 'structureController@deleteBranch');

    // ovjective
    Route::get('/dashboard/objectives', 'projectController@objectiveIndex');
    Route::post('/dashboard/addObjective', 'projectController@addObjective')->name('addObjective');
    Route::get('/dashboard/showObjectives', 'projectController@showObjectives')->name('showObjectives');
          // delete
    Route::post('/dashboard/objective/delete' , 'projectController@deleteObjective')->name('deleteObjective');
           // edit
    Route::post('/dashboard/objective/edit' , 'projectController@editObjective')->name('editObjective');

    // project
    Route::get('/dashboard/addProject', 'projectController@projectIndex');
    Route::post('/dashboard/addProject', 'projectController@addProject')->name('addProject');
    Route::get('/dashboard/showProject', 'projectController@showProjects');
    Route::get('/dashboard/project/tasks/{id}', 'projectController@showProject');
    Route::get('/dashboard/projects/tasks/{id}', 'projectController@showallnameProject');
    Route::get('/dashboard/project/tasksfortask/{id}', 'projectController@showProjectforDoneTask');
    Route::post('/dashboard/project/edit' , 'projectController@editProject')->name('editProject');
    Route::post('/dashboard/project/delete' , 'projectController@deleteProject')->name('deleteProject');
    // tasks

    Route::get('/dashboard/showTasks', 'projectController@showTasks');
    Route::get('/dashboard/Tasks/print', 'projectController@printTasks');
    Route::get('/dashboard/addTask', 'projectController@addTask');
    Route::post('/dashboard/task/delete', 'projectController@deleteTask')->name('deleteTask');
    Route::post('/dashboard/task/edit', 'projectController@editTask')->name('editTask');
    Route::post('/dashboard/addTask/{id}', 'projectController@addTask')->name('addTask');
    Route::get('/dashboard/tasks', 'tasksController@index');

    // follow Tasks
    Route::get('/dashboard/task/follow-up/task', 'followTaskController@index');
    Route::post('/dashboard/task/follow-up/task/taskConfirmation', 'followTaskController@taskConfirmation')->name('taskConfirmation');
    Route::post('/dashboard/task/follow-up/task/taskNotConfirmation', 'followTaskController@taskNotConfirmation')->name('taskNotConfirmation');

    Route::post('/dashboard/task/follow-up/task/statusConfirmation', 'followTaskController@statusConfirmation')->name('statusConfirmation');

    Route::post('/dashboard/task/follow-up/task/statusDenay', 'followTaskController@statusDenay')->name('statusDenay');
    Route::post('/dashboard/task/follow-up/task/taskDenay', 'followTaskController@taskDenay')->name('taskDenay');

    // excel
    Route::get('excel/profile','excelController@profileExport' )->name('exportUser');
    Route::get('excel/project','excelController@projectExport' )->name('exportProject');
    Route::get('/dashboard/papers','userController@paper');
    Route::get('/hierarchy' , function(){
        return view('Dashboard.hierarchy');
    });


    //hierarchy
    //show
    Route::get('/dashboard/hierarchy','structureController@showHierarchy');
        //add hierarchy
    Route::post('/dashboard/hierarchy/add','structureController@addDepartment')->name("addDepartment");
    Route::post('/dashboard/hierarchy/EditDepartment','structureController@EditDepartment')->name("EditDepartment");


    Route::post('/dashboard/hierarchy/edit','structureController@editSection')->name("editSection");

    Route::post('/dashboard/hierarchy/addSection','structureController@addSection')->name("addSection");
    Route::post('/dashboard/hierarchy/addMember','structureController@addMember')->name("addMemberToDepartment");
    Route::post('/dashboard/hierarchy/editMember','structureController@EditMember')->name("EditMemberToDepartment");




});



// for socialll

Route::group(['middleware' => ['auth' , 'social']], function () {

 // social

    Route::get('dashboard/social' , 'socialController@index');
    Route::get('dashboard/social/statistics' , 'socialController@statisticsIndex');
    Route::post('dashboard/createTable' , 'socialController@createTable')->name('createSocialTable');
    Route::post('dashboard/showTable/{id}' , 'socialController@showTable')->name('showSocialTable');
    Route::post('dashboard/api/rows/{id}' , 'socialController@fetchRows');
    Route::post('dashboard/api/rows' , 'socialController@updateRow');
    Route::post('dashboard/api/addrows/{id}' , 'socialController@addRow');
    Route::post('dashboard/api/deleterow/{id}' , 'socialController@deleteRow');

    Route::get('dashboard/api/rows/all' , 'socialController@fetchRowsAll');

});



Route::get('/test' , 'testController@test');

Route::get('/key', function(){
     Artisan::call('config:clear');
});







// Route::get('/myproject', function () {
//     return view('dashboard.myproject');
// });










// Route::get('excel/profile/{id}','testController@test' );

// Route::post('excel','excelController@excel' )->name('exportUsers');




// ////////////////////////////////
// SEEDER




Auth::routes(['register' => false]);

