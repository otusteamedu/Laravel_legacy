(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[29],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuelidate/lib/validators */ "./node_modules/vuelidate/lib/validators/index.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _mixins_base__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/mixins/base */ "./resources/manager/js/mixins/base.js");
/* harmony import */ var _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/mixins/crudMethods */ "./resources/manager/js/mixins/crudMethods.js");
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




/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'RoleEdit',
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_2__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__["updateMethod"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__["deleteMethod"]],
  props: {
    id: {
      type: [Number, String],
      required: true
    }
  },
  data: function data() {
    return {
      selectedPermissions: [],
      responseData: false,
      controlSaveVisibilities: false,
      redirectRoute: {
        name: 'manager.roles'
      },
      storeModule: 'roles'
    };
  },
  validations: {
    name: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.name.$dirty ? true : !this.isUniqueNameEdit;
      },
      testAlias: function testAlias(value) {
        return value.trim() === '' ? true : /^([a-z0-9]+[-]?)+[a-z0-9]$/.test(value);
      }
    },
    displayName: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.displayName.$dirty ? true : !this.isUniqueDisplayNameEdit;
      }
    },
    description: {
      touch: false
    },
    permissions: {
      touch: false
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])({
    name: function name(state) {
      return state.roles.fields.name;
    },
    displayName: function displayName(state) {
      return state.roles.fields.display_name;
    },
    description: function description(state) {
      return state.roles.fields.description;
    },
    permissions: function permissions(state) {
      return state.roles.fields.permissions;
    },
    permissionList: function permissionList(state) {
      return state.permissions.items;
    }
  }), {
    isUniqueName: function isUniqueName() {
      return !!this.$store.getters['roles/isUniqueName'](this.name);
    },
    isUniqueDisplayName: function isUniqueDisplayName() {
      return !!this.$store.getters['roles/isUniqueDisplayName'](this.displayName);
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])({
    indexAction: 'roles/index',
    showAction: 'roles/show',
    clearFieldsAction: 'roles/clearFields',
    indexPermissionsAction: 'permissions/index'
  }), {
    onCheck: function onCheck() {
      this.isDiffer(this.permissions, this.selectedPermissions) ? this.$v.permissions.$touch() : this.$v.permissions.$reset();
    },
    isDiffer: function isDiffer(a, b) {
      return !!a.filter(function (i) {
        return !b.includes(i);
      }).concat(b.filter(function (i) {
        return !a.includes(i);
      })).length;
    },
    onUpdate: function onUpdate() {
      return this.update({
        sendData: {
          formData: {
            name: this.name,
            display_name: this.displayName,
            description: this.description,
            permissions: this.selectedPermissions
          },
          id: this.id
        },
        title: this.displayName,
        successText: 'Роль обновлена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    },
    onDelete: function onDelete() {
      return this["delete"]({
        payload: this.id,
        title: this.displayName,
        alertText: "\u0440\u043E\u043B\u044C \xAB".concat(this.displayName, "\xBB"),
        successText: 'Роль удалена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.indexAction().then(function () {
      return _this.indexPermissionsAction();
    }).then(function () {
      return _this.showAction(_this.id);
    }).then(function () {
      _this.setPageTitle(_this.displayName);

      _this.selectedPermissions = _this.permissions.slice(0);
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=template&id=bdc58618&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=template&id=bdc58618& ***!
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
                          title: "К списку ролей",
                          route: "manager.roles"
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
                          icon: "title",
                          name: "display_name",
                          vField: _vm.$v.displayName,
                          differ: true,
                          value: _vm.displayName,
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
                          title: "Алиас",
                          icon: "code",
                          name: "name",
                          vField: _vm.$v.name,
                          differ: true,
                          value: _vm.name,
                          module: _vm.storeModule,
                          vRules: {
                            required: true,
                            unique: true,
                            alias: true,
                            minLength: true
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("v-textarea", {
                        attrs: {
                          name: "description",
                          vField: _vm.$v.description,
                          differ: true,
                          value: _vm.description,
                          module: _vm.storeModule
                        }
                      }),
                      _vm._v(" "),
                      _c("div", { staticClass: "space-30" })
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
              _vm.permissionList
                ? _c(
                    "md-card",
                    [
                      _c("card-icon-header", {
                        attrs: { icon: "vpn_key", title: "Разрешения" }
                      }),
                      _vm._v(" "),
                      _c(
                        "md-card-content",
                        _vm._l(_vm.permissionList, function(permission) {
                          return _c(
                            "md-switch",
                            {
                              key: permission.id,
                              attrs: { value: permission.id },
                              on: {
                                change: function($event) {
                                  return _vm.onCheck()
                                }
                              },
                              model: {
                                value: _vm.selectedPermissions,
                                callback: function($$v) {
                                  _vm.selectedPermissions = $$v
                                },
                                expression: "selectedPermissions"
                              }
                            },
                            [
                              _vm._v(
                                "\n                        " +
                                  _vm._s(permission.display_name) +
                                  "\n                    "
                              )
                            ]
                          )
                        }),
                        1
                      )
                    ],
                    1
                  )
                : _vm._e()
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

/***/ "./resources/manager/js/mixins/crudMethods.js":
/*!****************************************************!*\
  !*** ./resources/manager/js/mixins/crudMethods.js ***!
  \****************************************************/
/*! exports provided: createMethod, updateMethod, deleteMethod, uploadMethod, imageAddMethod, subCategoryImageAddMethod */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createMethod", function() { return createMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "updateMethod", function() { return updateMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "deleteMethod", function() { return deleteMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "uploadMethod", function() { return uploadMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "imageAddMethod", function() { return imageAddMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "subCategoryImageAddMethod", function() { return subCategoryImageAddMethod; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_1__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


var createMethod = {
  methods: {
    create: function create(_ref) {
      var _this = this;

      var sendData = _ref.sendData,
          title = _ref.title,
          successText = _ref.successText,
          redirectRoute = _ref.redirectRoute,
          _ref$storeModule = _ref.storeModule,
          storeModule = _ref$storeModule === void 0 ? null : _ref$storeModule;
      var module = storeModule ? "".concat(storeModule, "/") : '';
      return this.$store.dispatch("".concat(module, "store"), sendData).then(function () {
        _this.$router.go(-1) ? _this.$router.go(-1) : _this.$router.push(redirectRoute);
        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: successText,
          text: "\xAB".concat(title, "\xBB"),
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};
var updateMethod = {
  methods: {
    update: function update(_ref2) {
      var _this2 = this;

      var sendData = _ref2.sendData,
          title = _ref2.title,
          redirectRoute = _ref2.redirectRoute,
          successText = _ref2.successText,
          _ref2$storeModule = _ref2.storeModule,
          storeModule = _ref2$storeModule === void 0 ? null : _ref2$storeModule;
      var module = storeModule ? "".concat(storeModule, "/") : '';
      return this.$store.dispatch("".concat(module, "update"), sendData).then(function () {
        _this2.$router.go(-1) ? _this2.$router.go(-1) : _this2.$router.push(redirectRoute);
        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: successText,
          text: "\xAB".concat(title, "\xBB"),
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};
var deleteMethod = {
  methods: {
    "delete": function _delete(_ref3) {
      var _this3 = this;

      var payload = _ref3.payload,
          title = _ref3.title,
          alertText = _ref3.alertText,
          successText = _ref3.successText,
          _ref3$storeModule = _ref3.storeModule,
          storeModule = _ref3$storeModule === void 0 ? null : _ref3$storeModule,
          _ref3$redirectRoute = _ref3.redirectRoute,
          redirectRoute = _ref3$redirectRoute === void 0 ? null : _ref3$redirectRoute,
          _ref3$categoryId = _ref3.categoryId,
          categoryId = _ref3$categoryId === void 0 ? null : _ref3$categoryId,
          _ref3$paginationData = _ref3.paginationData,
          paginationData = _ref3$paginationData === void 0 ? null : _ref3$paginationData;
      var module = storeModule ? "".concat(storeModule, "/") : '';
      return deleteSwalFireConfirm(alertText).then(function (result) {
        if (result.value) {
          return _this3.$store.dispatch("".concat(module, "destroy"), payload).then(function () {
            if (redirectRoute) {
              _this3.$router.go(-1) ? _this3.$router.go(-1) : _this3.$router.push(redirectRoute);
            }

            if (paginationData) {
              categoryId ? _this3.$store.dispatch('categories/showImages', {
                id: categoryId,
                data: paginationData
              }) : _this3.$store.dispatch('images/index', paginationData);
            }

            return deleteSwalFireAlert(successText, title);
          });
        }
      });
    }
  }
};

var deleteSwalFireConfirm = function deleteSwalFireConfirm(alertText) {
  return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
    title: 'Вы уверены?',
    text: "\u0414\u0430\u043D\u043D\u043E\u0435 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0435 \u0443\u0434\u0430\u043B\u0438\u0442 ".concat(alertText, " \u0431\u0435\u0437\u0432\u043E\u0437\u0432\u0440\u0430\u0442\u043D\u043E!"),
    type: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'md-button md-success btn-fill',
    cancelButtonClass: 'md-button md-danger btn-fill',
    confirmButtonText: 'Удалить',
    cancelButtonText: 'Отменить',
    buttonsStyling: false
  });
};

var deleteSwalFireAlert = function deleteSwalFireAlert(successText, title) {
  return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
    title: successText,
    text: "\xAB".concat(title, "\xBB"),
    timer: 2000,
    type: 'success',
    showConfirmButton: false
  });
};

var uploadMethod = {
  methods: {
    upload: function () {
      var _upload = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(_ref4) {
        var uploadFiles, _ref4$type, type, _ref4$id, id, _ref4$storeModule, storeModule, paginationData, files, module;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                uploadFiles = _ref4.uploadFiles, _ref4$type = _ref4.type, type = _ref4$type === void 0 ? null : _ref4$type, _ref4$id = _ref4.id, id = _ref4$id === void 0 ? null : _ref4$id, _ref4$storeModule = _ref4.storeModule, storeModule = _ref4$storeModule === void 0 ? null : _ref4$storeModule, paginationData = _ref4.paginationData;
                files = Array.from(uploadFiles);
                module = storeModule ? storeModule : 'categories';

                if (!id) {
                  _context.next = 8;
                  break;
                }

                _context.next = 6;
                return this.$store.dispatch("".concat(module, "/uploadImages"), {
                  files: files,
                  id: id,
                  type: type,
                  paginationData: paginationData
                });

              case 6:
                _context.next = 10;
                break;

              case 8:
                _context.next = 10;
                return this.$store.dispatch('images/store', {
                  files: files,
                  paginationData: paginationData
                });

              case 10:
                _context.next = 12;
                return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
                  title: 'Изображения загружены!',
                  text: '',
                  timer: 2000,
                  showConfirmButton: false,
                  type: 'success'
                });

              case 12:
                return _context.abrupt("return", _context.sent);

              case 13:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function upload(_x) {
        return _upload.apply(this, arguments);
      }

      return upload;
    }()
  }
};
var imageAddMethod = {
  methods: {
    addImages: function addImages(_ref5) {
      var _this4 = this;

      var category = _ref5.category,
          selected = _ref5.selected;
      this.$store.dispatch('categories/addSelectedImages', {
        category_id: category.id,
        selected_images: selected
      }).then(function () {
        _this4.$router.push({
          name: 'manager.catalog.categories.images',
          params: {
            id: category.id
          }
        });

        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: 'Изображения добавлены!',
          text: '',
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};
var subCategoryImageAddMethod = {
  methods: {
    addImages: function addImages(_ref6) {
      var _this5 = this;

      var type = _ref6.type,
          id = _ref6.id,
          selected = _ref6.selected,
          redirectRoute = _ref6.redirectRoute;
      this.$store.dispatch('subCategories/addSelectedImages', {
        type: type,
        id: id,
        selected_images: selected
      }).then(function () {
        _this5.$router.push(redirectRoute);

        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: 'Изображения добавлены!',
          text: '',
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue":
/*!*****************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _RoleEdit_vue_vue_type_template_id_bdc58618___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RoleEdit.vue?vue&type=template&id=bdc58618& */ "./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=template&id=bdc58618&");
/* harmony import */ var _RoleEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RoleEdit.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _RoleEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _RoleEdit_vue_vue_type_template_id_bdc58618___WEBPACK_IMPORTED_MODULE_0__["render"],
  _RoleEdit_vue_vue_type_template_id_bdc58618___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RoleEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./RoleEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RoleEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=template&id=bdc58618&":
/*!************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=template&id=bdc58618& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RoleEdit_vue_vue_type_template_id_bdc58618___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./RoleEdit.vue?vue&type=template&id=bdc58618& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Roles/RoleEdit.vue?vue&type=template&id=bdc58618&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RoleEdit_vue_vue_type_template_id_bdc58618___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RoleEdit_vue_vue_type_template_id_bdc58618___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);