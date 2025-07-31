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
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>User Email</th>
                            {{-- <th>User Password</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                             @foreach($appUsers as $index => $appUser)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $appUser->app_u_name }}</td>
                                <td>{{ $appUser->phone_number }}</td>
                                <td>{{ $appUser->user_email }} </td>
                                   {{-- Show password hash if REALLY needed (not recommended) --}}
        {{-- <td><code>Hash::check({{ $appUser->password }})</code></td> --}}
                                <td>

                                    {{-- <a href="#" class="btn btn-primary"><i class="fa fa-trash"></i></a> --}}
  <a target="_blank" href="{{ route('admin.loginAsUser', $appUser->id) }}" class="btn btn-success btn-sm">
                👤 Login as User
            </a>
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