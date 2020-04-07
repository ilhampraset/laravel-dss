
<div class="col-md-3 left_col">
	<div class="left_col ">
		<div class="navbar nav_title" style="border: 0;">
			<a href="#" class="site_title"><i class="fa fa-paw"></i>
				<span>
					@role('admin')
					Admin Page
					@endrole
					@role('user')
					Pelaku Usaha Page
					@endrole
				</span>
			</a>
		</div>
		<div class="clearfix"></div>
		<div class="profile clearfix">
		<!-- <div class="profile_pic">
			<img src="/images/img.jpg" alt="..." class="img-circle profile_img">
		</div>
		<div class="profile_info">
			<span>Welcome,</span>
			<h2>John Doe</h2>
		</div> -->
	</div>
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		        <div class="menu_section">
		            <ul class="nav side-menu">
		            @role('admin')
		              <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		              <li><a href="{{url('kriteria')}}"><i class="fa fa-list"></i> Kriteria</a></li>
		              <li><a href="{{url('sub_kriteria')}}"><i class="fa fa-list-ul"></i> Sub Kriteria</a></li>
									<li><a href="{{url('profile-acuan')}}"><i class="fa fa-home"></i> Data Profile Acuan </a></li>
		             @endrole

		              @role('user')
		              <li><a href="{{url('user/home')}}"><i class="fa fa-home"></i> Dashboard </a></li>
									<li><a href="{{url('profile-acuan')}}"><i class="fa fa-list-ul"></i> Data Profile Acuan </a></li>
		              <li><a href="{{url('profile-matching')}}"><i class="fa fa-home"></i> Profile Matching </a></li>
		              @endrole

		            </ul>
		        </div>
		</div>

		<!-- /top navigation -->

   		 <!--top-nav-menu-->
        <!-- /menu footer buttons -->
	    <div class="sidebar-footer hidden-small">
	      <a data-toggle="tooltip" data-placement="top" title="Settings">
	        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	      </a>
	      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
	        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	      </a>
	      <a data-toggle="tooltip" data-placement="top" title="Lock">
	        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	      </a>
	      <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
	        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	      </a>
	    </div>
    	<!-- /menu footer buttons -->
  	</div>
</div>
