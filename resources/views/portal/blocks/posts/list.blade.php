<?php /** @var \App\Models\Post\Post $post */?>
<div class="col-6 col-md-6 col-sm-6">
    <img src="{{$post->image['path'] . '/' . $post->image['image']}}" alt="{{$post->name}}" class="mw-100 h-auto">
    {{link_to($post->link, $post->name, ['class' => 'btn-link btn-block'])}}
</div>
