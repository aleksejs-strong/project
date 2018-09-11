@include('includes\header')
<div class="container">
    <h1>Welcome to Library</h1>
    @if(isset($errorMessage))
        <div class="text-danger">{{$errorMessage}}</div>
    @endif
{{ Form::open(array('url' => 'login')) }}

    <div class="form-check">
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', Input::old('username'), array('placeholder' => 'XXXXXX','class' => 'form-control')) }}
    </div>

    <div class="form-check">
    {{ Form::label('password', 'Password') }}
    {{ Form::password(('password'),array('placeholder' => '**********','class' => 'form-control')) }}
    </div>

    <div>
        {{ Form::submit(('Submit!'),array('class' => 'btn btn-default')) }}
    </div>
{{ Form::close() }}

</div>
@include('includes\footer')