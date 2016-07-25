<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
	            <form method="post">
	            	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
               		<input type="submit" id="btnSubmit" value="Check Input Disk"></input>
                </form>
                <br/>
                <div style="color:red">{{ $message or ''}}</div>
            </div>
        </div>
    </body>
</html>