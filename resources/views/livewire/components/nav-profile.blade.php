<li class="nav-item dropdown d-none d-lg-block user-dropdown">
    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="img-xs rounded-circle" src="{{ Auth::user()->profile == null ? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' : asset(Auth::user()->profile) }} " alt="Profile image"> </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
        <div class="dropdown-header text-center">

        
            <img class="img-md rounded-circle"
                src="{{ Auth::user()->profile == null ? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' : asset(Auth::user()->profile) }}"
                style="max-height: 40px; max-width: 40px; width: 40px; height: 40px;"
                alt="Profile image">

            <p class="mb-1 mt-3 fw-semibold">
                {{ base64_decode(Auth::user()->first_name) }}
                {{ base64_decode(Auth::user()->last_name) }}
            </p>
            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }} </p>
        </div>
        <!-- <span class="badge badge-pill badge-danger">1</span> -->
        <a class="dropdown-item" href="{{ route('profile') }}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile </a>
        <a class="dropdown-item" href="{{ route('inbox') }}"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
        <a class="dropdown-item" wire:click="logout"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
    </div>
</li>