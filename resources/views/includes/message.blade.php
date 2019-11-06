@if (Session::get('status'))
    <div class="alert alert-success">
        {{Session::get('status')}}
    </div>
@endif