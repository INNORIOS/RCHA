@extends('layout-session')
@section('tile','TOUR')
@section('content')
{{-- <div class="mt-5 py-5 px-5"> --}}
{{-- <div><a href="{{route('innorios') }}">INNORIOS</a></div> --}}
{{-- <a href="{{url('http://127.0.0.1:8000/google') }}" target="_blank">Google</a> --}}
 <div><a href="{{route('tour') }}">Pid lnk</a></div>
 {{-- <iframe src="https://www.innorios.com" style="width:100%; height:100vh; border:none;"></iframe> --}}
 
 <div style=" height: 100vh;">
    {{-- <iframe src="https://www.innorios.com" style="width:100%; height:100%; border:none; overflow-x: hidden; overflow-y: hidden;">
    </iframe> --}}
    {{-- overflow-y: hidden;overflow-x: hidden; --}}
    <iframe id="myFrame" src="https://www.innorios.com" style="width:100%; height:100%; border:none; overflow:auto; scrollbar-width: thin;"></iframe>

<script>
document.getElementById('myFrame').addEventListener('click', function() {
    this.contentWindow.location.reload();
});
</script>

</div>

@endsection