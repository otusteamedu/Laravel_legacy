(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[51],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
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
  name: 'UserEdit',
  components: {
    VSelect: _custom_components_VForm_VSelect__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_3__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["updateMethod"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["deleteMethod"]],
  props: {
    id: {
      type: [String, Number],
      required: true
    }
  },
  data: function data() {
    return {
      responseData: false,
      selectedRole: [],
      changePassword: false,
      redirectRoute: {
        name: 'manager.users'
      },
      storeModule: 'users',
      controlSaveVisibilities: false
    };
  },
  validations: {
    name: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2)
    },
    email: {
      email: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["email"],
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.email.$dirty ? true : !this.isUniqueEmailEdit;
      }
    },
    publish: {
      touch: false
    },
    role: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false
    },
    oldPassword: {
      required: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["requiredIf"])(function () {
        return this.isPasswordChange;
      }),
      touch: false
    },
    password: {
      required: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["requiredIf"])(function () {
        return this.isPasswordChange;
      }),
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(6),
      touch: false
    },
    passwordConfirmation: {
      required: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["requiredIf"])(function () {
        return this.isPasswordChange;
      }),
      sameAsPassword: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["sameAs"])('password'),
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
    role: function role(state) {
      return state.users.fields.role;
    },
    oldPassword: function oldPassword(state) {
      return state.users.fields.old_password;
    },
    password: function password(state) {
      return state.users.fields.password;
    },
    passwordConfirmation: function passwordConfirmation(state) {
      return state.users.fields.password_confirmation;
    },
    roles: function roles(state) {
      return state.roles.items;
    }
  }), {
    isUniqueEmailEdit: function isUniqueEmailEdit() {
      return !!this.$store.getters['users/isUniqueEmailEdit'](this.email, this.id);
    },
    isPasswordChange: function isPasswordChange() {
      return this.changePassword;
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])({
    getItemsAction: 'users/getItems',
    getItemAction: 'users/getItem',
    getRolesAction: 'roles/getItems',
    updateField: 'users/updateField'
  }), {
    onChangePassword: function onChangePassword() {
      this.changePassword = true;
    },
    cancelOldPasswordChange: function cancelOldPasswordChange() {
      this.changePassword = false;
      this.updateField('old_password', '');
      this.updateField('password', '');
      this.updateField('password_confirmation', '');
      this.$v.oldPassword.$reset();
      this.$v.password.$reset();
      this.$v.passwordConfirmation.$reset();
    },
    onUpdate: function onUpdate() {
      var updateData = {
        name: this.name,
        email: this.email,
        role: this.role,
        publish: this.publish
      };
      var formData = this.changePassword ? _objectSpread({}, updateData, {
        password: this.password,
        old_password: this.oldPassword,
        password_confirmation: this.passwordConfirmation
      }) : updateData;
      return this.update({
        sendData: {
          formData: formData,
          id: this.id
        },
        title: this.name,
        successText: 'Пользователь обновлен!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    },
    onDelete: function onDelete() {
      return this["delete"]({
        payload: this.id,
        title: this.name,
        alertText: "\u043F\u043E\u043B\u044C\u0437\u043E\u0432\u0430\u0442\u0435\u043B\u044F \xAB".concat(this.name, "\xBB"),
        successText: 'Пользователь удален!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.getItemsAction().then(function () {
      return _this.getRolesAction();
    }).then(function () {
      return _this.getItemAction(_this.id);
    }).then(function () {
      _this.setPageTitle(_this.name);

      _this.selectedRole = _this.role;
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=template&id=4a7e1444&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=template&id=4a7e1444& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
                            on: { click: _vm.onDelete }
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
            {
              staticClass: "md-layout-item md-medium-size-50 md-small-size-100"
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
                          value: _vm.name,
                          vField: _vm.$v.name,
                          differ: true,
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
                          value: _vm.email,
                          vField: _vm.$v.email,
                          differ: true,
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
                      _c("v-switch", {
                        attrs: {
                          title: "Активен",
                          value: _vm.publish,
                          vField: _vm.$v.publish,
                          differ: true,
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
          _c(
            "div",
            {
              staticClass: "md-layout-item md-medium-size-50 md-small-size-100"
            },
            [
              _vm.roles.length
                ? [
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
                            _vm.roles.length
                              ? _c("v-select", {
                                  attrs: {
                                    title: "Роль",
                                    placeholder: "Выберите роль",
                                    name: "role",
                                    options: _vm.roles,
                                    value: _vm.role,
                                    vField: _vm.$v.role,
                                    differ: true,
                                    nameField: "display_name",
                                    module: _vm.storeModule
                                  }
                                })
                              : _vm._e()
                          ],
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "space-1" })
                  ]
                : _vm._e(),
              _vm._v(" "),
              _c(
                "md-card",
                [
                  !_vm.changePassword
                    ? _c("card-icon-header", {
                        attrs: { icon: "lock", title: "Смена пароля" }
                      })
                    : _c("card-icon-header", {
                        attrs: {
                          icon: "lock_open",
                          title: "Смена пароля",
                          color: "md-card-header-danger"
                        }
                      }),
                  _vm._v(" "),
                  _c(
                    "md-card-content",
                    [
                      !_vm.changePassword
                        ? _c(
                            "md-button",
                            {
                              staticClass: "md-success",
                              nativeOn: {
                                click: function($event) {
                                  return _vm.onChangePassword($event)
                                }
                              }
                            },
                            [_vm._v("Сменить пароль")]
                          )
                        : _c(
                            "div",
                            { staticClass: "form-group" },
                            [
                              _c("v-input", {
                                attrs: {
                                  title: "Действующий пароль",
                                  icon: "lock",
                                  name: "old_password",
                                  type: "password",
                                  vField: _vm.$v.oldPassword,
                                  module: _vm.storeModule,
                                  vRules: { required: true }
                                }
                              }),
                              _vm._v(" "),
                              _c("v-input", {
                                attrs: {
                                  title: "Новый пароль",
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
                                  vRules: {
                                    required: true,
                                    sameAsPassword: true
                                  }
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "div",
                                { staticClass: "mt-2" },
                                [
                                  _c(
                                    "md-button",
                                    {
                                      staticClass: "md-danger",
                                      nativeOn: {
                                        click: function($event) {
                                          return _vm.cancelOldPasswordChange(
                                            $event
                                          )
                                        }
                                      }
                                    },
                                    [_vm._v("Отменить")]
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
                ],
                1
              )
            ],
            2
          )
        ])
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Users/UserEdit.vue":
/*!*****************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Users/UserEdit.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UserEdit_vue_vue_type_template_id_4a7e1444___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UserEdit.vue?vue&type=template&id=4a7e1444& */ "./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=template&id=4a7e1444&");
/* harmony import */ var _UserEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UserEdit.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _UserEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UserEdit_vue_vue_type_template_id_4a7e1444___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UserEdit_vue_vue_type_template_id_4a7e1444___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Users/UserEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./UserEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=template&id=4a7e1444&":
/*!************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=template&id=4a7e1444& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserEdit_vue_vue_type_template_id_4a7e1444___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./UserEdit.vue?vue&type=template&id=4a7e1444& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Users/UserEdit.vue?vue&type=template&id=4a7e1444&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserEdit_vue_vue_type_template_id_4a7e1444___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UserEdit_vue_vue_type_template_id_4a7e1444___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);