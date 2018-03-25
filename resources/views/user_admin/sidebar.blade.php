
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            @if($lShop)
              <div class="user-panel" style="height: 40px;">
                <div class="info" style="left: 0;">
                  <p>Hello {{ $lShop->name }}</p>
                </div>
              </div>
            @endif

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="{{ route('user_dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>

            @if(Auth::user()->isShopAdmin())

              <li class="{{ Request::is('administrator/products')? 'active' :''  }}"><a href="{{ route('all_shop_products') }}"><i class="fa fa-list"></i>  <span> Products </span> </a></li>


              <li class="treeview {{ Request::is('admin/shop/sales*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-sellsy"></i>
                  <span>Sales</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/shop/sales')? 'active' :''  }}">
                    <a href="{{ route('user_all_sales') }}"><i class="fa fa-list-alt"></i> All Sales </a>
                  </li>
                  <li class="{{ Request::is('admin/shop/sales/create')? 'active' :''  }}"><a href="{{ route('user_new_sales') }}"><i class="fa fa-plus-square-o"></i>New Sales </a></li>
                </ul>
              </li>




              <li class="treeview {{ Request::is('admin/repair-product*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-wrench"></i>
                  <span>Repair Product</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/repair-product')? 'active' :''  }}">
                    <a href="{{ route('all_repair_product') }}"><i class="fa fa-list-alt"></i> All repair product </a>
                  </li>
                  <li class="{{ Request::is('admin/repair-product/create')? 'active' :''  }}"><a href="{{ route('new_repair_product') }}"><i class="fa fa-plus-square-o"></i>Add new </a></li>
                </ul>
              </li>

              <li class="treeview {{ Request::is('admin/shop/agents*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-users"></i>
                  <span>Staffs</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/shop/agents')? 'active' :''  }}">
                    <a href="{{ route('user_agent_list') }}"><i class="fa fa-list-alt"></i> Staffs </a>
                  </li>
                  <li class="{{ Request::is('admin/shop/agents/create')? 'active' :''  }}"><a href="{{ route('user_agent_create') }}"><i class="fa fa-plus-square-o"></i>Add Staff </a></li>
                </ul>
              </li>


              <li class="treeview {{ Request::is('admin/messages*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-envelope-o"></i>
                  <span>Messages</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/messages')? 'active' :''  }}"><a href="{{ route('agent_inbox') }}"><i class="fa fa-inbox"></i> Inbox</a></li>
                  <li class="{{ Request::is('admin/messages/sent')? 'active' :''  }}"><a href="{{ route('agent_sent_message') }}"><i class="fa fa-send-o"></i> Sent</a></li>
                  <li class="{{ Request::is('admin/messages/compose')? 'active' :''  }}"><a href="{{ route('message_compose') }}"><i class="fa fa-pencil"></i> Compose </a></li>
                </ul>
              </li>

              <li class="treeview {{ Request::is('admin/shop/exports*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-share-square-o"></i>
                  <span>Exports</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/shop/exports/agents/csv')? 'active' :''  }}"><a href="{{ route('export_agents_csv') }}"><i class="fa fa-file-o"></i> Sales Report</a></li>
                </ul>
              </li>

              <li class="treeview {{ Request::is('admin/profile')? 'active' :''  }}">
                <a href="{{ route('user_profile') }}"><i class="fa fa-user"></i> <span> Profile </span> </a>
              </li>

              <li class="treeview {{ Request::is('admin/shop/settings')? 'active' :''  }}">
                <a href="{{ route('shop_settings') }}"><i class="fa fa-gear"></i> <span>Settings</span> </a>
              </li>


            @endif


            @if(Auth::user()->isUser())

              <li class="{{ Request::is('administrator/products')? 'active' :''  }}"><a href="{{ route('all_shop_products') }}"><i class="fa fa-list"></i>  <span> Products </span> </a></li>


              <li class="treeview {{ Request::is('admin/shop/sales*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-sellsy"></i>
                  <span>Sales</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/shop/sales')? 'active' :''  }}">
                    <a href="{{ route('user_all_sales') }}"><i class="fa fa-list-alt"></i> All Sales </a>
                  </li>
                  <li class="{{ Request::is('admin/shop/sales/create')? 'active' :''  }}"><a href="{{ route('user_new_sales') }}"><i class="fa fa-plus-square-o"></i>New Sales </a></li>
                </ul>
              </li>

              <li class="treeview {{ Request::is('admin/repair-product*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-wrench"></i>
                  <span>Repair Product</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/repair-product')? 'active' :''  }}">
                    <a href="{{ route('all_repair_product') }}"><i class="fa fa-list-alt"></i> All repair product </a>
                  </li>
                  <li class="{{ Request::is('admin/repair-product/create')? 'active' :''  }}"><a href="{{ route('new_repair_product') }}"><i class="fa fa-plus-square-o"></i>Add new </a></li>
                </ul>
              </li>



              <li class="treeview {{ Request::is('admin/stock*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-bar-chart"></i>
                  <span>Stocks</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/stock')? 'active' :''  }}"><a href="{{ route('user_stock_index') }}"><i class="fa fa-list"></i> Stocks </a></li>
                </ul>
              </li>


              <li class="treeview {{ Request::is('admin/messages*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-envelope-o"></i>
                  <span>Messages</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/messages')? 'active' :''  }}"><a href="{{ route('agent_inbox') }}"><i class="fa fa-inbox"></i> Inbox</a></li>
                  <li class="{{ Request::is('admin/messages/sent')? 'active' :''  }}"><a href="{{ route('agent_sent_message') }}"><i class="fa fa-send-o"></i> Sent</a></li>
                  <li class="{{ Request::is('admin/messages/compose')? 'active' :''  }}"><a href="{{ route('message_compose') }}"><i class="fa fa-pencil"></i> Compose </a></li>
                </ul>
              </li>

              <li class="treeview {{ Request::is('admin/shop/exports*')? 'active' :''  }}">
                <a href="#">
                  <i class="fa fa-share-square-o"></i>
                  <span>Exports</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('admin/shop/exports/agents/csv')? 'active' :''  }}"><a href="{{ route('export_agents_csv') }}"><i class="fa fa-file-o"></i> Sales Report</a></li>
                </ul>
              </li>

              <li class="treeview {{ Request::is('admin/profile')? 'active' :''  }}">
                <a href="{{ route('user_profile') }}"><i class="fa fa-user"></i> <span> Profile </span> </a>
              </li>


            @endif




            <li class="treeview {{ Request::is('administrator/account*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is('administrator/account/change-password')? 'active' :''  }}"><a href="{{ route('change_password') }}"><i class="fa fa-circle-o"></i> Change Password</a></li>
              </ul>
            </li>




            <li class="treeview">
              <a href="{{ route('user_logout') }}"><i class="fa fa-sign-out"></i> <span> Log Out </span> </a>
            </li>





          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>