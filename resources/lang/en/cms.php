<?php
return [
    'index' => 'News CMS',
    'title' => 'Home',
    'menu' => 'Menu',
    'yes' => 'Yes',
    'no' => 'No',
    'actions' => [
        'update' => 'Update',
        'create' => 'Save',
        'destroy' => 'Delete',
        'close' => 'Close',
        'published' => 'Publish',
        'unpublished' => 'Unpublish',
        'logout' => 'Logout',
    ],
    'fields' => [
        'name' => 'Name',
        'title' => 'Title',
        'keywords' => 'Keywords',
        'description' => 'Seo description',
        'content' => 'Content',
        'slug' => 'Character code',
        'created_at' => 'Creation date',
        'updated_at' => 'Update date',
        'published_at' => 'Date of publication',
        'published' => 'Published',
        'user' => 'User',
        'icon' => 'Avatar',
        'image' => 'Image',
    ],
    'page' => [
        'title' => [
            'index' => 'Pages',
            'create' => 'Create page',
            'edit' => 'Page editing',
            'show' => 'View page',
            'destroy' => 'Delete page',
        ],
        'annotation' => [
            'destroy' => 'Are you sure you want to delete the page?',
        ],
        'actions' => [
            'edit' => 'Edit page',
            'add' => 'Add page',
        ],
    ],
    'rubric' => [
        'title' => [
            'index' => 'Categories',
            'create' => 'Create category',
            'edit' => 'Category editing',
            'show' => 'View column',
            'destroy' => 'Delete rubric',
        ],
        'annotation' => [
            'destroy' => 'Are you sure you want to delete the rubric?',
        ],
        'actions' => [
            'edit' => 'Edit category',
            'add' => 'Add category',
        ],
        'fields' => [
            'countPost' => 'Number of news',
        ],
    ],
    'comment' => [
        'title' => [
            'index' => 'Comments',
            'show' => 'View comment',
            'destroy' => 'Delete comment',
            'published' => 'Post a comment',
            'unpublished' => 'Unmark comment',
        ],
        'annotation' => [
            'destroy' => 'Are you sure you want to delete the comment?',
            'published' => 'Are you sure you want to post a comment?',
            'unpublished' => 'Are you sure you want to remove the comment from the publication?',
        ],
        'actions' => [
            'published' => 'Post a comment',
            'unpublished' => 'Un-post comment',
            'open' => 'Go',
        ],
        'fields' => [
            'countPost' => 'Number of news',
            'post' => 'News',
            'shortContent' => 'Comment',
            'answer' => 'Reply to comment',
            'countAnswer' => 'Number of responses',
        ],
    ],
    'right' => [
        'title' => [
            'index' => 'Rights',
        ],
        'fields' => [
            'name' => 'Name of right',
            'right' => 'Right',
        ],
    ],
    'group' => [
        'title' => [
            'index' => 'Groups',
            'create' => 'Create group',
            'edit' => 'Group editing',
            'show' => 'View group',
            'destroy' => 'Delete group',
        ],
        'annotation' => [
            'destroy' => 'Are you sure you want to delete the group?',
        ],
        'actions' => [
            'edit' => 'Edit group',
            'add' => 'Add group',
        ],
        'fields' => [
            'countUsers' => 'Number of users',
            'rights' => 'Rights',
        ],
    ],
    'user' => [
        'title' => [
            'index' => 'Users',
            'create' => 'Create user',
            'edit' => 'Edit user',
            'show' => 'View user',
            'destroy' => 'Delete user',
        ],
        'annotation' => [
            'destroy' => 'Are you sure you want to delete the user?',
        ],
        'actions' => [
            'edit' => 'Edit user',
            'add' => 'Add user',
        ],
        'fields' => [
            'group' => 'Group',
            'name' => 'Full name',
            'email' => 'E-mail',
            'password' => 'Password',
            'confirmPassword' => 'Confirm password',
        ],
    ],
    'post' => [
        'title' => [
            'index' => 'News',
            'create' => 'Create news',
            'edit' => 'Edit news',
            'show' => 'View news',
            'destroy' => 'Delete news',
            'published' => 'Publish news',
            'unpublished' => 'Unpublish news',
        ],
        'annotation' => [
            'destroy' => 'Are you sure you want to delete the news?',
            'published' => 'Are you sure you want to publish the news?',
            'unpublished' => 'Are you sure you want to remove the news from the publication?',
        ],
        'actions' => [
            'edit' => 'Edit news',
            'add' => 'Add news',
        ],
        'fields' => [
            'rubrics' => 'Rubrics',
        ],
    ],
    'settings' => [
        'title' => [
            'index' => 'Settings',
        ],
    ],
];