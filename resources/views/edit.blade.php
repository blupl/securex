@extends('orchestra/foundation::layouts.page')

@section('navbar')
    {{--    @include('blupl/printmedia::widgets.header')--}}
@endsection

@section('content')
    @include('blupl/securex::form.securex')
@stop

@push('orchestra.footer')
@include('blupl/printmedia::common._inputScript')
<script type="text/javascript" src="{{ asset('packages/blucms/foundation/js/wizard/jquery.smartWizard.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Smart Wizard
        $('#wizard').smartWizard();

        function onFinishCallback() {
            $('#wizard').smartWizard('showMessage', 'Finish Clicked');
            //alert('Finish Clicked');
        }
    });

    $(document).ready(function () {
        // Smart Wizard
        $('#wizard_verticle').smartWizard({
            transitionEffect: 'slide'
        });

    });

    $(document).ready(function () {
        $('.form-active').on('click', function() {
            var field = $(this).parents('fieldset');
            if(field.prop('disabled')  == true) {
                field.prop("disabled", false);
                $(this).html('<small>| Deactivate</small>');
            }else {
                field.prop("disabled", true);
                $(this).html('<small>| Active</small>');
            }

        });
    });
</script>

@endpush

@push('orchestra.header')
@include('blupl/printmedia::form.style')

<style>
    .help-block {
        color: red;
        position: absolute;
        right: 10px;
        margin-top: 35px;
        font-size: 10px;
    }
</style>
@endpush