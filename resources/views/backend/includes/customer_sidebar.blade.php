<style>
    .tooltip .tooltip-inner {
        margin-left: 17px; 
    }
</style>
<!-- sidebar -->
<div class="sidebar px-4 py-4 py-md-4 me-0">
	<div class="d-flex flex-column h-100">
		
		<!-- Menu: main ul -->
		<ul class="menu-list flex-grow-1 mt-3">
	
			<li><a class=" m-link <?php if($pagename == 'Dashboard'){ echo 'active'; } ?>" href="{{url('dashboard')}}"><i class="icofont-home fs-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Home"></i> <span>Home </span></a></li>
			<!-- <li>
				<a class="m-link " href=""><i class="icofont-pencil fs-5"></i> <span>Orders  </span></a>
			</li> -->
            <li>
				<a class="m-link <?php if($pagename == 'Tarcking Status' || $pagename == 'Tarcking Status View'){ echo 'active'; } ?>" href="{{url('tracking-status')}}"><i class="icofont-location-pin fs-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Tracking & Status"></i><span>Tracking & Status  </span></a>
			</li>
            <!-- <li>
				<a class="m-link <?php if($pagename == 'Report' || $pagename == 'Order History' || $pagename == 'Sales Orders' || $pagename == 'Inventory Levels'){ echo 'active'; } ?>" href="{{url('report')}}"><i class="icofont-chart-bar-graph fs-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Report"></i> <span>Report  </span></a>
			</li> -->
            <li>
				<a href="{{url('payment')}}" class="m-link <?php if($pagename == 'Payment' || $pagename == 'Payment Create' || $pagename == 'Payment Edit'){ echo 'active'; } ?>" href=""><i class="icofont-credit-card fs-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Payment"></i> <span>Payment  </span></a>
			</li>
            <li>
				<a class="m-link <?php if($pagename == 'Specbook'){ echo 'active'; } ?>" href="{{url('specbook')}}"><i class="icofont-ebook" data-bs-toggle="tooltip" data-bs-placement="right" title="Specbook"></i><span>Specbook  </span></a>
			</li>
            <!-- <li>
				<a class="m-link <?php if($pagename == 'RMA' || $pagename == 'RMA View'){ echo 'active'; } ?>" href="{{url('rma-s')}}"><i class="icofont-arrow-left fs-5" data-bs-toggle="tooltip" data-bs-placement="right" title="RMA's"></i><span>RMA's  </span></a>
			</li> -->
           

           	<?php 
            $showprofileeditPage = false;
            if($pagename == 'Customer Profile Edit')
            { $showprofileeditPage = true; } 
            $showchnagepassPage = false;
            if($pagename == 'Reset Password')
            { $showchnagepassPage =true; }
            $expandCust_grp = $showprofileeditPage || $showchnagepassPage;
            ?>
            <li class="collapsed">

				<a class="m-link <?php if($pagename == 'Customer Profile Edit' || $pagename == 'Reset Password'){ echo 'active'; } ?>" href="{{url('customer_edit_profile/edit')}}">
				    <i class="icofont-user" data-bs-toggle="tooltip" data-bs-placement="right" title="My Account"></i>
				    <span>My Account</span>
				    <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span>
				</a>
				<!-- Menu: Sub menu ul -->
				<ul class="sub-menu collapse <?php if($expandCust_grp) { echo "show"; }?>" id="menu-product">
					<li><a class="ms-link <?php if($pagename == 'Customer Profile Edit'){ echo 'active'; } ?>" href="{{url('/customer_edit_profile/edit')}}" ><span>Edit Profile</span></a></li>
					<li><a class="ms-link <?php if($pagename == 'Reset Password'){ echo 'active'; } ?>" href="{{url('/reset_password/edit')}}" ><span>Change Password</span></a></li>
				</ul>
			</li>

		</ul>

		<!-- Menu: menu collepce btn -->
		<button type="button" class="btn btn-link sidebar-mini-btn text-light sd_cls">
			<span class="ms-2"><i class="icofont-bubble-right"></i></span>
		</button>
		<!-- <button type="button" class="btn btn-link sidebar-mini-btn text-light">
			<span class="ms-2"><i class="icofont-bubble-right"></i></span>
		</button> -->
	</div>
</div>
