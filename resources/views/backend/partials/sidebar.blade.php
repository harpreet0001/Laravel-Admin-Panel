<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.home') }}">
                {{-- @if (get_static_option('site_admin_dark_mode') == 'off')
                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                @else
                    {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                @endif --}}
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ active_menu('admin-home') }}">
                        <a href="{{ route('admin.home') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>@lang('dashboard')</span>
                        </a>
                    </li>
                    <li class="main_dropdown
                        @if (request()->is(['admin-home/frontend/new-business', 'admin-home/frontend/all-business', 'admin-home/frontend/all-business/role','admin-home/frontend/deactive-business'])) active @endif
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-business"></i>
                                <span>{{ __('Business Manage') }}</span></a>
                            <ul class="collapse">
                                    <li class="{{ active_menu('admin-home/frontend/all-business') }}"><a
                                            href="{{route('admin.all.frontend.business')}}">{{ __('All Business') }}</a></li>  
                            </ul>
                    </li>
                    <li class="main_dropdown
                        @if (request()->is(['admin-home/frontend/new-cutsomer', 'admin-home/frontend/all-cutsomer', 'admin-home/frontend/all-cutsomer/role','admin-home/frontend/deactive-cutsomer'])) active @endif
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-cutsomer"></i>
                                <span>{{ __('Cutsomer Manage') }}</span></a>
                            <ul class="collapse">
                                    <li class="{{ active_menu('admin-home/frontend/all-cutsomer') }}"><a
                                            href="{{route('admin.all.frontend.customer')}}">{{ __('All Cutsomer') }}</a></li>  
                            </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
