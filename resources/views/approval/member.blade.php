@extends('orchestra/foundation::layouts.page')


@section('navbar')
    @include('blupl/securex::widgets.header')
@endsection

@section('content')

    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <a href="{{ URL::previous() }}">
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <p class="box-title">Back</p>
                </a>
            </div>
            <div class="box-body"></div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <a href="#" class="broken">
                    <i class="fa fa-print"></i>
                    <p class="box-title">Print</p>
                </a>
                <a class="col-md-offset-1 broken" href="{{-- handles('blupl/securex::printing/pdf/'.$member->id) --}}">
                    <i class="fa fa-save"></i>
                    <p class="box-title">Save As PDF</p>
                </a>
            </div>

            <div class="box-body">
                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="exampleInputName">NAME</label>
                            <p>{{ $member->name }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputRole1">Role</label>
                            <p>{{ $member->role }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputId">National ID / Passport Number</label>
                            <p>{{ $member->personal_id }}<p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="exampleInputGender">Gender</label>
                            <p>{{ $member->gender }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputDate">Date of Birth</label>
                            <p>{{ $member->date_of_birth }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Mobile Phone Number</label>
                            <p>{{ $member->mobile }}<p>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-4">
                            <label for="exampleInputRole1">Work Station</label>
                            <p>{{ $member->work_station }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">E-Mail ID</label>
                            <p>{{ $member->email }}<p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="exampleInputFile">Photo</label>
                            <br>
                            <img src="{{ url($member->photo) }}" style="width: 50px;"/>
                            <h5>File Upload</h5>
                            <a href="{{ url($member->photo) }}">DOWNLOAD</a>
                        </div>
                    </div>
                </div>


                {!! Form::open(['url'=>route('securex.approval.zone', $member->id), 'method'=>'PUT']) !!}

                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="form-group">
                        {!! Form::hidden('member_id[]', $member->id) !!}
                        @for($x=1; $x <= 6; $x++)
                            <label style="margin-right: 25px;">
                                {!! Form::checkbox( 'zone[]', $x, false,['class'=>'minimal']) !!} Zone # {{ $x }}
                            </label>
                        @endfor
                    </div>
                </div>
                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="form-group">
                        <div class="col-md-4 text-center">
                            <label class="text-center">
                                {!! Form::radio( 'grade', '1', true,['class'=>'minimal']) !!} </br> Both Dhaka and Chittagong
                            </label>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="text-center">
                                {!! Form::radio( 'grade', '2', false,['class'=>'minimal']) !!} </br> Dhaka Central
                            </label>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="text-center">
                                {!! Form::radio( 'grade', '3', false,['class'=>'minimal']) !!} </br> Chittagong Central
                            </label>
                        </div>
                    </div>
                </div>
                {!! Form::hidden('number', hexdec(uniqid())) !!}
                {!! Form::submit('Approve', ['class'=>'btn btn-block btn-warning btn-sm']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
