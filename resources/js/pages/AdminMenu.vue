<template>
    <div class='admin-menu'>
        <router-link class='button admin-menu__button' to='/userlist'>{{ $t('admin_menu.users') }}</router-link>

        <router-link class='button admin-menu__button' to='/products'>{{ $t('admin_menu.products') }}</router-link>

        <router-link class='button admin-menu__button' to='/categories'>{{ $t('admin_menu.categories') }}</router-link>

        <router-link class='button admin-menu__button' to='/categiry_groups'>{{ $t('admin_menu.category_groups') }}</router-link>
 
        <router-link class='button admin-menu__button' to='/order_statuses'>{{ $t('admin_menu.order_statuses') }}</router-link>

        <router-link class='button admin-menu__button' to='/colors'>{{ $t('admin_menu.colors') }}</router-link>

        <router-link class='button admin-menu__button' to='/materials'>{{ $t('admin_menu.materials') }}</router-link>

        <router-link class='button admin-menu__button' to='/guarantees'>{{ $t('admin_menu.guarantees') }}</router-link>    
    </div>
</template>

<script>
export default {
    name: 'admin_menu'
}
</script>
