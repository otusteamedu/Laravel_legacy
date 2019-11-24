import DropDown from "./components/Dropdown.vue";
/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */
import { SlideYDownTransition } from 'vue2-transitions'

import CardIconHeader from "@/custom_components/Cards/CardIconHeader";
import VeeInput from "@/custom_components/VeeForm/VeeInput";
import VeeTextarea from "@/custom_components/VeeForm/VeeTextarea";
import VeeImage from "@/custom_components/VeeForm/VeeImage";
import RouterButtonLink from "@/custom_components/Buttons/RouterButtonLink";
import ControlButton from "@/custom_components/Buttons/ControlButton";
import UploadButton from "@/custom_components/Buttons/UploadButton";

const GlobalComponents = {
  install(Vue) {
    Vue.component("drop-down", DropDown);
    Vue.component("slide-y-down-transition", SlideYDownTransition);
    Vue.component("card-icon-header", CardIconHeader);
    Vue.component("vee-input", VeeInput);
    Vue.component("vee-textarea", VeeTextarea);
    Vue.component("vee-image", VeeImage);
    Vue.component("router-button-link", RouterButtonLink);
    Vue.component("control-button", ControlButton);
    Vue.component("upload-button", UploadButton);
  }
};

export default GlobalComponents;
