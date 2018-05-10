@inject('sidebarservice', 'App\Services\SideBarService')
@extends('layout')


@section('search')
@stop


@section('main')
  <section id="main-section">
    <div class="container-fluid detail-header-fluid">
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="detail-header">
              <h1 class="detail-title col-md-6">
               <?php
                if(appLang == "_vi")
                  echo $realEstateCode->name_vi;
                else
                  echo $realEstateCode->name_en;
              ?>                
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 main-content">
          <div class="row">
            <?php
            if($lstProperties != null)
            {
              $i = 0;
              foreach($lstProperties as $property)
              {
                if (appLang == "_vi") {
                  $urlName = $sidebarservice->kd($property->title_vi);
                }
                else {
                  $urlName = $sidebarservice->kd($property->title_en);
                }
            ?>
            <div class="col-md-4">
              <div class="list-box">
                <div class="listing-box">
                  <a href="{{siteURL}}/property/detail/{{$urlName}}/<?php echo $property->id_key; ?>">
                    <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/properties/<?php echo $lstImage[$i]; ?>')">
                      <!-- <div class="listing-box-image-label">New</div> -->
                    </div>
                    <!-- /.listing-box-image -->
                    <div class="listing-box-title">
                      <h3>
                          <?php

                            if(appLang == "_vi")
                              echo $property->title_vi;
                            else
                              echo $property->title_en;
                          ?>
                      </h3>
                      <h4><?php echo $property->price; ?> <?php echo " ". $lstpricetype[$i]; ?></h4>
                    </div>
                  </a>
                  <!-- /.listing-box-title -->
                  <div class="listing-box-content-property">
                    <dl>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bed.png" /><span class="listing-box-content-title"><?php echo $property->bedroom?></span></dt>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bath.png" /><span class="listing-box-content-title"><?php echo $property->bathroom?></span></dt>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/acreage.png" /><span class="listing-box-content-title"><?php echo $property->area?> m2</span></dt>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/placeholder-for-map.png" />
                        <span class="listing-box-content-title">
                        <?php
                        if(appLang == "_vi")
                          {
                            if($property->township == "Q1")
                              echo "Q.1";
                            if($property->township == "Q2")
                              echo "Q.2";
                            if($property->township == "Q3")
                              echo "Q.3";
                            if($property->township == "Q4")
                              echo "Q.4";;
                            if($property->township == "Q5")
                              echo "Q.5";
                            if($property->township == "Q6")
                              echo "Q.6";
                            if($property->township == "Q7")
                              echo "Q.7";
                            if($property->township == "Q8")
                              echo "Q.8";
                            if($property->township == "Q9")
                              echo "Q.9";
                            if($property->township == "Q10")
                              echo "Q.10";
                            if($property->township == "Q11")
                              echo "Q.11";
                            if($property->township == "Q12")
                              echo "Q.12";
                            if($property->township == "QTD")
                              echo "Q.Thủ Đức";
                            if($property->township == "QGV")
                              echo "Q.Gò Vấp";
                            if($property->township == "QBT")
                              echo "Q.Bình Thạnh";
                            if($property->township == "QTB")
                              echo "Q.Tân Bình";
                            if($property->township == "QTP")
                              echo "Q.Tân Phú";
                            if($property->township == "QPN")
                              echo "Q.Phú Nhuận";
                            if($property->township == "QBT2")
                              echo "Q.Bình Tân";
                          }
                        else
                          {
                            if($property->township == "Q1")
                              echo "Dist.1";
                            if($property->township == "Q2")
                              echo "Dist.2";
                            if($property->township == "Q3")
                              echo "Dist.3";
                            if($property->township == "Q4")
                              echo "Dist.4";;
                            if($property->township == "Q5")
                              echo "Dist.5";
                            if($property->township == "Q6")
                              echo "Dist.6";
                            if($property->township == "Q7")
                              echo "Dist.7";
                            if($property->township == "Q8")
                              echo "Dist.8";
                            if($property->township == "Q9")
                              echo "Dist.9";
                            if($property->township == "Q10")
                              echo "Dist.10";
                            if($property->township == "Q11")
                              echo "Dist.11";
                            if($property->township == "Q12")
                              echo "Dist.12";
                            if($property->township == "Q12")
                              echo "Dist.12";
                            if($property->township == "QTD")
                              echo "Thu Duc Dist";
                            if($property->township == "QGV")
                              echo "Go Vap Dist";
                            if($property->township == "QBT")
                              echo "Binh Thanh Dist";
                            if($property->township == "QTB")
                              echo "Tan Binh Dist";
                            if($property->township == "QTP")
                              echo "Tan Phu Dist";
                            if($property->township == "QPN")
                              echo "Phu Nhuan Dist";
                            if($property->township == "QBT2")
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
            }?>
            <!-- /.listing-box -->
            <!-- <div class="col-md-4 col-sm-6">
              <div class="list-box">
                <div class="listing-box">
                  <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/placeholder.png');">
                    <div class="listing-box-image-label">Featured</div> -->
                    <!-- /.listing-box-image-label -->
                    <!-- <span class="listing-box-image-links">
                      <a href="properties.html">
                        <i class="fa fa-heart"></i> <span>Add to favorites</span>
                    </a>
                    <a href="properties-detail-standard.html"><i class="fa fa-search"></i> <span>View detail</span></a>
                    <a href="properties-compare.html"><i class="fa fa-balance-scale"></i> <span>Compare property</span></a>
                    </span>
                  </div> -->
                  <!-- /.listing-box-image -->
                  <!-- <div class="listing-box-title">
                    <h3><a href="properties-detail-standard.html">Bright Island Route</a></h3>
                    <h4>$ 40.000</h4>
                  </div> -->
                  <!-- /.listing-box-title -->
                  <!-- <div class="listing-box-content">
                    <dl>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bath.png" /><span class="listing-box-content-title">Bathrooms</span></dt>
                      <dd>2</dd>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bed.png" /><span class="listing-box-content-title">Beds</span></dt>
                      <dd>3</dd>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/acreage.png" /><span class="listing-box-content-title">Area</span></dt>
                      <dd>147 m2</dd>
                    </dl>
                    <dl>
                      <dt><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i><span class="listing-box-content-title">Location</span></dt>
                      <dd>Dist.1</dd>
                    </dl>
                  </div> -->
                  <!-- /.listing-box-cotntent -->
                <!-- </div>
              </div>
            </div> -->
            <!-- /.listing-box -->
            <div class="pagination-wrapper">
              <ul class="pagination">
                {!! $lstProperties->render() !!}
              </ul>
              <!-- /.pagination -->
            </div>  
            <!-- /.pagination-wrapper -->
          </div>
        </div>
        
      </div>
    </div>
  </section>
@stop
