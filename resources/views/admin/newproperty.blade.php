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
          <input type="text" name="id" value="0" hidden>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Real Estate Type: </label>
            <input type="radio" style="margin-left: 20px" id="property_type_1" name="propertytype" value="1" checked/>
            Rent
            <input type="radio" style="margin-left: 20px" id="property_type_2" name="propertytype" value="2"/> Sales
            <select id="type" name="type" class="form-control">
              <?php
              foreach ($lsttype as $type) {
                if ($type->type == 1)
                  echo "<option value='$type->id'>$type->name_en ($type->code)</option>";
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
                      <input id="title" name="title" placeholder="Enter english title..." type="text"
                             class="form-control" aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>Description</label>
                      <textarea style="min-height: 150px" name="description" id="description" class="form-control"
                                required>
                                            </textarea>
                      <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                      <script>
                        CKEDITOR.replace('description');
                      </script>
                    </div>
                  </div>
                  <div id="tab-2" class="tab-pane">
                    <div class="row">
                      <label>Title</label>
                      <input id="titlevi" name="titlevi" placeholder="Enter vietnamese title..." type="text"
                             class="form-control" aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>Description</label>
                      <textarea style="min-height: 150px" name="descriptionvi" id="descriptionvi" class="form-control">
                                            </textarea>
                      <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                      <script>
                        CKEDITOR.replace('descriptionvi');
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
            <input placeholder="Example: 1520" id="area" name="area" type="text" class="form-control"
                   aria-required="true">
          </div>
          <div class="form-group col-md-2">
            <label>Bed Rooms</label>
            <select name="bedroom" class="form-control">
              <?php
              for ($i = 0; $i < 16; $i++) {
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
                echo "<option value='$i'>$i</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label>Price</label>
            <input placeholder="Example: 2000" id="price" name="price" type="number" class="form-control"
                   aria-required="true">
          </div>
          <div class="form-group col-md-2">
            <label>Price Type</label>
            <select name="typeprice" class="form-control">
              <?php
              foreach ($lstpricetype as $type) {
                echo "<option value='$type->id'>$type->name</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label>Status</label>
            <select name="status" class="form-control">
              <option value='1'>Available</option>
              <option value='2'>Sold / Rent out</option>
              <option value='3'>Drafts</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Address</label>
            <input placeholder="Floor 1, 2 Hoa Lam Building, Thi Sach Street, District 1, HCMC" id="address"
                   name="address" type="text" class="form-control" aria-required="true">
          </div>
          <div class="form-group col-md-3">
            <label>Location</label>
            <select name="township" class="form-control">
              <option value='Q1'>District 1 (Q1)</option>
              <option value='Q2'>District 2 (Q2)</option>
              <option value='Q3'>District 3 (Q3)</option>
              <option value='Q4'>District 4 (Q4)</option>
              <option value='Q5'>District 5 (Q5)</option>
              <option value='Q6'>District 6 (Q6)</option>
              <option value='Q7'>District 7 (Q7)</option>
              <option value='Q8'>District 8 (Q8)</option>
              <option value='Q9'>District 9 (Q9)</option>
              <option value='Q10'>District 10 (Q10)</option>
              <option value='Q11'>District 11 (Q11)</option>
              <option value='Q12'>District 12 (Q12)</option>
              <option value='QTD'>Thu Duc District (QTD)</option>
              <option value='QGV'>Go Vap District (QGV)</option>
              <option value='QBT'>Binh Thanh District (QBT)</option>
              <option value='QTB'>Tan Binh District (QTB)</option>
              <option value='QTP'>Tan Phu District (QTP)</option>
              <option value='QPN'>Phu Nhuan District (QPN)</option>
              <option value='QBT2'>Binh Tan District (QBT2)</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Date of availibility</label>
            <input id="datepicker" name="availabletime" placeholder="dd/MM/yyyy" type="text" class="form-control"
                   aria-required="true">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Agent </label>
            <select name="author" class="form-control">
              <?php
              foreach ($lstauthor as $author) {
                echo "<option value='$author->id'>$author->name</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Project </label>
            <select name="project" class="form-control">
              <option value="0">None</option>
              <?php
              foreach ($lstproject as $project) {
                echo "<option value='$project->id'>$project->name_en</option>";
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
              <option value='0'>Unfurnished</option>
              <option value='1'>Furniture Features</option>
              <!-- <option value='2'>Partially furnished</option> -->
            </select>
          </div>
          <div class="form-group col-md-12" id="showfurnished" style="display:none;">
            <div class="select-checkbox"><a><span
                    onclick="selectCheckbox('all', 'furniture-checkbox');">Select All</span></a> / <a><span
                    onclick="selectCheckbox('none', 'furniture-checkbox');">Select None</span></a></div>
            <div class="amenities" style="overflow-y: scroll; max-height: 300px; border: 1px solid #e5e6e7">
              <div class="col-md-12">
                <?php
                foreach ($lstfurnished as $furnished) {
                  echo "<div class='col-md-4'><input type='checkbox' name='furnished[]' value='$furnished->id' class='furniture-checkbox'> $furnished->name_en<br/></div>";
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

<div id="myModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h6 style="font-size: 16px; font-weight: bold" class="modal-title">Processing...</h6>
      </div>
      <div class="modal-body" style="min-height: 100px;">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
          <img style="margin-left: 35px;" src="{{generateAsset('public/images/loading.gif')}}" height="50px"
               width="50px">
        </div>
        <div class="col-md-4">

        </div>

      </div>
    </div>

  </div>
</div>
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
</script>
<script type="text/javascript">
  var baseUrl = "{{ generateUrl('/') }}";
  var token = "{{ Session::getToken() }}";
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("div#dropzoneFileUpload", {
    url: baseUrl + "/admin/realestate/rent/new/upload",
    params: {
      _token: token
    },
    autoProcessQueue: false,
    addRemoveLinks: true,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    init: function () {
      this.on("queuecomplete", function (file) {

        Command: toastr["success"]("Add new property success !!!")

        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        window.location = document.referrer;
      });
    }

  });
  Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",

  };
  $("#submit").click(function (e) {

    if ($("#title").val() == "" | $("#titlevi").val() == "") {

      alert("Title cannot be null");
      return false;
    }
    if (myDropzone.getQueuedFiles().length <= 0) {
      alert("Images cannot be null");
      return false;
    }
    if ($("#area").val() == "") {
      alert("Area cannot be null")
      return false;
    }
    if ($("#price").val() == "") {
      alert("Price cannot be null")
      return false;
    }
    if ($("#address").val() == "") {
      alert("Address cannot be null")
      return false;
    }
    if ($("#datepicker").val() == "") {
      alert("Date of availibility cannot be null");
      return false;
    }

    var frm = $('#form');
    frm.submit(function (ev) {
      $('#myModal').modal('show');
      $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        success: function (data) {
          if (myDropzone.getQueuedFiles().length > 0) {
            myDropzone.on("sending", function (file, xhr, formData) {
              formData.append("id", data);
            });
            myDropzone.processQueue();
          }
          else {
            Command: toastr["success"]("Add new property success !!!")

            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            window.location = document.referrer;
          }

        }
      });

      ev.preventDefault();
    });

  });
  $("#property_type_1, #property_type_2").change(function () {
    var token = "{{ Session::getToken() }}";
    if ($("#property_type_1").is(":checked")) {
      $.ajax({
        type: "POST",
        url: './select',
        data: {
          _token: token,
          type: $("#property_type_1").val(),
        },
        success: function (data) {
          // delete exited items
          $("#type").empty();
          var result = "";
          // add new items
          $(data.data).each(function (key, value) {
            result += "<option value=" + value.id + ">" + value.name_en + " (" + value.code + ")</option>";

          })
          $("#type").append(result);
        }
      });
    }
    else {
      $.ajax({
        type: "POST",
        url: './select',
        data: {
          _token: token,
          type: $("#property_type_2").val(),
        },
        success: function (data) {
          // delete existed items
          $("#type").empty();
          var result = "";
          // delete existed items
          $(data.data).each(function (key, value) {
            result += "<option value=" + value.id + ">" + value.name_en + " (" + value.code + ")</option>";

          })
          $("#type").append(result);
        }
      });
    }
  });
</script>
@stop
