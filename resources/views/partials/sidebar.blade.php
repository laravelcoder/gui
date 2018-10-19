@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('clip_mgmt_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.clip-mgmt.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('clip_access')
                    <li>
                        <a href="{{ route('admin.clips.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.clips.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('video_access')
                    <li>
                        <a href="{{ route('admin.videos.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.videos.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('image_access')
                    <li>
                        <a href="{{ route('admin.images.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.images.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('brand_access')
                    <li>
                        <a href="{{ route('admin.brands.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.brands.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('industry_access')
                    <li>
                        <a href="{{ route('admin.industries.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.industry.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('detection_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.detections.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('single_channel_access')
                            <li>
                                <a href="{{ route('admin.single_channels.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.single-channel.title')</span>
                                </a>
                            </li>
                            @endcan
                            
                            @can('multi_channel_access')
                            <li>
                                <a href="{{ route('admin.multi_channels.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.multi-channel.title')</span>
                                </a>
                            </li>
                            @endcan
                            
                            @can('all_channel_access')
                            <li>
                                <a href="{{ route('admin.all_channels.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.all-channels.title')</span>
                                </a>
                            </li>
                            @endcan
                            
                        </ul>
                    </li>
                    @endcan
                    
                </ul>
            </li>
            @endcan
            
            @can('sources_mgmt_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.sources-mgmt.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('ftp_access')
                    <li>
                        <a href="{{ route('admin.ftps.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.ftp.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                </ul>
            </li>
            @endcan
            
            @can('task_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>@lang('global.task-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('task_access')
                    <li>
                        <a href="{{ route('admin.tasks.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.tasks.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('task_status_access')
                    <li>
                        <a href="{{ route('admin.task_statuses.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('global.task-statuses.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('task_tag_access')
                    <li>
                        <a href="{{ route('admin.task_tags.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('global.task-tags.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('task_calendar_access')
                    <li>
                        <a href="{{ route('admin.task_calendars.index') }}">
                            <i class="fa fa-calendar"></i>
                            <span>@lang('global.task-calendar.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                </ul>
            </li>
            @endcan
            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>
                    @endcan
                    
                </ul>
            </li>
            @endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
        <img src="{{ asset('images/sling_n_dish.png') }}" />
    </section>
</aside>

