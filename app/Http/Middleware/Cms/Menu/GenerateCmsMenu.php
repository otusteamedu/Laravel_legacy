<?php

namespace App\Http\Middleware\Cms\Menu;

use App\Services\Menu\CmsMenu;
use Closure;
use Lavary\Menu\Builder;

class GenerateCmsMenu
{
    /**
     * @todo Переделать по человечески
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('cmsMenu', function (Builder $menu) use ($request) {
            $routeName = $request->route()->getName();
            $menu->add('Главная', ['id' => 'main', 'url' => route('cms.index'), 'class' => 'nav-header']);
            $main = $menu->find('main');
            $main->add('Страницы', ['id' => 'pages', 'url' => route('cms.pages.index'), 'class' => 'nav-header']);

            $main->add('Новости', ['id' => 'mainNews', 'class' => 'nav-header']);
            $news = $menu->find('mainNews');
            $news->add('Новости', ['id' => 'posts', 'url' => route('cms.posts.index'), 'class' => 'nav-item']);
            $news->add('Рубрики', ['id' => 'rubrics', 'url' => route('cms.rubrics.index'), 'class' => 'nav-item']);
            $news->add('Коментарии', ['id' => 'comments', 'url' => route('cms.comments.index'), 'class' => 'nav-item']);

            $main->add('Пользователи', ['id' => 'mainUsers', 'class' => 'nav-header']);
            $mainUsers = $menu->find('mainUsers');
            $mainUsers->add('Пользователи', ['id' => 'users', 'url' => route('cms.users.index'), 'class' => 'nav-item']);
            $mainUsers->add('Группы', ['id' => 'groups', 'url' => route('cms.groups.index'), 'class' => 'nav-item']);
            $mainUsers->add('Права', ['id' => 'rights', 'url' => route('cms.rights.index'), 'class' => 'nav-item']);

            $main->add('Настройки', ['id' => 'settings', 'url' => route('cms.settings.index'), 'class' => 'nav-header']);

            switch ($routeName) {
                case 'cms.pages.create':
                    $pages = $menu->find('pages');
                    $pages->add('Добавление страницы', ['id' => 'addPages', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.pages.show':
                    $pages = $menu->find('pages');
                    $pages->add('Просмотр страницы', ['id' => 'viewPages', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.pages.edit':
                    $pages = $menu->find('pages');
                    $pages->add('Редактирование страницы', ['id' => 'editPages', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.posts.create':
                    $posts = $menu->find('posts');
                    $posts->add('Добавление новости', ['id' => 'addPost', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.posts.show':
                    $posts = $menu->find('posts');
                    $posts->add('Просмотр новости', ['id' => 'viewPost', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.posts.edit':
                    $posts = $menu->find('posts');
                    $posts->add('Редактирование новости', ['id' => 'editPost', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.rubrics.create':
                    $rubrics = $menu->find('rubrics');
                    $rubrics->add('Добавление Рубрики', ['id' => 'addRubric', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.rubrics.show':
                    $rubrics = $menu->find('rubrics');
                    $rubrics->add('Просмотр рубрики', ['id' => 'viewRubric', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.rubrics.edit':
                    $rubrics = $menu->find('rubrics');
                    $rubrics->add('Редактирование рубрики', ['id' => 'editRubric', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.comments.create':
                    $comments = $menu->find('comments');
                    $comments->add('Добавление коментария', ['id' => 'addComment', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.comments.show':
                    $comments = $menu->find('comments');
                    $comments->add('Просмотр коментария', ['id' => 'viewComment', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.comments.edit':
                    $comments = $menu->find('comments');
                    $comments->add('Редактирование коментария', ['id' => 'editComment', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.users.create':
                    $users = $menu->find('users');
                    $users->add('Добавление пользователя', ['id' => 'addUser', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.users.show':
                    $users = $menu->find('users');
                    $users->add('Просмотр пользователя', ['id' => 'viewUser', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.users.edit':
                    $users = $menu->find('users');
                    $users->add('Редактирование пользователя', ['id' => 'editUser', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.groups.create':
                    $groups = $menu->find('groups');
                    $groups->add('Добавление группы', ['id' => 'addGroup', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.groups.show':
                    $groups = $menu->find('groups');
                    $groups->add('Просмотр группы', ['id' => 'viewGroup', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.groups.edit':
                    $groups = $menu->find('groups');
                    $groups->add('Редактирование группы', ['id' => 'editGroup', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.rights.create':
                    $rights = $menu->find('rights');
                    $rights->add('Добавление права', ['id' => 'addRight', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.rights.show':
                    $rights = $menu->find('rights');
                    $rights->add('Просмотр права', ['id' => 'viewRight', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
                case 'cms.rights.edit':
                    $rights = $menu->find('rights');
                    $rights->add('Редактирование права', ['id' => 'editRight', 'url' => $request->url(), 'onlyBread' => true]);
                    break;
            }
        });
        return $next($request);
    }
}
