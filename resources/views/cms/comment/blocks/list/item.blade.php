<?php
    /** @var \App\Models\Post\Comment $comment */
?>
<tr>
    <th scope="row">{{ $comment->id }}</th>
    <td>{{ link_to(route('cms.comments.show', ['comment' => $comment->id]), $comment->short_content) }}</td>
    <td>{{ $comment->post->name }}</td>
    <td>{{ $comment->is_published ? __('cms.yes') : __('cms.no') }}</td>
    <td>{{$comment->created_at->format('d.m.Y H:m:i')}}</td>
</tr>