<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar" style="background-color:#181e35">
    <div class="c-sidebar-brand d-lg-down-none">
        <img class="c-sidebar-brand d-lg-down-none" width="118" height="46" src="{{ asset('img/logo.png') }}" alt="{{ appName() }}">
        <img class="c-sidebar-brand-minimized" width="46" height="46" src="{{ asset('img/logo.png') }}" alt="{{ appName() }}">
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

        <li class="c-sidebar-nav-title">@lang('Website Management')</li>
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Articles Management')"
                icon="c-sidebar-nav-icon cil-book" />

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.articles.index')"
                        class="c-sidebar-nav-link"
                        :text="__('All Articles')"
                        :active="activeClass(Route::is('admin.articles.index'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.articles.create')"
                        class="c-sidebar-nav-link"
                        :text="__('Write New Article')"
                        :active="activeClass(Route::is('admin.articles.create'), 'c-active')" />
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Notice Portal')"
                icon="c-sidebar-nav-icon cil-bullhorn"/>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.notices.index')"
                        class="c-sidebar-nav-link"
                        :text="__('All Notices and Publications')"
                        :active="activeClass(Route::is('admin.notices.index'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.notices.create')"
                        class="c-sidebar-nav-link"
                        :text="__('Dispatch a new Notice')"
                        :active="activeClass(Route::is('admin.notices.create'), 'c-active')" />
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Site Settings')"
                icon="c-sidebar-nav-icon cil-cog"/>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="url('/admin/executive-settings')"
                        class="c-sidebar-nav-link"
                        :text="__('Board Member Settings')"
                        :active="activeClass(str_contains(url()->current(), '/admin/executive-settings'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.showMenu')"
                        class="c-sidebar-nav-link"
                        :text="__('Menu Management')"
                        :active="activeClass(Route::is('admin.showMenu'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="url('/admin/marquee-settings')"
                        class="c-sidebar-nav-link"
                        :text="__('Marquee Content Setting')"
                        :active="activeClass(str_contains(url()->current(), '/admin/marquee-settings'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="url('/admin/url-settings')"
                        class="c-sidebar-nav-link"
                        :text="__('Site Options')"
                        :active="activeClass(str_contains(url()->current(), '/admin/url-settings'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="url('/admin/api-settings')"
                        class="c-sidebar-nav-link"
                        :text="__('Google API Settings')"
                        :active="activeClass(str_contains(url()->current(), '/admin/api-settings'), 'c-active')" />
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-title">@lang('Trader Dues')</li>
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Trader Dues Management')"
                icon="c-sidebar-nav-icon cil-spreadsheet"/>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.traderdues.index')"
                        class="c-sidebar-nav-link"
                        :text="__('All Trader Dues')"
                        :active="activeClass(Route::is('admin.traderdues.index'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.traderdues.create')"
                        class="c-sidebar-nav-link"
                        :text="__('New Trader Due')"
                        :active="activeClass(Route::is('admin.traderdues.create'), 'c-active')" />
                </li>
            </ul>
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.traderduespayment.index')"
                    class="c-sidebar-nav-link"
                    :text="__('Review Transaction Details')"
                    icon="c-sidebar-nav-icon cil-money"
                    :active="activeClass(Route::is('admin.traderduespayment.index'), 'c-active')" />
            </li>
        </li>

        <li class="c-sidebar-nav-title">@lang('Commodity and Daily Price Reports')</li>
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Price Reports Management')"
                icon="c-sidebar-nav-icon cil-calendar"/>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.pricelog.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Price Reports Dashboard')"
                        :active="activeClass(Route::is('admin.pricelog.index'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.pricelog.create')"
                        class="c-sidebar-nav-link"
                        :text="__('Create New Daily Price Report')"
                        :active="activeClass(Route::is('admin.pricelog.create'), 'c-active')" />
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Commodity Management')"
                icon="c-sidebar-nav-icon cil-apple"/>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.commodities.index')"
                        class="c-sidebar-nav-link"
                        :text="__('All Curated Commodities')"
                        :active="activeClass(Route::is('admin.commodities.index'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.commodities.create')"
                        class="c-sidebar-nav-link"
                        :text="__('Create New Commodity')"
                        :active="activeClass(Route::is('admin.commodities.create'), 'c-active')" />
                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-title">@lang('Arrival Reports')</li>
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Arrival Commodity')"
                icon="c-sidebar-nav-icon cil-truck"/>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.commodities-arrival.index')"
                        class="c-sidebar-nav-link"
                        :text="__('All Curated Commodities')"
                        :active="activeClass(Route::is('admin.commodities-arrival.index'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.commodities-arrival.create')"
                        class="c-sidebar-nav-link"
                        :text="__('Create New Commodity')"
                        :active="activeClass(Route::is('admin.commodities-arrival.create'), 'c-active')" />
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Daily Arrival Management')"
                icon="c-sidebar-nav-icon cil-calendar-check"/>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.arrival.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Daily Arrival Portal')"
                        :active="activeClass(Route::is('admin.arrival.index'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.arrival.create')"
                        class="c-sidebar-nav-link"
                        :text="__('New Arrival Log')"
                        :active="activeClass(Route::is('admin.arrival.create'), 'c-active')" />
                </li>
            </ul>
        </li>

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="action('\Barryvdh\TranslationManager\Controller@getIndex')"
                    class="c-sidebar-nav-link"
                    :text="__('Localization Management')"
                    icon="c-sidebar-nav-icon cil-speech"
                    :active="activeClass(Route::is('\Barryvdh\TranslationManager\Controller@getIndex'), 'c-active')" />
            </li>

            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('unisharp.lfm.show')"
                    class="c-sidebar-nav-link"
                    :text="__('File Management')"
                    icon="c-sidebar-nav-icon cil-folder"
                    :active="activeClass(Route::is('unisharp.lfm.*'), 'c-active')" />
            </li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->can('admin.serialkeys.view'))
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    class="c-sidebar-nav-dropdown-toggle"
                    icon="c-sidebar-nav-icon cil-paperclip"
                    :text="__('Licensing')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.license.index')"
                            class="c-sidebar-nav-link"
                            :text="__('All Licenses')"
                            :active="activeClass(Route::is('admin.license.index'), 'c-active')" />
                    </li>
                    @if ($logged_in_user->can('admin.serialkeys.create'))
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.license.create')"
                            class="c-sidebar-nav-link"
                            :text="__('New License')"
                            :active="activeClass(Route::is('admin.license.create'), 'c-active')" />
                    </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
