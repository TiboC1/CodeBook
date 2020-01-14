@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8">
            <header><h3>What is on your mind?</h3></header>
         
            <div class="card">
                  <div class="card-header">
                  <div class="input-group">
                      <input type="text" name= "title" class="form-control" placeholder="Title">
                      
                     
                    </div>
                    <form action="{{ route('create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="2" placeholder="Your Post"></textarea>

<div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="title" id="new-post" rows="5" placeholder="Your Post"></textarea>

                </div>
                
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <input type="file" name= "image" class="form-control" placeholder="Image">
            <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Create Post</button>
            
                      </div>
            </form>
        
         </div>
                  
                 
                  <ul class="list-group card-list-group">
                    <li class="list-group-item py-5">
                      <div class="media">
                        <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>
                        <div class="media-body">
                          <div class="media-heading">
                            <small class="float-right text-muted">4 min</small>
                            <h5>Peter Richards</h5>
                          </div>
                          <div>
                            Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras
                            justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient montes,
                            nascetur ridiculus mus.
                          </div>
                          <ul class="media-list">
                            <li class="media mt-4">
                              <div class="media-object avatar mr-4" style="background-image: url(demo/faces/female/17.jpg)"></div>
                              <div class="media-body">
                                <strong>Debra Beck: </strong>
                                Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus
                                auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                              </div>
                            </li>
                            <li class="media mt-4">
                              <div class="media-object avatar mr-4" style="background-image: url(demo/faces/male/32.jpg)"></div>
                              <div class="media-body">
                                <strong>Jack Ruiz: </strong>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                                amet risus.
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item py-5">
                      <div class="media">
                        <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>
                        <div class="media-body">
                          <div class="media-heading">
                            <small class="float-right text-muted">12 min</small>
                            <h5>Peter Richards</h5>
                          </div>
                          <div>
                            Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis
                            parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                          </div>
                        </div>
                      </div>
                    </li>
        </div>
        
     
               
     
          

@endsection

