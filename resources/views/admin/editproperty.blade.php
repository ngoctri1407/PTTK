@extends('admin.sidebar')
@section('content')
{!! Form::open(array('url' => generateUrl('admin') . '/realestate/manage', 'files'=>true, 'id' =>'form')) !!}

<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>New Property </h5>
      </div>
      <div class="ibox-content">
        <div class="form-group">
          <input type="text" id="id" name="id" value="{{ $property->id_key }}" hidden>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Real Estate Type</label>
            <select name="type" class="form-control">
              <?php
              foreach ($lsttype as $type) {
                if ($type->id == $property->type)
                  echo "<option value='$type->id' selected>$type->name_en ($type->code)</option>";
                
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel blank-panel">
              <div class="panel-heading" style="padding: 0px">
                <div class="panel-options">
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">English</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Vietnamese</a></li>
                  </ul>
                </div>
              </div>
              <div class="panel-body">
                <div class="tab-content">
                  <div id="tab-1" class="tab-pane active">
                    <div class="row">
                      <label>Title</label>
                      <input value="{{ $property->title_en }}" name="title" placeholder="Enter english title..."
                             type="text" class="form-control" required aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>Description</label>
                      <textarea style="min-height: 150px" name="description" id="content" class="form-control" required>
                                                {{ $property->description_en }}
                                            </textarea>
                      <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                      <script>
                        CKEDITOR.replace('content');
                      </script>
                    </div>
                  </div>
                  <div id="tab-2" class="tab-pane">
                    <div class="row">
                      <label>Title</label>
                      <input value="{{ $property->title_vi }}" name="titlevi" placeholder="Enter vietnamese title..."
                             type="text" class="form-control" required aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>Description</label>
                      <textarea style="min-height: 150px" name="descriptionvi" id="contentvi" class="form-control">
                                                {{ $property->description_vi }}
                                            </textarea>
                      <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                      <script>
                        CKEDITOR.replace('contentvi');
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Property Images </h5>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="dropzone" id="dropzoneFileUpload">
            <div id="uploadme" class="fallback">
              <input id="image" name="image" type="file" multiple/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Property Detail </h5>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="form-group col-md-2">
            <label>Area (m2)</label>
            <input value="{{ $property->area }}" placeholder="Example: 1520" name="area" type="text"
                   class="form-control" required="" aria-required="true">
          </div>
          <div class="form-group col-md-2">
            <label>Bed Rooms</label>
            <select name="bedroom" class="form-control">
              <?php
              for ($i = 0; $i < 16; $i++) {
                if ($i == $property->bedroom)
                  echo "<option value='$i' selected>$i</option>";
                else
                  echo "<option value='$i'>$i</option>";
                
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label>Bath Rooms</label>
            <select name="bathroom" class="form-control">
              <?php
              for ($i = 0; $i < 16; $i++) {
                if ($i == $property->bathroom)
                  echo "<option value='$i' selected>$i</option>";
                else
                  echo "<option value='$i'>$i</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label>Price</label>
            <input value="{{ $property->price }}" placeholder="Example: 2000" name="price" type="number"
                   class="form-control" required="" aria-required="true">
          </div>
          <div class="form-group col-md-2">
            <label>Price Type</label>
            <select name="typeprice" class="form-control">
              <?php
              foreach ($lstpricetype as $type) {
                if ($type->id == $property->type_price)
                  echo "<option value='$type->id' selected>$type->name</option>";
                else
                  echo "<option value='$type->id'>$type->name</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label>Status</label>
            <select name="status" class="form-control">
              <?php
              if ($property->status == 1)
                echo "<option value='1' selected>Available</option>";
              else
                echo "<option value='1'>Available</option>";
              
              if ($property->status == 2)
                echo "<option value='2' selected>Sold / Rent out</option>";
              else
                echo "<option value='2'>Sold / Rent out</option>";
              
              if ($property->status == 3)
                echo "<option value='3' selected>Drafts</option>";
              else
                echo "<option value='3'>Drafts</option>";
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Address</label>
            <input value="{{ $property->address }}"
                   placeholder="Floor 1, 2 Hoa Lam Building, Thi Sach Street, District 1, HCMC" name="address"
                   type="text" class="form-control" required="" aria-required="true" id="address">
          </div>
          <div class="form-group col-md-3">
            <label>Township</label>
            <select name="township" class="form-control">
              <?php
              if ($property->township == "Q1")
                echo "<option value='Q1' selected>District 1 (Q1)</option>";
              else
                echo "<option value='Q1'>District 1 (Q1)</option>";
              if ($property->township == "Q2")
                echo "<option value='Q2' selected>District 2 (Q2)</option>";
              else
                echo "<option value='Q2'>District 2 (Q1)</option>";
              if ($property->township == "Q3")
                echo "<option value='Q3' selected>District 3 (Q3)</option>";
              else
                echo "<option value='Q3'>District 3 (Q3)</option>";
              if ($property->township == "Q4")
                echo "<option value='Q4' selected>District 4 (Q4)</option>";
              else
                echo "<option value='Q4'>District 4 (Q4)</option>";
              if ($property->township == "Q5")
                echo "<option value='Q5' selected>District 5 (Q5)</option>";
              else
                echo "<option value='Q5'>District 5 (Q5)</option>";
              if ($property->township == "Q6")
                echo "<option value='Q6' selected>District 6 (Q6)</option>";
              else
                echo "<option value='Q6'>District 6 (Q6)</option>";
              if ($property->township == "Q7")
                echo "<option value='Q7' selected>District 7 (Q7)</option>";
              else
                echo "<option value='Q7'>District 7 (Q7)</option>";
              if ($property->township == "Q8")
                echo "<option value='Q8' selected>District 8 (Q8)</option>";
              else
                echo "<option value='Q8'>District 8 (Q8)</option>";
              if ($property->township == "Q9")
                echo "<option value='Q9'>District 9 (Q9)</option>";
              else
                echo "<option value='Q9'>District 9 (Q9)</option>";
              if ($property->township == "Q10")
                echo "<option value='Q10' selected>District 10 (Q10)</option>";
              else
                echo "<option value='Q10'>District 10 (Q10)</option>";
              if ($property->township == "Q11")
                echo "<option value='Q11' selected>District 11 (Q11)</option>";
              else
                echo "<option value='Q11'>District 11 (Q11)</option>";
              if ($property->township == "Q12")
                echo "<option value='Q12' selected>District 12 (Q12)</option>";
              else
                echo "<option value='Q12'>District 12 (Q12)</option>";
              if ($property->township == "Q12")
                echo "<option value='Q12' selected>District 12 (Q12)</option>";
              else
                echo "<option value='Q12'>District 12 (Q12)</option>";
              if ($property->township == "QTD")
                echo " <option value='QTD' selected>Thu Duc District (QTD)</option>";
              else
                echo "<option value='QTD'>Thu Duc District (QTD)</option>";
              if ($property->township == "QGV")
                echo "<option value='QGV' selected>Go Vap District (QGV)</option>";
              else
                echo " <option value='QGV'>Go Vap District (QGV)</option>";
              if ($property->township == "QBT")
                echo "<option value='QBT' selected>Binh Thanh District (QBT)</option>";
              else
                echo "<option value='QBT'>Binh Thanh District (QBT)</option>";
              if ($property->township == "QTB")
                echo "<option value='QTB' selected>Tan Binh District (QTB)</option>";
              else
                echo "<option value='QTB'>Tan Binh District (QTB)</option>";
              if ($property->township == "QTP")
                echo "<option value='QTP' selected>Tan Phu District (QTP)</option>";
              else
                echo "<option value='QTP'>Tan Phu District (QTP)</option>";
              if ($property->township == "QPN")
                echo "<option value='QPN' selected>Phu Nhuan District (QPN)</option>";
              else
                echo "<option value='QPN'>Phu Nhuan District (QPN)</option>";
              if ($property->township == "QBT2")
                echo "<option value='QBT2' selected>Binh Tan District (QBT2)</option>";
              else
                echo "<option value='QBT2'>Binh Tan District (QBT2)</option>";
              
              ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Date of availibility</label>
            <input value="{{ $property->available_time }}" id="datepicker" name="availabletime" placeholder="dd/MM/yyyy"
                   type="text" class="form-control" required="" aria-required="true">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Author </label>
            <select name="author" class="form-control">
              <?php
              foreach ($lstauthor as $author) {
                if ($author->id == $property->id_author)
                  echo "<option value='$author->id' selected>$author->name</option>";
                else
                  echo "<option value='$author->id'>$author->name</option>";
                
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Project </label>
            <select name="project" class="form-control">
              
              <?php
              if ($projectselected == null) {
                echo "<option value='0' selected>None</option>";
              } else {
                echo "<option value='0'>None</option>";
              }
              foreach ($lstproject as $project) {
                if (count($projectselected) > 0) {
                  if ($project->id == $projectselected[0]->id_project)
                    echo "<option value='$project->id' selected>$project->name_en</option>";
                  else
                    echo "<option value='$project->id'>$project->name_en</option>";
                } else {
                  echo "<option value='$project->id'>$project->name_en</option>";
                }
                
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Amenities & Furnished Detail </h5>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="col-md-6">
            <label>Inside Facilities</label>
            <div class="select-checkbox"><a><span onclick="selectCheckbox('all', 'inside-amenities-checkbox');">Select All</span></a>
              / <a><span onclick="selectCheckbox('none', 'inside-amenities-checkbox');">Select None</span></a></div>
            <div class="amenities" style="overflow-y: scroll; max-height: 350px; border: 1px solid #e5e6e7">
              <div class="col-md-12">
                <?php
                foreach ($lstinsideamenities as $amenities) {
                  $check = false;
                  foreach ($lstamenitiesselected as $selected) {
                    if ($amenities->id == $selected->id_amenities) {
                      echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' checked class='inside-amenities-checkbox'> $amenities->name_en<br/></div>";
                      $check = true;
                      break;
                    }
                  }
                  if ($check == false)
                    echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' class='inside-amenities-checkbox'> $amenities->name_en<br/></div>";
                }
                ?>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <label>Nearby Facilities</label>
            <div class="select-checkbox"><a><span onclick="selectCheckbox('all', 'nearby-amenities-checkbox');">Select All</span></a>
              / <a><span onclick="selectCheckbox('none', 'nearby-amenities-checkbox');">Select None</span></a></div>
            <div class="amenities" style="overflow-y: scroll; max-height: 350px; border: 1px solid #e5e6e7">
              <div class="col-md-12">
                <?php
                foreach ($lstnearbyamenities as $amenities) {
                  $check = false;
                  foreach ($lstamenitiesselected as $selected) {
                    if ($amenities->id == $selected->id_amenities) {
                      echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' checked class='nearby-amenities-checkbox'> $amenities->name_en<br/></div>";
                      $check = true;
                      break;
                    }
                  }
                  if ($check == false)
                    echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' class='nearby-amenities-checkbox'> $amenities->name_en<br/></div>";
                }
                ?>
              </div>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6" style="margin-top: 15px">
            <label>Furnished </label>
            <select id="selectedfurnished" name="selectedfurnished" onchange="showFurnished()" class="form-control">
              <?php
              if (count($lstfurnishedselected) != 0) {
                echo "<option value='0'>Unfurnished</option>";
                echo "<option value='1' selected>Furniture Features</option>";
                // echo "<option value='2'>Partially furnished</option>";
              } else {
                echo "<option value='0' selected>Unfurnished</option>";
                echo "<option value='1' >Furniture Features</option>";
                // echo "<option value='2'>Partially furnished</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-12" id="showfurnished" style="<?php
          if (count($lstfurnishedselected) == 0) {
            echo "display:none";
          }
          ?>">
            <div class="select-checkbox"><a><span
                    onclick="selectCheckbox('all', 'furniture-checkbox');">Select All</span></a> / <a><span
                    onclick="selectCheckbox('none', 'furniture-checkbox');">Select None</span></a></div>
            <div class="amenities" style="overflow-y: scroll; max-height: 300px; border: 1px solid #e5e6e7">
              <div class="col-md-12">
                <?php
                foreach ($lstfurnished as $furnished) {
                  $check = false;
                  if (count($lstfurnishedselected) > 0) {
                    foreach ($lstfurnishedselected as $selected) {
                      if ($furnished->id == $selected->id_furnished) {
                        echo "<div class='col-md-4'><input type='checkbox' name='furnished[]' value='$furnished->id' checked class='furniture-checkbox'> $furnished->name_en<br/></div>";
                        $check = true;
                        break;
                      }
                    }
                    if ($check == false)
                      echo "<div class='col-md-4'><input type='checkbox' name='furnished[]' value='$furnished->id' class='furniture-checkbox'> $furnished->name_en<br/></div>";
                  } else {
                    echo "<div class='col-md-4'><input type='checkbox' name='furnished[]' value='$furnished->id' class='furniture-checkbox'> $furnished->name_en<br/></div>";
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="hr-line-dashed" style="border-color: green"></div>
        <div class="form-group">
          <a href="{{ generateUrl('/admin/realestate') }}" class="btn btn-white">Cancel</a>
          <input id="submit" type="submit" class="btn btn-primary" value="Save">
        </div>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
@stop
@section('page-script')

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{ generateAsset('public/js/jquery-2.1.1.js') }}"></script>
<link rel="stylesheet" href="{{ generateAsset('public/css/dropzone.css') }}">
<script src="{{ generateAsset('public/js/dropzone.js') }}"></script>
<script type="text/javascript">
  $(function () {
    $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
  });

  function showFurnished () {
    if ($("#selectedfurnished").val() == 0) {
      $("#showfurnished").hide();
    }
    else {
      $("#showfurnished").show();
    }

  }

  var baseUrl = "{{ generateUrl('/') }}";
  var token = "{{ Session::getToken() }}";
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("div#dropzoneFileUpload", {
    url: baseUrl + "/admin/realestate/edit/editupload",
    params: {
      _token: token,
      id: $("#id").val()
    },
    autoProcessQueue: true,
    addRemoveLinks: true,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    removedfile: function (file) {
      x = confirm('Do you want to delete?');
      if (!x) return false;
      else {
        console.log(file.name);
        var token = "{{ Session::getToken() }}";
        $.ajax({
          type: "POST",
          url: '././deleteimage',
          data: {
            _token: token,
            id: $("#id").val(),
            id_images: file.name,
          },
          success: function (data) {

          }
        });
        location.reload();
      }
    },
    init: function () {
      this.on("complete", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
          Command: toastr["success"]("Update image property success !!!")

          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          location.reload();
        }
      });

      let token = "{{ Session::getToken() }}";
      let count = 0;

      $.ajax({
        type: "POST",
        url: '././listimage',
        data: {
          _token: token,
          id: $("#id").val(),
        },
        success: function (data) {
          $(data.lstimage).each(function (key, value) {
            var mockFile = {
              name: value.id_images,
              size: 30165,
              type: 'image/jpeg',
              accepted: true,
              status: Dropzone.ADDED
            };
            myDropzone.emit("addedfile", mockFile);
            myDropzone.createThumbnailFromUrl(mockFile, "{{ generateUrl('/public') }}/images/properties/" + value.id_images);
            mockFile.previewElement.classList.add('dz-success');
            mockFile.previewElement.classList.add('dz-complete');
            myDropzone.files.push(mockFile);
            count++;
          });
        }
      });
    }
  });
  Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
  };

</script>

@stop
