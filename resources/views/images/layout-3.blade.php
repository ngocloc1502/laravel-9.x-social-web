<div class="col-md-12 p-0">
    <a href="{{ route('blog.show', ['id' => $post->id, '#images-0']) }}">
        <img src="{{ asset('storage/images/'.$post->getImagesRelation[0]->image) }}" class="rounded img-thumbnail" alt="...">
    </a>
</div>
<div class="col-md-6 p-0">
    <a href="{{ route('blog.show', ['id' => $post->id, '#images-1']) }}">
        <img src="{{ asset('storage/images/'.$post->getImagesRelation[1]->image) }}" class="rounded img-thumbnail" alt="...">
    </a>
</div>
<div class="col-md-6 p-0">
    <a href="{{ route('blog.show', ['id' => $post->id, '#images-2']) }}">
        <img src="{{ asset('storage/images/'.$post->getImagesRelation[2]->image) }}" class="rounded img-thumbnail" alt="...">
    </a>
</div>