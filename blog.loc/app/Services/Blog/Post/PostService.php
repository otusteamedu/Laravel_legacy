<?php

namespace App\Services\Blog\Post;


use App\Models\Post\Post;

class PostService
{
    public function getPosts(array $filter)
    {
        $posts = Post::get();

        return $posts;
    }

    public function addPost($data)
    {
        $title = $data['title'];
        if (isset($data['image'])) {
            $image = $data['image'];
        } else {
            $image = null;
        }

        if (isset($data['shortText'])) {
            $shortText = $data['shortText'];
        } else {
            $shortText = mb_strimwidth($data['text'], 0, 200, "...");
        }

        $text = $data['text'];

        if (isset($data['keywords'])) {
            $keywords = $data['keywords'];
        } else {
            $keywords = null;
        }

        $userId = 1;
        $categoryId = 0;
        $publishDate = null;

        $post = Post::addPost(
            $title,
            $image,
            $shortText,
            $text,
            $keywords,
            $userId,
            $categoryId,
            $publishDate
        );

        return $post;
    }

    public function getStatuses()
    {
        $statuses = [];
        $statuses[Post::STATUS_DRAFT] = Post::STATUS_DRAFT;
        $statuses[Post::STATUS_PLANNED] = Post::STATUS_PLANNED;
        $statuses[Post::STATUS_PUBLISHED] = Post::STATUS_PUBLISHED;

        return $statuses;
    }
}