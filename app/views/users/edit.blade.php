{{ Form::open(array('url'=>'users/edit', 'class'=>'form-edit')) }}

    <h2 class="form-signup-heading">Edit</h2>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <div class="form-group">
        {{ Form::text('firstname', Auth::user()->firstname, array('class'=>'form-control', 'placeholder'=>'First Name')) }}
    </div>
    <div class="form-group">
        {{ Form::text('lastname', Auth::user()->lastname, array('class'=>'form-control', 'placeholder'=>'Last Name')) }}
    </div>
    <div class="form-group">
        {{ Form::text('email', Auth::user()->email, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
    </div>
    <div class="form-group">
        {{ Form::text('location', Auth::user()->location, array('class'=>'form-control', 'placeholder'=>'Location')) }}
    </div>
    <div class="form-group">
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    </div>
    <div class="form-group">
        {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
    </div>
    <div class="form-group">
        {{ Form::file('image', array('class'=>'form-control')) }}
    </div>

    {{ Form::submit('Update', array('class'=>'btn btn-large btn-primary btn-block')) }}

{{ Form::close() }}