<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> 
                    <span>Main</span>
                </li>
                <li class="active"> 
                    <a href="{{route('admin.home')}}"><i class="fa fa-folder"></i> <span>Dashboard</span></a>
                </li>               
                <li class="submenu">
                    <a href="#"><i class="fa fa-folder"></i> <span> Category</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('category.index')}}"><i style="font-size: 16px;margin-top:-5px;" class="fa fa-circle-o"></i> Category</a></li>
                        <li><a href="{{route('subcategory.index')}}"><i style="font-size: 16px;margin-top:-5px;" class="fa fa-circle-o"></i> Sub Category</a></li>
                        <li><a href="{{route('childcategory.index')}}"><i style="font-size: 16px;margin-top:-5px;" class="fa fa-circle-o"></i> Child Category</a></li>
                        <li><a href="#"><i style="font-size: 16px;margin-top:-5px;" class="fa fa-circle-o"></i> Brand</a></li>
                    </ul>
                </li>
                <li class="menu-title"> 
                    <span>Profile</span>
                </li>
                <li> 
                    <a href="{{route('admin.logout')}}" id="logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                </li> 
            </ul>
        </div>
    </div>
</div>