import DashboardLayout from '@/pages/Dashboard/Layout/DashboardLayout.vue'
import Dashboard from '@/pages/Dashboard/Dashboard.vue'

// Image pages
const ImageList = resolve => {
    require.ensure(['@/pages/Dashboard/Images/ImageList.vue'], () => {
        resolve(require('@/pages/Dashboard/Images/ImageList.vue'))
    })
};
const ExcludedImageList = resolve => {
    require.ensure(['@/pages/Dashboard/Images/ExcludedImageList.vue'], () => {
        resolve(require('@/pages/Dashboard/Images/ExcludedImageList.vue'))
    })
};
const ImageEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Images/ImageEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Images/ImageEdit.vue'))
    })
};

// Category pages
const CatalogPanel = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/CatalogPanel.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/CatalogPanel.vue'))
    })
};
const CategoryList = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/Categories/CategoryList.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/Categories/CategoryList.vue'))
    })
};
const CategoryCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/Categories/CategoryCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/Categories/CategoryCreate.vue'))
    })
};
const CategoryEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/Categories/CategoryEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/Categories/CategoryEdit.vue'))
    })
};

// SubCategories
const SubCategoryList = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/SubCategories/SubCategoryList.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/SubCategories/SubCategoryList.vue'))
    })
};
const SubCategoryCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/SubCategories/SubCategoryCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/SubCategories/SubCategoryCreate.vue'))
    })
};
const SubCategoryEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/SubCategories/SubCategoryEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/SubCategories/SubCategoryEdit.vue'))
    })
};
const SubCategoryImageList = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/SubCategories/ImageList.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/SubCategories/ImageList.vue'))
    })
};
const SubCategoryExcludedImageList = resolve => {
    require.ensure(['@/pages/Dashboard/Catalog/SubCategories/ExcludedImageList.vue'], () => {
        resolve(require('@/pages/Dashboard/Catalog/SubCategories/ExcludedImageList.vue'))
    })
};

// Textures
const TextureList = resolve => {
    require.ensure(['@/pages/Dashboard/Textures/TextureList.vue'], () => {
        resolve(require('@/pages/Dashboard/Textures/TextureList.vue'))
    })
};
const TextureCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Textures/TextureCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Textures/TextureCreate.vue'))
    })
};
const TextureEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Textures/TextureEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Textures/TextureEdit.vue'))
    })
};

// Users
const UserList = resolve => {
    require.ensure(['@/pages/Dashboard/Users/UserList.vue'], () => {
        resolve(require('@/pages/Dashboard/Users/UserList.vue'))
    })
};
const UserCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Users/UserCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Users/UserCreate.vue'))
    })
};
const UserEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Users/UserEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Users/UserEdit.vue'))
    })
};

// Roles
const RoleList = resolve => {
    require.ensure(['@/pages/Dashboard/Roles/RoleList.vue'], () => {
        resolve(require('@/pages/Dashboard/Roles/RoleList.vue'))
    })
};
const RoleCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Roles/RoleCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Roles/RoleCreate.vue'))
    })
};
const RoleEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Roles/RoleEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Roles/RoleEdit.vue'))
    })
};

// Permissions
const PermissionList = resolve => {
    require.ensure(['@/pages/Dashboard/Permissions/PermissionList.vue'], () => {
        resolve(require('@/pages/Dashboard/Permissions/PermissionList.vue'))
    })
};
const PermissionCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Permissions/PermissionCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Permissions/PermissionCreate.vue'))
    })
};
const PermissionEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Permissions/PermissionEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Permissions/PermissionEdit.vue'))
    })
};

// Settings
const SettingList = resolve => {
    require.ensure(['@/pages/Dashboard/Settings/SettingList.vue'], () => {
        resolve(require('@/pages/Dashboard/Settings/SettingList.vue'))
    })
};
const SettingAdministrationList = resolve => {
    require.ensure(['@/pages/Dashboard/Settings/SettingAdministrationList.vue'], () => {
        resolve(require('@/pages/Dashboard/Settings/SettingAdministrationList.vue'))
    })
};
const SettingCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Settings/SettingCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Settings/SettingCreate.vue'))
    })
};
const SettingEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Settings/SettingEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Settings/SettingEdit.vue'))
    })
};
const SettingGroupCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Settings/SettingGroupCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Settings/SettingGroupCreate.vue'))
    })
};
const SettingGroupEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Settings/SettingGroupEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Settings/SettingGroupEdit.vue'))
    })
};

// Store
const StorePanel = resolve => {
    require.ensure(['@/pages/Dashboard/Store/StorePanel.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/StorePanel.vue'))
    })
};

// Deliveries
const DeliveryList = resolve => {
    require.ensure(['@/pages/Dashboard/Store/Delivery/DeliveryList.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/Delivery/DeliveryList.vue'))
    })
};
const DeliveryCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Store/Delivery/DeliveryCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/Delivery/DeliveryCreate.vue'))
    })
};
const DeliveryEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Store/Delivery/DeliveryEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/Delivery/DeliveryEdit.vue'))
    })
};

// OrderStatuses
const OrderStatusList = resolve => {
    require.ensure(['@/pages/Dashboard/Store/OrderStatuses/OrderStatusList.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/OrderStatuses/OrderStatusList.vue'))
    })
};
const OrderStatusCreate = resolve => {
    require.ensure(['@/pages/Dashboard/Store/OrderStatuses/OrderStatusCreate.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/OrderStatuses/OrderStatusCreate.vue'))
    })
};
const OrderStatusEdit = resolve => {
    require.ensure(['@/pages/Dashboard/Store/OrderStatuses/OrderStatusEdit.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/OrderStatuses/OrderStatusEdit.vue'))
    })
};

// Orders
const OrderList = resolve => {
    require.ensure(['@/pages/Dashboard/Store/Orders/OrderList.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/Orders/OrderList.vue'))
    })
};
const Order = resolve => {
    require.ensure(['@/pages/Dashboard/Store/Orders/Order.vue'], () => {
        resolve(require('@/pages/Dashboard/Store/Orders/Order.vue'))
    })
};

// Error pages
const Error404 = resolve => {
    require.ensure(['@/pages/Dashboard/Errors/404.vue'], () => {
        resolve(require('@/pages/Dashboard/Errors/404.vue'))
    })
};
const ErrorsLayout = resolve => {
    require.ensure(['@/pages/Dashboard/Errors/ErrorsLayout.vue'], () => {
        resolve(require('@/pages/Dashboard/Errors/ErrorsLayout.vue'))
    })
};

const managerDashboardPage = [
    {
        path: 'dashboard',
        name: 'manager.dashboard',
        components: { default: Dashboard }
    }
];
const managerImagePages = [
    {
        path: 'images',
        name: 'manager.images',
        component: ImageList,
        props: true,
        beforeEnter(to, from, next) {
            to.params.category_type = 'images';
            next();
        }
    },
    {
        path: 'images/:id',
        name: 'manager.images.edit',
        component: ImageEdit,
        props: true
    }
];
const managerCatalogPanel = [
    {
        path: 'catalog',
        name: 'manager.catalog',
        component: CatalogPanel
    }
];
const managerTexturesPages = [
    {
        path: 'textures',
        name: 'manager.textures',
        component: TextureList
    },
    {
        path: 'textures/create',
        name: 'manager.textures.create',
        component: TextureCreate
    },
    {
        path: 'textures/:id',
        name: 'manager.textures.edit',
        component: TextureEdit,
        props: true
    }
];
const managerSettingsPages = [
    {
        path: 'settings',
        name: 'manager.settings',
        component: SettingList
    },
    {
        path: 'settings/administration',
        name: 'manager.settings.administration',
        component: SettingAdministrationList
    },
    {
        path: 'settings/create',
        name: 'manager.settings.create',
        component: SettingCreate
    },
    {
        path: 'settings/:id',
        name: 'manager.settings.edit',
        component: SettingEdit,
        props: true
    },
    {
        path: 'settings/groups/create',
        name: 'manager.settings.groups.create',
        component: SettingGroupCreate
    },
    {
        path: 'settings/groups/:id',
        name: 'manager.settings.groups.edit',
        component: SettingGroupEdit,
        props: true
    }
];
const managerUsersPages = [
    {
        path: 'users',
        name: 'manager.users',
        component: UserList
    },
    {
        path: 'users/create',
        name: 'manager.users.create',
        component: UserCreate,
        props: true
    },
    {
        path: 'users/:id',
        name: 'manager.users.edit',
        component: UserEdit,
        props: true
    }
];
const managerRolesPages = [
    {
        path: 'roles/',
        name: 'manager.roles',
        component: RoleList
    },
    {
        path: 'roles/create',
        name: 'manager.roles.create',
        component: RoleCreate,
        props: true
    },
    {
        path: 'roles/:id',
        name: 'manager.roles.edit',
        component: RoleEdit,
        props: true
    }
];
const managerPermissionsPages = [
    {
        path: 'permissions/',
        name: 'manager.permissions',
        component: PermissionList
    },
    {
        path: 'permissions/create',
        name: 'manager.permissions.create',
        component: PermissionCreate,
        props: true
    },
    {
        path: 'permissions/:id',
        name: 'manager.permissions.edit',
        component: PermissionEdit,
        props: true
    }
];

const managerStorePanel = [
    {
        path: 'store',
        name: 'manager.store',
        component: StorePanel
    }
];

const managerPages = {
    path: '/manager',
    component: DashboardLayout,
    redirect: '/manager/dashboard',
    children: [
        ...managerDashboardPage,
        ...managerImagePages,
        ...managerCatalogPanel,
        ...managerTexturesPages,
        ...managerSettingsPages,
        ...managerUsersPages,
        ...managerRolesPages,
        ...managerPermissionsPages,
        ...managerStorePanel
    ]
};

const managerCategoriesPages = {
    path: '/manager/catalog/categories',
    component: DashboardLayout,
    children: [
        {
            path: ':category_type',
            name: 'manager.catalog.categories.list',
            component: CategoryList,
            props: true
        },
        {
            path: ':category_type/create',
            name: 'manager.catalog.categories.create',
            component: CategoryCreate,
            props: true
        },
        {
            path: ':category_type/:id',
            name: 'manager.catalog.categories.edit',
            component: CategoryEdit,
            props: true
        },
        {
            path: ':category_type/:id/images',
            name: 'manager.catalog.categories.images',
            component: ImageList,
            props: true
        },
        {
            path: ':category_type/:id/images/excluded',
            name: 'manager.catalog.categories.images.excluded',
            component: ExcludedImageList,
            props: true
        }
    ]
};

const managerSubCategoriesPages = {
    path: '/manager/catalog/subcategories',
    component: DashboardLayout,
    children: [
        {
            path: ':category_type',
            name: 'manager.catalog.subcategories.list',
            component: SubCategoryList,
            props: true
        },
        {
            path: ':category_type/create',
            name: 'manager.catalog.subcategories.create',
            component: SubCategoryCreate,
            props: true
        },
        {
            path: ':category_type/:id',
            name: 'manager.catalog.subcategories.edit',
            component: SubCategoryEdit,
            props: true
        },
        {
            path: ':category_type/:id/images',
            name: 'manager.catalog.subcategories.images',
            component: SubCategoryImageList,
            props: true
        },
        {
            path: ':category_type/:id/images/excluded',
            name: 'manager.catalog.subcategories.images.excluded',
            component: SubCategoryExcludedImageList,
            props: true
        }
    ]
};

const managerDeliveriesPages = {
    path: '/manager/store',
    component: DashboardLayout,
    children: [
        {
            path: 'deliveries',
            name: 'manager.store.deliveries',
            component: DeliveryList
        },
        {
            path: 'deliveries/create',
            name: 'manager.store.deliveries.create',
            component: DeliveryCreate
        },
        {
            path: 'deliveries/:id',
            name: 'manager.store.deliveries.edit',
            component: DeliveryEdit,
            props: true
        }
    ]
};

const managerOrderStatusPages = {
    path: '/manager/store',
    component: DashboardLayout,
    children: [
        {
            path: 'order-statuses',
            name: 'manager.store.orderStatuses',
            component: OrderStatusList
        },
        {
            path: 'order-statuses/create',
            name: 'manager.store.orderStatuses.create',
            component: OrderStatusCreate
        },
        {
            path: 'order-statuses/:id',
            name: 'manager.store.orderStatuses.edit',
            component: OrderStatusEdit,
            props: true
        }
    ]
};

const managerOrderPages = {
    path: '/manager/store',
    component: DashboardLayout,
    children: [
        {
            path: 'orders',
            name: 'manager.store.orders',
            component: OrderList
        },
        {
            path: 'orders/:id',
            name: 'manager.store.orders.order',
            component: Order,
            props: true
        }
    ]
};

const managerErrorPages = {
    path: '/manager/errors',
    component: ErrorsLayout,
    children: [
        {
            path: '404',
            name: 'manager.errors.404',
            component: Error404
        }
    ]
};

const routes = [
    managerPages,
    managerCategoriesPages,
    managerSubCategoriesPages,
    managerDeliveriesPages,
    managerOrderPages,
    managerOrderStatusPages,
    managerErrorPages,
    {
        path: '*',
        redirect: {
            name: 'manager.errors.404'
        }
    }
];

export default routes
