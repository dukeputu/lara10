@extends('layouts.app')
@section('title', 'Income List')

@section('content')


<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Plan Income View</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="fileTable1" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>User Name</th>
                                <th>User Phone No</th>
                                <th>Last Wallet Balance</th>
                                <th>Balance Request</th>
                                <th>Payment Photo</th>
                                <th>Status</th>
                                <th>Requested At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($userBalanceRequest as $index => $BalanceRequest)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $BalanceRequest->app_user_name }}</td>
                                <td>{{ $BalanceRequest->user_phone }}</td>
                                <td>{{ $BalanceRequest->user_wallet }}</td>
                                <td>{{ $BalanceRequest->req_bal_amount }}</td>
                                <td><a href="{{ $BalanceRequest->pay_screenshot }}" target="_blank">View Screenshot</a>
                                </td>

                                <td>
                                    @if($BalanceRequest->status == 1)
                                    <span class="badge bg-success">Approved</span>
                                    @elseif($BalanceRequest->status == 2)
                                    <span class="badge bg-warning">Pending</span>
                                    @else
                                    <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>

                                <td>{{ \Carbon\Carbon::parse($BalanceRequest->created_at)->format('d-m-Y , h:i A') }}
                                </td>

                               <td>
    @if($BalanceRequest->status == 1)
        <button class="btn btn-primary btn-sm" disabled>
            <i class="fa fa-check"></i> Approved
        </button>
    @else
        <form action="{{ route('addBalanceTrafer.list', $BalanceRequest->id) }}" method="POST" style="display:inline-block;" 
      onsubmit="return confirm('Are you sure you want to send ₹{{ $BalanceRequest->req_bal_amount }} to {{ $BalanceRequest->app_user_name }}?');">
    @csrf
    <input type="hidden" name="userBlaAdd" value="{{ $BalanceRequest->req_bal_amount }}">
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa fa-check"></i>
    </button>
</form>

    @endif
</td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>
</section>
</div>




@endsection





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if ($errors -> any())
        toastr.error("{{ $errors->first() }}");
    @endif
</script>

<script>
    setTimeout(() => {
        document.querySelectorAll('.flash-message').forEach(el => {
            el.style.transition = "opacity 0.5s";
            el.style.opacity = 0;
            setTimeout(() => el.style.display = 'none', 500);
        });
    }, 4000);
</script>