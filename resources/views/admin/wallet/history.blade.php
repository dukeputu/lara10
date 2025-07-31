@extends('layouts.app')
@section('title', 'Income List')

@section('content')


<div class="container">
    <h3>Wallet Transfer History</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Last Wallet Balance</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transfers as $row)
                @php
                    $isCredit = session('member_id') === $row->to_member_id;
                    $amountText = $isCredit ? '+'.$row->amount.' Cr' : '-'.$row->amount.' Dr';
                    $balance = $isCredit ? $row->to_member_balance : $row->from_member_balance;

                    $fromName = \App\Models\Member::where('member_id', $row->from_member_id)->value('name');
                    $toName = \App\Models\Member::where('member_id', $row->to_member_id)->value('name');
                @endphp
                <tr>
                    <td>{{ $fromName }} [{{ $row->from_member_id }}]</td>
                    <td>{{ $toName }} [{{ $row->to_member_id }}]</td>
                    <td class="{{ $isCredit ? 'text-success' : 'text-danger' }}"><strong>{{ $amountText }}</strong></td>
                    <td>{{ $balance }}</td>
                    <td>{{ date('d-m-Y H:i', strtotime($row->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

