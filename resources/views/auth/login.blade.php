<!DOCTYPE html>
<html>
<head>
    <title>Member Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Member Login</h4>
                </div>
                <div class="card-body">
                    {{-- Show session errors --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('member.login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="member_id">Member ID</label>
                            <input type="text" class="form-control" name="member_id" placeholder="Enter Member ID"  required  value="{{ old('member_id') }}">
                            
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
