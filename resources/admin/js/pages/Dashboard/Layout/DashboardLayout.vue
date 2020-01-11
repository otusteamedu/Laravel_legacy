<template>
    <div
        class="wrapper"
        :class="[
      { 'nav-open': $sidebar.showSidebar },
      { rtl: $route.meta.rtlActive }
    ]"
    >
        <notifications />
        <side-bar
            :active-color="sidebarBackground"
            :background-image="sidebarBackgroundImage"
            :data-background-color="sidebarBackgroundColor"
        >
            <user-menu />
            <mobile-menu />
            <template slot="links">
                <sidebar-item :link="{name: 'Панель управления', icon: 'dashboard', path: '/manager/dashboard'}" />
                <sidebar-item :link="{name: 'Конфигурация', icon: 'settings', path: '/manager/settings'}" />
                <sidebar-item :link="{name: 'Изображения', icon: 'image', path: '/manager/images'}" />
                <sidebar-item :link="{name: 'Магазин', icon: 'local_mall', path: '/manager/store'}">
                    <sidebar-item :link="{name: 'Доставка', icon: 'local_mall', path: '/manager/store/delivery'}" />
                </sidebar-item>
                <sidebar-item :link="{name: 'Каталог', icon: 'category'}">
                    <sidebar-item :link="{name: 'Темы', path: '/manager/catalog/categories/topics'}" />
                    <sidebar-item :link="{name: 'Цвета', path: '/manager/catalog/categories/colors'}" />
                    <sidebar-item :link="{name: 'Интерьеры', path: '/manager/catalog/categories/interiors'}" />
                    <sidebar-item :link="{name: 'Теги', path: '/manager/catalog/tags'}" />
                    <sidebar-item :link="{name: 'Владельцы', path: '/manager/catalog/owners'}" />
                </sidebar-item>
                <sidebar-item :link="{name: 'Фактуры', icon: 'style', path: '/manager/textures'}" />
                <sidebar-item :link="{name: 'Пользователи', icon: 'people', path: '/manager/users'}" />
                <sidebar-item :link="{name: 'Роли', icon: 'business_center', path: '/manager/roles'}" />
                <sidebar-item :link="{name: 'Привилегии', icon: 'vpn_key', path: '/manager/permissions'}" />
            </template>
        </side-bar>
        <div class="main-panel">
            <top-navbar />
            <div
                :class="{ content: !$route.meta.hideContent }"
                @click="toggleSidebar"
            >
                <zoom-center-transition :duration="200" mode="out-in">
                    <!-- your content here -->
                    <router-view />
                </zoom-center-transition>
            </div>
            <content-footer v-if="!$route.meta.hideFooter" />
        </div>
    </div>
</template>
<script>
  /* eslint-disable no-new */
  import PerfectScrollbar from "perfect-scrollbar";
  import "perfect-scrollbar/css/perfect-scrollbar.css";

  function hasElement(className) {
    return document.getElementsByClassName(className).length > 0;
  }

  function initScrollbar(className) {
    if (hasElement(className)) {
      new PerfectScrollbar(`.${className}`);
    } else {
      // try to init it later in case this component is loaded async
      setTimeout(() => {
        initScrollbar(className);
      }, 100);
    }
  }

  import TopNavbar from "./TopNavbar.vue";
  import ContentFooter from "./ContentFooter.vue";
  import MobileMenu from "./Extra/MobileMenu.vue";
  import FixedPlugin from "../../FixedPlugin.vue";
  import UserMenu from "./Extra/UserMenu.vue";
  import {ZoomCenterTransition} from "vue2-transitions";

  export default {
    components: {
      TopNavbar,
      ContentFooter,
      MobileMenu,
      FixedPlugin,
      UserMenu,
      ZoomCenterTransition
    },
    data() {
      return {
        sidebarBackgroundColor: "black",
        sidebarBackground: "green",
        sidebarBackgroundImage: "./img/sidebar-2.jpg",
        sidebarMini: true,
        sidebarImg: true
      };
    },
    methods: {
      toggleSidebar() {
        if (this.$sidebar.showSidebar) {
          this.$sidebar.displaySidebar(false);
        }
      },
      minimizeSidebar() {
        if (this.$sidebar) {
          this.$sidebar.toggleMinimize();
        }
      }
    },
    mounted() {
      let docClasses = document.body.classList;
      let isWindows = navigator.platform.startsWith("Win");
      if (isWindows) {
        // if we are on windows OS we activate the perfectScrollbar function
        initScrollbar("sidebar");
        initScrollbar("sidebar-wrapper");
        initScrollbar("main-panel");

        docClasses.add("perfect-scrollbar-on");
      } else {
        docClasses.add("perfect-scrollbar-off");
      }
    },
    watch: {
      sidebarMini() {
        this.minimizeSidebar();
      }
    }
  };
</script>
<style lang="scss">
    $scaleSize: 0.95;
    @keyframes zoomIn95 {
        from {
            opacity: 0;
            transform: scale3d($scaleSize, $scaleSize, $scaleSize);
        }
        to {
            opacity: 1;
        }
    }

    .main-panel .zoomIn {
        animation-name: zoomIn95;
    }

    @keyframes zoomOut95 {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
            transform: scale3d($scaleSize, $scaleSize, $scaleSize);
        }
    }

    .main-panel .zoomOut {
        animation-name: zoomOut95;
    }
</style>
