<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> 
                    <span>Main</span>
                </li>
                <li class="{{ request()->is('admin-home') ? 'active' : '' }}"> 
                    <a href="{{route('admin.home')}}"><i class="fa fa-folder"></i> <span>Dashboard</span></a>
                </li>               
                <li class="submenu">
                    <a class="{{ request()->is('category') ? 's_active' : '' }} {{ request()->is('subcategory') ? 's_active' : '' }} {{ request()->is('childcategory') ? 's_active' : '' }} {{ request()->is('brand') ? 's_active' : '' }}" href="#"><i class="fa fa-folder"></i> <span> Category</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ request()->is('category') ? 'active' : '' }}"><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i> Category</a></li>
                        <li class="{{ request()->is('subcategory') ? 'active' : '' }}"><a href="{{route('subcategory.index')}}"><i class="fa fa-circle-o"></i> Sub Category</a></li>
                        <li class="{{ request()->is('childcategory') ? 'active' : '' }}"><a href="{{route('childcategory.index')}}"><i class="fa fa-circle-o"></i> Child Category</a></li>
                        <li class="{{ request()->is('brand') ? 'active' : '' }}"><a href="{{route('brand.index')}}"><i class="fa fa-circle-o"></i> Brand</a></li>
                    </ul>
                </li>
                <li class="menu-title"> 
                    <span>Profile</span>
                </li>
                <li class="submenu">
                    <a class="{{ request()->is('setting/seo') ? 's_active' : '' }} {{ request()->is('setting/smtp') ? 's_active' : '' }} {{ request()->is('setting/page') ? 's_active' : '' }}" href="#"><i class="fa fa-folder"></i> <span> Settings</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ request()->is('setting/seo') ? 'active' : '' }}"><a href="{{route('setting.seo.index')}}"><i class="fa fa-circle-o"></i> SEO Setting</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Website Setting</a></li>
                        <li class="{{ request()->is('setting/page') ? 'active' : '' }}"><a href="{{route('setting.page.index')}}"><i class="fa fa-circle-o"></i> Page Management</a></li>
                        <li class="{{ request()->is('setting/smtp') ? 'active' : '' }}"><a href="{{route('setting.smtp.index')}}"><i class="fa fa-circle-o"></i> SMTP Setting</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Payment Getway</a></li>
                    </ul>
                </li>
                <li> 
                    <a href="{{route('admin.logout')}}" id="logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                </li> 
            </ul>
        </div>
    </div>
</div>