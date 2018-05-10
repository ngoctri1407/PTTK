<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>
    @section('title')
    SGHome | Dashboard
    @show
  </title>
  <link href="{{ generateAsset('public/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{ generateAsset('public/font-awesome/css/font-awesome.css') }}" rel="stylesheet"/>
  <!-- Toastr style -->
  <link href="{{ generateAsset('public/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
  <!-- Gritter -->
  <link href="{{ generateAsset('public/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet"/>
  <link href="{{ generateAsset('public/css/animate.css') }}" rel="stylesheet"/>
  <link href="{{ generateAsset('public/css/style.css') }}" rel="stylesheet"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  </meta>
  </meta>
</head>
<body>
<div id="wrapper">
  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav" id="side-menu">
        <li class="nav-header">
          <div class="dropdown profile-element" style="text-align: center">
							<span>
                            <img alt="image" width="100%" src="{{generateAsset('public/images/logo_sghome.png')}}"/>
                             </span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Administrator</strong></span>
                                </span>
            </a>

          </div>
          <div class="logo-element">
            SGH
          </div>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/realestate') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Properties </span></a>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/project') }}"><i class="fa fa-folder-o"></i> <span
                class="nav-label">Project </span></a>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/coderealestate') }}"><i class="fa fa-road"></i> <span class="nav-label">Code Properties </span></a>
        </li>
        <li>
          <a href="#"><i class="fa fa-building-o"></i> <span class="nav-label">Amenities</span><span
                class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="{{ generateUrl('/admin/inside') }}">Inside Facilities</a></li>
            <li><a href="{{ generateUrl('/admin/nearby') }}">Nearby Facilities</a></li>
          </ul>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/furnished') }}"><i class="fa fa-glass"></i> <span
                class="nav-label">Furnished</span></a>

        </li>
        <li>
          <a href="{{ generateUrl('/admin/author') }}"><i class="fa fa-users"></i> <span class="nav-label">Agent</span></a>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/news') }}"><i class="fa fa-newspaper-o"></i> <span
                class="nav-label">News</span></a>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/price') }}"><i class="fa fa-money"></i> <span
                class="nav-label">Price</span></a>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/about') }}"><i class="fa fa-home"></i> <span
                class="nav-label">About</span></a>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/setting') }}"><i class="fa fa-cog"></i> <span class="nav-label">Setting</span></a>
        </li>
      </ul>

    </div>
  </nav>

  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
      <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"></nav>
      <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        {!! Form::open(array('url' => generateUrl('/admin/realestate/search'), 'class'=>'navbar-form-custom')) !!}
        <div class="form-group">
          <input type="text" placeholder="Search ID Property..." class="form-control" name="query">
        </div>
        {!! Form::close() !!}
      </div>
      <ul class="nav navbar-top-links navbar-right">
        <li>
          <span class="m-r-sm text-muted welcome-message">Hello <b>{{ Session::get('usernamelogin') }}</b></span>
        </li>
        <li>
          <a href="{{ generateUrl('/admin/logout') }}">
            <i class="fa fa-sign-out"></i> Log out
          </a>
        </li>
      </ul>
      </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="wrapper wrapper-content">
          <div class="row">
            @yield('content')
            @yield('page-script')
          </div>
        </div>
        {{--
        <div class="footer">--}}
          {{--
          <div class="pull-right">--}}
            {{--<strong>Copyright</strong> Saigon Home &copy; 2016--}}
            {{--
          </div>
          --}}
          {{--
        </div>
        --}}
        </form>
      </div>

      </nav>
    </div>
  </div>
</div>
<!-- Mainly scripts -->
<script src="{{ generateAsset('public/js/jquery-2.1.1.js') }}">
</script>
<script src="{{ generateAsset('public/js/bootstrap.min.js') }}">
</script>
<script src="{{ generateAsset('public/js/plugins/metisMenu/jquery.metisMenu.js') }}">
</script>
<script src="{{ generateAsset('public/js/plugins/slimscroll/jquery.slimscroll.min.js') }}">
</script>
<!-- Flot -->
<script src="{{ generateAsset('public/js/plugins/flot/jquery.flot.js') }}">
</script>
<script src="{{ generateAsset('public/js/plugins/flot/jquery.flot.tooltip.min.js') }}">
</script>
<script src="{{ generateAsset('public/js/plugins/flot/jquery.flot.spline.js') }}">
</script>
<script src="{{ generateAsset('public/js/plugins/flot/jquery.flot.resize.js') }}">
</script>
<script src="{{ generateAsset('public/js/plugins/flot/jquery.flot.pie.js') }}">
</script>
<!-- Peity -->
<script src="{{ generateAsset('public/js/plugins/peity/jquery.peity.min.js') }}">
</script>
<script src="{{ generateAsset('public/js/demo/peity-demo.js') }}">
</script>
<!-- Custom and plugin javascript -->
<script src="{{ generateAsset('public/js/inspinia.js') }}">
</script>
<script src="{{ generateAsset('public/js/plugins/pace/pace.min.js') }}">
</script>
<!-- jQuery UI -->
<script src="{{ generateAsset('public/js/plugins/jquery-ui/jquery-ui.min.js') }}">
</script>
<!-- GITTER -->
<script src="{{ generateAsset('public/js/plugins/gritter/jquery.gritter.min.js') }}">
</script>
<!-- Sparkline -->
<script src="{{ generateAsset('public/js/plugins/sparkline/jquery.sparkline.min.js') }}">
</script>
<!-- Sparkline demo data  -->
<script src="{{ generateAsset('public/js/demo/sparkline-demo.js') }}">
</script>
<!-- ChartJS-->
<script src="{{ generateAsset('public/js/plugins/chartJs/Chart.min.js') }}">
</script>
<!-- Toastr -->
<script src="{{ generateAsset('public/js/plugins/toastr/toastr.min.js') }}"></script>
<!-- Google places autocomplete -->
<script>
  function activatePlacesSearch () {
    let input = document.getElementById('address');
    if (!input) {
      return;
    }
    let autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function () {
      let place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("Không tìm thấy kết quả tương ứng với : '" + place.name + "'");
      }
    })
  }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GG_API_KEY')); ?>&libraries=places&callback=activatePlacesSearch"
    async defer>
</script>

</body>
</html>
