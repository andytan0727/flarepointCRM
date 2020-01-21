<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} v{{ config('app.version') }}</title>
    <link href="{{ asset('css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.atwho.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

    <div id="wrapper">

        <button type="button" class="navbar-toggle menu-txt-toggle" style=""><span class="icon-bar"></span> <span
                class="icon-bar"></span> <span class="icon-bar"></span></button>

        <div class="navbar navbar-default navbar-top">
            <!--NOTIFICATIONS START-->
            <div class="menu">

                <div class="notifications-header">
                    <p>{{__('Notifications')}}</p>
                </div>
                <!-- Menu -->
                <ul>
                    <?php $notifications = auth()->user()->unreadNotifications; ?>

                    @foreach($notifications as $notification)

                    <a href="{{ route('notification.read', ['id' => $notification->id])  }}"
                        onClick="postRead({{ $notification->id }})">
                        <li>
                            <img src="/{{ auth()->user()->avatar }}" class="notification-profile-image">
                            <p>{{ $notification->data['message']}}</p>
                        </li>
                    </a>
                    @endforeach
                </ul>
            </div>

            <div class="dropdown" id="nav-toggle">
                <a id="notification-clock" role="button" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-bell"><span id="notifycount">{{ $notifications->count() }}</span></i>
                </a>
            </div>
            @push('scripts')
            <script>
                $('#notification-clock').click(function(e) {
  e.stopPropagation();
  $(".menu").toggleClass('bar')
});
$('body').click(function(e) {
  if ($('.menu').hasClass('bar')) {
    $(".menu").toggleClass('bar')
  }
})
                  id = {};
                        function postRead(id) {
                            $.ajax({
                                type: 'post',
                                url: '{{url('/notifications/markread')}}',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                        }

            </script>
            @endpush
            <!--NOTIFICATIONS END-->
            <button type="button" id="mobile-toggle" class="navbar-toggle mobile-toggle" data-toggle="offcanvas"
                data-target="#myNavmenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>


        <!-- /#sidebar-wrapper -->
        <!-- Sidebar menu -->

        @include('layouts.menu')

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            @if(Session::has('flash_message_warning'))
            <message message="{{ Session::get('flash_message_warning') }}" type="warning"></message>
            @endif
            @if(Session::has('flash_message'))
            <message message="{{ Session::get('flash_message') }}" type="success"></message>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>@yield('heading')</h1>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.caret.min.js') }}"></script>
    <script src="{{ asset('js/jquery.atwho.min.js') }}"></script>

    @stack('scripts')

</body>

</html>