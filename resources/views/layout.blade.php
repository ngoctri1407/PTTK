@inject('sidebarservice', 'App\Services\SideBarService')

<?php 
require public_path()."/FBcomments/fbSDK.php";
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>
    SGHome.VN
  </title>
  <!-- Bootstrap -->
  <link href="{{ generateAsset('public/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- WEB FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,600" rel="stylesheet" />
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,300,700&subset=vietnamese,latin" rel="stylesheet" type="text/css" /> -->
  <!-- NORMAL -->
  <link href="{{ generateAsset('public/css/normalize.css') }}" rel="stylesheet" />
  <!-- ICON FONTS -->
  <link href="{{ generateAsset('public/css/font-awesome.min.css') }}" rel="stylesheet" />
<!-- 
      <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet"> -->
  <!-- FULL SLIDER -->
  <link href="{{ generateAsset('public/css/full-slider.css') }}" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="{{ generateAsset('public/css/front-style.css') }}" rel="stylesheet" />
  <link href="{{ generateAsset('public/css/media-query.css') }}" rel="stylesheet" />
  <!-- Range Slider -->
  <link href="{{ generateUrl('/public') }}/css/bootstrap-slider.min.css" rel="stylesheet" />
  <!-- Image Slider -->
  <link rel="stylesheet" type="text/css" href="{{ generateUrl('/public') }}/css/image-slider.css" />
  <!-- Date picker -->
  <link href="{{ generateUrl('/public') }}/css/datepicker.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ generateUrl('/public') }}/css/component.css" />
  <link href="{{ generateUrl('/public') }}/css/animate.css" rel="stylesheet">
  <script src="{{ generateUrl('/public') }}/js/modernizr.custom.js"></script>

</head>

<body>
  <header id="header">
    <nav class="header-nav">
      <div class="language-flag">
        <a href="#"><img src="{{ generateUrl('/public') }}/images/flags/vi.png" id="viLanguage" /></a>
        <a href="#"><img src="{{ generateUrl('/public') }}/images/flags/en.png" id="enLanguage" /></a>
        @if(!session()->has('usernamelogin'))
        <a href="login" type="button" class="btn btn-success btn-sm">Login</a>
        <a href="register" type="button" class="btn btn-primary btn-sm">Register</a>
        @else
        <a href="logout" type="button" class="btn btn-danger btn-sm">Logout</a>
        @endif
      </div>
      <ul class="navbar-ul">
        <li class="navbar-li">
          <a href="{{siteURL}}">
            <?php
            if (appLang != '_vi') {
              echo "Home";
            } else {
              echo "Trang Chủ";
            }
            ?>
          </a>
        </li>
        <li class="navbar-li">
          <a href="{{siteURL}}/show-properties/all/sale">
            <?php
            if (appLang != '_vi') {
              echo "Sale";
            } else {
              echo "Bán";
            }
            ?>
          </a>
          <?php
          $lstType = $sidebarservice->getLstTypeNav('sale');
          if($lstType != null)
          {
            echo '<ul class="rent-ul">';
            foreach ($lstType as $type)
            {
              if (appLang == "_vi") {
                $urlName = $sidebarservice->kd($type->name_vi);
                echo '<li class="rent-li"><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_vi.'</a></li>';
              }
              else {
                $urlName = $sidebarservice->kd($type->name_en);
                echo '<li class="rent-li"><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_en.'</a></li>';
              }
            }
            echo "</ul>";
          }
          ?>
        </li>
        <li class="navbar-li">
          <a href="{{siteURL}}/show-properties/all/rent">
            <?php
            if (appLang != '_vi') {
              echo "Rent";
            } else {
              echo "Thuê";
            }
            ?>
          </a>
          <?php
          $lstType = $sidebarservice->getLstTypeNav('rent');
          if($lstType != null)
          {
            echo '<ul class="rent-ul">';
            foreach ($lstType as $type)
            {
              if (appLang == "_vi") {
                $urlName = $sidebarservice->kd($type->name_vi);
              }
              else {
                $urlName = $sidebarservice->kd($type->name_en);
              }
              if (appLang == '_vi') {
                echo '<li class="rent-li"><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_vi.'</a></li>';
              } else {
                echo '<li class="rent-li"><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_en.'</a></li>';
              }
            }
            echo "</ul>";
          }
          ?>
        </li>
        <li class="navbar-li">
          <a href="<?php echo siteURL;?>/show-projects/all">
            <?php
            if (appLang != '_vi') {
              echo "Project";
            } else {
              echo "Dự Án";
            }
            ?>
          </a>
          <ul class="rent-ul">
            <li class="rent-li">
              <a href="<?php echo siteURL;?>/show-projects/ExistsProjects/EP">
                <?php
                if (appLang != '_vi') {
                  echo "Exists Projects";
                } else {
                  echo "Dự án Hiện Tại";
                }
                ?>
              </a>
            </li>
            <li class="rent-li">
              <a href="<?php echo siteURL;?>/show-projects/NewProjects/NP">
                <?php
                if (appLang != '_vi') {
                  echo "New Projects";
                } else {
                  echo "Dự án Mới";
                }
                ?>
              </a>
            </li>
            <li class="rent-li">
              <a href="<?php echo siteURL;?>/show-projects/UpcomingProjects/UP">
                <?php
                if (appLang != '_vi') {
                  echo "Upcoming Projects";
                } else {
                  echo "Dự án Sắp Tới";
                }
                ?>
              </a>
            </li>
          </ul>
        </li>
        <li class="navbar-li">
          <a href="{{ siteURL }}/show-news/all">
            {{config(appLang.'.strNews')}}
          </a>
          <ul class="rent-ul">
            <li class="rent-li">
              <a href="{{ siteURL }}/show-news/news">
                <?php
                if (appLang != '_vi') {
                  echo "News";
                } else {
                  echo "Tin Tức";
                }
                ?>
              </a>
            </li>
            <li class="rent-li">
              <a href="{{ siteURL }}/show-news/recruitment">
                Recruitment
              </a>
            </li>
            <li class="rent-li">
              <a href="{{ siteURL }}/show-news/advertisement">
                Advertisement
              </a>
            </li>
            <li class="rent-li">
              <a href="{{ siteURL }}/show-news/pr">
                PR
              </a>
            </li>
          </ul>
        </li>
      </ul>

      <div id="dl-menu" class="dl-menuwrapper">
        <button class="dl-trigger">Open Menu</button>
        <ul class="dl-menu">
          <li>
            <a href="{{siteURL}}">
              <?php
              if (appLang != '_vi') {
                echo "Home";
              } else {
                echo "Trang Chủ";
              }
              ?>
            </a>
          </li>
          <li>
            <a href="#">
              <?php
              if (appLang != '_vi') {
                echo "Sale";
              } else {
                echo "Bán";
              }
              ?>
            </a>
            <?php
            $lstType = $sidebarservice->getLstTypeNav('sale');
            if($lstType != null)
            {
              echo '<ul class="dl-submenu">';
              foreach ($lstType as $type)
              {
                if (appLang == "_vi") {
                  $urlName = $sidebarservice->kd($type->name_vi);
                }
                else {
                  $urlName = $sidebarservice->kd($type->name_en);
                }
                if (appLang == '_vi') {
                  echo '<li><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_vi.'</a></li>';
                } else {
                  echo '<li><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_en.'</a></li>';
                }
              }
              echo "</ul>";
            }
            ?>
          </li>
          <li>
            <a href="#">
              <?php
              if (appLang != '_vi') {
                echo "Rent";
              } else {
                echo "Thuê";
              }
              ?>
            </a>
            <?php
            $lstType = $sidebarservice->getLstTypeNav('rent');
            if($lstType != null)
            {
              echo '<ul class="dl-submenu">';
              foreach ($lstType as $type)
              {
                if (appLang == "_vi") {
                  $urlName = $sidebarservice->kd($type->name_vi);
                }
                else {
                  $urlName = $sidebarservice->kd($type->name_en);
                }
                if (appLang == '_vi') {
                  echo '<li><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_vi.'</a></li>';
                } else {
                  echo '<li><a href="'.siteURL.'/show-properties/'.$urlName.'/'.$type->code.'">'.$type->name_en.'</a></li>';
                }
              }
              echo "</ul>";
            }
            ?>
          </li>

          <li>
            <a href="<?php echo siteURL;?>/show-projects/all">
              <?php
              if (appLang != '_vi') {
                echo "Project";
              } else {
                echo "Dự Án";
              }
              ?>
            </a>
            <ul class="dl-submenu">
              <li>
                <a href="<?php echo siteURL;?>/show-projects/ExistsProjects/EP">
                  <?php
                  if (appLang != '_vi') {
                    echo "Exists Projects";
                  } else {
                    echo "Dự án Hiện Tại";
                  }
                  ?>
                </a>
              </li>
              <li>
                <a href="<?php echo siteURL;?>/show-projects/NewProjects/NP">
                  <?php
                  if (appLang != '_vi') {
                    echo "New Projects";
                  } else {
                    echo "Dự án Mới";
                  }
                  ?>
                </a>
              </li>
              <li>
                <a href="<?php echo siteURL;?>/show-projects/UpcomingProjects/UP">
                  <?php
                  if (appLang != '_vi') {
                    echo "Upcoming Projects";
                  } else {
                    echo "Dự án Sắp Tới";
                  }
                  ?>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="{{ siteURL }}/commercial">
              Commercial
            </a>
          </li>

          
          <li>
            <a href="{{ siteURL }}/show-news/all">
              News
            </a>
            <ul class="dl-submenu">
              <li>
                <a href="{{ siteURL }}/show-news/news">
                  <?php
                  if (appLang != '_vi') {
                    echo "News";
                  } else {
                    echo "Tin Tức";
                  }
                  ?>
                </a>
              </li>
              <li>
                <a href="{{ siteURL }}/show-news/recuitment">
                  Recuitment
                </a>
              </li>
              <li>
                <a href="{{ siteURL }}/show-news/advertisement">
                  Advertisement
                </a>
              </li>
              <li>
                <a href="{{ siteURL }}/show-news/pr">
                  PR
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="{{siteURL}}/about-us">
              <?php
                  if (appLang != '_vi') {
                    echo "About Us";
                  } else {
                    echo "Về Chúng Tôi";
                  }
                  ?>
            </a>
          </li>
        </ul>
      </div>
      <!-- /dl-menuwrapper -->
    </nav>
    <div id="logo">
      <a href="{{siteURL}}">
        <img src="{{ generateUrl('/public') }}/images/logo_sghome.png" />
      </a>
    </div>
    
    @yield('search')
  </header>
  <div class="content">
    @yield('main')
    <section id="footer-section">
      <div class="footer-background container-fluid parallax-window" style="  background: url('{{env('APP_URL')}}/public/images/bg/footer.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        <div class="footer-overlay"></div>
        <div class="row">
          <div class="col-md-12">
            <div class="container">
              <div class="row">
              <?php
              if (appLang == '_vi') {
              ?>
                <div class="col-md-6">
                  <h2>Công ty TNHH Môi Giới BĐS US Home</h2>
                  <p>US Home cung cấp những dịch vụ sau:
                    <br /> - Dịch vụ môi giới Bán và Cho Thuê Căn Hộ/ Nhà Ở
                    <br /> - Văn phòng – Mặt bằng bán lẻ cho thuê
                    <br /> - Kho Xưởng và Đất bán hoặc cho thuê
                    <br /> - Đầu tư nhà ở tại nước ngoài
                    <br /> - Dịch vụ quản lý tài sản, quản lý khu căn hộ dịch vụ
                    <br /> - Tư vấn thành lập mô hình tòa nhà căn hộ dịch vụ cho thuê</p>
                </div>
                <div class="col-md-6">
                  <h2>Liên hệ</h2>
                  <p>Trụ sở chính: 
                    <br />Lầu 1, Tòa nhà Hoa Lâm
                    <br />Số 2 đường Thi Sách, phường Bến Nghé, Q1, TP.HCM
                    <br />Chi nhánh: 
                    <br />58A đường 47, phường Thảo Điền, Q2, TP.HCM
                    <br />Tel: (+84) 8 6281 9241 - 6281 8485 | Hotline: (+84) 909 28 29 22
                    <br />Email: info@sghome.vn | Website: www.sghome.vn</p>
                </div>
                <?php
                } else {
                ?>
                <div class="col-md-6">
                  <h2>About US Home Company Ltd</h2>
                  <p>US Home provides the excellent real estate services, included:
                    <br /> - Residential Sales – Buy - Leasing
                    <br /> - Retail – Office Leasing
                    <br /> - Factory/ Land for rent & for sale
                    <br /> - Oversea Residential Project
                    <br /> - Property Management
                    <br /> - Set up a Brand New Boutique Serviced Apartment Building</p>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


    <!-- Share-Tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5790d156f599d9c5"></script>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="{{ generateAsset('public/js/jquery.min.js') }}">
  </script>
  <!-- paralax scrolling -->
  <script src="{{ generateAsset('public/js/parallax.min.js') }}">
  </script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ generateAsset('public/js/bootstrap.min.js') }}">
  </script>
  <!-- Custom script -->
  <script src="{{ generateAsset('public/js/script.js') }}">
  </script>
  <!-- Date picker -->
  <script src="{{ generateUrl('/public') }}/js/bootstrap-datepicker.js"></script>
  <script src="{{ generateUrl('/public') }}/js/jquery.dlmenu.js"></script>
  <script src="{{ generateUrl('/public') }}/js/animation.js"></script>
    <!-- Range slider -->
  <script src="{{ generateAsset('public/js/bootstrap-slider.min.js') }}">
  </script>
  
<!-- check contact email form validation -->
  <script type="text/javascript">
  function getFileExtension(filename) {
  return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
}
var _validFileExtensions = ["jpg", "jpeg", "bmp", "gif", "png"];
    $('#attach').change(function () {
      if(this.files.length > 5)
      {
        alert("Maximum files number allowed is 5!");
        this.value = null;
        return;
      }
      var i = 0;
      for(i; i < this.files.length;i++){
        var f = this.files[i];
        // check file extension
        var ext = getFileExtension(f.name);
        var checkExt = false;
        for(var j = 0; j < _validFileExtensions.length ; j++){
          if(ext == _validFileExtensions[j]){
            checkExt = true ;
          }
        }
        if(!checkExt){
          alert("Sorry, " + f.name + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
          this.value = null;
        }
        // check file size under 2MB
        if (f.size > 2097152 || f.fileSize > 2097152)
        {
           alert("Allowed file size exceeded. (Max. 8 MB)");
           this.value = null;
        }
      }
    });
    $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
</script>
@yield('extend-script')
</body>

</html>
