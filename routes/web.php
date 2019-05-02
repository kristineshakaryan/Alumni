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




Route::post('/setting','UserController@changePassword')->name('changePassword');
Route::post('/ResetPassword','UserController@ResetPassword')->name('ResetPassword');
Route::get('/ResetPassword/{token}','UserController@CheckToken');


Route::get('/','UserController@index')->middleware('login')->name('index');
Route::post('/ChangePassword','UserController@changePassword')->middleware('login')->name('ChangePassword');


/*
    Start User part
*/

Route::get('/login',function(){
    return view('user.login');
})->middleware('notLogin')->name('login.view');


Route::get('/ResetPassword',function(){
    return view('user.reset_password');
})->name('ResetPassword.view');

Route::group(['namespace' => 'User'], function () {
    Route::get('linkedin/callback', 'UserController@CallbackOnLinkedin')->name('user.linkedin.callback');
    Route::get('linkedin/redirect', 'UserController@RedirectToLinkedin')->name('user.linkedin.redirect');
    Route::get('/register','UserController@viewRegister')->name('register.view');
});


Route::group(['prefix' => 'user','namespace' => 'User'], function () {
    Route::get('logout','UserController@logout')->name('logout.user');
    Route::post('login','UserController@login')->name('login.user');
    Route::post('register','UserController@register')->name('register.user');

});


Route::group(['prefix' => 'user','namespace' => 'User','middleware' => ['login','User']], function () {

    Route::get('dashboard','UserController@Dashboard')->name('user.dashboard');
    Route::get('UserProfile/{id}','UserController@UserProfile')->name('user.user.profile');
    Route::get('EditProfile','UserController@EditProfile')->name('user.edit-profile');
    Route::post('EditProfile','UserController@EditProfile')->name('user.edit-profile');

/*
   Start Directory  part
*/
    Route::get('directory','DirectoryController@directory')->name('user.directory');
/*
    End Directory part
*/

/*
    Start Job part
*/
    Route::get('jobOffer','JobController@JobOffer')->name('user.job-offer');
/*
    End Job part
*/

/*
    Start Mentorat part
*/

    Route::get('mentorship','MentoratController@mentorship')->name('user.mentorship');

/*
    End Mentorat part
*/
    Route::get('post-job','UserController@postjob')->name('user.post-job');
    Route::get('profile','UserController@profile')->name('user.profile');

});
/*
    End User part
*/


/*
    Start  Admin part
*/
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['notLogin']], function () {
    Route::get('login',function(){
        return view('admin.login');
    })->name('login.admin.get');
    Route::post('login','AdminController@login')->name('login.admin');
});
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['login','Admin']], function () {
    Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');
    Route::get('profile','AdminController@profile')->name('admin.profile');
    Route::get('EditProfile','AdminController@EditProfile')->name('admin.edit-profile');
    Route::post('EditProfile','AdminController@EditProfile')->name('admin.edit-profile');
    Route::get('UserProfile/{id}','AdminController@UserProfile')->name('admin.user.profile');
    /*
       Start Directory  part
    */
    Route::get('directory','DirectoryController@directory')->name('admin.directory');
    Route::get('UserCSV','DirectoryController@UserCSV')->name('admin.user-csv');
    Route::get('UserEditProfile/{id}','DirectoryController@UserEditProfile')->name('admin.user.edit-profile');
    Route::get('NewUser','DirectoryController@NewUser')->name('admin.new-user');
    Route::post('UserEditProfile','DirectoryController@UserUpdateProfile')->name('admin.user.update-profile');
    Route::post('NewUser','DirectoryController@AddNewUser')->name('admin.new-user');
/*
    End Directory part
*/
/*
    Start Mentorat part
*/

    Route::get('mentorship','MentoratController@mentorship')->name('admin.mentorship');
    Route::get('MentorCSV','MentoratController@MentorCSV')->name('admin.mentor-csv');

/*
    End Mentorat part
*/

/*
    Start Job part
*/
    Route::get('jobOffer','JobController@JobOffer')->name('admin.job-offer');
/*
    End Job part
*/


});
/*
    End Admin part
*/



/*
    Start Super Admin part
*/
Route::get('/login/ZCSUUYpBXDlBwxoH5h23UBWW',function(){
    return view('super_admin.login');
})->middleware('notLogin')->name('login.super_admin.get');

Route::group(['prefix' => 'super_admin','namespace' => 'SuperAdmin'], function () {
    Route::post('login','SuperAdminController@login')->name('login.super_admin');
    Route::get('logout','SuperAdminController@logout')->name('logout.super_admin');
});

Route::group(['prefix' => 'super_admin','namespace' => 'SuperAdmin','middleware' => ['login','SuperAdmin']], function () {

Route::get('setting','SuperAdminController@setting')->name('super_admin.setting');
Route::get('/dashboard',function(){
    return view('super_admin.dashboard');
})->name('super_admin.dashboard');
/*
   Start Group  part
*/
    Route::get('AllGroups','GroupController@AllGroups')->name('super_admin.AllGroups');
    Route::get('NewGroup','GroupController@NewGroup')->name('super_admin.NewGroup');
    Route::get('GroupDetails/{id}','GroupController@GroupDetails')->name('super_admin.GroupDetails');
    Route::post('NewGroup','GroupController@AddNewGroup')->name('super_admin.NewGroup');
    Route::post('DeleteGroup','GroupController@DeleteGroup')->name('super_admin.DeleteGroup');
    Route::post('EditGroup','GroupController@EditGroup')->name('super_admin.EditGroup');
    Route::post('UpdateGroup','GroupController@UpdateGroup')->name('super_admin.UpdateGroup');
    Route::post('ShowSchools','GroupController@ShowSchools')->name('super_admin.ShowSchools');
    Route::post('AddAdminToGroup','GroupController@AddAdminToGroup')->name('super_admin.AddAdminToGroup');
/*
    End Group part
*/

/*
   Start Users  part
*/
    Route::get('AllUsers','UsersController@Allusers')->name('super_admin.AllUsers');
    Route::get('NewUser','UsersController@NewUser')->name('super_admin.NewUser');
    Route::get('UserDetails/{id}','UsersController@UserDetails')->name('super_admin.UserDetails');
    Route::get('DownloadSurveyAnswersUser/{id}','UsersController@DownloadSurveyAnswersUser')->name('super_admin.DownloadSurveyAnswersUser');
    Route::post('NewUser','UsersController@AddNewUser')->name('super_admin.NewUser');
    Route::post('AddNewUserCsv','UsersController@AddNewUserCsv')->name('super_admin.AddNewUserCsv');
    Route::post('DeleteUser','UsersController@DeleteUser')->name('super_admin.DeleteUser');
    Route::post('EditUser','UsersController@EditUser')->name('super_admin.EditUser');
    Route::post('UpdateUser','UsersController@UpdateUser')->name('super_admin.UpdateUser');
    /*
        End Users part
    */

    /*
       Start School part
    */
    Route::get('AllClients','SchoolController@AllClients')->name('super_admin.AllClients');
    Route::get('NewClient','SchoolController@NewClient')->name('super_admin.NewClient');
    Route::get('ClientDetails/{id}','SchoolController@ClientDetails')->name('super_admin.ClientDetails');
    Route::post('NewClient','SchoolController@AddNewClient')->name('super_admin.NewClient');
    Route::post('DeleteClient','SchoolController@DeleteClient')->name('super_admin.DeleteClient');
    Route::post('EditClient','SchoolController@EditClient')->name('super_admin.EditClient');
    Route::post('UpdateClient','SchoolController@UpdateClient')->name('super_admin.UpdateClient');
    Route::post('SendRecapMail','SchoolController@SendRecapMail')->name('super_admin.SendRecapMail');
    Route::post('AddAdminToClient','SchoolController@AddAdminToClient')->name('super_admin.AddAdminToClient');
    Route::post('SendMailNewsletter','SchoolController@SendMailNewsletter')->name('super_admin.SendMailNewsletter');
    Route::post('AddSurveyToSchool','SchoolController@AddSurveyToSchool')->name('super_admin.AddSurveyToSchool');
    /*
        End School part
    */
    /*
       Start School part
    */
    Route::get('EmailingAllUsers','EmailController@EmailingAllUsers')->name('super_admin.EmailingAllUsers');
    /*
        End School part
    */

    /*
       Start Degree part
    */
    Route::get('AllDegrees','DegreeController@AllDegrees')->name('super_admin.AllDegrees');
    Route::get('NewDegree','DegreeController@NewDegree')->name('super_admin.NewDegree');
    Route::get('DegreeDetails/{id}','DegreeController@DegreeDetails')->name('super_admin.DegreeDetails');
    Route::post('AddDegree','DegreeController@AddDegree')->name('super_admin.AddDegree');
    Route::post('NewDegree','DegreeController@AddNewDegree')->name('super_admin.NewDegree');
    Route::post('DeleteDegree','DegreeController@DeleteDegree')->name('super_admin.DeleteDegree');
    Route::post('EditDegree','DegreeController@EditDegree')->name('super_admin.EditDegree');
    Route::post('UpdateDegree','DegreeController@UpdateDegree')->name('super_admin.UpdateDegree');
    Route::post('GetDegreeOfTheSchools','DegreeController@GetDegreeOfTheSchools')->name('super_admin.GetDegreeOfTheSchools');
    /*
        End Degree part
    */

    /*
       Start Job Board part
    */
    Route::get('AllJobBoards','JobBoardController@AllJobBoards')->name('super_admin.AllJobBoards');
    Route::get('NewJobBoard','JobBoardController@NewJobBoard')->name('super_admin.NewJobBoard');
    Route::post('NewJobBoard','JobBoardController@AddNewJobBoard')->name('super_admin.NewJobBoard');
    Route::post('DeleteJobBoard','JobBoardController@DeleteJobBoard')->name('super_admin.DeleteJobBoard');
    Route::post('EditJobBoard','JobBoardController@EditJobBoard')->name('super_admin.EditJobBoard');
    Route::post('UpdateJobBoard','JobBoardController@UpdateJobBoard')->name('super_admin.UpdateJobBoard');
    /*
        End Job Board part
    */

    /*   Start Blog part
    */
    Route::get('NewBlog','BlogPostController@NewBlog')->name('super_admin.NewBlog');
    Route::post('NewBlog','BlogPostController@AddNewBlog')->name('super_admin.NewBlog');
    Route::get('AllBlogs','BlogPostController@AllBlogs')->name('super_admin.AllBlogs');
    Route::post('DeleteBlogPost','BlogPostController@DeleteBlogPost')->name('super_admin.DeleteBlogPost');
    Route::post('UploadImage','BlogPostController@UploadImage')->name('super_admin.UploadImage');
    /*
        End Blog part
    */

    /*   Start Surveys part
    */
    Route::get('NewSurvey','SurveyController@NewSurvey')->name('super_admin.NewSurvey');
    Route::get('AllSurveys','SurveyController@AllSurveys')->name('super_admin.AllSurveys');
    Route::post('AddSurvey','SurveyController@AddSurvey')->name('super_admin.AddSurvey');
    Route::post('DeleteSurvey','SurveyController@DeleteSurvey')->name('super_admin.DeleteSurvey');
    /*
        End Surveys part
    */

    /*   Start Company part
    */
    Route::get('NewCompany','CompanyController@NewCompany')->name('super_admin.NewCompany');
    Route::get('AllCompanies','CompanyController@AllCompanies')->name('super_admin.AllCompanies');
    Route::get('CompanyDetails/{id}','CompanyController@CompanyDetails')->name('super_admin.CompanyDetails');
    Route::post('Newcompany','CompanyController@AddNewcompany')->name('super_admin.Newcompany');
    Route::post('DeleteCompany','CompanyController@DeleteCompany')->name('super_admin.DeleteCompany');
    Route::post('EditCompany','CompanyController@EditCompany')->name('super_admin.EditCompany');
    Route::post('UpdateCompany','CompanyController@UpdateCompany')->name('super_admin.UpdateCompany');
    /*
        End Surveys part
    */

/*
   Start Database part
*/
        Route::get('ShowDatabase','DatabaseController@ShowDatabase')->name('super_admin.ShowDatabase');
        Route::get('ShowDatabase/{id}','DatabaseController@ShowDatabase');
/*
    End Database part
*/

});
/*
    End Super Admin part
*/