<div class="col-md-6 p-0">
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
<div class="transparent col-md-6 p-0">
    <a class="text-light" href="{{ route('blog.show', ['id' => $post->id, '#images-3']) }}">
        <img src="{{ asset('storage/images/'.$post->getImagesRelation[4]->image) }}" class="rounded img-thumbnail" alt="...">
        <div class="center">{{ "+".$post->getImagesRelation->skip(4)->count()}}</div>
    </a>
</div>