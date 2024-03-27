@session('message')
<div class="alert alert-{{session('type')}} mx-5 my-3 w-100"> {{session('message')}} </div>
@endsession