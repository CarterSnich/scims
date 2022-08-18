<style>
    #sidebar {
        min-width: 280px;
        height: auto;
    }

    #sidebar hr {
        margin: 1rem 0;
        color: inherit;
        background-color: #7952b3;
        border: 0;
        opacity: .25;
    }


    #sidebar ul li a span {
        position: relative;
    }

    #sidebar ul li a span div {
        position: absolute;
        bottom: -2px;
        width: 0px;
        height: 4px;
        transition: all ease-in-out 0.3s;
        background-image: linear-gradient(90deg, rgba(24, 97, 241, 0.5354341565727854) 50%, rgba(255, 255, 255, 0) 100%);
        border-radius: 0.25rem
    }

    #sidebar ul li a:hover:not(.active) span div {
        width: 110%
    }
</style>
<aside id="sidebar">
    <div class="d-flex h-100 flex-column flex-shrink-0 p-3 bg-light">
        <ul class="nav nav-pills flex-column mb-auto">

            {{-- senior citizens --}}
            <li>
                <a href="/citizens" class="d-flex flex-column nav-link @if (Request::is('citizens')) active @endif">
                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person me-3" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                        <span class="mt-auto">
                            @if (auth()->user()->type == 'staff')
                                Senior Citizens List
                            @else
                                Manage Senior Citizens
                            @endif
                            <div></div>
                        </span>
                    </div>
                </a>
            </li>

            {{-- barangays registered --}}
            <li>
                <a href="/barangays" class="d-flex flex-column nav-link @if (Request::is('barangays')) active @endif">
                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people me-3" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                        </svg>

                        <span class="mt-auto">
                            Barangay's Registered
                            <div></div>
                        </span>
                    </div>
                </a>
            </li>


            {{-- id applications --}}
            @if (auth()->user()->type == 'staff')
                <li>
                    <a href="/id_applications" class="d-flex flex-column nav-link @if (Request::is('id_applications')) active @endif">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-credit-card-2-front me-3" viewBox="0 0 16 16">
                                <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z" />
                                <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                            </svg>

                            <span class="mt-auto">
                                ID Applications
                                <div></div>
                            </span>
                        </div>
                    </a>
                </li>
            @endif

            {{-- pensions --}}
            @if (auth()->user()->type == 'staff')
                <li>
                    <a href="/pensions" class="d-flex flex-column nav-link @if (Request::is('pensions')) active @endif">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cash-coin me-3" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                            </svg>
                            <span class="mt-auto">
                                @if (auth()->user()->type == 'staff')
                                    View pension
                                @else
                                    Pension
                                @endif
                                <div></div>
                            </span>
                        </div>
                    </a>
                </li>
            @endif

            {{-- reports --}}
            <li>
                <a href="/reports" class="d-flex flex-column nav-link @if (Request::is('reports')) active @endif">
                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clipboard2-data me-3" viewBox="0 0 16 16">
                            <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z" />
                            <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z" />
                            <path d="M10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V9a1 1 0 0 0-1-1Z" />
                        </svg>
                        <span class="mt-auto">
                            @if (auth()->user()->type == 'staff')
                                Reports
                            @else
                                View Reports
                            @endif
                            <div></div>
                        </span>
                    </div>
                </a>
            </li>

            {{-- user accounts --}}
            @if (auth()->user()->type == 'admin')
                <li>
                    <a href="/users" class="d-flex flex-column nav-link @if (Request::is('users')) active @endif">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle me-3" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                            <span class="mt-auto">
                                User accounts
                                <div></div>
                            </span>
                        </div>
                    </a>
                </li>
            @endif

            {{-- delisted senior citizens --}}
            @if (auth()->user()->type == 'admin')
                <li>
                    <a href="/citizens/delisted" class="d-flex flex-column nav-link @if (Request::is('citizens/delisted')) active @endif">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-dash me-3" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            <span class="mt-auto">
                                Delisted Senior Citizens
                                <div></div>
                            </span>
                        </div>
                    </a>
                </li>
            @endif

        </ul>
    </div>

</aside>
