{{-- // dd($userPic);
// exit;
/*
@if ($userName)
<strong>{{ $userName }}</strong>
@endif


@if($userPic)
<img src="{{ url(asset($userPic))}}" alt="image" class="imaged w32">
@endif
*/ --}}


@extends('userApp.layouts.userAppLayout')
@section('title', 'Dashboard')

@section('content')



<!-- App Header -->
<div class="appHeader">
    <div class="left">
        <a href="{{route('dashboard.app')}}" class="headerButton ">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        Add Balance


    </div>

</div>
<!-- * App Header -->

<br>
<br>

<div class="section mt-5 mb-4">

    <div class="card">
        <div class="card-body">
            <h4>Company Payment Details</h4>

            @if($warningMessage)
            <div class="alert alert-danger mb-1">
                {{ $warningMessage }}
            </div>
            @endif

            @foreach($membersBankDetails as $bankDetails)

            <div>
                <strong>Bank Name : {{ $bankDetails->BankName }} </strong><br>
                <strong>Bank IFCE Code: {{ $bankDetails->BankIFSC }} </strong><br>
                <strong>AC Holder Name : {{ $bankDetails->name }} </strong><br>
                <strong>Bank AC. No : {{ $bankDetails->BankACNo }} </strong><br>
                <strong>UPI Id : {{ $bankDetails->upiId }} </strong><br>
                <strong>UPI QR Code 👇 </strong><br><br>
            </div>
            <center class="mb-1">
                <img src="{{ url(asset($bankDetails->qrCodeUpload	))}}" class="imaged w200">
            </center>
            @endforeach

        </div>
    </div>


</div>

<h1 class="text-center pt-2"> Add Balance Amount</h1>

<div class="section mt-2">

    <div class="card">
        <div class="card-body">

        @php
        $userId = session('app_user_id');
        $userName = session('app_user_name');
        $userPhone = session('app_user_phone');
        @endphp

        @if(session('success'))
            <div class="alert alert-primary mb-1">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-1">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('userAddBalance.userApp') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="userId" value="{{ $userId }}">
            <input type="hidden" name="userName" value="{{ $userName }}">
            <input type="hidden" name="userPhone" value="{{ $userPhone }}">

            <div class="card">
                <div class="card-body">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="add_balance_amount">Amount</label>
                            <input required type="number" class="form-control" id="add_balance_amount"
                                name="add_balance_amount" value="{{ old('add_balance_amount') }}"
                                placeholder="Enter Amount Here">
                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                        </div>
                    </div>

                    <h3 class="text-center pt-2">Upload Payment ScreenShot</h3>

                    <div class="custom-file-upload" id="fileUpload1">
                        <input type="file" id="fileuploadInput" accept=".png, .jpg, .jpeg" name="payment_screenShot">
                        <label for="fileuploadInput">
                            <span>
                                <strong>
                                    <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                    <i>Upload Payment ScreenShot</i>
                                </strong>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <br><br><br>
            <div>
                <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
            </div>
            <br><br><br><br>
        </form>

        </div>
    </div>

</div>



@endsection