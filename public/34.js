(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[34],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
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
/* harmony import */ var _config__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @/config */ "./resources/manager/js/config/index.js");
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
  name: 'UserCreate',
  components: {
    VSelect: _custom_components_VForm_VSelect__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_3__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["createMethod"]],
  data: function data() {
    return {
      responseData: false,
      redirectRoute: {
        name: 'manager.users'
      },
      storeModule: 'users',
      defaultRole: _config__WEBPACK_IMPORTED_MODULE_5__["default"].DEFAULT_ROLE
    };
  },
  validations: {
    name: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2)
    },
    email: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      email: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["email"],
      touch: false,
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.email.$dirty ? true : !this.isUniqueEmail;
      }
    },
    password: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(6)
    },
    passwordConfirmation: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      sameAsPassword: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["sameAs"])('password'),
      touch: false
    },
    roles: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])({
    name: function name(state) {
      return state.users.fields.name;
    },
    email: function email(state) {
      return state.users.fields.email;
    },
    publish: function publish(state) {
      return state.users.fields.publish;
    },
    roles: function roles(state) {
      return state.users.fields.roles;
    },
    password: function password(state) {
      return state.users.fields.password;
    },
    passwordConfirmation: function passwordConfirmation(state) {
      return state.users.fields.password_confirmation;
    },
    roleList: function roleList(state) {
      return state.roles.items;
    }
  }), {
    isUniqueEmail: function isUniqueEmail() {
      return !!this.$store.getters['users/isUniqueEmail'](this.email);
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])({
    getItemsAction: 'users/getItems',
    clearFieldsAction: 'users/clearFields',
    getRolesAction: 'roles/getItems',
    updateFieldAction: 'users/updateField'
  }), {
    onCreate: function onCreate() {
      return this.create({
        sendData: {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.passwordConfirmation,
          publish: this.publish,
          roles: this.roles
        },
        title: this.name,
        successText: 'Пользователь создан!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.clearFieldsAction();
    this.getItemsAction().then(function () {
      return _this.getRolesAction();
    }).then(function () {
      _this.updateFieldAction({
        field: 'roles',
        value: _this.defaultRole
      });

      _this.setPageTitle('Новый Пользователь');

      _this.responseData = true;
    })["catch"](function () {
      return _this.$router.push(_this.redirectRoute);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=template&id=4b4ec0d0&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=template&id=4b4ec0d0& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
                [
                  _c(
                    "md-card-content",
                    { staticClass: "md-between" },
                    [
                      _c("router-button-link", {
                        attrs: {
                          title: "К списку пользователей",
                          route: "manager.users"
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
                                return _vm.onCreate("auto-close")
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
        _c(
          "div",
          { staticClass: "md-layout" },
          [
            _c(
              "div",
              {
                staticClass:
                  "md-layout-item md-medium-size-50 md-small-size-100"
              },
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
                            title: "Имя",
                            icon: "person",
                            name: "name",
                            vField: _vm.$v.name,
                            module: _vm.storeModule,
                            vRules: { required: true, minLength: true }
                          }
                        }),
                        _vm._v(" "),
                        _c("v-input", {
                          attrs: {
                            title: "Email",
                            icon: "mail",
                            name: "email",
                            vField: _vm.$v.email,
                            vDelay: true,
                            module: _vm.storeModule,
                            vRules: {
                              required: true,
                              unique: true,
                              email: true,
                              minLength: true
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("v-input", {
                          attrs: {
                            title: "Пароль",
                            icon: "lock",
                            name: "password",
                            type: "password",
                            vField: _vm.$v.password,
                            module: _vm.storeModule,
                            vRules: { required: true, minLength: true }
                          }
                        }),
                        _vm._v(" "),
                        _c("v-input", {
                          attrs: {
                            title: "Подтверждение пароля",
                            icon: "lock",
                            name: "password_confirmation",
                            type: "password",
                            vField: _vm.$v.passwordConfirmation,
                            module: _vm.storeModule,
                            vRules: { required: true, sameAsPassword: true }
                          }
                        }),
                        _vm._v(" "),
                        _c("v-switch", {
                          attrs: {
                            title: "Активен",
                            value: _vm.publish,
                            module: _vm.storeModule
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
            ),
            _vm._v(" "),
            _vm.roleList.length
              ? [
                  _c(
                    "div",
                    {
                      staticClass:
                        "md-layout-item md-medium-size-50 md-small-size-100"
                    },
                    [
                      _c(
                        "md-card",
                        [
                          _c("card-icon-header", {
                            attrs: { icon: "business_center", title: "Роли" }
                          }),
                          _vm._v(" "),
                          _c(
                            "md-card-content",
                            [
                              _vm.roleList.length
                                ? _c("v-select", {
                                    attrs: {
                                      title: "Роль",
                                      placeholder: "Выберите роль",
                                      name: "roles",
                                      value: _vm.roles,
                                      vField: _vm.$v.roles,
                                      options: _vm.roleList,
                                      nameField: "display_name",
                                      indexName: "name",
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
                ]
              : _vm._e()
          ],
          2
        )
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/config/index.js":
/*!**********************************************!*\
  !*** ./resources/manager/js/config/index.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  'DEFAULT_ROLE': 'user'
});

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Users/UserCreate.vue":
/*!*******************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Users/UserCreate.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UserCreate_vue_vue_type_template_id_4b4ec0d0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UserCreate.vue?vue&type=template&id=4b4ec0d0& */ "./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=template&id=4b4ec0d0&");
/* harmony import */ var _UserCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UserCreate.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _UserCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UserCreate_vue_vue_type_template_id_4b4ec0d0___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UserCreate_vue_vue_type_template_id_4b4ec0d0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Users/UserCreate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./UserCreate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=template&id=4b4ec0d0&":
/*!**************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=template&id=4b4ec0d0& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreate_vue_vue_type_template_id_4b4ec0d0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./UserCreate.vue?vue&type=template&id=4b4ec0d0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserCreate.vue?vue&type=template&id=4b4ec0d0&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreate_vue_vue_type_template_id_4b4ec0d0___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreate_vue_vue_type_template_id_4b4ec0d0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);