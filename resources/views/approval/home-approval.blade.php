@extends('orchestra/foundation::layouts.page')

@section('navbar')
    @include('blupl/securex::widgets.header')
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th>Number Of Entries</th>
            <th>Pending</th>
            <th>Approval</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Registered Member</td>
            <td><a href="{{ handles('blupl/securex::approval/list') }}"> {{ $securex->all()->count() }}</a></td>
            <td>{{ $host->where('status','=', 0)->count() }}</td>
            <td>{{ $host->where('status','=', 1)->count() }}</td>
        </tr>
        </tbody>
    </table>
@stop
