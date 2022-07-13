
<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body> <!-- class="animsition" --> 
	
	<header>
        @include('header')
	</header>

	@include('cart')

	@yield('content')

    @include('footer')
</body>
</html>