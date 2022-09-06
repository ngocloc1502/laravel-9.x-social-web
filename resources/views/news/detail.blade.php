@extends('layouts.app')

@section('content')
<!-- Begin Article
================================================== -->
<div class="container">
	<div class="row">
			<!-- Begin Fixed Left Share -->
			<div class="col-md-2 col-xs-12">
				<div class="share d-flex align-items-center flex-column">
					<p>
						Share
					</p>
					<ul>
						<li>
						<a target="_blank" href="https://twitter.com/home?status=http%3A//www.wowthemes.net">
						<svg class="svgIcon-use" width="29" height="29" viewbox="0 0 29 29"><path d="M21.967 11.8c.018 5.93-4.607 11.18-11.177 11.18-2.172 0-4.25-.62-6.047-1.76l-.268.422-.038.5.186.013.168.012c.3.02.44.032.6.046 2.06-.026 3.95-.686 5.49-1.86l1.12-.85-1.4-.048c-1.57-.055-2.92-1.08-3.36-2.51l-.48.146-.05.5c.22.03.48.05.75.08.48-.02.87-.07 1.25-.15l2.33-.49-2.32-.49c-1.68-.35-2.91-1.83-2.91-3.55 0-.05 0-.01-.01.03l-.49-.1-.25.44c.63.36 1.35.57 2.07.58l1.7.04L7.4 13c-.978-.662-1.59-1.79-1.618-3.047a4.08 4.08 0 0 1 .524-1.8l-.825.07a12.188 12.188 0 0 0 8.81 4.515l.59.033-.06-.59v-.02c-.05-.43-.06-.63-.06-.87a3.617 3.617 0 0 1 6.27-2.45l.2.21.28-.06c1.01-.22 1.94-.59 2.73-1.09l-.75-.56c-.1.36-.04.89.12 1.36.23.68.58 1.13 1.17.85l-.21-.45-.42-.27c-.52.8-1.17 1.48-1.92 2L22 11l.016.28c.013.2.014.35 0 .52v.04zm.998.038c.018-.22.017-.417 0-.66l-.498.034.284.41a8.183 8.183 0 0 0 2.2-2.267l.97-1.48-1.6.755c.17-.08.3-.02.34.03a.914.914 0 0 1-.13-.292c-.1-.297-.13-.64-.1-.766l.36-1.254-1.1.695c-.69.438-1.51.764-2.41.963l.48.15a4.574 4.574 0 0 0-3.38-1.484 4.616 4.616 0 0 0-4.61 4.613c0 .29.02.51.08.984l.01.02.5-.06.03-.5c-3.17-.18-6.1-1.7-8.08-4.15l-.48-.56-.36.64c-.39.69-.62 1.48-.65 2.28.04 1.61.81 3.04 2.06 3.88l.3-.92c-.55-.02-1.11-.17-1.6-.45l-.59-.34-.14.67c-.02.08-.02.16 0 .24-.01 2.12 1.55 4.01 3.69 4.46l.1-.49-.1-.49c-.33.07-.67.12-1.03.14-.18-.02-.43-.05-.64-.07l-.76-.09.23.73c.57 1.84 2.29 3.14 4.28 3.21l-.28-.89a8.252 8.252 0 0 1-4.85 1.66c-.12-.01-.26-.02-.56-.05l-.17-.01-.18-.01L2.53 21l1.694 1.07a12.233 12.233 0 0 0 6.58 1.917c7.156 0 12.2-5.73 12.18-12.18l-.002.04z"></path></svg>
						</a>
						</li>
						<li>
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//www.wowthemes.net">
						<svg class="svgIcon-use" width="29" height="29" viewbox="0 0 29 29"><path d="M16.39 23.61v-5.808h1.846a.55.55 0 0 0 .546-.48l.36-2.797a.551.551 0 0 0-.547-.62H16.39V12.67c0-.67.12-.813.828-.813h1.474a.55.55 0 0 0 .55-.55V8.803a.55.55 0 0 0-.477-.545c-.436-.06-1.36-.116-2.22-.116-2.5 0-4.13 1.62-4.13 4.248v1.513H10.56a.551.551 0 0 0-.55.55v2.797c0 .304.248.55.55.55h1.855v5.76c-4.172-.96-7.215-4.7-7.215-9.1 0-5.17 4.17-9.36 9.31-9.36 5.14 0 9.31 4.19 9.31 9.36 0 4.48-3.155 8.27-7.43 9.15M14.51 4C8.76 4 4.1 8.684 4.1 14.46c0 5.162 3.75 9.523 8.778 10.32a.55.55 0 0 0 .637-.543v-6.985a.551.551 0 0 0-.55-.55H11.11v-1.697h1.855a.55.55 0 0 0 .55-.55v-2.063c0-2.02 1.136-3.148 3.03-3.148.567 0 1.156.027 1.597.06v1.453h-.924c-1.363 0-1.93.675-1.93 1.912v1.78c0 .3.247.55.55.55h2.132l-.218 1.69H15.84c-.305 0-.55.24-.55.55v7.02c0 .33.293.59.623.54 5.135-.7 9.007-5.11 9.007-10.36C24.92 8.68 20.26 4 14.51 4"></path></svg>
						</a>
						</li>
					</ul>
					<div class="sep">
					</div>
					<p>
						Luợt xem
					</p>
					<ul>
						<li>
						<a href="">
						{{ $post->get_user_views_relation_count }}
						<br/>
						<svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12.01 20c-5.065 0-9.586-4.211-12.01-8.424 2.418-4.103 6.943-7.576 12.01-7.576 5.135 0 9.635 3.453 11.999 7.564-2.241 4.43-6.726 8.436-11.999 8.436zm-10.842-8.416c.843 1.331 5.018 7.416 10.842 7.416 6.305 0 10.112-6.103 10.851-7.405-.772-1.198-4.606-6.595-10.851-6.595-6.116 0-10.025 5.355-10.842 6.584zm10.832-4.584c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zm0 1c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4z"/></svg>
						</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- End Fixed Left Share -->

		<!-- Begin Post -->
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="mainheading">

				<!-- Begin Top Meta -->
				<div class="row post-top-meta">
					<div class="col-md-2">
						<a href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.$post->getUserRelation->avatar) }}" alt="Sal"></a>
					</div>
					<div class="col-md-8">
						<a class="link-dark" href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}">{{ $post->getUserRelation->name }}</a><a href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}" class="btn follow">Follow</a>
					</div>
					@auth
						<div class="col-md-2">
							<div class="btn-group float-right">
								<a class="btn p-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-4.5 14c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm4.5 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm4.5 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5z"/></svg>
								</a>
								
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
									@foreach ($menu as $row)
										@if ($row->id == 3)	
											<a class="dropdown-item" href="{{ url()->full().$row->uri }}"
												onclick="event.preventDefault();
												document.getElementById('deleteNews-form').submit();">
												{{ $row->title }}
											</a>
											<form id="deleteNews-form" action="{{ route('news.delete', ['id' => $post->id]) }}" method="POST" class="d-none">
												@csrf
												@method('DELETE')
											</form>
										@else
											<a class="dropdown-item" href="{{ url()->full().$row->uri }}">{{ $row->title }}</a>						
										@endif						
									@endforeach
								</div>
							</div>
						</div>
					@endauth
          		<div>
					
				<span class="post-date">{{ $post->updated_at->format('d F Y - H:i') }}</span>
          	</div>
				</div>
				<!-- End Top Menta -->

				<h1 class="posttitle">{{ $post->title }}</h1>

			</div>

			<!-- Begin Featured Image -->
			<img class="featured-image img-fluid" src="{{ asset('storage/images/'.$post->image) }}" alt="">
			<!-- End Featured Image -->

			<!-- Begin Post Content -->
			<div class="article-post">
        		<blockquote>
					{{ $post->introduction }}
				</blockquote>

				{!! $post->content !!}
			</div>
			<!-- End Post Content -->
		</div>
		<!-- End Post -->
		
	</div>
</div>
<!-- End Article
================================================== -->
<div class="hideshare"></div>

<!-- Begin Related
================================================== -->
<div class="graybg">
	<div class="container">
		<div class="mainheading	">
			@foreach ($post->getCommentAlive as $item)
				<div class="row post-top-meta">
					<div class="col-md-2">
						<a href="{{ route('profile.show', ['id' => $item->getUserRelation->id]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.$item->getUserRelation->avatar) }}" alt="Sal"></a>
					</div>
					<div class="col-md-10">
						<a class="link-dark" href="{{ route('profile.show', ['id' => $item->getUserRelation->id]) }}">{{ $item->getUserRelation->name }}</a>

						@auth	
							@if ( Auth::user()->getRoles->where('id', 1)->count() == 1 || Auth::id() == $item->user_id)
								<div class="btn-group float-right">
									<a class="btn p-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-4.5 14c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm4.5 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm4.5 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5z"/></svg>
									</a>
									
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
										<button type="button" class="dropdown-item btnEdit" id="{{ $item->id }}">{{ __('Sửa bình luận') }}</button>

										<button type="button" class="dropdown-item" href="#" onclick="event.preventDefault();
										document.getElementById('deleteNews-commnent').submit();">
											{{ __('Xóa bình luận') }}
										</button>
										<form id="deleteNews-commnent" action="{{ route('news.deleteComment', ['postId' => $post->id, 'commentId' => $item->id]) }}" method="POST" class="d-none">
											@csrf
											@method('DELETE')
										</form>
									</div>
								</div>
							@endif
						@endauth

						<div class="bd-example">
							<figure id="txtComment-{{ $item->id }}">
								<blockquote class="blockquote">
								<p>{{ $item->content }}</p>
								</blockquote>
								<figcaption class="blockquote-footer">
									<span class="post-date">{{ $item->updated_at }}</span>
								</figcaption>
							</figure>

							{{-- Hidden --}}
							<div class="row" id="formComment-{{ $item->id }}" style="display: none;">
								<form method="POST" action="{{ route('news.updateComment', ['postId' => $post->id, 'commentId' => $item->id]) }}" aria-label="{{ __('Comment') }}" accept-charset="UTF-8">
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
			
			@auth				
				<div class="row post-top-meta">
					<div class="col-md-2">
						<a href="{{ route('profile.show', ['id' => Auth::id()]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}" alt="Sal"></a>
					</div>
					<div class="col-md-10">
						<a class="link-dark" href="{{ route('profile.show', ['id' => Auth::id()]) }}">
							<b>{{ Auth::user()->name}}</b>
						</a>
						
						<div class="row">
							<form method="POST" action="{{ route('news.createComment', ['id' => $post->id]) }}" aria-label="{{ __('Comment') }}" accept-charset="UTF-8">
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
			@endauth
		</div>

		<div class="row listrecent listrelated">
		@foreach ($article as $item)          
			<!-- begin post -->
			<div class="col-md-4">
			<div class="card">
				<a href="{{ route('news.show', ['id' => $item->id]) }}">
					<img class="img-fluid img-thumb" src="{{ asset('storage/images/'.$item->image) }}" alt="">
				</a>
				<div class="card-block">
				<h2 class="card-title"><a href="{{ route('news.show', ['id' => $item->id]) }}">{{ $item->title }}</a></h2>
				<div class="metafooter">
					<div class="wrapfooter">
						<span class="meta-footer-thumb">
							<a href="{{ route('profile.show', ['id' => $item->getUserRelation->id]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.$item->getUserRelation->avatar) }}" alt="Sal"></a>
						</span>
						<span class="author-meta">
							<span class="post-name"><a href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}">{{ $item->getUserRelation->name }}</a></span><br/>
							<span class="post-date">{{ $item->updated_at->format('d F Y') }}</span>
						</span>
					</div>
				</div>
				</div>
			</div>
			</div>
			<!-- end post -->
		@endforeach
		</div>
	</div>
</div>
<!-- End Related Posts
================================================== -->

<!-- Begin Twitter Timeline
================================================== -->
<div class="container margtop3rem">
  <a class="twitter-grid" href="https://twitter.com/TwitterDev/timelines/539487832448843776">WowThemesNet Tweets</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>
<!-- End Twitter Timeline
================================================== -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	$('.btnEdit').click(function(e) {
		var id = $(this).attr('id');

		$('#txtComment-'+id).hide();
		$('#formComment-'+id).show();
	});
</script>

@endsection