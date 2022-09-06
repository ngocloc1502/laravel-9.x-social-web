@extends('layouts.app')

@section('content')
<!-- Begin Article
================================================== -->
<div class="container">
	<div class="row">

		<!-- Begin Fixed Left Share -->
		<div class="col-md-2 col-xs-12">
			<div class="share d-flex align-items-center flex-column">
				<p>Khiếu nại</p>
				<ul>
					<li>
            {{ $reports->count() }}
					</li>
					<li>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.178 8.333c0-.466-.826-1.333-2.426-1.333-2.502 0-3.408 1.5-6.752 1.5v4.964c1.766.271 3.484.817 4.344 3.802.239.831.39 1.734 1.187 1.734 1.188 0 1.297-2.562.844-4.391.656-.344 1.875-.468 2.489-.442.886.036 1.136-.409 1.136-.745 0-.505-.416-.675-.677-.755-.305-.094-.444-.404-.016-.461.418-.056.63-.328.63-.61 0-.323-.277-.66-.844-.705-.348-.027-.434-.312-.016-.406.351-.08.549-.326.549-.591 0-.314-.279-.654-.913-.771-.383-.07-.421-.445-.016-.477.345-.027.481-.146.481-.313z"/></svg>
					</li>
				</ul>
			</div>
		</div>
		<!-- End Fixed Left Share -->

    <!-- Begin Post -->
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="mainheading">
        <div class="listrecent listrelated">

          @foreach ($reports as $value)
            <!-- begin post -->
            <div class="authorpostbox">
              <div class="card">
                <img class="card-img-top" src="{{ asset('storage/images/'.$value->image->image) }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{ $value->table }}</h5>
                  <p class="card-text">{{ $value->content }}</p>
                </div>
                <ul class="list-group list-group-flush">
                  @foreach ($value->getFormReportRelation as $item)
                    <li class="list-group-item">- {{ $item->name }}</li>
                  @endforeach
  
                </ul>
                <div class="card-body">
                  <a href="{{ url($value->table.'/'.$value->post_id) }}" class="card-link">Xem bài viết</a>
                </div>
              </div>
            </div>
            <!-- end post -->
          @endforeach
  
        </div>
		  </div>
    </div>
    <!-- End Post -->
	</div>
</div>
<!-- End Article
================================================== -->
@endsection