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
 
Auth::routes(["verify"=>true]);

Route::prefix('post-award')->group(function () {
    Route::resource('configs', 'PostAward\ProjectController', ['names' => 'configs_post_award']);
    Route::resource('article', 'PostAward\ArticleController', ['names' => 'article_post_award']);
    Route::get('article/create/{id}', 'PostAward\ArticleController@create')->name('article.create');
    Route::resource('study-phase', 'PostAward\StudyPhaseController', ['names' => 'study_phase']);
    Route::resource('conformities', 'ProjectConformityController', ['names' => 'conformity_project']);
    Route::resource('workgroup_member', 'PostAward\WorkGroupMemberController', ['names' => 'workgroup']);
    Route::post('desative', [\App\Http\Controllers\PostAward\ArticleController::class, "desative_article"])->name("article.article_desative");
    Route::post('conformidade/store', [\App\Http\Controllers\PostAward\TaskConformityController::class, "store"])->name("conformity.store");
    Route::post('cc/store', [\App\Http\Controllers\PostAward\LinkProjectController::class, "store"])->name("cc_links.store");
    Route::post('agenda-monitoria/store', [\App\Http\Controllers\ProjectMonitoringPlanController::class, "store"])->name("agenda_monitoria_tarefa.store");
    Route::resource('docs', 'PostAward\DocumentProjectController', ['names' => 'post_award_doc']);
    Route::resource('work_group', 'PostAward\WorkGroupProjectController', ['names' => 'post_award_work_group']);
    Route::resource('task', 'PostAward\TaskController', ['names' => 'task']);
    Route::get('unidade_reguladora/approval/{id}', [\App\Http\Controllers\PostAward\ProjectController::class, 'unidade_reguladora_show_details'])->name('unidade_reguladora_show_details');
    Route::post('pi_response', [\App\Http\Controllers\PostAward\ProjectController::class, 'pi_response'])->name('pi_response');
    Route::post('pi_response_cibs', [\App\Http\Controllers\PostAward\ProjectController::class, 'pi_response_cibs'])->name('pi_response_cibs');

    Route::post('pi_response_cibs_', [\App\Http\Controllers\PostAward\ProjectController::class, 'pi_response_cibs_modal'])->name('pi_response_cibs_modal');

    Route::post('scientific/submit_approval/{id}', [\App\Http\Controllers\PostAward\ProjectController::class, 'aprovacao_científica'])->name('aprovacao_científica');
    Route::post('article/store', [\App\Http\Controllers\PostAward\ArticleController::class, 'store_article_by_specific_user'])->name('article.store_specific_article');
   
    Route::post('ethical/submit_approval/{id}', [\App\Http\Controllers\PostAward\ProjectController::class, 'aprovacao_etica'])->name('aprovacao_etica');
    Route::post('final/submit_approval', [\App\Http\Controllers\PostAward\ProjectController::class, 'aprovacao_final'])->name('aprovacao_final');
    Route::post('final/pi_report', [\App\Http\Controllers\PostAward\ProjectController::class, 'final_report_pi'])->name('final_report_pi');
    Route::get('scientific/approval/{id}', [\App\Http\Controllers\PostAward\ProjectController::class, 'aprovacao_científica_show_details'])->name('aprovacao_científica_show_details');
    Route::get('ethical/approval/{id}', [\App\Http\Controllers\PostAward\ProjectController::class, 'aprovacao_etica_show_details'])->name('aprovacao_etica_show_details');
});
//});
Route::get('article/create_new','PostAward\ArticleController@new_article')->name('article.new_article');

Route::post('article/store_new', [\App\Http\Controllers\PostAward\ArticleController::class, 'store_new_article'])->name('article.store_new_article');

Route::prefix('post-award')->group(function () {
    Route::resource('configs', 'PostAward\ProjectController', ['names' => 'configs_post_award']);
    Route::resource('docs', 'PostAward\DocumentProjectController', ['names' => 'post_award_doc']);
    Route::resource('project-charter', "PostAward\ProjectCharterController", ['names' => 'post_award.project_charter']);
    Route::get('project-charter', 'PostAward\ProjectCharterController@index')->name('post_award.project_charter_index');
    Route::get('project-charter/create/{p_id}', 'PostAward\ProjectCharterController@create')->name('post_award.project_charter_create');
    Route::post('project-charter/store', 'PostAward\ProjectCharterController@store')->name('post_award.project_charter_store');
    Route::post('project-charter/update', 'PostAward\ProjectCharterController@update')->name('post_award.project_charter_update');

    Route::post('external-approval', 'PostAward\ProjectExternalStateController@store')->name("external_committee_approval");

    Route::post('resend-protocol', 'PostAward\ProjectController@resend_protocol')->name('post_award.resend_protocol');

});

Route::prefix('configuration')->group(function () {
    Route::resource('recipients', 'Configuration\RecipientController', ['names'=>'recipients']);
    Route::get('recipient/update-state/{id}','Configuration\RecipientController@update')->name('recipient.alter_state');
    Route::post('update-user', 'Configuration\UserConfigurationController@updateUser')->name('configuration.user_update');
    Route::get('project-state/{p_id}/{psm_id}', 'Configuration\ProjectStateController@create')->name('configuration.project_state');
    Route::post('project-state/store', 'Configuration\ProjectStateController@store')->name('configuration.project_state_store');
    Route::post('cism-author/store', 'Configuration\CismAuthorController@store')->name('configuration.cism_store');
    Route::get('cism-author/update/{id}', 'Configuration\CismAuthorController@update')->name('configuration.cism_update');
});

Route::prefix('admin')->group(function () {
    Route::get('users/blocked', 'Admin\UserController@blockedUser')->name('blocked_user.list');
    Route::get('user-organization/state/{id}', 'UserInstitutionController@alter_state')->name('user_organization.alter_state');
    Route::post('user-organization/store', 'UserInstitutionController@store')->name('user_organization.store');
    Route::get('users/unlock/{id}', 'Admin\UserController@unlockUser')->name('unlock_user');
    Route::get('logs','LogsController@index')->name('logs');
    Route::resource('configs', 'FunderController', ['names' => 'admin.funder']);
    Route::get('funder/create', 'FunderController@create')->name('funder.create');
    Route::get('funder/list', 'FunderController@index')->name('funder.index');
    Route::post('funder/store', 'FunderController@store')->name('funder.store');
    Route::get('funder/change-state/{id}', 'FunderController@changeFunderState')->name('funder.changeFunderState');
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name("admin.user_list");
    Route::post('/update-role', [\App\Http\Controllers\Admin\UserController::class, 'update_user_role'])->name("admin.user_update_role");
    Route::get('/user-remove/{id}', [\App\Http\Controllers\Admin\UserController::class, 'updateUserState'])->name("admin.user_remove");
    Route::post('/user-active', [\App\Http\Controllers\Admin\UserController::class, 'updateUserState'])->name("admin.user_active");
    Route::get('/user-create', [\App\Http\Controllers\Admin\UserController::class, 'register'])->name("admin.register");
    Route::post('login-configuration', "Configuration\ConfigurationController@updateConfiguration")->name('configuration.login');
    Route::post('/user-store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name("admin.store");
    Route::get('project_state_report', [\App\Http\Controllers\Admin\Report\ProjectReportController::class, "project_state_report"])->name("admin.report.project_state_report");
    Route::get('report-relatorio', [\App\Http\Controllers\Admin\Report\ProjectReportController::class, "report_relatorio"])->name("admin.report.relatorio");
    Route::post('chart/data', [\App\Http\Controllers\Admin\Report\ProjectReportController::class, "fetch_data"])->name("admin.report.fetch_chart_data");
    // Route::prefix('report')->group(function () {
    //     Route::get('/', [\App\Http\Controllers\Admin\Report\ProjectReportController::class, "report"])->name("admin.report");
    //     Route::get('/{attribute}', [\App\Http\Controllers\Admin\Report\ProjectReportController::class, "report"])->name("admin.report");
    //     Route::get('/{attribute}/{method}/', [\App\Http\Controllers\Admin\Report\ProjectReportController::class, "report"])->name("admin.report");

    // });
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name("admin.dashboard");
        Route::get('getContext', [\App\Http\Controllers\Admin\DashboardController::class, 'getContextData'])->name('admin.dashboard.get_context');
        Route::get('/getContext/{attribute}', [\App\Http\Controllers\Admin\DashboardController::class, 'getContextData'])->name('admin.dashboard.get_context_');
    });
});

Route::prefix('configuration')->group(function () {
    Route::get('user',"Configuration\UserConfigurationController@index")->name("configuration.user");
});

Route::get('notification/send', [\App\Http\Controllers\Notification\SendEmailUserController::class, 'sendEmail']);

Route::prefix('pre-writing')->group(function () {
    Route::resource('configs', 'Pre_Writing\PreWritingConfigController', ['names' => 'configs']);
//    Route::group(['middleware' => ['auth', 'grant_manager']], function () {
        Route::prefix('grant-manager')->group(function () {
            Route::resource('configs', 'Pre_Writing\GrantManager\PreWritingConfigController', ['names' => 'configs_manager']);
            Route::get('project_list', [\App\Http\Controllers\Pre_Writing\GrantManager\PreWritingConfigController::class, 'grant_manager_index'])->name('grant.project_list');
            Route::get('project-approval/{id}', [\App\Http\Controllers\Pre_Writing\GrantManager\PreWritingConfigController::class, 'grant_manager_approval'])->name('grant.project_approval');

        });

        Route::get('scientific-approval/{id}','Pre_Writing\Project\ProjectController@scientific_approval')->name('scientific_director.approval');
//    });


   

    Route::get('register', 'Pre_Writing\Project\ProjectController@register')
    ->name('pre_writing.register');
    
    Route::get('investigator/project-detail/{id}','Pre_Writing\Project\ProjectController@pi_project_detail')
    ->name('pre_writing.pi.register');
    Route::post('store','Pre_Writing\Project\ProjectController@store')
    ->name('pre_writing.store');

    Route::post('project/approval','Pre_Writing\Project\ProjectController@project_approval')
    ->name('pre_writing.project_approval');

    Route::post('project/first_approval','Pre_Writing\Project\ProjectController@first_project_approval')
    ->name('pre_writing.first_project_approval');

    Route::post('project/scientific_approval','Pre_Writing\Project\ProjectController@second_scientific_approval')
    ->name('pre_writing.second_scientific_approval');

    Route::post('/staff/register',  [\App\Http\Controllers\StaffController::class, 'register'])->name('staff.store');
    Route::post('/document/other-document',  'Pre_Writing\Project\DocumentProjectController@add_concept_note_doc')->name('insert.other_document');

    Route::get('/investigator/project-list', 'Pre_Writing\Project\ProjectController@getProjectByInvestigator')
    ->name('pre_writing.investigator.project');
    Route::post('/timeline', [\App\Http\Controllers\Pre_writing\PreWritingConfigController::class, 'store'])
    ->name('investigator.project_timeline');

    Route::post('project/delete', 'Pre_Writing\Project\ProjectController@remove_project')->name('investigator.remove_project');

    Route::prefix('pre-award-manager')->group(function () {
        Route::get('grant-manager/project', 'Pre_Writing\Project\ProjectController@grant_manager_index')->name('grant_manager.index');
        Route::get('grant-manager/edit/{p_id}', 'Pre_Writing\Project\ProjectController@grant_manager_edit')->name('grant_manager.edit');
        Route::get('project-state/{p_id}', 'Pre_Writing\Project\ProjectController@project_state_index')->name('project_state');
        Route::get('project_approval', 'Pre_Writing\Project\ProjectController@pre_award_manager_index')->name('pam.project_list');
        Route::get('project-approval/{id}', 'Pre_Writing\Project\ProjectController@pre_award_manager_approval')->name('pam.project_approval');
        Route::get('project-detail/{id}', 'Pre_Writing\Project\ProjectController@project_details')->name('pam.project_detail');
        Route::get('index', 'Pre_Writing\Project\ProjectController@pre_award_dashboard')->name('pre_award_dashboard');
        Route::get('document-download/{id}', 'Pre_Writing\Project\ProjectController@document_download')->name('document_download');
    });
});
Route::get('/auth', [\App\Http\Controllers\AuthController::class, 'auth'])->name('auth');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('authenticate');
// Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('user/store', [\App\Http\Controllers\AuthController::class, 'store'])->name('user.store');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::post('/language', [\App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('language.change');



Route::get('/', [\App\Http\Controllers\Web\WebsiteController::class, 'index'])->name('cism.index');
Route::prefix('web')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Web\WebsiteController::class, 'index'])->name('cism.home');
    Route::get('/about', [\App\Http\Controllers\Web\WebsiteController::class, 'about'])->name('cism.about');
    Route::get('/contact', [\App\Http\Controllers\Web\WebsiteController::class, 'contact'])->name('cism.contact');
    Route::get('/artigo', [\App\Http\Controllers\Web\WebsiteController::class, 'artigo'])->name('cism.artigo');
    Route::get('/register', [\App\Http\Controllers\Web\WebsiteController::class, 'register'])->name('cism.new_user');
    Route::get('/project', [\App\Http\Controllers\Web\WebsiteController::class, 'projects'])->name('cism.projects');
    Route::get('/project/download/{id}', [\App\Http\Controllers\Web\WebsiteController::class, 'project_download'])->name('cism.project_download');
    Route::get('/proposal/download/{id}', [\App\Http\Controllers\Web\WebsiteController::class, 'proposal_download'])->name('cism.proposal_download');
    Route::get('/project/details/{id}', [\App\Http\Controllers\Web\WebsiteController::class, 'project_details'])->name('cism.project_details');
    Route::get('/proposal/details/{id}', [\App\Http\Controllers\Web\WebsiteController::class, 'proposal_details'])->name('cism.proposal_details');
    Route::get('/categories/{id}', [\App\Http\Controllers\Web\WebsiteController::class, 'article_by_category'])->name('cism.article_by_category');
    Route::get('/blog-details/{id}', [\App\Http\Controllers\Web\WebsiteController::class, 'blog_details'])->name('cism.blog_details');
    Route::get('article-details/{id}', [\App\Http\Controllers\Web\WebsiteController::class, 'article_details'])->name('cism.article_details');
    Route::post('store', [\App\Http\Controllers\Web\WebsiteController::class, 'store'])->name('cism.store');
    // Route::post('')
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/send-email', [App\Http\Controllers\Notification\EmailUserController::class, 'sendEmail'])->name('send_notification');

Route::prefix('reports')->group(function () {
    Route::get("project", "Admin\Report\ReportController@index")->name("report.index");
    Route::get("get", "Admin\Report\ReportController@getReportData")->name("report.project");
    Route::get("study-implementation/report/{id}", "Admin\Report\ReportController@download_study_implementation_report")->name("report.study_implementation");
});

Route::prefix('configuration')->group(function(){
    Route::get('system', 'Configuration\ConfigurationController@system_configuration')->name('system_configuration');
});


Route::get('email-validation/{id}','VerifyEmailController@verifyEmail')->name('user.verify_email');
