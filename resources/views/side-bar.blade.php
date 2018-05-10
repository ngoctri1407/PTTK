@inject('sidebarservice', 'App\Services\SideBarService')

<?php
$currentRoute = Route::current();
$params = $currentRoute->parameters();
if ($view_name == 'property-detail') {
  $idRelatedPro = $params['id'];
}
elseif ($view_name == 'project-detail') {
  $idProject = $params['id']; 
}
elseif ($view_name == 'news-detail') {
  $idNews = $params['id']; 
}
?>
<div class="col-md-3 side-bar">
  <?php
  if ($view_name == 'homes') {
  ?>
    <h2 class="main-title">Search</h2>
    <div class="listing-small-search">
      <form action="{{siteURL}}/search">
        <div class="row">
          <div class="col-md-12">
            <select class="form-control" name="type" required>
              <option value="">
                Type
              </option>
              <option value="R">
                Rent
              </option>
              <option value="S">
                Sell
              </option>
            </select>
          </div>
          <div class="col-md-12">
            <input type="text" name="keywords" class="search-input" placeholder="Keywords / Property Code" required />
          </div>
          <div class="col-md-12">
            <select class="form-control" name="type2">
              <option value="">
                All property types
              </option>
              <option value="0">
                Apartment
              </option>
              <option value="1">
                Serviced Apartment
              </option>
              <option value="2">
                House and Villa
              </option>
              <option value="3">
                Land
              </option>
              <option value="4">
                Office
              </option>
              <option value="5">
                Other
              </option>
            </select>
          </div>
          <div class="col-md-12">
            <select class="form-control" name="minbed">
              <option value="">
                Min beds
              </option>
              <option value="0">
                Any
              </option>
              <option value="1">
                1 bed
              </option>
              <option value="2">
                2 beds
              </option>
              <option value="3">
                3 beds
              </option>
              <option value="4">
                4 beds
              </option>
              <option value="5">
                5 beds
              </option>
              <option value=">5">
                >5 beds
              </option>
            </select>
          </div>
          <div class="col-md-12">
            <select class="form-control" name="maxbed">
              <option value="">
                Max beds
              </option>
              <option value="0">
                Any
              </option>
              <option value="1">
                1 bed
              </option>
              <option value="2">
                2 beds
              </option>
              <option value="3">
                3 beds
              </option>
              <option value="4">
                4 beds
              </option>
              <option value="5">
                5 beds
              </option>
              <option value=">5">
                >5 beds
              </option>
            </select>
          </div>
          <div class="col-md-12">
            <select class="form-control" name="minprice">
              <option value="">
                Min price pm
              </option>
              <option value="100">
                $100
              </option>
              <option value="200">
                $200
              </option>
              <option value="300">
                $300
              </option>
              <option value="400">
                $400
              </option>
              <option value="500">
                $500
              </option>
              <option value="600">
                $600
              </option>
              <option value="700">
                $700
              </option>
              <option value="800">
                $800
              </option>
              <option value="900">
                $900
              </option>
              <option value="1000">
                $1,000
              </option>
              <option value="1500">
                $1,500
              </option>
              <option value="2000">
                $2,000
              </option>
              <option value="2500">
                $2,500
              </option>
              <option value="3000">
                $3,000
              </option>
              <option value="3500">
                $3,500
              </option>
              <option value="4000">
                $4,000
              </option>
              <option value="4500">
                $4,500
              </option>
              <option value="5000">
                $5,000
              </option>
              <option value="6000">
                $6,000
              </option>
              <option value="7000">
                $7,000
              </option>
              <option value="8000">
                $8,000
              </option>
              <option value="9000">
                $9,000
              </option>
              <option value="10000">
                $10,000
              </option>
              <option value=">10000">
                >$10,000
              </option>
            </select>
          </div>
          <div class="col-md-12">
            <select class="form-control" name="maxprice">
              <option value="">
                Min price pm
              </option>
              <option value="100">
                $100
              </option>
              <option value="200">
                $200
              </option>
              <option value="300">
                $300
              </option>
              <option value="400">
                $400
              </option>
              <option value="500">
                $500
              </option>
              <option value="600">
                $600
              </option>
              <option value="700">
                $700
              </option>
              <option value="800">
                $800
              </option>
              <option value="900">
                $900
              </option>
              <option value="1000">
                $1,000
              </option>
              <option value="1500">
                $1,500
              </option>
              <option value="2000">
                $2,000
              </option>
              <option value="2500">
                $2,500
              </option>
              <option value="3000">
                $3,000
              </option>
              <option value="3500">
                $3,500
              </option>
              <option value="4000">
                $4,000
              </option>
              <option value="4500">
                $4,500
              </option>
              <option value="5000">
                $5,000
              </option>
              <option value="6000">
                $6,000
              </option>
              <option value="7000">
                $7,000
              </option>
              <option value="8000">
                $8,000
              </option>
              <option value="9000">
                $9,000
              </option>
              <option value="10000">
                $10,000
              </option>
              <option value=">10000">
                >$10,000
              </option>
            </select>
          </div>
          <div class="col-md-12">
            <select class="form-control" name="date">
              <option value="">
                Any date
              </option>
              <option value="now">
                Available now
              </option>
              <option value="1">
                January
              </option>
              <option value="2">
                Febuary
              </option>
              <option value="3">
                March
              </option>
              <option value="4">
                April
              </option>
              <option value="5">
                May
              </option>
              <option value="6">
                June
              </option>
              <option value="7">
                July
              </option>
              <option value="8">
                August
              </option>
              <option value="9">
                September
              </option>
              <option value="10">
                October
              </option>
              <option value="11">
                November
              </option>
              <option value="12">
                December
              </option>
            </select>
          </div>
        </div>
        <div class="row search-row">
          <div class="col-md-offset-6 col-md-6">
            <button type="submit" class="btn btn-danger search-button">Search</button>
          </div>
        </div>
      </form>
    </div>
  <?php
  }
  ?>
  <!-- <h2 class="main-title">Website Supporters</h2>
  <div class="listing-small">
    <div class="listing-small-inner">
      <div class="listing-small-image">
        <a href="#" style="background-image: url('{{ generateUrl('/public') }}/images/supporter/agent.jpg');">
        </a>
      </div> -->
      <!-- /.listing-small-image -->
      <!-- <div class="listing-small-content">
        <h3><a href="#">Anny Huynh</a></h3>
        <h4>Phone: 0909 28 29 22</h4>
        <h4><a href="mailto:anny@sghome.vn">anny@sghome.vn</a></h4>
      </div> -->
      <!-- /.listing-small-content -->
    <!-- </div> -->
    <!-- /.listing-small-inner -->
  <!-- </div> -->
  <!-- <div class="listing-small">
    <div class="listing-small-inner">
      <div class="listing-small-image">
        <a href="#" style="background-image: url('{{ generateUrl('/public') }}/images/supporter/agent.jpg');">
        </a>
      </div>
      /.listing-small-image
      <div class="listing-small-content">
        <h3><a href="#">Anny Huynh</a></h3>
        <h4>Phone: 0909 28 29 22</h4>
        <h4><a href="mailto:anny@sghome.vn">anny@sghome.vn</a></h4>
      </div> -->
      <!-- /.listing-small-content -->
    <!-- </div> -->
    <!-- /.listing-small-inner -->
  <!-- </div> -->
  <!-- <div class="listing-small">
    <div class="listing-small-inner">
      <div class="listing-small-image">
        <a href="#" style="background-image: url('{{ generateUrl('/public') }}/images/supporter/agent.jpg');">
        </a>
      </div> -->
      <!-- /.listing-small-image -->
      <!-- <div class="listing-small-content">
        <h3><a href="#">Anny Huynh</a></h3>
        <h4>Phone: 0909 28 29 22</h4>
        <h4><a href="anny@sghome.vn">anny@sghome.vn</a></h4>
      </div> -->
      <!-- /.listing-small-content -->
    <!-- </div> -->
    <!-- /.listing-small-inner -->
  <!-- </div> -->
  <h2 class="main-title">
  <?php
    if (($view_name == 'property-detail') || ($view_name == 'project-detail')) {
      echo "Related Properties";
    }
    elseif ($view_name == 'news-detail') {
      echo "Related News";
    }  
    else {
      echo "Hot Properties";
    }   
  ?>
  </h2>
  <?php
    if ($view_name == 'property-detail') {
      $lstRelatedPro = $sidebarservice->getRelatedPro($idRelatedPro);
    }
    elseif ($view_name == 'project-detail') {
      $lstRelatedPro = $sidebarservice->getProInProject($idProject);
    }
    elseif ($view_name == 'news-detail') {
      $lstRelatedPro = $sidebarservice->getNewInCat($idNews);
    } 
    else {
      $lstRelatedPro = $sidebarservice->getHotPro();
    }
    if($lstRelatedPro != null)
    {
      foreach ($lstRelatedPro as $relatedPro)
      { 
        if (appLang == "_vi") {
          $urlName = $sidebarservice->kd($relatedPro->title_vi);
        }
        else {
          $urlName = $sidebarservice->kd($relatedPro->title_en);
        }
        $relatedPro->price = number_format($relatedPro->price); ?>
          <?php if($view_name != 'news-detail') { ?>
          <a href="{{siteURL}}/property/detail/{{$urlName}}/{{$relatedPro->id_key}}">
          <?php } else { ?>
          <a href="{{siteURL}}/news/detail/{{$urlName}}/{{$relatedPro->id}}">
          <?php } ?>
            <div class="list-box-small">
              <?php if($view_name != 'news-detail') { ?>
              <img src="{{ generateUrl('/public') }}/images/properties/{{$sidebarservice->getProImage($relatedPro->id_key)}}">
              <?php } else { ?>
              <img src="{{ generateUrl('/public') }}/images/news/{{ $relatedPro->image }}">
              <?php } ?>
              <ul>
                <li class="name">
                  <?php if (appLang == "_vi") {
                    echo $relatedPro->title_vi;
                  }
                  else {
                    echo $relatedPro->title_en;
                  } ?>
                  <?php if ($view_name != 'news-detail') { ?>
                <li class="price">{{$relatedPro->price}} <?php echo $sidebarservice->getPriceType($relatedPro->type_price); ?></li>
                <?php } ?>
              </ul>
            </div>
          </a>
  <!-- /.listing-small -->
  <?php
      }
    }
  ?>
  <!-- /.listing-small -->
</div>
