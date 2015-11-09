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
                <a href="#">
                    <i class="fa fa-print"></i>
                    <p class="box-title">Print</p>
                </a>
            </div>

            <div class="box-body">
                {!! Form::open(['url'=>handles('blupl/securex::approval/zone/batch'), 'method'=>'PUT']) !!}
                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="row">
                        @foreach($members as $member)
                        <div class="col-md-4">
                                {!! Form::hidden('member[]', $member->id) !!}
                                {{ $member->name }}
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="form-group">
                        @for($x=1; $x <= 6; $x++)
                            <label style="margin-right: 25px;">
                                {{--<input  name="zone[{{ $member->id }}][{{ $x }}]" type="checkbox" value="{{ $x }}">--}}
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
