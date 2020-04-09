(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[41],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
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
//
//





/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'SettingEdit',
  components: {
    VSelect: _custom_components_VForm_VSelect__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_3__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["updateMethod"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["deleteMethod"]],
  props: {
    id: {
      type: [Number, String],
      required: true
    }
  },
  data: function data() {
    return {
      defaultGroup: {
        title: 'Нет группы',
        value: 0
      },
      storeModule: 'settings',
      responseData: false,
      controlSaveVisibilities: false,
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
        return value.trim() === '' && !this.$v.displayName.$dirty ? true : !this.isUniqueDisplayNameEdit;
      }
    },
    keyName: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.keyName.$dirty ? true : !this.isUniqueKeyNameEdit;
      },
      testKey: function testKey(value) {
        return value.trim() === '' ? true : /^([a-z0-9]+[_]?)+[a-z0-9]$/.test(value);
      }
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
    isUniqueKeyNameEdit: function isUniqueKeyNameEdit() {
      return !!this.$store.getters['settings/isUniqueKeyNameEdit'](this.keyName, this.id);
    },
    isUniqueDisplayNameEdit: function isUniqueDisplayNameEdit() {
      return !!this.$store.getters['settings/isUniqueDisplayNameEdit'](this.displayName, this.id);
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])({
    getItemsWithTypesAction: 'settings/getItemsWithTypes',
    getItemAction: 'settings/getItem',
    getGroupsAction: 'settingGroups/getItems'
  }), {
    onUpdate: function onUpdate() {
      return this.update({
        sendData: {
          formData: {
            key_name: this.keyName,
            display_name: this.displayName,
            group_id: this.group
          },
          id: this.id
        },
        title: this.displayName,
        successText: 'Настройка обновлена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    },
    onDelete: function onDelete() {
      return this["delete"]({
        payload: this.id,
        title: this.displayName,
        alertText: "\u043D\u0430\u0441\u0442\u0440\u043E\u0439\u043A\u0443 \xAB".concat(this.name, "\xBB"),
        successText: 'Настройка удалена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.getItemsWithTypesAction().then(function () {
      return _this.getItemAction(_this.id);
    }).then(function () {
      return _this.getGroupsAction();
    }).then(function () {
      if (!_this.settingGroups.length) _this.$router.push(_this.redirectRoute);

      _this.setPageTitle(_this.displayName);

      _this.responseData = true;
    }).then(function () {
      _this.$v.$reset();

      _this.controlSaveVisibilities = true;
    })["catch"](function () {
      return _this.$router.push(_this.redirectRoute);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=template&id=618b3910&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=template&id=618b3910& ***!
  \************************************************************************************************************************************************************************************************************************************/
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
                          route: _vm.redirectRoute.name
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "div",
                        [
                          _c(
                            "slide-y-down-transition",
                            {
                              directives: [
                                {
                                  name: "show",
                                  rawName: "v-show",
                                  value:
                                    _vm.controlSaveVisibilities &&
                                    _vm.$v.$anyDirty &&
                                    !_vm.$v.$invalid,
                                  expression:
                                    "controlSaveVisibilities && $v.$anyDirty && !$v.$invalid"
                                }
                              ]
                            },
                            [
                              _c("control-button", {
                                attrs: { title: "Сохранить" },
                                on: { click: _vm.onUpdate }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("control-button", {
                            staticClass: "md-danger",
                            attrs: { title: "Удалить", icon: "delete" },
                            on: {
                              click: function($event) {
                                return _vm.onDelete()
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
                          value: _vm.displayName,
                          vField: _vm.$v.displayName,
                          differ: true,
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
                          value: _vm.keyName,
                          vField: _vm.$v.keyName,
                          vDelay: true,
                          differ: true,
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
                      _vm.settingGroups.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Группа",
                              placeholder: "Выберите группу настройки",
                              name: "group_id",
                              value: _vm.group,
                              vField: _vm.$v.group,
                              differ: true,
                              options: _vm.settingGroups,
                              defaultTitle: _vm.defaultGroup.title,
                              defaultValue: _vm.defaultGroup.value,
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _c("h4", { staticClass: "card-title mb-0" }, [
                        _vm._v("Тип")
                      ]),
                      _vm._v(" "),
                      _c("h3", { staticClass: "mt-0" }, [
                        _c("small", [_vm._v(_vm._s(_vm.type))])
                      ])
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

/***/ "./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue":
/*!***********************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SettingEdit_vue_vue_type_template_id_618b3910___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SettingEdit.vue?vue&type=template&id=618b3910& */ "./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=template&id=618b3910&");
/* harmony import */ var _SettingEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SettingEdit.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SettingEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SettingEdit_vue_vue_type_template_id_618b3910___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SettingEdit_vue_vue_type_template_id_618b3910___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SettingEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=template&id=618b3910&":
/*!******************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=template&id=618b3910& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingEdit_vue_vue_type_template_id_618b3910___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SettingEdit.vue?vue&type=template&id=618b3910& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Settings/SettingEdit.vue?vue&type=template&id=618b3910&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingEdit_vue_vue_type_template_id_618b3910___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SettingEdit_vue_vue_type_template_id_618b3910___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);