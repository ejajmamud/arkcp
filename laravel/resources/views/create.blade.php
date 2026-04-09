
@extends('layouts.admin')
@section('admincontent')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea'});
  tinymce.init({
    selector : "textarea",
    plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
    toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  });
</script>
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="posts.php" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create New Post</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="posts.php">Posts</a></div>
          <div class="breadcrumb-item">Create New Post</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Create New Post</h2>
        <p class="section-lead">
          On this page you can create a new post and fill in all fields.
        </p>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Write Your Post</h4>
              </div>
              <div class="card-body">
                <form action="/new-post" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                  <div class="col-sm-12 col-md-7">
                    <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name="title" class="form-control" >
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea class="summernote-simple form-control" name='body' style="min-height: 400px;"></textarea>
                  </div>
                </div>
                 <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="file" required class="form-control" />
                    </div>
                  </div>
                </div>
                {{--<div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control inputtags">
                  </div>
                </div> --}}
                {{-- <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric">
                      <option>Publish</option>
                      <option>Draft</option>
                      <option>Pending</option>
                    </select>
                  </div>
                </div> --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>

                    <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
                  </div>
                </div>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="#">Ooisolutions</a>
    </div>
    <div class="footer-right">
      2.3.0
    </div>
  </footer>

  </div>
</div>

