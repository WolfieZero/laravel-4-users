{{ Form::open(array('url'=>'users/delete', 'class'=>'form-edit')) }}

    <h2 class="form-signup-heading">Delete?</h2>

    <p>Are you sure you want to delete yourself, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}?

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    {{ Form::submit('Delete me!', array('class'=>'btn btn-large btn-primary btn-block')) }}

{{ Form::close() }}