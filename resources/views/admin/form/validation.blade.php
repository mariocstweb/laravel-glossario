        
@if ($errors->any())
<div id="validation-alert" class="alert alert-danger">
    <h5>I seguenti campi contengono errori:</h5>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif