<style>
    @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    
}

body {
    background-color: #DDDDDD;
}

.wrapper {
    display: flex;
    position: relative
}

.wrapper .sidebar {
    width: 15%;
    height: 100%;
    background: #922B21;
    padding: 15px 0px;
    position: fixed;
    overflow: auto;
}

.wrapper .sidebar h2 {
    color: #fff;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 5px
}

.wrapper .sidebar ul li {
    padding: 15px;
    border-bottom: 1px solid #bdb8d7;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    border-top: 1px solid rgba(255, 255, 255, 0.05)
}

.top_menu {
    font-size: 16px;
    background: #922B21;
    font-family: 'Josefin Sans', sans-serif;
    color: #bdb8d7;
}


.wrapper .sidebar ul li a {
    color: #bdb8d7;
    display: block
}

.wrapper .sidebar ul li a .fa {
    width: 25px
}

.wrapper .sidebar ul li:hover {
    background-color: #7d777717;
    cursor: pointer;
}

.wrapper .sidebar ul li:hover a {
    color: #fff
}

.wrapper .sidebar .social_media {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    display: flex
}

.wrapper .sidebar .social_media a {
    display: block;
    width: 40px;
    height: 40px;
    background: transparent;
    line-height: 45px;
    text-align: center;
    margin: 0 5px;
    color: #bdb8d7;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px
}

.wrapper .main_content {
    width: 100%;
    margin-left: 15%
}

.wrapper .main_content .header {
    padding: 5px;
    background: #922B21;
    color: #fff;
    border-bottom: 1px solid #e0e4e8
}

.wrapper .main_content .info {
    margin: 20px;
    color: #717171;
    line-height: 25px
}

.wrapper .main_content .info{
    margin-bottom: 20px
}

    /* width */
body::-webkit-scrollbar {
  width: 5px;
}

/* Track */
body::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
body::-webkit-scrollbar-thumb {
  background: #922B21; 
  border-radius: 10px;
}

/* Handle on hover */
body::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}


.sidebar::-webkit-scrollbar {
  width: 5px;
}

/* Track */
.sidebar::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
.sidebar::-webkit-scrollbar-thumb {
  background: #b63b4d; 
  border-radius: 10px;
}

/* Handle on hover */
.sidebar::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}

/*Dropdown menu css */
    ul {
        list-style-type: none
    }

    a {
        color: #b63b4d;
        text-decoration: none
    }

    .accordion {
        width: 100%;
        background: #922B21;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 0px
    }

    .accordion .link {
        cursor: pointer;
        display: block;
        padding: 0px 0px 0px 25px;
        color: #bdb8d7;
        font-size: 16px;
        position: relative;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        transition: all 0.4s ease
    }

    .accordion .link:hover{
        color: #fff
    }

    .accordion li i {
        position: absolute;
        top: 2px;
        left: 1px;
        font-size: 16px;
        color: #bdb8d7;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        transition: all 0.4s ease
    }

    .accordion li i:hover, .fa-chevron-down:hover{
        color: #fff
    }

    .accordion li i.fa-chevron-down {
        right: 12px;
        left: auto;
        font-size: 16px
    }

    .accordion li.open .link {
        color: #bdb8d7
    }

    .accordion li.open i {
        color: #bdb8d7
    }

    .accordion li.open i.fa-chevron-down {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg)
    }

    .submenu {
        display: none;
        background: #b63b4d;
        font-size: 14px
    }

    .submenu li {
        border-bottom: 1px solid #4b4a5e
    }

    .submenu a {
        display: block;
        text-decoration: none;
        color: #bdb8d7;
        padding: 0px;
        padding-left: 30px;
        -webkit-transition: all 0.25s ease;
        -o-transition: all 0.25s ease;
        transition: all 0.25s ease
    }

    .submenu a:hover {
        color: #fff
    }

</style>

<script type='text/javascript'>
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            var links = this.el.find('.link');

            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }

        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
            $this = $(this),
            $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        }

        var accordion = new Accordion($('#accordion'), false);
    });
</script>

</head>
<body>
<div class="wrapper">
    <div class="sidebar" style="font-family: 'Josefin Sans', sans-serif">
        <div style="text-align: center;">
            <img src={{ asset("public/img/logo_26.png") }} alt="SJGH Lab" style="padding-bottom: 15px; align-items: center;">
        </div>
    @if((Session::get('user')['user_level'] === 'Admin') || (Session::get('user')['user_level'] === 'User'))
        <ul style="margin-bottom: 0px"> 
            <li><a href="{{ route('dashboard') }}" style="text-decoration: none;"><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="{{ route('enter-test') }}" style="text-decoration: none;"><i class="fa fa-database"></i>Enter Report</a></li>
            <li><a href="{{ route('results') }}" style="text-decoration: none;"><i class="fa fa-list"></i>Results</a></li>
        </ul>

        <ul id="accordion" class="accordion" style="margin-bottom: 0px">
            <li>
                <div class="link"><i class="fa fa-server"></i>Data<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                    <li><a href="{{ route('add-patient') }}">New Patient</a></li>
                    <li><a href="{{ route('patients-list') }}">Patient List</a></li>

                    @if (Session::get('user')['user_level'] === 'Admin')
                        <li><a href="{{ route('report') }}">Report</a></li>
                    @endif
                </ul>
            </li>
            <li>
                <div class="link"><i class="fa fa-university"></i>Blood Bank<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                    <li><a href="{{ route('create-donor') }}">Reg. Donor</a></li>
                    <li><a href="{{ route('stock-blood') }}">Stock Blood Bank</a></li>
                    <li><a href="{{ route('blood-in-stock') }}">Blood In Stock</a></li>
                    <li><a href="{{ route('blood-transfussions') }}">Blood Transfusions</a></li>
                    <li><a href="{{ route('donors-list') }}">Donors List</a></li>
                    <li><a href="{{ route('results-blood-labs') }}">Blood Lab Results</a></li>
                </ul>
            </li>
                @if (Session::get('user')['user_level'] === 'Admin')
                    <li>
                        <div class="link"><i class="fa fa-archive"></i>Archive<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="archive_labs.php">Labs Results</a></li>
                            <li><a href="archive_edit_results.php">Edit Lab Results</a></li>
                            <li><a href="archive_blood_transfusion.php">Blood Transfusions</a></li>
                        </ul>
                    </li>
                @endif
            @if (Session::get('user')['user_level'] === 'Admin')
                <li>
                    <div class="link"><i class="fa fa-cog fa-spin"></i>Custom Settings<i class="fa fa-chevron-down"></i></div>
                    <ul class="submenu"> 
                        <li><a href="{{ route('custom-types') }}">Custom List</a></li>
                        <li><a href="{{ route('category') }}">Add Category</a></li>
                        <li><a href="{{ route('dropdown') }}">Add Dropdown</a></li>    
                    </ul>
                </li>
            @endif
            <li>
                <div class="link"><i class="fa fa-user"></i> {{ Session::get('user')['username'] }}<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                    @if (Session::get('user')['user_level'] === 'Admin')
                        <li><a href="{{ route('add-user') }}">Add New User</a></li>
                        <li><a href="{{ route('user-list') }}">Users List</a></li>
                        {{-- <li><a href="edit_report.php">Edit Report</a></li> --}}
                    @else
                        {{-- <li><a href="user_edit_report.php">Edit Report</a></li> --}}
                    @endif 
                    <li><a href="{{ route('user-profile') }}">Profile</a></li>
                </ul>
            </li>
        </ul>
    @endif    
    @if((Session::get('user')['user_level'] === 'Doctor') || (Session::get('user')['user_level'] === 'Nurse'))
        <ul id="accordion" class="accordion" style="margin-bottom: 0px">
            <li>
                <div class="link"><i class="fa fa-user"></i> {{ Session::get('user')['username'] }}<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                    <li><a href="{{ route('user-profile') }}" style="text-decoration: none;">Profile</a></li>
                </ul>
            </li>
        </ul>
        
        <ul style="margin-bottom: 0px">
            <li><a href="{{ route('doc-get-labs') }}" style="text-decoration: none;"><i class="fa fa-database"></i>Lab Results</a></li>
        </ul>
    @endif

        {{-- <ul style="margin-bottom: 0px">
            <li><a href="{{ route('logout') }}" style="text-decoration: none;"><i class="fa fa-sign-out"></i>Logout</a></li>
        </ul> --}}
    </div>
    <div class="main_content">
        <div class="header" style="position: fixed; width: 85%; z-index: 2; height: 65px;">
    
            <div class="top_menu" style="float: left; padding-top: 10px">
                <b style="font-size: 25px;">St. John of God Hospital, Duayaw Nkwanta ({{ Session::get('user')['department'] }}) - LRMS</b>
            </div>

            <a href="{{ route('logout') }}" class="btn btn-primary float-right" style="margin-top: 8px; text-decoration: none; font-family: 'Josefin Sans', sans-serif;"><i class="fa fa-sign-out"></i>Logout</a>

            
            {{-- <div class="social_media" style="float: right; padding-top: 15px">
                <a href="http://m.me/sarpduasam" target="_blank"><i class="fa fa-facebook-f" style="color: #475BBC; font-size: 25px; padding-right: 10px;"></i></a> 
                <a href="https://twitter.com/sarpduasam" target="_blank"><i class="fa fa-twitter" style="color: aqua; font-size: 25px; padding-right: 10px;"></i></a> 
                <a href="https://wa.link/dqlq0r" target="_blank"><i class="fa fa-whatsapp" style="color: green; font-size: 25px; padding-right: 10px;"></i></a>
            </div> --}}

        </div>
    {{-- </div>
</div> --}}