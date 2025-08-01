<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;




class MemberController extends Controller
{
   

public function getIntroducer($id)
{
    $introducer = Member::where('member_id', $id)
        ->orWhere('phone', $id)
        ->first();

    if (!$introducer) {
        return response()->json(['error' => 'Introducer not found']);
    }

    return response()->json([
       'introducer_id_hidden' => $introducer->member_id,
       'name'      => $introducer->name,
       'phone'     => $introducer->phone,
       'address'   => $introducer->address,
       'position'  => $introducer->position,
    ]);
}



  // Show Add Form
    public function adminCreate()
    {
        $last = Member::orderBy('id', 'desc')->first();
        $nextId = str_pad(($last ? $last->id + 1 : 1), 7, '0', STR_PAD_LEFT); // e.g. 0000007

    if (request()->routeIs('addAdmin.adminCreate')) {
        return view('admin.logicApp.addAdmin', [
            'nextId' => $nextId,
            'company' => null,
            'isEdit' => false,
        ]);
    }
        return view('admin.member_join', compact('nextId', 'memberJoinDropDpwn'));
    }



       // Store New Company
    public function adminStore(Request $request)
    {
        $request->validate([
            'member_id' => 'required|unique:members,member_id',
            'CompanyName' => 'required',
            'phone' => 'required|unique:members,phone',
            'qrCodeUpload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('qrCodeUpload')) {
            $file = $request->file('qrCodeUpload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/qr_company'), $filename);
            $filePath = 'uploads/qr_company/' . $filename;
        }

        $joinDate = Carbon::now();

        Member::create([
            'member_id' => $request->member_id,
            'name' => $request->CompanyName,
            'phone' => $request->phone,
            'password' => Hash::make('abc11'),
            'email' => $request->email,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'state' => $request->state,
            'cin_no' => $request->cin_no,
            'BankName' => $request->BankName,
            'BankACNo' => $request->BankACNo,
            'BankIFSC' => $request->BankIFSC,
            'upiId' => $request->upiId,
            'qrCodeUpload' => $filePath,
            'join_date' => $joinDate,
            'expiry_date' => '2025-07-18',
            // 'status' => Active= 1, Deactive =2, Pending = 3	,
            'status' => 2,
        ]);

     if (request()->routeIs('addAdmin.adminStore')) {
            return back()->with('success', 'Registration successful!');
        }

        return back()->with('success', 'Company added Successful.');
    }

    // Show Edit Form
    public function adminEdit($id)
    {
        $company = Member::findOrFail($id);
        return view('admin.logicApp.addAdmin', [
            'company' => $company,
            'nextId' => $company->member_id,
            'isEdit' => true,
        ]);
    }

    // Update Existing Company

public function adminUpdate(Request $request, $id)
{
    $company = Member::findOrFail($id);

    $request->validate([
        'CompanyName' => 'required',
        'phone' => 'required|unique:members,phone,' . $id,
        'qrCodeUpload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'password' => 'nullable|string|min:4', // Optional password update
        'company_status' => 'required|in:1,2,3',
    ]);

    // Handle QR file
    $filePath = $company->qrCodeUpload;
    if ($request->hasFile('qrCodeUpload')) {
        $file = $request->file('qrCodeUpload');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/qr_company'), $filename);
        $filePath = 'uploads/qr_company/' . $filename;
    }

    // Prepare update data
    $updateData = [
        'name' => $request->CompanyName,
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        'pincode' => $request->pincode,
        'state' => $request->state,
        'cin_no' => $request->cin_no,
        'BankName' => $request->BankName,
        'BankACNo' => $request->BankACNo,
        'BankIFSC' => $request->BankIFSC,
        'upiId' => $request->upiId,
        'qrCodeUpload' => $filePath,
        'status' => $request->company_status,
    ];

    // If password is filled, update it
    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    $company->update($updateData);

    return back()->with('success', 'Company updated successfully!');
}




// ******************************************

public function viewAdminsList()
{
    // $getCompany  = DB::table('members')->get();
   
    $getCompany = Member::where('member_id', '!=', '0000001')->get();


    // $compantList= DB::table('plan_name_master')->get();

    // return view('admin.plan_master', compact('plans', 'planNames'));
    
    return view('admin.logicApp.viewAdminsList', compact('getCompany'));

}
// ********************************

public function packageMasterGet()
{    
   // Fetch all packages from the database
    $packages = \DB::table('package_master')->get();
    // Pass the packages data to the view 
    return view('admin.logicApp.packageMaster', compact('packages'));
}



 public function packageMasterStore(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'package_name' => 'required|string|max:255',
            'package_amount' => 'required|numeric',
            'package_payout_per' => 'required|numeric',
            'package_total_amount' => 'required|numeric',
            'package_time_duration' => 'required|numeric',
        ]);

        // Insert data into package_master table
        DB::table('package_master')->insert([
            'package_name' => $request->package_name,
            'package_amount' => $request->package_amount,
            'package_payout_per' => $request->package_payout_per,
            'package_total_amount' => $request->package_total_amount,
            'package_time_duration' => $request->package_time_duration,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // return redirect()->route('packageMaster.list')->with('success', 'Package created successfully!');
        return back()->with('success', 'Package created successfully!');
    }




// **************************************************











// This is pure Laravel + DataTables JS, no third-party Laravel packages, fully customizable.

public function allMembersList()
{
return view('admin.allViewTables.allMembersList');
}

/**
     * Reusable dynamic datatable method for any table.
     */



    public function dynamicDataTable(Request $request)
    {
        $table = $request->get('table');
        $columns = $request->get('columns'); // required
        $searchable = $request->get('searchable', []);
        $orderable = $request->get('orderable', []);

        if (!$table || !$columns || !is_array($columns)) {
            return response()->json(['error' => 'Missing or invalid table or columns'], 400);
        }

        // Base query
        $query = DB::table($table);
        $totalData = $query->count();

        // Searching
        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search, $searchable) {
                foreach ($searchable as $col) {
                    $q->orWhere($col, 'like', "%{$search}%");
                }
            });
        }

        $totalFiltered = $query->count();

        // Ordering
        $orderCol = $request->input('order.0.column', 0);
        $orderBy = $columns[$orderCol] ?? $columns[0];
        $dir = $request->input('order.0.dir', 'asc');

        $query->orderBy($orderBy, $dir)
              ->offset($request->input('start'))
              ->limit($request->input('length'));

        $data = [];
        $i = $request->input('start') + 1;

        foreach ($query->get() as $row) {
            $temp = [];
            $temp['DT_RowIndex'] = $i++;
            foreach ($columns as $col) {
                $temp[$col] = $row->$col ?? '';
            }
            $data[] = $temp;
        }

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        ]);
    }


// end This is pure Laravel + DataTables JS, no third-party Laravel packages, fully customizable.






// ****************************************


// ***********************************

    
public function showPlanPage($slug)
{
    // Get plan details
    $plan = DB::table('plan_master')
        ->whereRaw('LOWER(select_plan) = ?', [strtolower($slug)])
        ->first();

    if (!$plan) {
        abort(404, 'Plan not found');
    }

    // Get current logged-in member ID from session
    $beneficiaryId = session('member_id');

    // Get income transactions for the member under the plan
    $transactions = DB::table('mlm_transactions as t')
        ->join('members as m', 't.member_id', '=', 'm.member_id')
        ->select(
            't.member_id',
            'm.name as downline_name',
            't.level',
            't.amount',
            't.plan_id'
        )
        ->where('t.beneficiary_id', $beneficiaryId)
        ->where('t.plan_id', $plan->select_plan_id)
        ->get();

    // Total income
    $totalIncome = $transactions->sum('amount');

    return view('admin.allViewTables.plans_view_menu', [
        'plan' => $plan,
        'transactions' => $transactions,
        'totalIncome' => $totalIncome,
    ]);
}

// *************************************


// *************************************************









// User App All Cntoler Start *************************


public function registerUserApp(Request $request)
{
    // Validate input (optional, but recommended)
    $request->validate([
        'user_name'             => 'required|string|max:255',
        'phone_number'     => 'required|string|max:20|unique:app_users,phone_number',
        // 'password'         => 'required|string|max:255',
        'address'          => 'nullable|string',
        'profile_picture'      => 'nullable|file|mimes:jpeg,png,jpg,|max:20048',
        'upi_qr_code'      => 'required|nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
    ]);

    


        // Step 2: Find Introducer
    $introducer = DB::table('app_users')
        ->where('phone_number', $request->introducer_number)
        ->first();

    // if (!$introducer) {
    //     return back()->withErrors(['introducer_number' => '❌ Introducer not valid'])->withInput();
    // }

     $uploadFile = function ($request, $inputName, $folder, $prefix = '') {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $filename = $request->phone_number . '_' . $prefix . '_' . $file->getClientOriginalName();
                $file->move(public_path("uploads/$folder"), $filename);
                return "uploads/$folder/" . $filename;
            }
            return null;
        };

        $profilePicPath = $uploadFile($request, 'profile_picture', 'qr_user', 'profile');
        $qrCodePath     = $uploadFile($request, 'upi_qr_code', 'qr_user', 'qr');

      



    // Insert into DB

    DB::table('app_users')->insert([
        'app_u_name'              => $request->user_name,
        'phone_number'      => $request->phone_number,
        'user_wallet'      => 0,
        'introducer_id'     => $introducer->id ?? '1',
        'introducer_phone'     => $introducer->phone_number ?? '0001112223',
        'introducer_name'   => $introducer->app_u_name ?? 'Company',
        'user_email'      => $request->user_email,
        // 'password'          => Hash::make($request->password ?? '000111'),
        'password'          => Hash::make('0011'),
        'app_u_address'           => $request->user_address,
        'pin_code'          => $request->pin_code,
        'bank_name'         => $request->bank_name,
        'ifsc_code'         => $request->ifsc_code,
        'bank_account_no'   => $request->bank_account_no,
        'upi_id'            => $request->upi_id,
        'upi_qr_code'       => $profilePicPath,
        'user_pic_img'       => $qrCodePath,
        'status'            => 1,
        'created_at'        => now(),
        'updated_at'        => now(),
    ]);

    // return back()->with('success', 'Plan added with level' . $nextLevel);

   return redirect()->route('userLogin.app')->with('success', '<h3 style="color:#fff;"> Registered Successfully.<br> Login User Name = ' . $request->phone_number . '<br>Login Password Is = 0011</h3>');

     
}


public function appUsersAdminPanelList()
{    
    $appUsers = \DB::table('app_users')->get();

    $userBalanceRequest = \DB::table('user_balance_request')
        ->leftJoin('app_users', 'user_balance_request.app_user_id', '=', 'app_users.id')
            ->select(
                'user_balance_request.*',
                'app_users.user_wallet',
                'app_users.bank_name',
                'app_users.ifsc_code',
                'app_users.bank_account_no',
                'app_users.upi_id',
                'app_users.upi_qr_code'
            )
            ->orderBy('user_balance_request.id', 'desc')
            ->get();


    $withdrawalRequest = \DB::table('user_withdraw_request')
                ->leftJoin('app_users', 'user_withdraw_request.app_user_id', '=', 'app_users.id')
                ->select(
                    'user_withdraw_request.*',
                    'app_users.user_wallet',
                    'app_users.bank_name',
                    'app_users.ifsc_code',
                    'app_users.bank_account_no',
                    'app_users.upi_id',
                    'app_users.upi_qr_code'
                )
                ->get();




    if (request()->routeIs('addBalanceRequest.list')) {
        return view('admin.logicApp.addBalanceRequest', compact('userBalanceRequest'));
    }

    if (request()->routeIs('withdrawalRequest.list')) {
        return view('admin.logicApp.withdrawalRequest', compact('withdrawalRequest'));
    }
    
    return view('admin.logicApp.appUsers', compact('appUsers'));
    
}



public function userAppDashboard()
{    

    // $appPackages = \DB::table('package_master')->get();

        $actived = 1;
        $membersBankDetails = DB::table('members')
            ->where('status', $actived)
            ->orderBy('id', 'asc')
            ->get();
        // Default message
        $warningMessage = null;
        // Check if there are more than 1 active members
        if ($membersBankDetails->count() > 1) {
            $warningMessage = "More than 1 company is active. Please contact the company.";
        }

    if (request()->routeIs('addBalance.userApp')) {
        return view('userApp.userAppView.addBalance', compact('membersBankDetails','warningMessage'));
    }

    // return view('userApp.userAppView.dashboard', compact('appPackages'));
    
}






public function userAddBalance(Request $request)
{
    $request->validate([
        'add_balance_amount' => 'required|string|max:10',
        'payment_screenShot' => 'nullable|file|mimes:jpeg,png,jpg|max:20048',
        'userId'             => 'required',
        'userName'           => 'required',
        'userPhone'          => 'required',
    ]);

    $uploadFile = function ($request, $inputName, $folder) {
        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);
            $filename = Str::slug($request->userPhone) . '_' . now()->format('YmdHis') .'_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/$folder"), $filename);
            return "uploads/$folder/" . $filename;
        }
        return null;
    };

    $paymentScreenShot = $uploadFile($request, 'payment_screenShot', 'userPaymentScreenShot');

    // Insert into user_balance_request table
    DB::table('user_balance_request')->insert([
        'app_user_id'     => $request->userId,
        'app_user_name'   => $request->userName,
        'user_phone'      => $request->userPhone,
        'req_bal_amount'  => $request->add_balance_amount,
        'pay_screenshot'  => $paymentScreenShot,
        'status'          => 2, // Pending
        'created_at'      => now(),
        'updated_at'      => now(),
    ]);

    // Get current wallet (before change)
    $walletBefore = DB::table('app_users')->where('id', $request->userId)->value('user_wallet') ?? 0;

    // Insert into user_transactions table
    DB::table('user_transactions')->insert([
        'app_user_id'     => $request->userId,
        'type_id'         => 1, // 1 = Add Balance
        'amount'          => $request->add_balance_amount,
        'wallet_before'   => $walletBefore,
        'wallet_after'    => $walletBefore, // Balance not yet added
        'status'          => 'Pending',
        'requested_at'    => now(),
        'screenshot'      => $paymentScreenShot,
        'created_at'      => now(),
        'updated_at'      => now(),
    ]);

    return redirect()->route('dashboard.app')->with('success', 'Rs.' . $request->add_balance_amount . ' balance request submitted successfully. Please wait for approval.');
}






    /*    return redirect()->route('userLogin.app')->with('success', '<h3 style="color:#fff;"> Registered Successfully.<br> Login User Name = ' . $request->phone_number . '<br>Login Password Is = 000111</h3>'); */




public function withdrawMoneyUserApp(Request $request)
{
    $request->validate([
        'withdraw_req' => 'required|numeric|min:1',
        'userId'       => 'required|integer',
        'userName'     => 'required|string|max:100',
        'userPhone'    => 'required|string|max:15',
    ]);

    $userId = $request->userId;
    $withdrawAmount = floatval($request->withdraw_req);

    // Fetch user
    $user = DB::table('app_users')->where('id', $userId)->first();
    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    $currentWallet = floatval($user->user_wallet);

    if ($currentWallet < $withdrawAmount) {
        return back()->with('error', 'Insufficient balance for withdrawal.');
    }

    $paymentScreenshot = 0; // Default

    DB::beginTransaction();
    try {
        // 1. Deduct wallet
        $newWallet = $currentWallet - $withdrawAmount;
        DB::table('app_users')->where('id', $userId)->update([
            'user_wallet' => $newWallet
        ]);

        // 2. Insert into withdraw request table
        DB::table('user_withdraw_request')->insert([
            'app_user_id'     => $userId,
            'app_user_name'   => $request->userName,
            'user_phone'      => $request->userPhone,
            'req_bal_amount'  => $withdrawAmount,
            'pay_screenshot'  => $paymentScreenshot,
            'status'          => 2, // Pending
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        // 3. Log user transaction (type_id 4 = Withdrawal)
        DB::table('user_transactions')->insert([
            'app_user_id'   => $userId,
            'type_id'       => 4,
            'amount'        => $withdrawAmount,
            'wallet_before' => $currentWallet,
            'wallet_after'  => $newWallet,
            'status'        => 'Pending',
            'requested_at'  => now(),
            'done_at'       => null,
            'screenshot'    => $paymentScreenshot,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        DB::commit();

        // Update wallet in session
        Session::put('app_user_wallet', $newWallet);

        return back()->with('success', '₹' . number_format($withdrawAmount, 2) . ' withdrawal request submitted successfully. Please wait for approval.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong. Try again.');
    }
}



public function withdrawalScrenshortUpload(Request $request, $id)
{
    $request->validate([
        'payment_screenshot' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:20480', // 20 MB max
    ]);

    $withdrawal = DB::table('user_withdraw_request')->where('id', $id)->first();

    if (!$withdrawal) {
        return back()->with('error', 'Withdrawal request not found.');
    }

    $filePath = $withdrawal->pay_screenshot;

    if ($request->hasFile('payment_screenshot')) {
        $file = $request->file('payment_screenshot');
        $filename = 'withdraw_' . now()->format('Ymd_His') . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/withdrawalDone'), $filename);
        $filePath = 'uploads/withdrawalDone/' . $filename;
    }

    DB::beginTransaction();
    try {
        // 1. Update withdrawal request table
        DB::table('user_withdraw_request')->where('id', $id)->update([
            'pay_screenshot' => $filePath,
            'status'         => 1, // Done
            'updated_at'     => now(),
        ]);

        // 2. Update corresponding transaction in user_transactions
        DB::table('user_transactions')
            ->where('app_user_id', $withdrawal->app_user_id)
            ->where('type_id', 4) // Withdrawal
            ->whereNull('done_at') // Pending only
            ->orderByDesc('id')
            ->limit(1)
            ->update([
                'screenshot' => $filePath,
                'status'     => 'Done',
                'done_at'    => now(),
                'updated_at' => now(),
            ]);

        DB::commit();
        return back()->with('success', 'Screenshot uploaded and withdrawal marked as completed.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong while updating. Please try again.');
    }
}







/* 
public function addBalanceTrafer(Request $request, $id)
{
    $request->validate([
        'userBlaAdd' => 'required|numeric',
    ]);

    // Get withdrawal request
    $balanceRequest = DB::table('user_balance_request')->where('id', $id)->first();

    if (!$balanceRequest) {
        return back()->with('error', 'Balance request not found.');
    }

    // Fetch user
    $user = DB::table('app_users')->where('id', $balanceRequest->app_user_id)->first();

    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    $requestedAmount = (float)$request->userBlaAdd;
    $walletBefore = (float)$user->user_wallet;
    $walletAfter = $walletBefore + $requestedAmount;

    // 1. Update request status to "Done"
    DB::table('user_balance_request')->where('id', $id)->update([
        'status' => 1, // Approved
        'updated_at' => now(),
    ]);

    // 2. Update user's wallet
    DB::table('app_users')->where('id', $user->id)->update([
        'user_wallet' => $walletAfter,
    ]);

    // 3. Insert into `user_transactions`
    DB::table('user_transactions')->insert([
        'app_user_id'   => $user->id,
        'type_id'       => 1, // 1 = Add Balance
        'amount'        => $requestedAmount,
        'wallet_before' => $walletBefore,
        'wallet_after'  => $walletAfter,
        'status'        => 'Done',
        'requested_at'  => $balanceRequest->created_at,
        'done_at'       => now(),
        'screenshot'    => $balanceRequest->pay_screenshot ?? null,
        'created_at'    => now(),
        'updated_at'    => now(),
    ]);

    return back()->with('success', 'Balance transferred and transaction recorded successfully.');
}
 */


// ************************************************************
public function addBalanceTrafer(Request $request, $id)
{
    $request->validate([
        'userBlaAdd' => 'required|numeric',
    ]);

    // Get withdrawal request
    $balanceRequest = DB::table('user_balance_request')->where('id', $id)->first();

    if (!$balanceRequest) {
        return back()->with('error', 'Balance request not found.');
    }

    // Fetch user
    $user = DB::table('app_users')->where('id', $balanceRequest->app_user_id)->first();

    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    $requestedAmount = (float)$request->userBlaAdd;
    $walletBefore = (float)$user->user_wallet;
    $walletAfter = $walletBefore + $requestedAmount;

    DB::beginTransaction();

    try {
        // 1. Update request status to "Done"
        DB::table('user_balance_request')->where('id', $id)->update([
            'status' => 1,
            'updated_at' => now(),
        ]);

        // 2. Update user's wallet
        DB::table('app_users')->where('id', $user->id)->update([
            'user_wallet' => $walletAfter,
        ]);

        // 3. Update the existing transaction
        DB::table('user_transactions')
            ->where('app_user_id', $user->id)
            ->where('type_id', 1) // Add Balance
            ->where('status', 'Pending')
            ->where('amount', $requestedAmount)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->update([
                'wallet_after' => $walletAfter,
                'status'       => 'Done',
                'done_at'      => now(),
                'updated_at'   => now(),
            ]);

        DB::commit();

        return back()->with('success', 'Balance transferred and transaction updated successfully.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'An error occurred while updating balance.');
    }
}
// *************************************************************





public function buyPackage(Request $request)
{
    $userId = Session::get('app_user_id');
    $introducer_id = Session::get('introducer_id');
    $introducer_phone = Session::get('introducer_phone');

    if (!$userId) {
        return redirect()->route('userLogin.app')->with('error', 'You must be logged in to buy a package.');
    }

    $packageId = $request->package_id;

    // Fetch user & package
    $user = DB::table('app_users')->where('id', $userId)->first();
    $package = DB::table('package_master')->where('id', $packageId)->first();

    if (!$user || !$package) {
        return back()->with('error', 'User or Package not found.');
    }

    $walletBefore = (float)$user->user_wallet;
    $packageAmount = (float)$package->package_amount;

    if ($walletBefore < $packageAmount) {
        return back()->with('error', 'Insufficient wallet balance.');
    }

    $walletAfter = $walletBefore - $packageAmount;

    // Start DB transaction to ensure consistency
    DB::beginTransaction();

    try {
        // 1. Deduct user wallet
        DB::table('app_users')->where('id', $userId)->update([
            'user_wallet' => $walletAfter,
            'updated_at' => now()
        ]);

        // 2. Insert package purchase
        DB::table('user_package_purchases')->insert([
            'app_user_id' => $userId,
            'package_id'  => $packageId,
            'introducer_id'  => $introducer_id,
            'introducer_phone'  => $introducer_phone,
            'amount_paid' => $packageAmount,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // 3. Insert into user_transactions
        DB::table('user_transactions')->insert([
            'app_user_id'   => $userId,
            'type_id'       => 2, // 2 = Package Buy
            'amount'        => $packageAmount,
            'wallet_before' => $walletBefore,
            'wallet_after'  => $walletAfter,
            'status'        => 'Done',
            'requested_at'  => now(),
            'done_at'       => now(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // 4. Update wallet in session
        Session::put('app_user_wallet', $walletAfter);

        DB::commit();

        return back()->with('success', 'Package purchased successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong while purchasing the package.');
    }
}





public function showPackageBuyingRequests()
{
    $requests = DB::table('user_package_purchases as upp')
        ->leftJoin('app_users as au', 'upp.app_user_id', '=', 'au.id')
        ->leftJoin('package_master as pm', 'upp.package_id', '=', 'pm.id')
        ->select(
            'upp.id',
            'au.app_u_name as user_name',
            'au.phone_number',
            'upp.amount_paid',
            'pm.package_name',
            'upp.created_at'
        )
        ->orderBy('upp.created_at', 'desc')
        ->get();

    return view('admin.logicApp.packageBuyingRequest', compact('requests'));
}



// ******************************************************
public function userAppDashboardUpdate()
{
    $appPackages = DB::table('package_master')->get();
    $userId = session('app_user_id');

    $purchases = DB::table('user_package_purchases')
        ->join('package_master', 'user_package_purchases.package_id', '=', 'package_master.id')
        ->where('user_package_purchases.app_user_id', $userId)
        ->where('user_package_purchases.is_credited', 0)
        ->select(
            'user_package_purchases.id as purchase_id',
            'user_package_purchases.created_at',
            'package_master.package_total_amount',
            'package_master.package_time_duration'
        )
        ->get();

    foreach ($purchases as $purchase) {
        $matureTime = \Carbon\Carbon::parse($purchase->created_at)
            ->addMinutes(intval($purchase->package_time_duration));

        if (now()->greaterThanOrEqualTo($matureTime)) {
            $currentWallet = DB::table('app_users')->where('id', $userId)->value('user_wallet');
            $amountToCredit = floatval($purchase->package_total_amount);
            $newWallet = floatval($currentWallet) + $amountToCredit;

            // Begin transaction
            DB::beginTransaction();

            try {
                // 1. Update user wallet
                DB::table('app_users')
                    ->where('id', $userId)
                    ->update(['user_wallet' => $newWallet]);

                // 2. Mark package as credited
                DB::table('user_package_purchases')
                    ->where('id', $purchase->purchase_id)
                    ->update([
                        'is_credited' => 1,
                        'updated_at' => now()
                    ]);

                // 3. Log transaction
                DB::table('user_transactions')->insert([
                    'app_user_id'   => $userId,
                    'type_id'       => 3, // 3 = Maturity
                    'amount'        => $amountToCredit,
                    'wallet_before' => $currentWallet,
                    'wallet_after'  => $newWallet,
                    'status'        => 'Done',
                    'requested_at'  => $matureTime,
                    'done_at'       => now(),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                // Optionally log the error
            }
        }
    }

    $hasBoughtPackage1 = DB::table('user_package_purchases')
                        ->where('app_user_id', $userId)
                        ->where('package_id', 1)
                        ->exists();



    // Refresh wallet in session
    $userWallet = DB::table('app_users')->where('id', $userId)->value('user_wallet');
    Session::put('app_user_wallet', $userWallet);

    return view('userApp.userAppView.dashboard', compact('userWallet', 'appPackages','hasBoughtPackage1'));
}
// ************************************************************



public function allTransactionsUserApp(Request $request)
{
    // $userId = auth()->user()->id; // or $request->user()->id if using auth guard
    $userId = session('app_user_id');

    $transactions = DB::table('user_transactions as ut')
        ->join('transaction_types as tt', 'ut.type_id', '=', 'tt.id')
        ->select(
            'ut.*',
            'tt.name as type'
        )
        ->where('ut.app_user_id', $userId)
        ->orderByDesc('ut.id')
        ->get();

    return view('userApp.userAppView.allTransactions', compact('transactions'));
}






public function myPackagesList()
{
    $userId = session('app_user_id');

    $transactions = DB::table('user_transactions')
        ->where('app_user_id', $userId)
        ->whereIn('type_id', [2, 3]) // Buy or Maturity
        ->orderByDesc('id')
        ->get();

    $packageData = DB::table('user_package_purchases as upp')
        ->join('package_master as pm', 'upp.package_id', '=', 'pm.id')
        ->where('upp.app_user_id', $userId)
        ->select(
            'upp.id as purchase_id',
            'upp.amount_paid',
            'upp.created_at as purchase_created_at',
            'upp.is_credited',
            'pm.package_name',
            'pm.package_amount',
            'pm.package_total_amount',
            'pm.package_time_duration',
            'pm.package_payout_per'
        )
        ->get();

    $combined = $transactions->map(function ($txn) use ($packageData) {
        $match = null;

        if ($txn->type_id == 2) { // Buy
            $match = $packageData->first(function ($pkg) use ($txn) {
                return (float)$pkg->amount_paid === (float)$txn->amount &&
                    \Carbon\Carbon::parse($pkg->purchase_created_at)->format('Y-m-d H:i') ===
                    \Carbon\Carbon::parse($txn->requested_at)->format('Y-m-d H:i');
            });
        }

        if ($txn->type_id == 3) { // Maturity
            $match = $packageData->first(function ($pkg) use ($txn) {
                return $pkg->is_credited == 1 &&
                    (float)$pkg->package_total_amount === (float)$txn->amount;
            });
        }

        return (object)[
            'type_id'           => $txn->type_id,
            'type_name'         => $txn->type_id == 2 ? 'Package Buy' : 'Maturity',
            'status'            => $txn->status,
            'amount'            => $txn->amount,
            'wallet_before'     => $txn->wallet_before,
            'wallet_after'      => $txn->wallet_after,
            'requested_at'      => $txn->requested_at,
            'done_at'           => $txn->done_at,
            'package_name'      => $match->package_name ?? 'N/A',
            'package_amount'    => $match->package_amount ?? null,
            'package_total_amount' => $match->package_total_amount ?? null,
            'package_time_duration' => $match->package_time_duration ?? null,
            'package_payout_per' => $match->package_payout_per ?? null,
            'is_credited'       => $match->is_credited ?? null,
        ];
    });

    return view('userApp.userAppView.myPackagesList', [
        'appPackages' => $combined
    ]);
}


/* public function downlinesTree()
{
    
    return view('userApp.userAppView.downlinesTree'); 
} */


public function downlinesTree()
{
    $currentPhone = session('app_user_phone'); // Get logged-in user's phone
    $members = DB::table('app_users')->get();

    $rootUser = $members->where('phone_number', $currentPhone)->first(); // Find root user

    $treeHtml = '';

    if ($rootUser) {
        $treeHtml .= '<ul>';
        $treeHtml .= '<li>';
        $treeHtml .= '<div class="node toggle open" style="background:#d1ffd1;border:2px solid green;">';
        $treeHtml .= '👑 ' . $rootUser->app_u_name . ' [' . $rootUser->phone_number . ']</div>';

        $treeHtml .= $this->buildTreeHtml($members, $rootUser->id); // Pass root user ID
        $treeHtml .= '</li>';
        $treeHtml .= '</ul>';
    }

    return view('userApp.userAppView.downlinesTree', compact('treeHtml'));
}







private function buildTreeHtml($members, $parentId = null)
{
    $html = '';
    $children = $members->where('introducer_id', $parentId);

    if ($children->count()) {
        $html .= '<ul class="children">';
        foreach ($children as $member) {
            $hasChild = $members->where('introducer_id', $member->id)->count() > 0;

            $html .= '<li>';
            $html .= '<div class="node toggle ' . ($hasChild ? 'open' : '') . '" style="border: 1px solid #ccc;">';
            $html .= ($hasChild ? '➖' : '👤') . ' ';
            $html .= htmlspecialchars($member->app_u_name) . ' ';

            // ✅ Here is the fixed part with correct PHP string syntax
            $html .= '<span 
                class="text-primary openIncomeModal" 
                data-user-name="' . htmlspecialchars($member->app_u_name) . '" 
                data-user-phone="' . htmlspecialchars($member->phone_number) . '" 
                data-user-id="' . $member->id . '" 
                style="cursor:pointer;" 
                data-bs-toggle="modal" 
                data-bs-target="#ModalBasic">
                [' . htmlspecialchars($member->phone_number) . ']
            </span>';

            $html .= '</div>';

            // 🔁 Recursive call for children
            $html .= $this->buildTreeHtml($members, $member->id);

            $html .= '</li>';
        }
        $html .= '</ul>';
    }

    return $html;
}








public function getDownlineIncome($id)
{
    $allUserIds = $this->getAllDownlineUserIds($id);

    $downlines = DB::table('app_users as au')
        ->leftJoin('user_package_purchases as upp', 'au.id', '=', 'upp.app_user_id')
        ->whereIn('au.id', $allUserIds)
        ->select('au.app_u_name as name', 'au.phone_number as phone', 'upp.amount_paid as amount')
        ->get();

    return response()->json([
        'downlines' => $downlines
    ]);
}

private function getAllDownlineUserIds($parentId)
{
    $ids = [];
    $directs = DB::table('app_users')->where('introducer_id', $parentId)->pluck('id');

    foreach ($directs as $id) {
        $ids[] = $id;
        $ids = array_merge($ids, $this->getAllDownlineUserIds($id));
    }

    return $ids;
}








    public function updatePassword(Request $request)
{
    $userId = session('app_user_id');

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'User not authenticated.']);
    }

    // Validate file types
    $request->validate([
        'upi_qr_code' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'user_pic_img' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Check password match
    if ($request->new_password !== $request->confirm_password) {
        return response()->json(['success' => false, 'message' => 'Passwords do not match.']);
    }

    // Upload helper
    $uploadFile = function ($field, $folder, $prefix = '') use ($request) {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $filename = 'USER_' . $prefix . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("uploads/$folder"), $filename);
            return "uploads/$folder/" . $filename;
        }
        return null;
    };

    // Upload files if present
    $qrPath = $uploadFile('upi_qr_code', 'qr_user', 'qr');
    $picPath = $uploadFile('user_pic_img', 'user_pics', 'pic');

    // Prepare update data
    $updateData = [
        'password' => Hash::make($request->new_password),
        'bank_name' => $request->bank_name,
        'ifsc_code' => $request->ifsc_code,
        'bank_account_no' => $request->bank_account_no,
        'upi_id' => $request->upi_id,
        'updated_at' => now(),
    ];

    if ($qrPath) $updateData['upi_qr_code'] = $qrPath;
    if ($picPath) $updateData['user_pic_img'] = $picPath;

    // Update user
    DB::table('app_users')->where('id', $userId)->update($updateData);

    return response()->json([
        'success' => true,
        'message' => 'Password & bank details updated successfully.',
        'redirect' => true,
        'redirect_url' => route('userLogin.app'),
        'password_message' => '<h3 style="color:#fff;">Your new password is: <strong>' . $request->new_password . '</strong><br>Save it carefully.</h3>'
    ]);
}




public function adminLoginAsUser($userId)
{
    $user = DB::table('app_users')->where('id', $userId)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Set session variables to simulate login
    session([
        'app_user_id' => $user->id,
        'app_user_name' => $user->app_u_name,
        'app_user_wallet' => $user->user_wallet,
        'app_user_phone' => $user->phone_number
    ]);

    return redirect()->route('dashboard.app')->with('success', '🔑 You are now logged in as: ' . $user->app_u_name);
}




// User App All Cntoler End *************************


// delete **************************************************

/*
Your Controller Method (already good)
 // ✅ Only allow specific tables
    $allowedTables = ['members', 'plans', 'companies'];
✅ 2. Define Route in web.php

Route::get('/delete/{table}/{id}', [MemberController::class, 'deleteFromTable'])->name('generic.delete');

✅ 3. Use in Blade (Dynamic Delete Button)

<a href="{{ route('generic.delete', ['table' => 'members', 'id' => $company->id]) }}"
   onclick="return confirm('Are you sure you want to delete {{ $company->name }}?')"
   class="btn btn-danger">
    <i class="fa fa-trash"></i>
</a>

*/


public function deleteFromTable(Request $request, $table, $id)
{
    // ✅ Only allow specific tables
    $allowedTables = ['members', 'package_master'];

    if (!in_array($table, $allowedTables)) {
        abort(403, 'Unauthorized table access.');
    }

    DB::table($table)->where('id', $id)->delete();

    // return back()->with('success', ucfirst($table) . ' deleted successfully!');
    return back()->with('success',  ' Deleted successfully!');
}

// delete **************************************************


}