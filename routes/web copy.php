<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberLoginController;

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


    // 🌳 MLM Tree View
    Route::get('/member-tree', [MemberController::class, 'showTree']);

    // 🧍‍♂️ plan-master 
    Route::post('/plan-master', [MemberController::class, 'storePlanMaster']);

    // Show plan master view (with list)
    Route::get('/plan-master', [MemberController::class, 'showPlanMaster']);

  



    // ✅ Step 3: Route to Handle Plan View Define a route to handle these dynamic plan pages:
    Route::get('/plan/{slug}', [MemberController::class, 'showPlanPage']);


    Route::get('/admin/update-wallets', [MemberController::class, 'updateAllMemberWalletsManually'])->name('admin.updateWallets');

    Route::get('/admin/update-total-deposits', [MemberController::class, 'updateCompanyTotalDeposits'])->name('admin.updateTotalDeposits');


    // ******************************************************
    /*
    🔁 **1. /check-member-status**
    This route checks all members, updates their status based on expiry: active, pending (within 30 days), or expired. Run it manually or via CRON to keep statuses current.
    */
    Route::get('/check-member-status', [MemberController::class, 'checkMemberStatusAndNotify']);
    
    /*
    🧨 **2. /auto-deactivate-members**
    Used to instantly deactivate members whose expiry date has passed. Sets their status to expired. Can be scheduled as a backup to ensure no expired users stay active.
    */
    Route::get('/auto-deactivate-members', [MemberController::class, 'autoDeactivateExpiredMembers']);
    
    /*
    📣 **3. /notify-renewals**
    Shows members whose membership will expire in 20–30 days. Useful for reporting or sending out reminders via SMS or email.
    */
    Route::get('/notify-renewals', [MemberController::class, 'notifyExpiringMembers']);
    
    /*
    🗂️ **4. /renewal-reminder**
    Displays a view of members expiring within 60 days. Lets admins monitor upcoming expiries and take action as needed.
    */
    
    Route::get('/renew-member/{member_id}', [MemberController::class, 'renewMember']);
    
    /*
    🔁 **5. /renew-member/{member\_id}**
    Manually renews a member's plan based on their original plan validity. Extends the expiry date and marks them as active.
    */
    Route::get('/renewal-reminder', [MemberController::class, 'checkMemberExpiries']);
    
    //*******************************************

    Route::get('/wallet-transfer', [MemberController::class, 'showWalletTransferForm'])->name('wallet.transfer.form');
    Route::post('/wallet-transfer', [MemberController::class, 'processWalletTransfer'])->name('wallet.transfer.process');
    Route::get('/wallet-transfer-history', [MemberController::class, 'walletTransferHistory'])->name('wallet.transfer.history');


    // ********************************************

    // ******************************************************

    
    // 🧍‍♂️ KYC Update (static)
    Route::get('/kyc-update', function () {
        return view('admin.kyc_update');
    });
});



  // 🧍‍♂️ User app test
    Route::get('/user-app-dashboard', function () {
        return view('userApp.userAppView.dashboard');
    })->name('dashboard.app');
  // 🧍‍♂️ User app test
    Route::get('/register-user-app', function () {
        return view('userApp.userAppView.userRegister');
    })->name('userRegister.app');
  // 🧍‍♂️ User app test
    Route::get('/login-user-app', function () {
        return view('userApp.userAppView.userLogin');
    })->name('userLogin.app');

    Route::get('/all-transactions-user-app', function () {
        return view('userApp.userAppView.allTransactions');
    })->name('allTransactions.userApp');

    Route::get('/user-app-settings', function () {
        return view('userApp.userAppView.userAppSettings');
    })->name('userAppSettings.userApp');


    Route::get('/add-balance-user-app', function () {
        return view('userApp.userAppView.addBalance');
    })->name('addBalance.userApp');



    // **************** route For Logic service

      // 🧍‍♂️ User app test
/*     Route::get('/add-company', function () {
        return view('admin.logicApp.addAdmin');
    })->name('addAdmin.list'); */

    Route::get('/add-company', [MemberController::class, 'adminCreate'])->name('addAdmin.adminCreate');
     Route::post('/add-company', [MemberController::class, 'adminStore'])->name('addAdmin.adminStore');

Route::get('/edit-company/{id}', [MemberController::class, 'adminEdit'])->name('addAdmin.adminEdit');
Route::post('/edit-company/{id}', [MemberController::class, 'adminUpdate'])->name('addAdmin.adminUpdate');



     Route::get('/view-admins-list', [MemberController::class, 'viewAdminsList'])->name('viewAdmins.list');
        // Handle delete




    Route::get('/package-master-list', function () {
        return view('admin.logicApp.packageMaster');
    })->name('packageMaster.list');

    Route::get('/app-users-list', function () {
        return view('admin.logicApp.appUsers');
    })->name('appUsers.list');

    Route::get('/add-balance-request-list', function () {
        return view('admin.logicApp.addBalanceRequest');
    })->name('addBalanceRequest.list');

    Route::get('/package-buying-request-list', function () {
        return view('admin.logicApp.packageBuyingRequest');
    })->name('packageBuyingRequest.list');

    Route::get('/withdrawal-request-list', function () {
        return view('admin.logicApp.withdrawalRequest');
    })->name('withdrawalRequest.list');

    Route::get('/wallet-transaction-list', function () {
        return view('admin.logicApp.walletTransaction');
    })->name('walletTransaction.list');



    // ************************************************

  // Route::get('/delete/{table}/{id}', [MemberController::class, 'deleteFromTable'])->name('generic.delete');
    Route::post('/delete/{table}/{id}', [MemberController::class, 'deleteFromTable'])->name('generic.delete');

    // ************************************************
    