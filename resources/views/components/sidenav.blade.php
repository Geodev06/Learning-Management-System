<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Core</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Learning</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('modules') }}">Modules</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Assessments</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Feedbacks</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">System Administration</li>

        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                <i class="menu-icon mdi mdi-cog"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Portal</a></li>
                </ul>
            </div>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="docs/documentation.html">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>

