@extends('layouts.app')
@section('title', 'Income List')

@section('content')



<div class="container">
    <h3>Wallet to Wallet Transfer</h3>
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif


   


    <form method="POST" action="{{ route('wallet.transfer.process') }}">
        @csrf
          <p class="from-top-header">Member Information</p>
                        <div class="row">

                            <!-- Introducer Section -->
                            <div class="form-group col-md-4">
                                <label> Enter Introduce ID or Phone</label>
                                <div style="display: flex;">
                                    <input type="number"  id="introducer_id"
                                        class="form-control">
                                    <input type="hidden" name="to_member_id" id="introducer_id_hidden">
                                    <button type="button" id="introduceIDBtn"
                                        class="btn btn-primary">Search</button>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Introducer Name<sup>*</sup></label>
                                <input type="text" class="form-control" name="introducer_name" id="introducer_name"
                                    readonly>

                            </div>

                            <div class="form-group col-md-4">
                                <label>Introducer Phone No</label>
                                <input type="text" class="form-control" name="introducer_phone" id="introducer_phone"
                                    readonly>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Introducer Full Address</label>
                                <input type="text" class="form-control" name="introducer_address"
                                    id="introducer_address" readonly>
                            </div>

                        </div>



        {{-- <div class="form-group">
            <label>Recipient Member ID</label>
            <input type="text" name="to_member_id" class="form-control" required>
        </div> --}}

        <div class="form-group">
            <label>Amount</label>
            <input type="number" name="amount" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Transfer</button>
    </form>
</div>
@endsection





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
    setTimeout(() => {
        document.querySelectorAll('.flash-message').forEach(el => {
            el.style.transition = "opacity 0.5s";
            el.style.opacity = 0;
            setTimeout(() => el.style.display = 'none', 500);
        });
    }, 4000);
</script>


<script>
    $(document).ready(function () {
        $('#introduceIDBtn').click(function () {
        // $('#introducer_id').focusout(function () {
            var id = $('#introducer_id').val();

            if (id) {
                $.get('/get-introducer/' + id, function (data) {
                    if (data && data.name) {
                        $('#introducer_id_hidden').val(data.introducer_id_hidden);
                        $('#introducer_name').val(data.name);
                        $('#introducer_phone').val(data.phone);
                        $('#introducer_address').val(data.address);

                        // Set Position radio button
                        /* if (data.position === 'Left') {
                            $('#position_left').prop('checked', true);
                        } else if (data.position === 'Right') {
                            $('#position_right').prop('checked', true);
                        } */
                    } else {
                        alert('Introducer not found');
                    }
                }).fail(function () {
                    alert('Something went wrong');
                });
            } else {
                // alert('Please enter Introducer ID');
            }
        });
    });
</script>