@inject('sidebarservice', 'App\Services\SideBarService')
@extends('layout')

@section('search')
  <div id="search-section">
    <div class="container">
      <form action="{{siteURL}}/search" class="search-form" name="search-form">
        <div class="search-form-container">
          <h1 class="centered">Search properties</h1>
          <div class="search-container">
            <div class="search-inner-container">
              <div class="row">
                <div class="search-col col-md-1 col-md-offset-1">
                  <select id="search-type" class="form-control" name="type">
                    <option value="">
                      Type
                    </option>
                    <option value="R">
                      Rent
                    </option>
                    <option value="S">
                      Sale
                    </option>
                  </select>
                </div>
                <div class="search-col col-md-7">
                  <input type="text" name="keywords" class="search-input" placeholder="Keywords / Property Code" />
                </div>
              </div>
              <div class="row">
                <div class="search-col col-md-2 col-md-offset-1 col-sm-6">
                  <select class="form-control" name="type2">
                    <option value="">
                      All property types
                    </option>
                    <option value="A">
                      Apartment
                    </option>
                    <option value="SA">
                      Serviced Apartment
                    </option>
                    <option value="HV">
                      House and Villa
                    </option>
                    <option value="L">
                      Land
                    </option>
                    <option value="OF">
                      Office
                    </option>
                    <option value="O">
                      Other
                    </option>
                  </select>
                </div>
                <div class="search-col col-md-1 col-sm-6">
                  <select class="form-control" name="minbed">
                    <option value="">
                      Min beds
                    </option>
                    <option value="">
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
                    <option value="6">
                      6 beds
                    </option>
                    <option value="7">
                      7 beds
                    </option>
                    <option value="8">
                      8 beds
                    </option>
                    <option value="9">
                      9 beds
                    </option>
                  </select>
                </div>
                <div class="search-col col-md-1 col-sm-6">
                  <select class="form-control" name="maxbed">
                    <option value="">
                      Max beds
                    </option>
                    <option value="">
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
                    <option value="6">
                      6 beds
                    </option>
                    <option value="7">
                      7 beds
                    </option>
                    <option value="8">
                      8 beds
                    </option>
                    <option value="9">
                      9 beds
                    </option>
                  </select>
                </div>
                <div class="search-col col-md-1 col-sm-6">
                  <select id="min-price" class="form-control" name="minprice">
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
                <div class="search-col col-md-1 col-sm-6">
                  <select id="max-price" class="form-control" name="maxprice">
                    <option value="">
                      Max price pm
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
                <div class="search-col col-md-2 col-sm-6 last-col">
                  <select class="form-control" name="date">
                    <option value="">
                      Any date
                    </option>
                    <option value="{{date('m')+0}}">
                      Available now
                    </option>
                    <option disabled>
                      In or Before:
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
                  <!-- <input class="datepicker" data-date-format="mm/dd/yyyy" placeholder="Available Date" /> -->
                </div>
                <div class="col-md-2 col-sm-12 search-button-container">
                  <!-- Indicates a dangerous or potentially negative action -->
                  <button type="submit" id="search-submit" type="button" class="btn btn-danger">Search</button>
                </div>
              </div>
            </div>
            <div class="rui-clearfix"></div>
          </div>
        </div>
      </form>
    </div>
  </div>

@stop


@section('main')
  <section id="main-section search-page">
    <div class="container-fluid detail-header-fluid">
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="detail-header">
              <!-- <div class="detail-nav col-md-6">
                <ul class="detail-nav-right">
                  <li class="detail-nav-items">
                    <a href="#">Home</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ Home</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ Home</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ Home</a>
                  </li>
                </ul>
              </div> -->
              <h1 class="detail-title col-md-6">Search result for keyword: <i>"<?php echo $key;?>"</i></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <h2 class="main-title">Properties</h2>
            <?php 
            $i=0;
            foreach ($result as $item) {
              if (appLang == "_vi") {
                $urlName = $sidebarservice->kd($item->title_vi);
              }
              else {
                $urlName = $sidebarservice->kd($item->title_en);
              }
              ?>
          
            <div class="col-md-4 col-sm-6">
              <div class="list-box">
                <div class="listing-box">
                <a href="property/detail/{{$urlName}}/<?php echo $item->id_key ?>">
                  <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/properties/<?php echo $img[$i];?>');">
                    <div class="listing-box-image-label">
                    <?php 
                      if (appLang == "_vi") {
                        echo $lstcatvi[$i];
                      }
                      else {
                        echo $lstcaten[$i];
                      }
                    ?>
                    </div>
                  </div>
                  <!-- /.listing-box-image -->
                  <div class="listing-box-title">
                    <h3>
                        <?php

                          if(appLang == "_vi")
                            echo $item->title_vi;
                          else
                            echo $item->title_en;
                        ?>
                    </h3>
                    <h4><?php echo $item->price?> <?php echo " ". $lstpricetype[$i]?></h4>
                  </div>
                  </a>
                  <!-- /.listing-box-title -->
                  <div class="listing-box-content-property">
                    <dl>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bed.png" /><span class="listing-box-content-title"><?php echo $item->bedroom?></span></dt>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bath.png" /><span class="listing-box-content-title"><?php echo $item->bathroom?></span></dt>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/acreage.png" /><span class="listing-box-content-title"><?php echo $item->area?> m2</span></dt>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/placeholder-for-map.png" />
                        <span class="listing-box-content-title">
                        <?php
                        if(appLang == "_vi")
                          {
                            if($item->township == "Q1")
                              echo "Q.1";
                            if($item->township == "Q2")
                              echo "Q.2";
                            if($item->township == "Q3")
                              echo "Q.3";
                            if($item->township == "Q4")
                              echo "Q.4";;
                            if($item->township == "Q5")
                              echo "Q.5";
                            if($item->township == "Q6")
                              echo "Q.6";
                            if($item->township == "Q7")
                              echo "Q.7";
                            if($item->township == "Q8")
                              echo "Q.8";
                            if($item->township == "Q9")
                              echo "Q.9";
                            if($item->township == "Q10")
                              echo "Q.10";
                            if($item->township == "Q11")
                              echo "Q.11";
                            if($item->township == "Q12")
                              echo "Q.12";
                            if($item->township == "QTD")
                              echo "Q.Thủ Đức";
                            if($item->township == "QGV")
                              echo "Q.Gò Vấp";
                            if($item->township == "QBT")
                              echo "Q.Bình Thạnh";
                            if($item->township == "QTB")
                              echo "Q.Tân Bình";
                            if($item->township == "QTP")
                              echo "Q.Tân Phú";
                            if($item->township == "QPN")
                              echo "Q.Phú Nhuận";
                            if($item->township == "QBT2")
                              echo "Q.Bình Tân";
                          }
                        else
                          {
                            if($item->township == "Q1")
                              echo "Dist.1";
                            if($item->township == "Q2")
                              echo "Dist.2";
                            if($item->township == "Q3")
                              echo "Dist.3";
                            if($item->township == "Q4")
                              echo "Dist.4";;
                            if($item->township == "Q5")
                              echo "Dist.5";
                            if($item->township == "Q6")
                              echo "Dist.6";
                            if($item->township == "Q7")
                              echo "Dist.7";
                            if($item->township == "Q8")
                              echo "Dist.8";
                            if($item->township == "Q9")
                              echo "Dist.9";
                            if($item->township == "Q10")
                              echo "Dist.10";
                            if($item->township == "Q11")
                              echo "Dist.11";
                            if($item->township == "Q12")
                              echo "Dist.12";
                            if($item->township == "Q12")
                              echo "Dist.12";
                            if($item->township == "QTD")
                              echo "Thu Duc Dist";
                            if($item->township == "QGV")
                              echo "Go Vap Dist";
                            if($item->township == "QBT")
                              echo "Binh Thanh Dist";
                            if($item->township == "QTB")
                              echo "Tan Binh Dist";
                            if($item->township == "QTP")
                              echo "Tan Phu Dist";
                            if($item->township == "QPN")
                              echo "Phu Nhuan Dist";
                            if($item->township == "QBT2")
                              echo "Binh Tan Dist";
                          }

                        ?>
                        </span>
                      </dt>
                    </dl>
                  </div>
                  <!-- /.listing-box-cotntent -->
                </div>
              </div>
            </div>
              <?php
              $i++;
            }
            ?>
            
            <!-- /.listing-box -->
          </div>
          <!-- / properties result -->
          <div class="row">
            <h2 class="main-title">Projects</h2>
            <?php
            if($lstproject != null)
            {
              $i=0;
              foreach($lstproject as $project)
              {
                if (appLang == "_vi") {
                  $urlName = $sidebarservice->kd($project->name_vi);
                }
                else {
                  $urlName = $sidebarservice->kd($project->name_en);
                }
            ?>
            <div class="col-md-4 col-sm-6">
              <div class="list-box">
                <div class="listing-box">
                  <a href="<?php echo siteURL;?>/project/detail/{{$urlName}}/<?php echo $project->id ?>">
                  <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/projects/<?php echo $lstCatImg[$i] ?>');">
                    <!-- <div class="listing-box-image-label">Featured</div> -->
                    <div class="listing-box-image-label">
                    <?php
                    echo $lstcatpro[$i];
                  ?>
                    </div>
                  </div>
                  </a>
                  <!-- /.listing-box-image -->
                  <div class="listing-box-title">
                    <h3><a href="<?php echo siteURL;?>/project/detail/{{$urlName}}/<?php echo $project->id ?>">
                    <?php 
                    if(appLang == "_vi")
                      echo $project->name_vi;
                    else
                      echo $project->name_en;
                    ?>
                    </a></h3>
                    <!-- <h4>$ 40.000</h4> -->
                  </div>
                  <!-- /.listing-box-title -->
                  <div class="listing-box-content">
                    <dl>
                      <dt><i class="fa fa-home" aria-hidden="true"></i><span class="listing-box-content-title">Investor:</span></dt>
                      <dd><?php echo $project->investor;?></dd>
                      <dt><i class="fa fa-map-marker" aria-hidden="true"></i><span class="listing-box-content-title">Address:</span></dt>
                      <dd><?php echo $project->address;?></dd>
                      <dt><i class="fa fa-usd" aria-hidden="true"></i><span class="listing-box-content-title">Sale:</span></dt>
                      <dd><?php echo $project->sell_price;?></dd>
                      <dt><i class="fa fa-usd" aria-hidden="true"></i><span class="listing-box-content-title">Rent:</span></dt>
                      <dd><?php echo $project->lease_price;?></dd>
                    </dl>
                  </div>
                  <!-- /.listing-box-cotntent -->
                </div>
              </div>
            </div>
            <?php 
            $i++;
          }
        }
        ?>
            <!-- /.listing-box -->
          </div>
          <!-- / project result -->
          <div class="row">
            
            <h2 class="main-title">News</h2>
            <?php
              if($lstproject != null)
              {
                $i=0;
                foreach($lstnews as $news)
                {
                  if (appLang == "_vi") {
                    $urlName = $sidebarservice->kd($news->title_vi);
                  }
                  else {
                    $urlName = $sidebarservice->kd($news->title_en);
                  }
              ?>
            <div class="col-md-4 col-sm-6">
              <div class="post">
                  <div class="post-image">
                    <a class="post-image-link" href="<?php echo siteURL;?>/news/detail/{{$urlName}}/<?php echo $news->id ?>" style="background-image: url('{{ generateUrl('/public') }}/images/news/{{$news->image}}');">
                    </a>
                  </div>
                  <!-- /.post-image -->
                  <div class="post-title">
                    <h2>
                      <a href="<?php echo siteURL;?>/news/detail/{{$urlName}}/<?php echo $news->id ?>">
                        <?php
                        if (appLang == "_vi")
                        echo $news->title_vi;
                        else 
                        echo $news->title_en;
                        ?>
                      </a>
                    </h2>
                  </div>
                  <!-- /.post-title -->
                  <div class="post-meta meta-news">
                    <!-- /.post-meta-item -->
                    <div class="post-meta-item meta-date">
                      <?php echo date('d/m/Y', strtotime($news->created_at)); ?>
                    </div>
                  </div>
                  <!-- /.post-meta -->
                  <div class="post-content">
                    <p>
                      <?php 
                    if(appLang == "_vi")
                    echo substr($news->content_vi, 0, 200);
                  else 
                    echo substr($news->content_en, 0, 200);
                  echo '...';
                    ?>
                    </p>
                  </div>
                  <!-- /.post-content -->
                  <div class="post-read-more">
                    <a href="<?php echo siteURL;?>/news/detail/{{$urlName}}/<?php echo $news->id ?>">
                      <?php if(appLang == "_vi")
                      echo 'Xem thêm';
                      else
                      echo 'Read More';
                    ?>
                      <i class="fa fa-chevron-right">
                      </i>
                    </a>
                  </div>
                  <!-- /.post-read-more -->
                </div>
                <!-- /.post-->
            </div>
          <?php 
          $i++;
        }
      }
      ?>
          <!-- / news result -->
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
