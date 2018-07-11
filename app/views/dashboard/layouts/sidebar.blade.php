<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
<li class="sidebar-toggler-wrapper">
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="sidebar-toggler">
    </div>
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
</li>

<li class="start dashboard">
    <a href="{{url(URL::to('/dashboard'))}}">
        <i class="fa fa-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
    </a>
</li>

@if(UserRole::isAdminUser())
    <li class="admins">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span class="title">Admin</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="add-admin">
                <a href="{{url(URL::to('/dashboard/add-admin'))}}">
                    <i class="fa fa-briefcase"></i>
                    <span class="badge badge-warning badge-roundless"></span>Add Admin</a>
            </li>
            <li class='admin-list'>
                <a href="{{url(URL::to('/dashboard/admins'))}}">
                    <i class="fa fa-list"></i>
                    <span class="badge badge-info"></span>Admin List</a>
            </li>
        </ul>
    </li>
    <li class="customers">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span class="title">Customers</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class='customer-list'>
                <a href="{{url(URL::to('/dashboard/customers'))}}">
                    <i class="fa fa-list"></i>
                    <span class="badge badge-info"></span>Customer List</a>
            </li>
        </ul>
    </li>
    <li class="faqs">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span class="title">FAQ</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="add-faq">
                <a href="{{url(URL::to('/dashboard/faqs/create'))}}">
                    <i class="fa fa-briefcase"></i>
                    <span class="badge badge-warning badge-roundless"></span>Add FAQ</a>
            </li>
            <li class='faq-list'>
                <a href="{{url(URL::to('/dashboard/faqs'))}}">
                    <i class="fa fa-list"></i>
                    <span class="badge badge-info"></span>All FAQs</a>
            </li>
        </ul>
    </li>
    <li class="business-tools">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span class="title">Business Tools</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="add-business-tool">
                <a href="{{url(URL::to('/dashboard/business/tool/add'))}}">
                    <i class="fa fa-clock-o"></i>
                    <span class="badge badge-warning badge-roundless"></span>Add Business Tool</a>
            </li>
            <li class="business-tools-list">
                <a href="{{url(URL::to('/dashboard/business/tools'))}}">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-info"></span>List Of Business Tools</a>
            </li>
        </ul>
    </li>
    <li class="videos">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span class="title">Videos</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="add-video">
                <a href="{{url(URL::to('/dashboard/video/add'))}}">
                    <i class="fa fa-clock-o"></i>
                    <span class="badge badge-warning badge-roundless"></span>Add A Video</a>
            </li>
            <li class="videos-list">
                <a href="{{url(URL::to('/dashboard/videos'))}}">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-info"></span>List Of Videos</a>
            </li>
        </ul>
    </li>
	<li class="settings">
        <a href="javascript:;">
            <i class="fa fa-wrench"></i>
            <span class="title">Settings</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="update-settings">
                <a href="{{url(URL::to('/dashboard/settings'))}}">
                    <i class="fa fa-wrench"></i>
                    <span class="badge badge-warning badge-roundless"></span>Settings</a>
            </li>
        </ul>
    </li>
    
@endif
@if(UserRole::isCustomer())
    <li class="clients">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span class="title">Clients</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="add-client">
                <a href="{{url(URL::to('/dashboard/add-client'))}}">
                    <i class="fa fa-briefcase"></i>
                    <span class="badge badge-warning badge-roundless"></span>Add Client</a>
            </li>
            <li class='client-list'>
                <a href="{{url(URL::to('/dashboard/clients'))}}">
                    <i class="fa fa-list"></i>
                    <span class="badge badge-info"></span>Client List</a>
            </li>
        </ul>
    </li>
    <li class="schedules">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span class="title">Schedules</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="add-event">
                <a href="{{url(URL::to('/events/create'))}}">
                    <i class="fa fa-clock-o"></i>
                    <span class="badge badge-warning badge-roundless"></span>Add an Event</a>
            </li>
            <li class="events">
                <a href="{{url(URL::to('/events'))}}">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-info"></span>Upcoming Events</a>
            </li>
            <li class="event-settings">
                <a href="{{url(URL::to('/events/settings'))}}">
                    <i class="fa fa-cogs"></i>
                    <span class="badge badge-info"></span>Settings</a>
            </li>
        </ul>
    </li>
    <li class="reports">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span class="title">Reports</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class="add-goal">
                <a href="{{url(URL::to('/goals/create'))}}">
                    <i class="fa fa-clock-o"></i>
                    <span class="badge badge-warning badge-roundless"></span>Set a Goal</a>
            </li>
            <li class="monthly-goal">
                <a href="{{url(URL::to('/dashboard/monthly-goal'))}}">
                    <i class="fa fa-bar-chart-o"></i>
                    <span class="badge badge-info"></span>Monthly Goal</a>
            </li>
            <li class="yearly-goal">
                <a href="{{url(URL::to('/dashboard/yearly-goal'))}}">
                    <i class="fa fa-bar-chart-o"></i>
                    <span class="badge badge-info"></span>Yearly Goal</a>
            </li>
        </ul>
    </li>
    <li class="faqs">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span class="title">FAQ</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li class='faq-list'>
                <a href="{{url(URL::to('/dashboard/faqs'))}}">
                    <i class="fa fa-list"></i>
                    <span class="badge badge-info"></span>All FAQs</a>
            </li>
        </ul>
    </li> 
    <li class="business-tools">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span class="title">Business Tools</span>
            <span class="arrow "></span>
        </a>

        <ul class="sub-menu">
            @foreach(BusinessToolsType::getAllBusinessToolsTypes() as $type)
                <li class="business-tool-list-{{$type->id}}"><a href="/dashboard/business/tools/type/{{$type->id}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </li>
    <li class="training-videos">
        <a href="javascript:;">
            <i class="fa fa-file-text"></i>
            <span class="title">Training Videos</span>
            <span class="arrow "></span>
        </a>

        <ul class="sub-menu">
            @foreach(VideoType::getAllVideoTypes() as $type)
                <li class="videos-list-{{$type->id}}"><a href="/videos/{{$type->id}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </li>
    <li class="todo-list">
        <a href="javascript:;">
            <i class="icon-check"></i>
            <span class="title">Todo List</span>
            <span class="arrow "></span>
        </a>

        <ul class="sub-menu">
        	<li class="todo-list-detail"><a href="/dashboard/todo">Todo List</a></li>
        </ul>
    </li>
@endif
</ul>
<!-- END SIDEBAR MENU -->
</div>
</div>
<!-- END SIDEBAR -->
