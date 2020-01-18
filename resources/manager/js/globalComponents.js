import DropDown from "./components/Dropdown.vue";
/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */
import { SlideYDownTransition } from 'vue2-transitions'

import CardIconHeader from "@/custom_components/Cards/CardIconHeader";
import VInput from "@/custom_components/VForm/VInput";
import VTextarea from "@/custom_components/VForm/VTextarea";
import VImage from "@/custom_components/VForm/VImage";
import VSwitch from "@/custom_components/VForm/VSwitch";

import RouterButtonLink from "@/custom_components/Buttons/RouterButtonLink";
import ControlButton from "@/custom_components/Buttons/ControlButton";
import UploadButton from "@/custom_components/Buttons/UploadButton";

const GlobalComponents = {
  install(Vue) {
    Vue.component("drop-down", DropDown);
    Vue.component("slide-y-down-transition", SlideYDownTransition);
    Vue.component("card-icon-header", CardIconHeader);
    Vue.component("v-input", VInput);
    Vue.component("v-textarea", VTextarea);
    Vue.component("v-image", VImage);
    Vue.component("v-switch", VSwitch);

    Vue.component("router-button-link", RouterButtonLink);
    Vue.component("control-button", ControlButton);
    Vue.component("upload-button", UploadButton);
  }
};

export default GlobalComponents;
