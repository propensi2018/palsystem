<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PAL - @yield('title')</title>

    <base href="{{ URL::asset('/') }}" terget="_blank"></base>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/datatables.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ url('css/navbars.css') }}" rel="stylesheet">
    <link href="{{ url('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ url('css/messages.css') }}" rel="stylesheet">
    <link href="{{ url('css/achsani.css') }}" rel="stylesheet">
    <link href="{{ url('css/customers_prospects.css') }}" rel="stylesheet">
    <link href="{{ url('css/profile-appointment.css') }}" rel="stylesheet">
    <link href="{{ url('css/riwayat.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('./slick/slicks.css') }}">
    <link rel="stylesheet" href="{{ url('./slick/slick-themes.css') }}">

    <script type="text/javascript" src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/datatables.min.js') }}"></script>

</head>

<body style="background-color: #fff;">

    <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="side-scroll">
            <ul class="sidebar-nav" id="menu">
                <li class="sidebar-brand">
                    <a href="{{ url('/dashboard') }}">
                        <img id="logo" src="{{ url('image/logo.png') }}" alt="icon name">
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dashboard') }}"><img class="sidebar-icon" src="{{ url('image/dashboard.svg') }}" alt="icon name">DASHBOARD</a>
                </li>

                @if(Auth::user()->role() == 'salesperson')
                <li class="active">
                    <a href="{{ url('/customer') }}"><img class="sidebar-icon" src="{{ url('image/customer.svg') }}" alt="icon name">CUSTOMER</a>
                </li>
                <li class="">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><img class="sidebar-icon" src="{{ url('image/message.svg') }}" alt="icon name">MESSAGE</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="{{ url('/show/messageInbox') }}"><img class="sidebar-icon" src="{{ url('image/inbox.svg') }}">INBOX</a></li>
                        <li><a href="{{ url('/show/messageSent') }}"><img class="sidebar-icon" src="{{ url('image/sent.svg') }}">SENT MAIL</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{ url('/history') }}"><img class="sidebar-icon" src="{{ url('image/profile.svg') }}" alt="icon name">PROFILE</a>
                </li>
                @endif

                @if(Auth::user()->role() == 'branch_manager')
                <li >
                    <a href="{{ url('/dataTransaksi') }}"><img class="sidebar-icon" src="{{ url('image/customer.svg') }}" alt="icon name">TRANSACTION</a>
                </li>
                <li class="">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><img class="sidebar-icon" src="{{ url('image/message.svg') }}" alt="icon name">MESSAGE</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="{{ url('/show/messageInbox') }}"><img class="sidebar-icon" src="{{ url('image/inbox.svg') }}">INBOX</a></li>
                        <li><a href="{{ url('/show/messageSent') }}"><img class="sidebar-icon" src="{{ url('image/sent.svg') }}">SENT MAIL</a></li>
                    </ul>
                </li>
                @endif

                 @if(Auth::user()->role() == 'regional_manager')
                <li class="">
                    <a href="#"><img class="sidebar-icon" src="{{ url('image/inbox.svg') }}" alt="icon name">MESSAGE</a>
                </li>
                @endif

                 @if(Auth::user()->role() == 'group_head')
                <li class="">
                    <a href="#"><img class="sidebar-icon" src="{{ url('image/inbox.svg') }}" alt="icon name">MESSAGE</a>
                </li>
                @endif
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <nav class="navbar">
            <a href="#menu-toggle" class="btn btn-link" id="menu-toggle"><img class="menu-icon" src="{{ url('image/menu-icon.svg') }}" alt="icon name"></a>
            <div>
               Hi, <b>{{ Auth::user()->name }}</b>
                <a class="logout-btn" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">(logout)</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                </form>
            </div>
        </nav>

        @yield('contents')

    </div>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    </script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    });


    $(document).on('ready', function() {
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
          });

    });

    $(function() {

      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: true,
        centerMode: true,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,

              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                settings: "unslick"

              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
      });
    });

    </script>

    <script type="text/javascript" src="{{ url('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('./slick/slick.min.js') }}" type="text/javascript" charset="utf-8"></script>

</body>

</html>
