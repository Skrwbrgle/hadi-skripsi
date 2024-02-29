     <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="#"><img class="hide-on-med-and-down" src="../../../app-assets/images/logo/materialize-logo-color.png" alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up" src="../../../app-assets/images/logo/materialize-logo.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">E-Travelize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
        </div>
            <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
                @can('admin')
                <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="Pages">Users</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li class="active"><a href="/admin"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Agent Travels</span></a>
                            </li>
                            {{-- <li class="active"><a href="/admin/customers"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Customers</span></a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                @endcan

                @can('agent')
                <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">drive_eta</i><span class="menu-title" data-i18n="Pages">Routes</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li class="active"><a href="/agent-travel"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List Route</span></a>
                            </li>
                            {{-- <li class="active"><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Customers</span></a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i class="material-icons">receipt</i><span class="menu-title" data-i18n="Pages">Invoice</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li class="active"><a href="/agent-travel/invoice"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">List Invoice</span></a>
                            </li>
                            {{-- <li class="active"><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Page Blank">Customers</span></a>
                            </li> --}}
                        </ul>
                    </div>
                </li>

                @endcan
            </ul>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>


