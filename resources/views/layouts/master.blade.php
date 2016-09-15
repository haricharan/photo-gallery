<!DOCTYPE html>
<html>
    <head>
    	<title>Ashari Photo Gallery - @yield('title')</title>
    </head>
    <body>
		@section('sidebar')
			This is the master sidebar.
        @show

        <div class="container">
			@yield('content')
		</div>
    </body>
</html>
    