<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    <img id="logo" src="{{ url('image/logo.png') }}" alt="icon name">
                </a>
            </li>
            <li class="sidebar-user">
                <img  src="{{ url('image/user.svg') }}" alt="icon name">
            </li>
            <li class="sidebar-user-name">
                <h3>Salesperson</h3>
            </li>
            <li class="sidebar-user-id">
                <p>ID: 1506724096</p>
            </li>
            <hr class="sidebar-hr">
            <li>
                <a href="#"><img class="sidebar-icon" src="{{ url('image/dashboard.svg') }}" alt="icon name">DASHBOARD</a>
            </li>
            <li>
                <a href="#"><img class="sidebar-icon" src="{{ url('image/customer.svg') }}" alt="icon name">CUSTOMER</a>
            </li>
            <li>
                <a href="#"><img class="sidebar-icon" src="{{ url('image/message.svg') }}" alt="icon name">MESSAGE</a>
            </li>
            <li>
                <a href="#"><img class="sidebar-icon" src="{{ url('image/profile.svg') }}" alt="icon name">PROFILE</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <a href="#menu-toggle" class="btn btn-link" id="menu-toggle"><img class="menu-icon" src="{{ url('image/menu-icon.svg') }}" alt="icon name"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register') }}">Register</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
