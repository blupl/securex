
<ul class="nav navbar-nav">
    @if(Request::is('securex/member'))
        <li role="presentation">
            <a id="" href="{{ handles('blupl/securex::member/registration') }}" >
                New Form
            </a>

        </li>
    @endif
    @if(Request::is('securex/approval/*') || Request::is('securex/printing'))
        <li role="presentation"><a href="#" id="batch">Batch</a></li>
    @endif
</ul>

@if(Request::is('securex/approval/*') || Request::is('securex/printing'))
    {{--Search Form--}}
    {!! Form::open(['class'=>'navbar-form navbar-right', 'method'=>'get']) !!}
    <div class="form-group">
        {!! Form::select('column', ['name'=>'Name', 'mobile'=>'Mobile'], null, ['class'=>'form-control']) !!}
        <input type="text" name="value" class="form-control" id="navbar-search-input" placeholder="Search">
        {!! Form::submit('Search', ['class'=>'form-control btn-success']) !!}
    </div>
    {!! Form::close() !!}
    {{--End Search Form--}}
@endif