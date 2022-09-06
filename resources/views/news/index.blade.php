@extends('layouts.app')

@section('content')
<!-- Begin Site Title
================================================== -->
<div class="container">
	<div class="mainheading">
		<h1 class="sitetitle">Moka</h1>	
		<p class="lead">
			Mỗi giọt cà phê rơi, thời gian như ngừng hẳn lại.
		</p>
	</div>
<!-- End Site Title
================================================== -->

	<!-- Begin Featured
	================================================== -->
	<section class="featured-posts">
	<div class="section-title">
		<h2><span>Nổi bật</span></h2>
	</div>
	<div class="card-columns listfeaturedtag">

		@foreach ($featured as $item)			
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
							<h4 class="card-text text-overflow">{{ $item->introduction }}</h4>
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
			
	</div>
	</section>
	<!-- End Featured
	================================================== -->

	<!-- Begin List Posts
	================================================== -->
	@foreach ($categories as $row)	
	<section class="recent-posts">
		<div class="section-title">
			<h2><span>{{ $row->name }}</span></h2>
		</div>
		<div class="card-columns listrecent">
	
			@foreach ($row->getNewsRelation->take(9) as $key => $item)
					<!-- begin post -->
					<div class="card">
						<a href="{{ route('news.show', ['id' => $item->id]) }}">
							<img class="img-fluid" src="{{ asset('storage/images/'.$item->image) }}"  width="360"  alt="">
						</a>
						<div class="card-block">
							<h2 class="card-title">
								<a href="{{ route('news.show', ['id' => $item->id]) }}">{{ $item->title }}</a>
							</h2>
							<h4 class="card-text text-overflow">{{ $item->introduction }}</h4>
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
	@endforeach
	<!-- End List Posts
	================================================== -->


	<!-- Begin List Posts
	================================================== -->
	<section class="recent-posts">
	<div class="section-title">
		<h2><span>Tất cả</span></h2>
	</div>
	<div class="card-columns listrecent">

		@foreach ($news as $item)
			<!-- begin post -->
			<div class="card">
				<a href="{{ route('news.show', ['id' => $item->id]) }}">
					<img class="img-fluid" src="{{ asset('storage/images/'.$item->image) }}" alt="">
				</a>
				<div class="card-block">
					<h2 class="card-title">
						<a href="{{ route('news.show', ['id' => $item->id]) }}">{{ $item->title }}</a>
					</h2>
					<h4 class="card-text text-overflow">{{ $item->introduction }}</h4>
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
	{{ $news->links() }}
	</section>
	<!-- End List Posts
	================================================== -->
</div>
<!-- /.container -->
@endsection