
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
                <a href="{{ handles('blupl/securex::printing/pdf/'.$member->id) }}">
                    <i class="fa fa-print"></i>
                    <p class="box-title">Print</p>
                </a>
                <a class="col-md-offset-1" href="{{ handles('blupl/securex::printing/pdf/'.$member->id) }}">
                    <i class="fa fa-save"></i>
                    <p class="box-title">Save As PDF</p>
                </a>
            </div>

            <div class="box-body">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div style="float: left;">
                            <p class="text-center">
                                <img src="{{ url($member->photo) }}" style="width: 95px;"/>
                            </p>
                            <p class="text-center" style="margin: 0;">{{ $member->name }}</p>
                            <p class="text-center" style="margin: 0;">{{ $member->role }}</p>
                            <p class="text-center" style="margin: 0;">{{ $member->organization }}</p>
                        </div>
                        <div style="float: left;">
                            <ul class="text-center" style="list-style-type: none; font-size: 20px; font-weight: 800;">
                                @foreach($member->zone as $zone)
                                <li>{{ $zone->zone }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
