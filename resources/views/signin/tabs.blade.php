     <ul class="nav nav-pills custom-nav nav-justified bg-success-subtle" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ route('wiz1', ['locale' => app()->getLocale()]) }}">
            <button class="nav-link {{ Route::currentRouteName() === 'wiz1' ? 'active' : '' }}"
                    id="steparrow-gen-info-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#steparrow-gen-info"
                    type="button"
                    role="tab"
                    aria-controls="steparrow-gen-info"
                    aria-selected="{{ Route::currentRouteName() === 'wiz1' ? 'true' : 'false' }}">
                Department
            </button>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('wiz2', ['locale' => app()->getLocale()]) }}">
            <button class="nav-link {{ Route::currentRouteName() === 'wiz2' ? 'active' : '' }}"
                    id="steparrow-description-info-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#steparrow-description-info"
                    type="button"
                    role="tab"
                    aria-controls="steparrow-description-info"
                    aria-selected="{{ Route::currentRouteName() === 'wiz2' ? 'true' : 'false' }}">
                Objectives
            </button>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('wiz3', ['locale' => app()->getLocale()]) }}">
            <button class="nav-link {{ Route::currentRouteName() === 'wiz3' ? 'active' : '' }}"
                    id="pills-experience-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-experience"
                    type="button"
                    role="tab"
                    aria-controls="pills-experience"
                    aria-selected="{{ Route::currentRouteName() === 'wiz3' ? 'true' : 'false' }}">
                Team
            </button>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('wiz4', ['locale' => app()->getLocale()]) }}">
            <button class="nav-link {{ Route::currentRouteName() === 'wiz4' ? 'active' : '' }}"
                    id="pills-programs-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-programs"
                    type="button"
                    role="tab"
                    aria-controls="pills-programs"
                    aria-selected="{{ Route::currentRouteName() === 'wiz4' ? 'true' : 'false' }}">
                Programs
            </button>
        </a>
    </li>
</ul>
