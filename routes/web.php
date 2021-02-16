<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EducationControllerAdmin;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExperienceControllerAdmin;
use App\Http\Controllers\PortfolioImageController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ReferenceControllerAdmin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPagesController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth','user']], function (){
    Route::get('/userDashboard', [UserPagesController::class, 'dashboard'])->name('userDashboard');
    Route::get('/editUserProfile', [UserPagesController::class, 'editUserProfile'])->name('editUserProfile');
    Route::put('/updateUserProfile', [UserController::class, 'updateUserProfile'])->name('updateUserProfile');
    Route::put('/editUserProfile/uploadImage', [UserController::class, 'change_profile_image'])->name('editUserProfile.uploadImage');
    Route::get('/editAdditionalInfo', [UserPagesController::class, 'editAdditionalInfo'])->name('editAdditionalInfo');
    Route::put('/updateAdditionalInfo', [UserController::class, 'updateAdditionalInfo'])->name('updateAdditionalInfo');
    //change profile template
    Route::get('/updateProfileTemplate', [UserPagesController::class, 'updateProfileTemplate'])->name('updateProfileTemplate');
    Route::put('/changeProfileTemplate', [UserController::class, 'changeProfileTemplate'])->name('changeProfileTemplate');
    //skills
    Route::get('/addSkills', [UserPagesController::class, 'addSkills'])->name('addSkills');
    Route::post('/addUserSkill', [UserController::class, 'addUserSkill'])->name('addUserSkill');
    Route::get('/editSkill/{id}',[UserPagesController::class, 'editSkill'])->name('editSkill');
    Route::put('/updateSkill/{id}', [UserController::class, 'updateSkill'])->name('updateSkill');
    Route::delete('/deleteSkill/{id}', [UserController::class, 'deleteSkill'])->name('deleteSkill');
    //change password
    Route::get('/changePassword', [UserPagesController::class, 'changePassword'])->name('changePassword');
    Route::put('/updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');
    //portfolio
    Route::get('/portfolio', [UserPagesController::class, 'portfolio'])->name('portfolio');
    Route::post('/addPortfolioImage', [UserController::class, 'addPortfolioImage'])->name('addPortfolioImage');
    Route::get('/getPortfolioData', [UserController::class, 'getPortfolioData'])->name('getPortfolioData');
    Route::delete('/deletePortfolioImage/{id}', [UserController::class, 'deletePortfolioImage'])->name('deletePortfolioImage');
   
    //experience
    Route::get('/addExperience', [UserPagesController::class, 'addExperience'])->name('addExperience');
    Route::post('/newExperience', [ExperienceController::class, 'newExperience'])->name('newExperience');
    Route::get('/getExperienceData', [ExperienceController::class, 'getExperienceData'])->name('getExperienceData');
    Route::delete('/deleteExperienceData/{id}', [ExperienceController::class, 'deleteExperienceData'])->name('deleteExperienceData');
    //education
    Route::get('/addEducation', [UserPagesController::class, 'addEducation'])->name('addEducation');
    Route::post('/newEducation', [EducationController::class, 'newEducation'])->name('deleteEducationData');
    Route::get('/getEducationData', [EducationController::class, 'getEducationData'])->name('getEducationData');
    Route::delete('/deleteEducationData/{id}', [EducationController::class, 'deleteEducationData'])->name('deleteEducationData');
    //refrence
    Route::get('/addReference', [UserPagesController::class, 'addReference'])->name('addReference');
    Route::post('/newReference', [ReferenceController::class, 'newReference'])->name('deleteReferenceData');
    Route::get('/getReferenceInfo', [ReferenceController::class, 'getReferenceInfo'])->name('getReferenceInfo');
    Route::delete('/deleteReferenceData/{id}', [ReferenceController::class, 'deleteReferenceData'])->name('deleteReferenceData');
    
    //contact messages
    Route::get('/contactMessages', [UserPagesController::class, 'contactMessages'])->name('contactMessages');
    Route::get('/getContactMessages', [ContactController::class, 'getContactMessages'])->name('getContactMessages');
    Route::put('/deleteContactMessages/{id}', [ContactController::class, 'deleteContactMessages'])->name('deleteContactMessages');
    //get deleted Messages
    Route::get('/contactDeletedMessages', [UserPagesController::class, 'contactDeletedMessages'])->name('contactDeletedMessages');
    Route::get('/getDeletedContactMessages', [ContactController::class, 'getDeletedContactMessages'])->name('getDeletedContactMessages');
    Route::delete('/deleteMessagesPermanently/{id}', [ContactController::class, 'deleteMessagesPermanently'])->name('deleteMessagesPermanently');
    Route::put('/retrieveMessage/{id}', [ContactController::class, 'retrieveMessage'])->name('retrieveMessage');    
});

//Admin routes
Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('/adminDashboard', [AdminPagesController::class, 'dashboard'])->name('adminDashboard');
    //show users
    Route::get('/showUsers', [AdminPagesController::class, 'showUsers'])->name('showUsers');
    Route::get('/getUsersData', [AdminPagesController::class, 'getUsersData'])->name('getUsersData');
    //admin profile
    Route::get('/editAdminProfile', [AdminPagesController::class, 'editAdminProfile'])->name('editAdminProfile');
    Route::put('/updateAdminProfile', [AdminController::class, 'updateAdminProfile'])->name('updateAdminProfile');
    Route::put('/editAdminProfile/uploadImage', [AdminController::class, 'change_profile_image'])->name('editAdminProfile.uploadImage');
    Route::get('/editAdminPassword', [AdminPagesController::class, 'editAdminPassword'])->name('editAdminPassword');
    Route::put('/updateAdminPassword', [AdminController::class, 'updateAdminPassword'])->name('updateAdminPassword');
    //edit users profile dashboard
    Route::get('/showUsers/editUser/{id}', [AdminPagesController::class , 'editUsers'])->name('showUsers.editUser');
    //change profile template
    Route::get('/updateTemplateAdminEdit/{id}', [AdminPagesController::class, 'updateTemplateAdminEdit'])->name('updateTemplateAdminEdit');
    Route::put('/changeTemplateAdminEdit/{id}', [AdminController::class, 'changeTemplateAdminEdit'])->name('changeTemplateAdminEdit');
    //users portfolio
    Route::get('/portfolioAdminEdit/{id}', [AdminPagesController::class, 'portfolioAdminEdit'])->name('portfolioAdminEdit');
    Route::post('/addPortfolioImageAdminEdit/{id}', [AdminController::class, 'addPortfolioImageAdminEdit'])->name('addPortfolioImageAdminEdit');
    Route::get('/getPortfolioDataAdminEdit/{id}', [AdminController::class, 'getPortfolioDataAdminEdit'])->name('getPortfolioDataAdminEdit');
    Route::delete('/deletePortfolioImageAdminEdit/{id}', [AdminController::class, 'deletePortfolioImageAdminEdit'])->name('deletePortfolioImageAdminEdit');
    //edit user's profile
    Route::get('/editUserProfileAdminEdit/{id}', [AdminPagesController::class, 'editUserProfileAdminEdit'])->name('editUserProfileAdminEdit');
    //update user's profile image
    Route::put('/editUserProfileImage/{id}', [AdminController::class, 'editUserProfileImage'])->name('editUserProfileImage');
    //update user's profile
    Route::put('/updateUserProfileAdminEdit/{id}', [AdminController::class, 'updateUserProfileAdminEdit'])->name('updateUserProfileAdminEdit');
    //update user's additional info
    Route::get('/editAdditionalInfoAdminEdit/{id}', [AdminPagesController::class, 'editAdditionalInfoAdminEdit'])->name('editAdditionalInfoAdminEdit');
    Route::put('/updateAdditionalInfoAdminEdit/{id}', [AdminController::class, 'updateAdditionalInfoAdminEdit'])->name('updateAdditionalInfoAdminEdit');
    //edit or user's skill
    Route::get('/addSkillsAdminEdit/{id}', [AdminPagesController::class, 'addSkillsAdminEdit'])->name('addSkillsAdminEdit');
    Route::post('/addUserSkillAdminEdit/{id}', [AdminController::class, 'addUserSkillAdminEdit'])->name('addUserSkillAdminEdit');
    Route::get('/editSkillAdminEdit/{id}/{user_id}',[AdminPagesController::class, 'editSkillAdminEdit'])->name('editSkillAdminEdit');
    Route::put('/updateSkillAdminEdit/{id}/{user_id}', [AdminController::class, 'updateSkillAdminEdit'])->name('updateSkillAdminEdit');
    Route::delete('/deleteSkillAdminEdit/{id}/{user_id}', [AdminController::class, 'deleteSkillAdminEdit'])->name('deleteSkillAdminEdit');
    //experience
    Route::get('/addExperienceAdminEdit/{id}', [AdminPagesController::class, 'addExperienceAdminEdit'])->name('addExperienceAdminEdit');
    Route::post('/newExperienceAdminEdit/{id}', [ExperienceControllerAdmin::class, 'newExperienceAdminEdit'])->name('newExperienceAdminEdit');
    Route::get('/getExperienceDataAdminEdit/{id}', [ExperienceControllerAdmin::class, 'getExperienceDataAdminEdit'])->name('getExperienceDataAdminEdit');
    Route::delete('/deleteExperienceDataAdminEdit/{id}', [ExperienceControllerAdmin::class, 'deleteExperienceDataAdminEdit'])->name('deleteExperienceDataAdminEdit');
    //education
    Route::get('/addEducationAdminEdit/{id}', [AdminPagesController::class, 'addEducationAdminEdit'])->name('addEducationAdminEdit');
    Route::post('/newEducationAdminEdit/{id}', [EducationControllerAdmin::class, 'newEducationAdminEdit'])->name('deleteEducationDataAdminEdit');
    Route::get('/getEducationDataAdminEdit/{id}', [EducationControllerAdmin::class, 'getEducationDataAdminEdit'])->name('getEducationDataAdminEdit');
    Route::delete('/deleteEducationDataAdminEdit/{id}', [EducationControllerAdmin::class, 'deleteEducationDataAdminEdit'])->name('deleteEducationDataAdminEdit');
    //refrence
    Route::get('/addReferenceAdminEdit/{id}', [AdminPagesController::class, 'addReferenceAdminEdit'])->name('addReferenceAdminEdit');
    Route::post('/newReferenceAdminEdit/{id}', [ReferenceControllerAdmin::class, 'newReferenceAdminEdit'])->name('deleteReferenceDataAdminEdit');
    Route::get('/getReferenceInfoAdminEdit/{id}', [ReferenceControllerAdmin::class, 'getReferenceInfoAdminEdit'])->name('getReferenceInfoAdminEdit');
    Route::delete('/deleteReferenceDataAdminEdit/{id}', [ReferenceControllerAdmin::class, 'deleteReferenceDataAdminEdit'])->name('deleteReferenceDataAdminEdit');
    
});


//view user profile
Route::get('/{name_slug}', [UserPagesController::class, 'viewProfile'])->name('viewProfile');
//store contact messages 
Route::post('/contactUser/{id}', [ContactController::class, 'contactUser'])->name('contactUser');
//fetch portfolio data
Route::get('/fetch_data/{slug}', [UserPagesController::class, 'fetch_data'])->name('fetch_data');
Route::get('/fetch_data_cresume/{slug}', [UserPagesController::class, 'fetch_data_cresume'])->name('fetch_data_cresume');

