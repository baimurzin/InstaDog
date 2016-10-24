<form action="{{URL::route('instagram.accounts.store')}}" method="post" onsubmit="return popupModule.submitPopupForm(this);">
    <div class="form-group @if($errors->has('login')) has-error @endif">
        <label>Login:</label>
        <input type="text" name="login" class="form-control" value="{{old('login')}}">
    </div>

    <div class="form-group @if($errors->has('password')) has-error @endif">
        <label>Password:</label>
        <input type="text" name="password" class="form-control" value="{{old('password')}}">
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>