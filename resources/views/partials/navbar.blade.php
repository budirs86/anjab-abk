<nav class="navbar navbar-expand-lg  bg-body-tertiary p-0 navbar-dark">
        <div class="container-fluid header1 px-3">
            <div class="logo">
                <a class="navbar-brand " href="/">
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
                    <li class="nav-item dropdown">
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

                            <p class="text-white d-inline ms-2">{{ auth()->user()->name }}</p>
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
                        {{-- <a
                            class="nav-link text-white d-inline"
                            href="#"
                            role="button"
                            aria-expanded="false"
                        >
                            Register
                        </a> --}}
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid mx-3">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav gap-3">
                    <a class="nav-link active" href="/"><img data-feather="home" width="20px"> Dashboard</a>
                    <a class="nav-link dropdown-center" href="#" role="button" data-bs-toggle="dropdown"><img data-feather="edit" width="20px"></img> 
                        Anjab
                        {{-- <ul class="dropdown-menu dropdown-menu-start">
                            <li>Entry Data Jabatan</li>
                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                        </ul> --}}
                        <ul class="dropdown-menu m-0">
                            <a class="dropdown-item pe-5 mb-2" href="/anjab/jabatan">Entry Data Jabatan</a>
                            <a class="dropdown-item pe-5 mb-2" href="/anjab/jabatan">Entry Data Jabatan</a>
                            <a class="dropdown-item pe-5 mb-2" href="/anjab/jabatan">Entry Data Jabatan</a>
                                {{-- Entry Data Jabatan --}}
                        
                            {{-- <li class="dropdown-item pe-5 mb-2">Entry Data Biodata</li>
                            <li class="dropdown-item pe-5 mb-2">Entry Analisis Jabatan</li>                               
                            <li class="dropdown-item pe-5 mb-2">Entry Syarat Jabatan</li>                                --}}
                        </ul>
                    </a>
                    <a class="nav-link" href="#"><img data-feather="edit" width="20px"></img> ABK</a>
                    <a class="nav-link" href="#"><img data-feather="file" width="20px"></img> Laporan</a>
                </div>
            </div> 
        </div>
    </nav>