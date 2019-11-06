@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="nav flex-column">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif