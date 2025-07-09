<!-- sidebar -->
<div class="sidebar px-4  me-0">
   <div class="d-flex flex-column h-100">
      <!-- <a href="{{url('admin/home')}}" class="mb-0 brand-icon">
         <span class="logo-icon">
         <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
         </span>
          
         </a> -->
      <ul class="menu-list flex-grow-1 mt-3">
         @if(Auth::user()->role_id == 1)
                <!-- Dashboard -->
                <li><a class="m-link <?php   if ($pagename == 'Dashboard') {
              echo 'active';
            } ?>" href="{{url('admin/home')}}"><i class="icofont-home fs-5" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Dashboard"></i>
                     <span>Dashboard </span></a></li>
                <!-- Users -->
                <?php 
                       $showuserPage = false;
            if ($pagename == 'Customer Index' || $pagename == 'Create Customer' || $pagename == 'Customer Edit' || $pagename == 'Customer View') {
              $showuserPage = true;
            }
            $showapprovalPage = false;
            if ($pagename == 'Customer Approvals' || $pagename == 'Customer Approval View') {
              $showapprovalPage = true;
            }
            $expanduser = $showuserPage || $showapprovalPage;
                        ?>
                <li class="collapsed">
                  <a class="m-link <?php   if ($pagename == 'Customer Index' || $pagename == 'Create Customer' || $pagename == 'Customer Edit' || $pagename == 'Customer View' || $pagename == 'Customer Approvals' || $pagename == 'Customer Approval View') {
              echo 'active';
            } ?>" data-bs-toggle="collapse" data-bs-target="#menu-user" href="#">
                     <i class="icofont-ui-user fs-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Users"></i>
                     <span>Users </span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                  <!-- Menu: Sub menu ul -->
                  <ul class="sub-menu collapse <?php   if ($expanduser) {
              echo "show";
            }?>" id="menu-user">
                     <li><a class="ms-link  <?php   if ($pagename == 'Customer Index' || $pagename == 'Create Customer' || $pagename == 'Customer Edit' || $pagename == 'Customer View') {
              echo 'active';
            } ?>" href="{{url('admin/customers')}}"><span>Users</span></a></li>
                     <li><a class="ms-link  <?php   if ($pagename == 'Customer Approvals' || $pagename == 'Customer Approval View') {
              echo 'active';
            } ?>" href="{{url('admin/approvals')}}"><span>Approvals</span></a></li>
                  </ul>
                </li>
                <!-- Products -->
                <?php 
                       $showproductPage = false;
            if ($pagename == 'Product Index' || $pagename == 'Create Item' || $pagename == 'Item Edit' || $pagename == 'Item View') {
              $showproductPage = true;
            }

            $showcategoryPage = false;
            if ($pagename == 'Category Index' || $pagename == 'Create Category' || $pagename == 'Category Edit') {
              $showcategoryPage = true;
            }

            $showdoorstylePage = false;
            if ($pagename == 'Door Style Index' || $pagename == 'Create Door Style' || $pagename == 'Door Style Edit') {
              $showdoorstylePage = true;
            }

            $showmodificationPage = false;
            if ($pagename == 'Addmodification Index' || $pagename == 'Create Addmodification' || $pagename == 'Addmodification Edit') {
              $showmodificationPage = true;
            }

            $showaccessoriesPage = false;
            if ($pagename == 'Accessories Index' || $pagename == 'Create Accessories' || $pagename == 'Accessories Edit') {
              $showaccessoriesPage = true;
            }

            $expandproduct = $showproductPage || $showcategoryPage || $showdoorstylePage || $showmodificationPage || $showaccessoriesPage;
                       ?>
                <li class="collapsed">
                  <a class="m-link <?php   if ($pagename == 'Product Index' || $pagename == 'Create Item' || $pagename == 'Item Edit' || $pagename == 'Item View' || $pagename == 'Category Index' || $pagename == 'Create Category' || $pagename == 'Category Edit' || $pagename == 'Door Style Index' || $pagename == 'Create Door Style' || $pagename == 'Door Style Edit' || $pagename == 'Addmodification Index' || $pagename == 'Create Addmodification' || $pagename == 'Addmodification Edit' || $pagename == 'Accessories Index' || $pagename == 'Create Accessories' || $pagename == 'Accessories Edit') {
              echo 'active';
            } ?>" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                     <i class="icofont-cube fs-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Products"></i>
                     <span>Products</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                  <!-- Menu: Sub menu ul -->
                  <ul class="sub-menu collapse <?php   if ($expandproduct) {
              echo "show";
            }?>" id="menu-product">
                     <li><a class="ms-link <?php   if ($pagename == 'Product Index' || $pagename == 'Create Item' || $pagename == 'Item Edit' || $pagename == 'Item View') {
              echo 'active';
            } ?>" href="{{url('admin/item-list')}}"
                         style="background: none!important; border: none;"><span>Product</span></a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Category Index' || $pagename == 'Create Category' || $pagename == 'Category Edit') {
              echo 'active';
            } ?>" href="{{url('admin/categories-list')}}"><span>Category</span> </a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Door Style Index' || $pagename == 'Create Door Style' || $pagename == 'Door Style Edit') {
              echo 'active';
            } ?>" href="{{url('admin/door-style-list')}}"><span>Door Style</span></a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Addmodification Index' || $pagename == 'Create Addmodification' || $pagename == 'Addmodification Edit') {
              echo 'active';
            } ?>" href="{{url('admin/addmodification/index')}}"><span>Modification</span></a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Accessories Index' || $pagename == 'Create Accessories' || $pagename == 'Accessories Edit') {
              echo 'active';
            } ?>" href="{{url('admin/accessories/index')}}"><span>Accessories</span></a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Edit Unassembled Discount') {
              echo 'active';
            } ?>" href="{{url('admin/edit-unassembled-discount')}}"><span>Unassembled Discount</span> </a></li>
                  </ul>
                </li>
                <!-- Process Manage -->
                <li><a class="m-link <?php   if ($pagename == 'Process Management' || $pagename == 'View Process') {
              echo 'active';
            } ?>" href="{{url('admin/process-manage')}}"><i class="icofont-spinner-alt-3" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Process Manage"></i> <span>Manage Orders</span></a></li>
                <!-- Customer Group -->
                <li>
                  <a class="m-link <?php   if ($pagename == 'Specbook Pdf' || $pagename == "Specbook Pdf Create" || $pagename == "Specbook Pdf Edit") {
              echo 'active';
            } ?>" href="{{url('admin/specbook-pdf')}}"><i class="icofont-ebook" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Specbook"></i><span>Specbook PDF </span></a>
                </li>

                <?php 
                       $showcustomergroupPage = false;
            if ($pagename == 'Customer Group' || $pagename == 'Customer Group Create' || $pagename == 'Customer Group Edit') {
              $showcustomergroupPage = true;
            }
            $showgroupingPage = false;
            if ($pagename == 'Customer Grouping' || $pagename == 'Customer Grouping Edit') {
              $showgroupingPage = true;
            }
            $expandCust_grp = $showcustomergroupPage || $showgroupingPage;
                       ?>
                <li class="collapsed">
                  <a class="m-link <?php   if ($pagename == 'Customer Group' || $pagename == 'Customer Group Create' || $pagename == 'Customer Group Edit' || $pagename == 'Customer Grouping' || $pagename == 'Customer Grouping Edit') {
              echo 'active';
            } ?>" data-bs-toggle="collapse" data-bs-target="#menu-customer-group" href="#"
                     style="padding: 8px 0px 10px 1px!important;">
                     <i class="icofont-users-alt-5 fs-5" data-bs-toggle="tooltip" data-bs-placement="right"
                       title="Customer Group"></i>
                     <span>Customer Group</span>
                     <span class="arrow icofont-rounded-down ms-auto text-end fs-5" <?php   if ($pagename == 'Customer Group' || $pagename == 'Customer Group Create' || $pagename == 'Customer Group Edit' || $pagename == 'Customer Grouping' || $pagename == 'Customer Grouping Edit') {
              echo 'style="margin-right: 20px;"';
            } ?>></span>
                  </a>
                  <!-- Menu: Sub menu ul -->
                  <ul class="sub-menu collapse <?php   if ($expandCust_grp) {
              echo "show";
            }?>" id="menu-customer-group">
                     <li><a class="ms-link <?php   if ($pagename == 'Customer Group' || $pagename == 'Customer Group Create' || $pagename == 'Customer Group Edit') {
              echo 'active';
            } ?>" href="{{url('admin/customer-group/index')}}"><span>Customer Group</span></a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Customer Grouping' || $pagename == 'Customer Grouping Edit') {
              echo 'active';
            } ?>" href="{{url('admin/customer-grouping/index')}}"><span>Customer Grouping</span></a></li>
                  </ul>
                </li>

                <?php 
                       $showtaxgroupPage = false;
            if ($pagename == 'Tax Group' || $pagename == 'Tax Group Create' || $pagename == 'Tax Group Edit') {
              $showtaxgroupPage = true;
            }
            $showtaxgroupingPage = false;
            if ($pagename == 'Tax Grouping' || $pagename == 'Tax Grouping Edit') {
              $showtaxgroupingPage = true;
            }
            $tax_grp = $showtaxgroupingPage || $showtaxgroupPage;
                       ?>
                <li class="collapsed">
                  <a class="m-link <?php   if ($pagename == 'Tax Group' || $pagename == 'Tax Group Create' || $pagename == 'Tax Group Edit' || $pagename == 'Tax Grouping Edit' || $pagename == 'Tax Grouping') {
              echo 'active';
            } ?>" data-bs-toggle="collapse" data-bs-target="#menu-tax-group" href="#"
                     style="padding: 8px 0px 10px 1px!important;">
                     <i class="icofont-users-alt-5 fs-5" data-bs-toggle="tooltip" data-bs-placement="right"
                       title="Tax Group"></i>
                     <span>Tax Group</span>
                     <span class="arrow icofont-rounded-down ms-auto text-end fs-5" <?php   if ($pagename == 'Tax Group' || $pagename == 'Tax Group Create' || $pagename == 'Tax Group Edit' || $pagename == 'Tax Grouping' || $pagename == 'Tax Grouping Edit') {
              echo 'style="margin-right: 20px;"';
            } ?>></span>
                  </a>
                  <!-- Menu: Sub menu ul -->
                  <ul class="sub-menu collapse <?php   if ($tax_grp) {
              echo "show";
            }?>" id="menu-tax-group">
                     <li><a class="ms-link <?php   if ($pagename == 'Tax Group' || $pagename == 'Tax Group Edit') {
              echo 'active';
            } ?>" href="{{url('admin/tax-group/index')}}"><span>Tax Group</span></a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Tax Grouping Edit' || $pagename == 'Tax Grouping') {
              echo 'active';
            } ?>" href="{{url('admin/tax-grouping/index')}}"><span>Tax Grouping</span></a></li>
                  </ul>
                </li>
                <li>
                  <a class="m-link <?php   if ($pagename == 'Shipping Cost List' || $pagename == "Specbook Pdf Create" || $pagename == "Shipping Cost Edit") {
              echo 'active';
            } ?>" href="{{url('admin/shipping-cost/index')}}"> <i class="icofont-users-alt-5 fs-5"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Shipping Cost"></i><span>Shipping Cost
                     </span></a>
                </li>
                <li>
                  <a class="m-link <?php   if ($pagename == 'Pay Later Group List' || $pagename == "Specbook Pdf Create" || $pagename == "Pay Later Group Edit") {
              echo 'active';
            } ?>" href="{{url('admin/pay-later-group/index')}}"> <i class="icofont-users-alt-5 fs-5"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Pay Later Group"></i><span>Pay Later Group
                     </span></a>
                </li>
                <?php 
                       $showAgentPage = false;
            if ($pagename == 'Agent Index' || $pagename == 'Create Agent' || $pagename == 'Agent View' || $pagename == 'Agent Edit') {
              $showAgentPage = true;
            }
            $showtaxgroupingPage = false;
            if ($pagename == 'Agent Assign') {
              $showtaxgroupingPage = true;
            }
            $agent = $showtaxgroupingPage || $showAgentPage;
                       ?>
                <li class="collapsed">
                  <a class="m-link <?php   if ($pagename == 'Agent Index' || $pagename == 'Create Agent' || $pagename == 'Agent View' || $pagename == 'Agent Edit' || $pagename == 'Agent Assign') {
              echo 'active';
            } ?>" data-bs-toggle="collapse" data-bs-target="#menu-agent" href="#"
                     style="padding: 8px 0px 10px 1px!important;">
                     <i class="icofont-users-alt-5 fs-5" data-bs-toggle="tooltip" data-bs-placement="right"
                       title="Tax Group"></i>
                     <span>Account Manager</span>
                     <span class="arrow icofont-rounded-down ms-auto text-end fs-5" <?php   if ($pagename == 'Agent Index' || $pagename == 'Create Agent' || $pagename == 'Agent View' || $pagename == 'Agent Edit' || $pagename == 'Agent Assign') {
              echo 'style="margin-right: 20px;"';
            } ?>></span>
                  </a>
                  <ul class="sub-menu collapse <?php   if ($agent) {
              echo "show";
            }?>" id="menu-agent">
                     <li><a class="ms-link <?php   if ($pagename == 'Agent Index' || $pagename == 'Create Agent' || $pagename == 'Agent View' || $pagename == 'Agent Edit') {
              echo 'active';
            } ?>" href="{{url('admin/agent-list')}}"><span>Account Manager</span></a></li>
                     <li><a class="ms-link <?php   if ($pagename == 'Agent Assign') {
              echo 'active';
            } ?>" href="{{url('admin/agent-assign-index')}}"><span> Account Manager Assigning</span></a></li>
                  </ul>
                </li>
                <li><a class="m-link <?php   if ($pagename == 'Coupon Index' || $pagename == 'Create Coupon' || $pagename == 'Coupon View' || $pagename == 'Coupon Edit') {
              echo 'active';
            } ?>" href="{{url('admin/coupon-list')}}"><i class="icofont-spinner-alt-3" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Coupon "></i> <span>Coupon </span></a></li>
            
                <li>
                  <a class="m-link <?php   if ($pagename == 'Drafts Index' || $pagename == 'Create Drafts' || $pagename == 'Drafts View' || $pagename == 'Drafts Edit') {
              echo 'active';
            } ?>" href="{{url('admin/drafts-list')}}">
                     <i class="icofont-file-text" data-bs-toggle="tooltip" data-bs-placement="right" title="Drafts"></i>
                     <span>Drafts</span>
                  </a>
                </li>

                <li>
                    <a class="m-link {{ $pagename == 'Logs Index' ? 'active' : '' }}" href="{{ route('logs.index') }}">
                        <i class="icofont-law-document" data-bs-toggle="tooltip" data-bs-placement="right" title="Logs"></i>
                        <span>Logs</span>
                    </a>
                </li>
       @endif

         @if(Auth::user()->role_id == 3)
                <li><a class="m-link <?php   if ($pagename == 'Dashboard') {
              echo 'active';
            } ?>" href="{{url('/home')}}"><i class="icofont-home fs-5" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Dashboard"></i>
                     <span>Dashboard </span></a></li>

                <li><a class="m-link <?php   if ($pagename == 'Customer Index' || $pagename == 'Create Customer' || $pagename == 'Customer Edit' || $pagename == 'Customer View') {
              echo 'active';
            } ?>" href="{{url('/customers')}}"><i class="icofont-ui-user fs-5" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Users"></i> <span>Users</span></a></li>
                <!-- Process Manage -->
                <li><a class="m-link <?php   if ($pagename == 'Process Management' || $pagename == 'View Process') {
              echo 'active';
            } ?>" href="{{url('/process-manage')}}"><i class="icofont-spinner-alt-3" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Process Manage"></i> <span>Manage Orders</span></a></li>

       @endif
         <!-- New Module -->
      </ul>
      <button type="button" class="btn btn-link sidebar-mini-btn text-light sd_cls">
         <span class="ms-2"><i class="icofont-bubble-right"></i></span>
      </button>
   </div>
</div>