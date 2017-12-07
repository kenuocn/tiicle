@if (count($errors) > 0)
    <div class="ui floating negative message alert">
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif