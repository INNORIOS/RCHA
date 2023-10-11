<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('Session Mgt')</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
   <style> ::-webkit-scrollbar {
    display: none;
  }</style> 
</head>
<body>
    <div class="no-scrollbar">
    <div class="container mt-5">
        
        @yield('content')
    </div>
    </div>
</body>
</html>