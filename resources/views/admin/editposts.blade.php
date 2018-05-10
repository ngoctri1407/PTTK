@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New Posts </h5>
                </div>
                <div class="ibox-content">
                    {!! Form::open(array('url' => generateUrl('admin') . '/news/manage', 'class'=>'search-form', 'files'=>true)) !!}
                    <div class="form-group">
                        <input type="text" name="id" value="{{ $news->id }}" hidden>
                    </div>
                    <div class="form-group">
                        <label>Select Category</label>
                        <select name="category" class="form-control">
                            <option value="1" <?php if($news->category == 1){ echo ' selected="selected"'; }?> >News</option>
                            <option value="2" <?php if($news->category == 2){ echo ' selected="selected"'; }?>>Recruitment</option>
                            <option value="3" <?php if($news->category == 3){ echo ' selected="selected"'; }?>>Advertisement</option>
                            <option value="4" <?php if($news->category == 4){ echo ' selected="selected"'; }?>>PR</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input name="image" type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>English Title</label>
                        <input name="title" value="{{ $news->title_en }}" type="text" placeholder="Enter title..." class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>English Title</label>
                        <input name="titlevi" value="{{ $news->title_vi }}" type="text" placeholder="Enter title..." class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>English Content</label>
                            <textarea name="content" id="content" class="form-control">
                                {{ $news->content_en }}
                            </textarea >
                        <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                        <script>
                            CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Vietnamese Content</label>
                            <textarea name="contentvi" id="contentvi" class="form-control">
                                {{ $news->content_vi }}
                            </textarea >
                        <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                        <script>
                            CKEDITOR.replace( 'contentvi' );
                        </script>
                    </div>
                    <div class="form-group">
                        <a href="{{ generateUrl('/admin/news') }}" class="btn btn-white">Cancel</a>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
