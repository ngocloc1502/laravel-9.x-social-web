<div class="col-md-12 p-0">
    <a href="{{ route('blog.show', ['id' => $post->id, '#images-0']) }}">
        <img src="{{ asset('storage/images/'.$post->getImagesRelation[0]->image) }}" class="rounded img-thumbnail" alt="...">    
    </a>
</div>