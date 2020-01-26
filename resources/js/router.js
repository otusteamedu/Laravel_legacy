import VueRouter from 'vue-router';

import SiteLayout from './components/site/Main';

import About from './components/site/About';
import Home from './components/site/Home';
import Features from './components/site/Features';
import Prices from './components/site/Prices';
import Contacts from './components/site/Contacts';

import Registration from './components/auth/Registration';
import Login from './components/auth/Login';
import ForgotPassword from './components/auth/ForgotPassword';

import Terms from './components/site/Terms';

// Admin
import AdminLayout from './components/admin/Layout';
import AdminMain from './components/admin/Main';
// Admin/User
import UserLayout from './components/admin/user/Layout';
import UsersList from './components/admin/user/List';
import UserEdit from './components/admin/user/Edit';
import UserCreate from './components/admin/user/Create';

// Profile - личный кабинет
import ProfileLayout from './components/profile/Layout';
import ProfileMain from './components/profile/Main';
// Profile/Comment
import CommentLayout from './components/profile/comments/Layout';
import CommentList from './components/profile/comments/List';
import CommentEdit from './components/profile/comments/Edit';

const routes = [
    {
        path: '/',
        component: SiteLayout,
        children: [
            {
                path: '',
                name: 'site.home',
                component: Home,
            },
            {
                path: 'about',
                name: 'site.about',
                component: About,
            },
            {
                path: 'features',
                name: 'site.features',
                component: Features,
            },
            {
                path: 'prices',
                name: 'site.prices',
                component: Prices,
            },
            {
                path: 'contacts',
                name: 'site.contacts',
                component: Contacts,
            },
            {
                path: 'registration',
                name: 'site.registration',
                component: Registration,
            },
            {
                path: 'login',
                name: 'site.login',
                component: Login,
            },
            {
                path: 'forgot-password',
                name: 'site.forgot-password',
                component: ForgotPassword,
            },
            {
                path: 'terms',
                name: 'site.terms',
                component: Terms,
            }
        ]
    },
    {
        path: '/admin',
        component: AdminLayout,
        meta: {
            auth: true
        },
        children: [
            {
                path: '',
                name: 'admin.main',
                component: AdminMain
            },
            {
                path: 'user',
                component: UserLayout,
                children: [
                    {
                        path: 'list',
                        name: 'admin.user.list',
                        component: UsersList
                    },
                    {
                        path: 'edit/:id',
                        name: 'admin.user.edit',
                        component: UserEdit
                    },
                    {
                        path: 'create',
                        name: 'admin.user.create',
                        component: UserCreate
                    }
                ]
            }
        ]
    },
    {
        path: '/profile',
        component: ProfileLayout,
        meta: {
            auth: true
        },
        children: [
            {
                path: '',
                name: 'profile.main',
                component: ProfileMain
            },
            {
                path: 'comment',
                component: CommentLayout,
                children: [
                    {
                        path: 'list',
                        name: 'profile.comment.list',
                        component: CommentList
                    },
                    {
                        path: 'edit/:id',
                        name: 'profile.comment.edit',
                        component: CommentEdit
                    },
                ]
            }
        ]
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
