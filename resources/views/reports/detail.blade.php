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
		<h2><span>Nổi bật</span></h2>
	</div>
	<div class="card-columns listfeaturedtag">

		@foreach ($user->take(4) as $item)			
			<!-- begin post -->
			<div class="card">
				<div class="row">
					<div class="col-md-5 wrapthumbnail">
						<a href="{{ route('profile.show', ['id' => $item->id]) }}">
							<div class="thumbnail" style="background-image:url({{ asset('storage/avatars/'.$item->avatar) }});">
							</div>
						</a>
					</div>
					<div class="col-md-7">
						<div class="card-block">
							<h2 class="card-title"><a href="{{ route('profile.show', ['id' => $item->id]) }}">{{ $item->name }}</a></h2>
							<h4 class="card-text">{{ $item->description }}</h4>
						</div>
					</div>
				</div>
			</div>
			<!-- end post -->
		@endforeach
			
	</div>
	</section>
	<!-- End Featured
	================================================== -->

	<section class="recent-posts">
		<div class="section-title">
			<h2><span>Top blog</span></h2>
		</div>
		<div class="card-columns listrecent">
			@foreach ($blogPosts->where('get_images_relation_count', '>', 0)->take(6) as $key => $post)
                <!-- begin post -->
				<div class="card">
					<a href="{{ route('news.show', ['id' => $post->getImagesRelation[0]->id]) }}">
						<img class="img-fluid img-thumb" src="{{ asset('storage/images/'.$post->getImagesRelation[0]->image) }}" alt="">
					</a>
					<div class="card-block">
						<h2 class="card-title text-overflow"><a href="{{ route('blog.show', ['id' => $post->id]) }}"  maxlength="20">{{ $post->content }}</a></h2>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
									<a href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}"><img class="author-thumb" src="{{ asset('storage/avatars/'.$post->getUserRelation->avatar) }}" alt="Sal"></a>
								</span>
								<span class="author-meta">
									<span class="post-name"><a href="{{ route('profile.show', ['id' => $post->getUserRelation->id]) }}">{{ $post->getUserRelation->name }}</a></span><br/>
									<span class="post-date">{{ $post->updated_at->format('d F Y') }}</span>
								</span>
							</div>
						</div>
					</div>
				</div>
                <!-- end post -->
			@endforeach
		</div>
	</section>

	<section class="recent-posts">
		<div class="section-title">
			<h2><span>Top tin tức</span></h2>
		</div>
		<div class="card-columns listrecent">
	
			@foreach ($newsPosts->take(6) as $key => $item)
				<!-- begin post -->
				<div class="card">
					<a href="{{ route('news.show', ['id' => $item->id]) }}">
						<img class="img-fluid" src="{{ asset('storage/images/'.$item->image) }}" alt="">
					</a>
					<div class="card-block">
						<h2 class="card-title">
							<a href="{{ route('news.show', ['id' => $item->id]) }}">{{ $item->title }}</a>
						</h2>
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
				<!-- end post -->
			@endforeach
	
		</div>
	</section>

</div>
<!-- /.container -->
@endsection