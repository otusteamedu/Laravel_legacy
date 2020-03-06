(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[39],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuelidate/lib/validators */ "./node_modules/vuelidate/lib/validators/index.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _custom_components_VForm_VSelect__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/custom_components/VForm/VSelect */ "./resources/manager/js/custom_components/VForm/VSelect.vue");
/* harmony import */ var _mixins_base__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/mixins/base */ "./resources/manager/js/mixins/base.js");
/* harmony import */ var _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/mixins/crudMethods */ "./resources/manager/js/mixins/crudMethods.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//





/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'SettingCreate',
  components: {
    VSelect: _custom_components_VForm_VSelect__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_3__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["createMethod"]],
  data: function data() {
    return {
      defaultGroup: {
        title: 'Нет группы',
        value: 0
      },
      storeModule: 'settings',
      responseData: false,
      redirectRoute: {
        name: 'manager.settings.administration'
      }
    };
  },
  validations: {
    displayName: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.displayName.$dirty ? true : !this.isUniqueDisplayName;
      }
    },
    keyName: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.keyName.$dirty ? true : !this.isUniqueKeyName;
      },
      testKey: function testKey(value) {
        return value.trim() === '' ? true : /^([a-z0-9]+[_]?)+[a-z0-9]$/.test(value);
      }
    },
    type: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false
    },
    group: {
      touch: false
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])({
    keyName: function keyName(state) {
      return state.settings.fields.key_name;
    },
    displayName: function displayName(state) {
      return state.settings.fields.display_name;
    },
    type: function type(state) {
      return state.settings.fields.type;
    },
    group: function group(state) {
      return state.settings.fields.group_id;
    },
    types: function types(state) {
      return state.settings.types;
    },
    settingGroups: function settingGroups(state) {
      return state.settingGroups.items;
    }
  }), {
    isUniqueKeyName: function isUniqueKeyName() {
      return !!this.$store.getters['settings/isUniqueKeyName'](this.keyName);
    },
    isUniqueDisplayName: function isUniqueDisplayName() {
      return !!this.$store.getters['settings/isUniqueDisplayName'](this.displayName);
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])({
    indexWithTypesAction: 'settings/indexWithTypes',
    clearFieldsAction: 'settings/clearFields',
    indexGroupsAction: 'settingGroups/index'
  }), {
    onCreate: function onCreate() {
      return this.create({
        sendData: {
          key_name: this.keyName,
          display_name: this.displayName,
          type: this.type,
          group_id: +this.group
        },
        title: this.displayName,
        successText: 'Настройка создана!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.clearFieldsAction();
    this.indexWithTypesAction().then(function () {
      return _this.indexGroupsAction();
    }).then(function () {
      if (!_this.settingGroups.length) _this.$router.push(_this.redirectRoute);

      _this.setPageTitle('Новая настройка');

      _this.responseData = true;
    })["catch"](function () {
      return _this.$router.push(_this.redirectRoute);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=template&id=4894ff82&":
/*!**************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=template&id=4894ff82& ***!
  \**************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.responseData
    ? _c("div", [
        _c("div", { staticClass: "md-layout" }, [
          _c(
            "div",
            { staticClass: "md-layout-item" },
            [
              _c(
                "md-card",
                { staticClass: "mt-0" },
                [
                  _c(
                    "md-card-content",
                    { staticClass: "md-between" },
                    [
                      _c("router-button-link", {
                        attrs: {
                          title: "В администрирование",
                          route: "manager.settings.administration"
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "slide-y-down-transition",
                        {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: !_vm.$v.$invalid,
                              expression: "!$v.$invalid"
                            }
                          ]
                        },
                        [
                          _c("control-button", {
                            on: {
                              click: function($event) {
                                return _vm.onCreate()
                              }
                            }
                          })
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "md-layout" }, [
          _c(
            "div",
            { staticClass: "md-layout-item" },
            [
              _c(
                "md-card",
                [
                  _c("card-icon-header"),
                  _vm._v(" "),
                  _c(
                    "md-card-content",
                    [
                      _c("v-input", {
                        attrs: {
                          title: "Наименование",
                          icon: "title",
                          name: "display_name",
                          vField: _vm.$v.displayName,
                          module: _vm.storeModule,
                          vRules: {
                            required: true,
                            unique: true,
                            minLength: true
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("v-input", {
                        attrs: {
                          title: "Ключ",
                          icon: "code",
                          name: "key_name",
                          vDelay: true,
                          vField: _vm.$v.keyName,
                          module: _vm.storeModule,
                          vRules: {
                            required: true,
                            unique: true,
                            key: true,
                            minLength: true
                          }
                        }
                      }),
                      _vm._v(" "),
                      _vm.types.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Тип",
                              placeholder: "Выберите тип настройки",
                              name: "type",
                              vField: _vm.$v.type,
                              value: _vm.type,
                              options: _vm.types,
                              nameField: "display_name",
                              indexName: "name",
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.settingGroups.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Группа",
                              placeholder: "Выберите группу настройки",
                              name: "group_id",
                              vField: _vm.$v.group,
                              options: _vm.settingGroups,
                              value: _vm.defaultGroup.value,
                              defaultTitle: _vm.defaultGroup.title,
                              defaultValue: _vm.defaultGroup.value,
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e()
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ])
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue":
/*!*************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SettingCreate_vue_vue_type_template_id_4894ff82___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SettingCreate.vue?vue&type=template&id=4894ff82& */ "./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=template&id=4894ff82&");
/* harmony import */ var _SettingCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SettingCreate.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SettingCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SettingCreate_vue_vue_type_template_id_4894ff82___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SettingCreate_vue_vue_type_template_id_4894ff82___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SettingCreate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=template&id=4894ff82&":
/*!********************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=template&id=4894ff82& ***!
  \********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingCreate_vue_vue_type_template_id_4894ff82___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SettingCreate.vue?vue&type=template&id=4894ff82& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingCreate.vue?vue&type=template&id=4894ff82&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingCreate_vue_vue_type_template_id_4894ff82___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingCreate_vue_vue_type_template_id_4894ff82___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);