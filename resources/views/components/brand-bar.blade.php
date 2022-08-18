<style>
    div.dropdown>a:hover {
        content: '';
        opacity: .5;
    }

    button[form=logout-form]:hover {
        background-color: #dc3545;
        color: white
    }

    nav {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.2);
    }
</style>
<nav class="navbar sticky-top navbar-dark bg-dark px-3 border-bottom border-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" width="30" height="30" class="d-inline-block align-top me-1" alt="">
            Senior Citizen Information Management System
        </a>

        @auth
            <div class="dropdown">
                <a href="#" class="d-flex flex-row align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-1">
                        <strong class="text-muted">({{ Auth::user()->type == 'admin' ? 'Administrator' : 'Staff' }})</strong>
                        <strong>{{ Auth::user()->name }}</strong>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="/settings">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><button type="submit" class="dropdown-item" form="logout-form">Logout</button></li>
                </ul>
            </div>
            <form id="logout-form" class="d-none" method="POST" action="/user/logout">
                @csrf
            </form>
        @endauth
    </div>
</nav>
