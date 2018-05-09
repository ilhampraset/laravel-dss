<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
   
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
    <!-- Font Awesome -->

    <link href="{{ url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    



    <!-- Custom Theme Style -->
    <link href="{{ url('assets/build/css/custom.min.css')}}" rel="stylesheet">
   
    @yield('css')
</head>
  <body class="nav-sm">
    <div class="container body">
      <div class="main_container">

 

        <!--sidebar -->
          <!-- sidebar menu -->
          @component('components.sidebar')
          @endcomponent
        <!-- /sidebar menu -->

          @component('components.topnav')
          @endcomponent
       

	   <div class="right_col" role="main">
       
    	    <div class="row">
		        <div class="col-md-12 col-sm-12 col-xs-12">
		          @yield('content')
		        </div>
          	</div>
        </div>

  		   @component('components.footer')
      @endcomponent

       <script src="{{ asset('js/app.js') }}"></script>
       <script src="{{ url('assets/build/js/custom.min.js') }}"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
          
        @yield('js')

     
</body>
</html>