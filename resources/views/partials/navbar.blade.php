<nav class="navbar navbar-expand-lg  bg-body-tertiary p-0">
        <div class="container-fluid header1 px-3">
            <div class="logo">
                <a class="navbar-brand text-white" href="#">
                    <img
                        src="/assets/undip-logo.svg"
                        alt="Logo"
                        width="100"
                        class="d-inline-block align-text-center"
                    />
                    Universitas Diponegoro <br />
                </a>
            </div>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown ">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <img
                                src="/assets/default-picture.svg"
                                alt="Profile Picture"
                                width="30"
                            />

                            <p class="d-inline text-white">{{ auth()->user()->name }}</p>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="nav-item">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Log Out</button>
                                </form>
                                
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a
                            class="nav-link text-white d-inline"
                            href="/login"
                            role="button"
                            aria-expanded="false"
                        >
                            Login
                        </a>
                        <a
                            class="nav-link text-white d-inline"
                            href="#"
                            role="button"
                            aria-expanded="false"
                        >
                            Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="#">Dashboard</a>
                    <a class="nav-link" href="#">Anjab</a>
                    <a class="nav-link" href="#">ABK</a>
                    <a class="nav-link" href="#">Laporan</a>
                </div>
            </div>
        </div>
    </nav>