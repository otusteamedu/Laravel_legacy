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
import List from './components/admin/user/List';

const routes = [
    {
        path: '/',
        component: SiteLayout,
        children: [
            {
                path: '',
                name: 'site.home',
                component: Home
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
        children: [
            {
                path: '',
                name: 'admin.main',
                component: AdminMain,
            },
            {
                path: 'user',
                component: UserLayout,
                children: [
                    {
                        path: 'list',
                        name: 'admin.user.list',
                        component: List
                    }
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
