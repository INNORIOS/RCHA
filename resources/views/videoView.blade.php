
{{-- @extends('layouts.app')

@section('content')
  <h1>Paid Video View</h1>
  <button>
    <a href="/videoView/{{ $token->paid_link }}" class="btn btn-primary">View Video</a> yoo
  </button>
  <video controls>
    <source src="/videoView/{{ $token->paid_link  }}" type="video/mp4">
  </video>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paid Video View</title>
    
</head>
<body>
    <h1>Paid Video View</h1>
   
    <iframe src="http://www.youtube.com/embed/{{$token}}" class="btn btn-primary" style="width:100%; height:100%; border:none; overflow:auto; scrollbar-width: thin;" allowfullscreen>View Video</iframe>
    {{-- <video controls>
        
          <source src="{{ $token->paid_link }}" type="video/mp4">
          </video> --}}
            {{-- <source src="/videoView/{{ $token }}" type="video/mp4"> --}}
</div>
</body>
</html> 

    {{-- <div><a href="{{route('tour') }}">Pid lnk</a></div> --}}
    {{-- <iframe src="https://www.innorios.com" style="width:100%; height:100vh; border:none;"></iframe> --}}
    
    {{-- <div style=" height: 100vh;"> --}}
       {{-- <iframe src="https://www.innorios.com" style="width:100%; height:100%; border:none; overflow-x: hidden; overflow-y: hidden;">
       </iframe> --}}
       {{-- overflow-y: hidden;overflow-x: hidden; --}}
       {{-- <iframe id="myFrame" src="/videoView/{{$paidLink }}" class="btn btn-primary" style="width:100%; height:100%; border:none; overflow:auto; scrollbar-width: thin;">View Video</iframe>
   
   <script>
   document.getElementById('myFrame').addEventListener('click', function() {
       this.contentWindow.location.reload();
   });
   </script> --}}
   
  