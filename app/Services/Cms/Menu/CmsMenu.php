<?php

namespace App\Services\Cms\Menu;

use App\Models\Page\Page;
use App\Models\Post\Comment;
use App\Models\Post\Post;
use App\Models\Post\Rubric;
use App\Models\Setting\Setting;
use App\Models\User\Group;
use App\Models\User\Right;
use App\Models\User\User;
use App\Policies\Abilities;
use Lavary\Menu\Builder;
use Lavary\Menu\Menu;
use Lavary\Menu\Item;
use \Illuminate\Http\Request;

/**
 * Класс генерации меню в административной части
 * Class CmsMenu
 * @package App\Services\Cms\Menu
 */
class CmsMenu
{
    /** @var Menu  */
    protected $menu;

    /** @var Request  */
    protected $request;

    /** @var array[]  */
    protected const CMS_TREE = [
        [
            'name' => 'cms.title',
            'url' => 'cms.index',
            'id' => 'main',
            'children' => [
                [
                    'name' => 'cms.page.title.index',
                    'url' => 'cms.pages.index',
                    'id' => 'pages',
                    'class' => 'nav-header',
                    'permission' => Abilities::VIEW_ANY,
                    'permissionModules' => [Page::class],
                    'children' => [
                        [
                            'name' => 'cms.page.title.create',
                            'url' => 'cms.pages.create',
                            'id' => 'createPage',
                            'onlyBread' => true
                        ],
                        [
                            'name' => 'cms.page.title.show',
                            'url' => 'cms.pages.show',
                            'id' => 'showPage',
                            'onlyBread' => true
                        ],
                        [
                            'name' => 'cms.page.title.edit',
                            'url' => 'cms.pages.edit',
                            'id' => 'editPage',
                            'onlyBread' => true
                        ],
                    ]
                ],
                [
                    'name' => 'cms.post.title.index',
                    'id' => 'mainNews',
                    'class' => 'nav-header',
                    'permission' => Abilities::VIEW_ANY,
                    'permissionModules' => [
                        Post::class,
                        Comment::class,
                        Rubric::class,
                    ],
                    'children' => [
                        [
                            'name' => 'cms.post.title.index',
                            'url' => 'cms.posts.index',
                            'id' => 'posts',
                            'class' => 'nav-item',
                            'permission' => Abilities::VIEW_ANY,
                            'permissionModules' => [
                                Post::class,
                            ],
                            'children' => [
                                [
                                    'name' => 'cms.post.title.create',
                                    'id' => 'createPost',
                                    'url' => 'cms.posts.create',
                                    'onlyBread' => true
                                ],
                                [
                                    'name' => 'cms.post.title.show',
                                    'id' => 'showPost',
                                    'url' => 'cms.posts.show',
                                    'onlyBread' => true,
                                ],
                                [
                                    'name' => 'cms.post.title.edit',
                                    'id' => 'editPost',
                                    'url' => 'cms.posts.edit',
                                    'onlyBread' => true,
                                ],
                            ],
                        ],
                        [
                            'name' => 'cms.rubric.title.index',
                            'url' => 'cms.rubrics.index',
                            'id' => 'rubrics',
                            'class' => 'nav-item',
                            'permission' => Abilities::VIEW_ANY,
                            'permissionModules' => [
                                Rubric::class,
                            ],
                            'children' => [
                                [
                                    'name' => 'cms.rubric.title.create',
                                    'id' => 'createRubric',
                                    'url' => 'cms.rubrics.create',
                                    'onlyBread' => true
                                ],
                                [
                                    'name' => 'cms.rubric.title.show',
                                    'id' => 'showRubric',
                                    'url' => 'cms.rubrics.show',
                                    'onlyBread' => true,
                                ],
                                [
                                    'name' => 'cms.rubric.title.edit',
                                    'id' => 'editRubric',
                                    'url' => 'cms.rubrics.edit',
                                    'onlyBread' => true,
                                ],
                            ],
                        ],
                        [
                            'name' => 'cms.comment.title.index',
                            'url' => 'cms.comments.index',
                            'id' => 'comments',
                            'class' => 'nav-item',
                            'permission' => Abilities::VIEW_ANY,
                            'permissionModules' => [
                                Comment::class,
                            ],
                            'children' => [
                                [
                                    'name' => 'cms.comment.title.create',
                                    'id' => 'createComment',
                                    'url' => 'cms.comments.create',
                                    'onlyBread' => true
                                ],
                                [
                                    'name' => 'cms.comment.title.show',
                                    'id' => 'showComment',
                                    'url' => 'cms.comments.show',
                                    'onlyBread' => true,
                                ],
                                [
                                    'name' => 'cms.comment.title.edit',
                                    'id' => 'editComment',
                                    'url' => 'cms.comments.edit',
                                    'onlyBread' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'cms.user.title.index',
                    'id' => 'mainUsers',
                    'class' => 'nav-header',
                    'permission' => Abilities::VIEW_ANY,
                    'permissionModules' => [
                        User::class,
                        Group::class,
                        Right::class,
                    ],
                    'viewedBread' => true,
                    'children' => [
                        [
                            'name' => 'cms.user.title.index',
                            'url' => 'cms.users.index',
                            'id' => 'users',
                            'class' => 'nav-item',
                            'permission' => Abilities::VIEW_ANY,
                            'permissionModules' => [
                                User::class,
                            ],
                            'viewedBread' => true,
                            'children' => [
                                [
                                    'name' => 'cms.user.title.create',
                                    'id' => 'createUser',
                                    'url' => 'cms.users.create',
                                    'onlyBread' => true
                                ],
                                [
                                    'name' => 'cms.user.title.show',
                                    'id' => 'showUser',
                                    'url' => 'cms.users.show',
                                    'onlyBread' => true,
                                ],
                                [
                                    'name' => 'cms.user.title.edit',
                                    'id' => 'editUser',
                                    'url' => 'cms.users.edit',
                                    'onlyBread' => true,
                                ],
                            ],
                        ],
                        [
                            'name' => 'cms.group.title.index',
                            'url' => 'cms.groups.index',
                            'id' => 'groups',
                            'class' => 'nav-item',
                            'permission' => Abilities::VIEW_ANY,
                            'permissionModules' => [
                                Group::class,
                            ],
                            'children' => [
                                [
                                    'name' => 'cms.group.title.create',
                                    'id' => 'createGroup',
                                    'url' => 'cms.groups.create',
                                    'onlyBread' => true
                                ],
                                [
                                    'name' => 'cms.group.title.show',
                                    'id' => 'showGroup',
                                    'url' => 'cms.groups.show',
                                    'onlyBread' => true,
                                ],
                                [
                                    'name' => 'cms.group.title.edit',
                                    'id' => 'editGroup',
                                    'url' => 'cms.groups.edit',
                                    'onlyBread' => true,
                                ],
                            ],
                        ],
                        [
                            'name' => 'cms.right.title.index',
                            'url' => 'cms.rights.index',
                            'id' => 'rights',
                            'class' => 'nav-item',
                            'permission' => Abilities::VIEW_ANY,
                            'permissionModules' => [
                                Right::class,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'cms.settings.title.index',
                    'url' => 'cms.settings.index',
                    'id' => 'settings',
                    'class' => 'nav-header',
                    'permission' => Abilities::VIEW_ANY,
                    'permissionModules' => [
                        Setting::class,
                    ],
                ],
            ],
        ],
    ];

    /**
     * CmsMenu constructor.
     * @param Menu $menu
     * @param Request $request
     */
    public function __construct(Menu $menu, Request $request)
    {
        $this->menu = $menu;
        $this->request = $request;
    }

    /**
     * создаем меню
     */
    public function createMenu(): void
    {
        $this->menu
        ->make('cmsMenu', function (Builder $menu) {
            $this->makeMenu($menu, static::CMS_TREE);
        });
    }

    /**
     * Проверяем права для отображения пункта меню
     * @param Item $item
     * @return bool
     */
    protected function itemFilter(array $item): bool
    {
        if (isset($item['permission'])) {
            foreach ($item['permissionModules'] as $module) {
                if (\Auth::user()->can($item['permission'], $module)) {
                    return true;
                }
            }
            return false;
        }

        return true;
    }

    /**
     * @param Builder $menu
     * @param array $tree
     * @param string $id
     */
    public function makeMenu(Builder $menu, array $tree, string $id = ''): void
    {
        foreach ($tree as $item) {
            $ability = $this->itemFilter($item);

            if ($ability === false && isset($item['viewedBread'])) {
                $item['onlyBread'] = true;
                $item['url'] = null;
                $ability = true;
            }

            if ($ability === false) {
                continue;
            }

            $params = [
                'id' => $item['id'],
                'class' => $item['class'] ?? '',
                'onlyBread' => $item['onlyBread'] ?? null,
            ];

            if ($params['onlyBread'] === null && isset($item['url'])) {
                $params['url'] = route($item['url']);
            } elseif (
                $params['onlyBread'] === true
                && $this->request->route()->getName() === $item['url']
            ) {
                $params['url'] = $this->request->url();
            }

            $mainMenu = $id ? $menu->find($id) : $menu;
            $mainMenu->add(__($item['name']), $params);


            if (isset($item['children'])) {
                $this->makeMenu($menu, $item['children'], $item['id']);
            }
        }
    }
}