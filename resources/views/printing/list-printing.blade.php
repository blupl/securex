@extends('orchestra/foundation::layouts.page')

@section('navbar')
    @include('blupl/securex::widgets.header')
@endsection

@section('content')
    {!! Form::open(['url'=>handles('blupl/securex::printing/pdf/batch')]) !!}

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Date / Time</th>
            <th class="text-center">Batch Printing<br/><input type="checkbox" id="select_all"></th>
            <th>Name</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->created_at }}</td>
            <td><input type="checkbox" class="checkbox" style="margin: 0 auto;" name="member[]" value="{{ $member->id }}"></td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->roleName($member->role) }}</td>
            <td>{{ ($member->status = true ? 'Approved' : 'Pending') }}</td>
            <td><a href="{{ handles('blupl/securex::printing/'.$member->id) }}">Print</a> </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! Form::submit('Batch Printing', ['id'=>'batch-approval', 'style'=>'display: none;']) !!}
    {!! Form::close() !!}
    {!! $members->render() !!}

@stop

