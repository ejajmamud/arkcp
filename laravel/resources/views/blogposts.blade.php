
@extends('layouts.admin')
@section('admincontent')

<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Posts</h1>
        <div class="section-header-button">
          <a href="/admin/create-post" class="btn btn-primary">Add New</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">All Posts</div>
        </div>
      </div>
      <div class="section-body">
        <p class="section-title">
          You can manage all posts, such as editing, deleting and more.
        </p>

        {{-- <div class="row">
          <div class="col-12">
            <div class="card mb-0">
              <div class="card-body">
                <ul class="nav nav-pills">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">All <span class="badge badge-white">5</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Draft <span class="badge badge-primary">1</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Trash <span class="badge badge-primary">0</span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div> --}}
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <!--<div class="card-header">
                <h4>All Posts</h4>
              </div> -->
              <div class="card-body">
                <div class="float-left">
                  {{-- <select class="form-control selectric">
                    <option>Action For Selected</option>
                    <option>Move to Draft</option>
                    <option>Delete Pemanently</option>
                  </select> --}}
                </div>
                <div class="float-right">
                  <form>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search">
                      <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>
                        #
                      </th>
                      <th>Title</th>
                      {{-- <th>Featured Image</th> --}}
                      <th>Action</th>
                    </tr>
                    @foreach( $posts as $post )
                        <tr>
                        <td>
                            {{$loop-> index+1 }}
                        </td>
                        <td><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
                        </td>

                        <td>
                            <a href="{{ url('edit/'.$post->slug)}}" class="btn btn-success text-white">Edit Post</a>
                            <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
                        </td>
                        </tr>
                    @endforeach
                  </table>
                </div>
                <div class="float-right">
                  <nav>
                    <ul class="pagination">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
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



@endsection
