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
              <h1 class="detail-title col-md-6">{{config(appLang.'.strListofProjects')}}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-9 main-content">
          <div class="row">
            
            <?php
            if($lstProjects != null)
            {
              $i = 0;
              foreach($lstProjects as $project)
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
                <a href="<?php echo siteURL;?>/project/detail/{{$urlName}}/<?php echo $project->id; ?>">
                <?php
                if (!$lstproimage[$i]) {
                ?>
                  <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/placeholder.png');">
                <?php
                } else {
                ?>
                  <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/projects/<?php echo $lstproimage[$i] ?>');">
                <?php
                }
                $i++;
                ?>
                    <!-- <div class="listing-box-image-label">Featured</div> -->
                  </div>
                  <!-- /.listing-box-image -->
                  <div class="listing-box-title">
                    <h3><a href="<?php echo siteURL;?>/project/detail/<?php echo $project->id ?>">
                    <?php 
                    if(appLang == "_vi")
                      echo $project->name_vi;
                    else
                      echo $project->name_en;
                    ?>
                    </a></h3>
                    <!-- <h4>$ 40.000</h4> -->
                  </div>
                  </a>
                  <!-- /.listing-box-title -->
                  <div class="listing-box-content">
                    <dl>
                      <dt><i class="fa fa-home" aria-hidden="true"></i><span class="listing-box-content-title">{{config(appLang.'.strInvestor')}}:</span></dt>
                      <dd><?php echo $project->investor;?></dd>
                      <dt><i class="fa fa-map-marker" aria-hidden="true"></i><span class="listing-box-content-title">{{config(appLang.'.strAddress')}}:</span></dt>
                      <dd><?php echo $project->address;?></dd>
                      <dt><i class="fa fa-usd" aria-hidden="true"></i><span class="listing-box-content-title">{{config(appLang.'.strSalePrice')}}:</span></dt>
                      <dd><?php echo $project->sell_price;?></dd>
                      <dt><i class="fa fa-usd" aria-hidden="true"></i><span class="listing-box-content-title">{{config(appLang.'.strRentPrice')}}:</span></dt>
                      <dd><?php echo $project->lease_price;?></dd>
                    </dl>
                  </div>
                  <!-- /.listing-box-cotntent -->
                </div>
              </div>
            </div>
            <?php
              }
            }?>
            <div class="pagination-wrapper">
              <ul class="pagination">
                {!! $lstProjects->render() !!}
              </ul>
              <!-- /.pagination -->
            </div>
            <!-- /.pagination-wrapper -->
          </div>
        </div>
        @include('side-bar');
      </div>
    </div>
  </section>
@stop
