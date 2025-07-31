@extends('layouts.app')
@section('title', 'Income List')

@section('content')



<div class="container">
    <h3>🔔 Membership Renewal Notice (Expiring in 30–60 Days)</h3>

    @if($expiringSoon->isEmpty())
        <div class="alert alert-success">No upcoming renewals found.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>SL No</th>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Join Date</th>
                    <th>Expiry Date</th>
                    <th>Renew</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($expiringSoon as $member)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $member->member_id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->select_plan_name }}</td>
                    <td>
                        @if ($member->status == 1)
                            <span class="badge badge-success">Active</span>
                        @elseif ($member->status == 2)
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Expired</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($member->join_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->expiry_date)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ url('/renew-member/' . $member->member_id) }}" class="btn btn-sm btn-primary">Renew</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
