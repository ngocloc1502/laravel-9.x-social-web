@extends('layouts.app')

@section('content')
<!-- Begin Author Posts
================================================== -->
<div class="graybg authorpage">
	<div class="container">
        <div class="listrecent listrelated">
            <div class="authorpostbox">
                @if(session()->get('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="section-title">
                            <h2><span>Tạo bài viết</span></h2>
                        </div>
                        <form method="POST" action="{{ route('blog.create') }}" aria-label="{{ __('Upload') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label text-md-left">{{ __('Tải ảnh lên') }}</label>
                                <div class="col-md-10">
                                  <input type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photos[]" id="photo" multiple>
                                  @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                  @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating col-12 p-0 my-2">
                                    <textarea class="form-control" name="content" placeholder="Leave a content here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Hãy viết gì đó...</label>
                                </div>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                              <div class="col-md-12 offset-md-12 p-0">
                                  <button type="submit" class="btn btn-primary btn-block">
                                      {{ __('Đăng bài') }}
                                  </button>
                              </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
		<div class="listrecent listrelated">
            @foreach ($blogs as $post)
				<!-- begin post -->
				<div class="authorpostbox">
					<div class="card">
                        <div class="row m-0">
                            @if ($post->getImagesRelation->count() < 6) 
                                @include('images.layout-'.$post->getImagesRelation->count())
                            @else
                                @include('images.layout-5')
                            @endif
                        </div>						
                        <div class="card-block">
							@if ($post->getImagesRelation->count() == 0)
                                <h2 class="card-title"><a href="{{ route('blog.show', ['id' => $post->id]) }}">
                                    {{ $post->content }}
                                </a></h2>
                            @else
                                <h4 class="card-text"><a href="{{ route('blog.show', ['id' => $post->id]) }}">
                                    {{ $post->content }}
                                </a></h4>
                            @endif
              				
							<div class="metafooter">
								<div class="wrapfooter">
                                    <span class="meta-footer-thumb">
                                        <a href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.$post->getUserRelation->avatar) }}" alt="Sal"></a>
                                    </span>
                                    <span class="author-meta">
                                        <span class="post-name"><a href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}">{{ $post->getUserRelation->name }}</a></span><br/>
                                        <span class="post-date">{{ $post->created_at->format('d M Y - H:i') }}</span>
                                    </span>
                                    <span class="post-read-more"><a href="{{ route('blog.createLike', ['id' => $post->id]) }}" title="Read Story">
                                        <span>
                                            @if ($post->getUserLikesRelation->where('id', Auth::id())->count())
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 4.248c-3.148-5.402-12-3.825-12 2.944 0 4.661 5.571 9.427 12 15.808 6.43-6.381 12-11.147 12-15.808 0-6.792-8.875-8.306-12-2.944z"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.28 3c3.236.001 4.973 3.491 5.72 5.031.75-1.547 2.469-5.021 5.726-5.021 2.058 0 4.274 1.309 4.274 4.182 0 3.442-4.744 7.851-10 13-5.258-5.151-10-9.559-10-13 0-2.676 1.965-4.193 4.28-4.192zm.001-2c-3.183 0-6.281 2.187-6.281 6.192 0 4.661 5.57 9.427 12 15.808 6.43-6.381 12-11.147 12-15.808 0-4.011-3.097-6.182-6.274-6.182-2.204 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248z"/></svg>
                                            @endif
                                        </span>
                                    </a></span>
                                    <span class="post-read-more h6 p-1">
                                        {{ $post->get_user_likes_relation_count }}
                                    </span>
                                </div>
							</div>

                            <div class="section-title">
                                <h2><span></span></h2>
                            </div>

                            <div class="row post-top-meta">
                                <div class="col-md-2">
                                    <a href="{{ route('profile.show', ['id' => Auth::id()]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}" alt="Sal"></a>
                                </div>
                                <div class="col-md-10">
                                    <a class="link-dark" href="{{ route('profile.show', ['id' => Auth::id()]) }}">
                                        <b>{{ Auth::user()->name}}</b>
                                    </a>
                                    
                                    <div class="row">
                                        <form method="POST" action="{{ route('blog.createComment', ['id' => $post->id]) }}" aria-label="{{ __('Comment') }}" accept-charset="UTF-8">
                                            @csrf
                                            <div class="form-floating col-12 p-0 my-2">
                                                <textarea class="form-control" name="contentComments" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">Bình luận</label>
                                            </div>
                                            <div class="col-12 p-0">
                                                <button type="submit" class="btn btn-primary">Gửi</button>
                                            </div>	
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @foreach ($post->getCommentAlive->take(3) as $item)
                                <div class="row post-top-meta">
                                    <div class="col-md-2">
                                        <a href="{{ route('profile.show', ['id' => $item->getUserRelation->id]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.$item->getUserRelation->avatar) }}" alt="Sal"></a>
                                    </div>
                                    <div class="col-md-10">
                                        <a class="link-dark" href="{{ route('profile.show', ['id' => $item->getUserRelation->id]) }}">{{ $item->getUserRelation->name }}</a>
                                        
                                        @if (Auth::id() === $item->user_id)
                                            <div class="btn-group float-right">
                                                <a class="btn p-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-4.5 14c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm4.5 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm4.5 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5z"/></svg>
                                                </a>
                                                
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                    <button type="button" class="dropdown-item btnEdit" id="{{ $item->id }}">{{ __('Sửa bình luận') }}</button>

                                                    <button type="button" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('deleteBlog-commnent').submit();">
                                                        {{ __('Xóa bình luận') }}
                                                    </button>
                                                    <form id="deleteBlog-commnent" action="{{ route('blog.deleteComment', ['postId' => $post->id, 'commentId' => $item->id]) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                                    
                                        <div class="bd-example">
                                            <figure id="txtComment-{{ $item->id }}">
                                                <blockquote class="blockquote">
                                                <p>{{ $item->content }}</p>
                                                </blockquote>
                                                <figcaption class="blockquote-footer">
                                                    <span class="post-date">{{ $item->created_at }}</span>
                                                </figcaption>
                                            </figure>

                                            {{-- Hidden --}}
                                            <div class="row" id="formComment-{{ $item->id }}" style="display: none;">
                                                <form method="POST" action="{{ route('blog.updateComment', ['postId' => $post->id, 'commentId' => $item->id]) }}" aria-label="{{ __('Comment') }}" accept-charset="UTF-8">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-floating col-12 p-0 my-2">
                                                        <textarea class="form-control" name="contentComments" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{ $item->content }}</textarea>
                                                        <label for="floatingTextarea2">Bình luận</label>
                                                    </div>
                                                    <div class="col-12 p-0">
                                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
						</div>
					</div>
				</div>
				<!-- end post -->
            @endforeach

		</div>
        {{ $blogs->links() }}
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	$('.btnEdit').click(function(e) {
		var id = $(this).attr('id');

		$('#txtComment-'+id).hide();
		$('#formComment-'+id).show();
	});
</script>
<!-- End Author Posts
================================================== -->
@endsection