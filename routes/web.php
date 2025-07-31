<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberLoginController;
use App\Http\Controllers\UserAppLoginController;

    // 🔐 Default page → Login form
    // Default Dashboard Page
    // Route::get('/', function () {
    //     return view('auth.login');
    // });
    Route::get('/', [MemberLoginController::class, 'showLoginForm'])->name('member.login.form');
    Route::get('/login', [MemberLoginController::class, 'showLoginForm']);
    Route::post('/login', [MemberLoginController::class, 'login'])->name('member.login');
    
    // 🚪 Logout route
    Route::get('/logout', [MemberLoginController::class, 'logout'])->name('member.logout');
    
       // 🧍‍♂️ Fontend member-register (static)
      Route::get('/member-register', [MemberController::class, 'adminCreate']);
      Route::post('/member-register', [MemberController::class, 'adminStore']);
     // 🔄 AJAX: Introducer data
     Route::get('/get-introducer/{id}', [MemberController::class, 'getIntroducer']);
    



// 🔒 Protected Routes for Logged-in Members
Route::middleware(['auth.member'])->group(function () {

    // ✅ Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // 🧾 Member Join
    Route::get('/member-join', [MemberController::class, 'adminCreate']);
    Route::post('/member-join', [MemberController::class, 'adminStore'])->name('fun.memberJoin');
   
    // All Members list
   Route::get('/all-member-list', [MemberController::class, 'allMembersList']);
    // /**
    //      * Reusable dynamic datatable method for any table.
    //      */
    Route::post('/datatable-fetch', [MemberController::class, 'dynamicDataTable'])->name('dynamicDataTable.ajax');



    // ✅ Step 3: Route to Handle Plan View Define a route to handle these dynamic plan pages:
    Route::get('/plan/{slug}', [MemberController::class, 'showPlanPage']);




    // **************All Logic App Auth URLs Start******************************

    Route::get('/add-company', [MemberController::class, 'adminCreate'])->name('addAdmin.adminCreate');
     Route::post('/add-company', [MemberController::class, 'adminStore'])->name('addAdmin.adminStore');

    Route::get('/edit-company/{id}', [MemberController::class, 'adminEdit'])->name('addAdmin.adminEdit');
    Route::post('/edit-company/{id}', [MemberController::class, 'adminUpdate'])->name('addAdmin.adminUpdate');


     Route::get('/view-admins-list', [MemberController::class, 'viewAdminsList'])->name('viewAdmins.list');
        // Handle delete


    Route::get('/package-master-store', [MemberController::class, 'packageMasterGet'])->name('packageMaster.list');
    Route::post('/package-master-store', [MemberController::class, 'packageMasterStore'])->name('packageMaster.store');


   Route::get('/app-users-list-admin-panel', [MemberController::class, 'appUsersAdminPanelList'])->name('appUsers.listAdminPanel');

   Route::get('/add-balance-request-list', [MemberController::class, 'appUsersAdminPanelList'])->name('addBalanceRequest.list');

 Route::post('/add-balance-request-list/{id}', [MemberController::class, 'addBalanceTrafer'])->name('addBalanceTrafer.list');


   Route::get('/withdrawal-request-list', [MemberController::class, 'appUsersAdminPanelList'])->name('withdrawalRequest.list');

Route::post('/withdrawal-request-list/{id}', [MemberController::class, 'withdrawalScrenshortUpload'])->name('withdrawalScrenshortUpload.list');



Route::get('/package-buying-request-list', [MemberController::class, 'showPackageBuyingRequests'])->name('packageBuyingRequest.list');




    // **************All Logic App Auth URLs end******************************


    // ******************************************************

    
    // 🧍‍♂️ KYC Update (static)
    Route::get('/kyc-update', function () {
        return view('admin.kyc_update');
    });
});


// *****************************************************************************

  // 🧍‍♂️ User app register
    Route::get('/register-user-app', function () {
        return view('userApp.userAppView.userRegister');
    })->name('userRegister.app');

    Route::post('/register-user-app', [MemberController::class, 'registerUserApp'])->name('registerUserApp.userApp');

  // 🧍‍♂️ User app login
     // User App Login Routes
Route::get('/login-user-app', [UserAppLoginController::class, 'showLoginForm'])->name('userLogin.app');
Route::post('/login-user-app', [UserAppLoginController::class, 'login'])->name('loginUserApp.userApp');
Route::get('/logout-user-app', [UserAppLoginController::class, 'logout'])->name('logoutUserApp.userApp');


Route::get('/admin-login-as-user/{userId}', [MemberController::class, 'adminLoginAsUser'])->name('admin.loginAsUser');


// Protected App User Routes
Route::middleware(['auth.userapp'])->group(function () {
      // 🧍‍♂️ User app test
Route::get('/user-app-dashboard', [MemberController::class, 'userAppDashboard'])->name('dashboard.app');

Route::get('/user-app-dashboard', [MemberController::class, 'userAppDashboardUpdate'])->name('dashboard.app');


Route::post('/user-app-dashboard', [MemberController::class, 'withdrawMoneyUserApp'])->name('withdrawMoney.userApp');

Route::post('/buy-package', [MemberController::class, 'buyPackage'])->name('package.buy');


Route::get('/add-balance-user-app', [MemberController::class, 'userAppDashboard'])->name('addBalance.userApp');

Route::post('/add-balance-user-app', [MemberController::class, 'userAddBalance'])->name('userAddBalance.userApp');

Route::get('/all-transactions-user-app', [MemberController::class, 'allTransactionsUserApp'])->name('allTransactions.userApp');

Route::get('/my-packages-list', [MemberController::class, 'myPackagesList'])->name('myPackagesList.userApp');


Route::get('/down-line-tree', [MemberController::class, 'downlinesTree'])->name('downlines.userApp');

Route::get('/api/get-downline-income/{userId}', [MemberController::class, 'getDownlineIncome']);

Route::post('/user/update-password', [MemberController::class, 'updatePassword'])->name('user.password.update');





});




    Route::get('/user-app-settings', function () {
        return view('userApp.userAppView.userAppSettings');
    })->name('userAppSettings.userApp');





    // **************** route For Logic service







    Route::get('/wallet-transaction-list', function () {
        return view('admin.logicApp.walletTransaction');
    })->name('walletTransaction.list');





























    // ************************************************

  // Route::get('/delete/{table}/{id}', [MemberController::class, 'deleteFromTable'])->name('generic.delete');
    Route::post('/delete/{table}/{id}', [MemberController::class, 'deleteFromTable'])->name('generic.delete');

    // ************************************************
    