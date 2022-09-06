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
		<h2><span>{{ $category->name }}</span></h2>
	</div>
	<div class="listfeaturedtag">

		@foreach ($posts as $item)			
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
			
	</div>
	</section>
	<!-- End Featured
	================================================== -->
</div>
<!-- /.container -->
@endsection