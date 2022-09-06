@extends('layouts.app')

@section('content')
<!-- Begin Site Title
================================================== -->
<div class="container">
<!-- End Site Title
================================================== -->

	<!-- Begin Featured
	================================================== -->
	<section class="featured-posts">
	<div class="section-title">
		<h2><span>Tin tức</span></h2>
	</div>
	<div class="listfeaturedtag">

		@foreach ($newsPosts as $item)			
			<!-- begin post -->
			<div class="card">
				<div class="row">
					<div class="col-md-5 wrapthumbnail">
						<a href="{{ route('news.show', ['id' => $item->id]) }}">
							<div class="thumbnail" style="background-image:url({{ asset('storage/images/'.$item->image) }});">
							</div>
						</a>
					</div>
					<div class="col-md-7">
						<div class="card-block">
							<h2 class="card-title"><a href="{{ route('news.show', ['id' => $item->id]) }}">{{ $item->title }}</a></h2>
							<h4 class="card-text">{{ $item->introduction }}</h4>
							<div class="metafooter">
								<div class="wrapfooter">
									<span class="meta-footer-thumb">
										<a href="{{ route('profile.show', ['id' => $item->getUserRelation->id]) }}">
											<img class="author-thumb" src="{{ asset('storage/avatars/'.$item->getUserRelation->avatar) }}" alt="Sal">
										</a>
									</span>
									<span class="author-meta">
									<span class="post-name">
										<a href="{{ route('profile.show', ['id' => $item->getUserRelation->id]) }}">{{ $item->getUserRelation->name }}</a>
									</span><br/>
									<span class="post-date">{{ $item->created_at->format('d F Y') }}</span>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end post -->
		@endforeach
		
        {{ $newsPosts->links() }}
	</div>

	<section class="featured-posts">
        <div class="section-title">
            <h2><span>Tin tức</span></h2>
        </div>
            <div class="listrecent listrelated pt-4">
            @foreach ($blogPosts->take(5) as $post)
                <!-- begin post -->
                <div class="authorpostbox">
                    <div class="card">
                        <div class="row m-0">
                            @if ($post->getImagesRelation->count() != 0)
                                @include('images.layout-'.$post->getImagesRelation->count())
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

            {{ $blogPosts->links() }}
        </div>
	</section>
	<!-- End Featured
	================================================== -->
</div>
<!-- /.container -->
@endsection