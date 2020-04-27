(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[49],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuelidate/lib/validators */ "./node_modules/vuelidate/lib/validators/index.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _mixins_base__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/mixins/base */ "./resources/manager/js/mixins/base.js");
/* harmony import */ var _mixins_changingFields__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/mixins/changingFields */ "./resources/manager/js/mixins/changingFields.js");
/* harmony import */ var _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/mixins/crudMethods */ "./resources/manager/js/mixins/crudMethods.js");
/* harmony import */ var _custom_components_Editors_TextEditor__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @/custom_components/Editors/TextEditor */ "./resources/manager/js/custom_components/Editors/TextEditor.vue");
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






/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'TextureEdit',
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_2__["pageTitle"], _mixins_changingFields__WEBPACK_IMPORTED_MODULE_3__["changePublishEdit"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["updateMethod"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["deleteMethod"]],
  components: {
    'text-editor': _custom_components_Editors_TextEditor__WEBPACK_IMPORTED_MODULE_5__["default"]
  },
  props: {
    id: {
      type: [Number, String],
      required: true
    },
    result: []
  },
  data: function data() {
    return {
      storeModule: 'textures',
      responseData: false,
      redirectRoute: {
        name: 'manager.textures'
      }
    };
  },
  validations: {
    name: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.name.$dirty ? true : !this.isUniqueNameEdit;
      }
    },
    price: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      numeric: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["numeric"],
      touch: false
    },
    width: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      numeric: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["numeric"],
      touch: false
    },
    thumb: {
      touch: false
    },
    sample: {
      touch: false
    },
    background: {
      touch: false
    },
    description: {
      touch: false
    },
    publish: {
      touch: false
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])('textures', {
    name: function name(state) {
      return state.fields.name;
    },
    price: function price(state) {
      return state.fields.price;
    },
    width: function width(state) {
      return state.fields.width;
    },
    thumbPath: function thumbPath(state) {
      return state.fields.thumb_path;
    },
    samplePath: function samplePath(state) {
      return state.fields.sample_path;
    },
    backgroundPath: function backgroundPath(state) {
      return state.fields.background_path;
    },
    thumb: function thumb(state) {
      return state.fields.thumb;
    },
    sample: function sample(state) {
      return state.fields.sample;
    },
    background: function background(state) {
      return state.fields.background;
    },
    description: function description(state) {
      return state.fields.description;
    },
    publish: function publish(state) {
      return state.fields.publish;
    }
  }), {
    isUniqueNameEdit: function isUniqueNameEdit() {
      return !!this.$store.getters['textures/isUniqueNameEdit'](this.name, this.id);
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])('textures', {
    getItemAction: 'getItem',
    getItemsAction: 'getItems',
    clearFieldsAction: 'clearFields'
  }), {
    onUpdate: function onUpdate() {
      return this.update({
        sendData: {
          formData: {
            name: this.name,
            price: this.price,
            width: this.width,
            thumb: this.thumb,
            sample: this.sample,
            background: this.background,
            description: this.description,
            publish: +this.publish
          },
          id: this.id
        },
        title: this.name,
        successText: 'Фактура обновлена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    },
    onDelete: function onDelete() {
      this["delete"]({
        payload: this.id,
        title: this.name,
        alertText: "\u0444\u0430\u043A\u0442\u0443\u0440\u0430 \xAB".concat(this.name, "\xBB"),
        successText: 'Фактура удалена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.getItemsAction().then(function () {
      return _this.getItemAction(_this.id);
    }).then(function () {
      _this.setPageTitle("\u0424\u0430\u043A\u0442\u0443\u0440\u0430 \xAB".concat(_this.name, "\xBB"));

      _this.responseData = true;
    }).then(function () {
      return _this.$v.$reset();
    })["catch"](function () {
      return _this.$router.push(_this.redirectRoute);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=template&id=90076520&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=template&id=90076520& ***!
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
                [
                  _c(
                    "md-card-content",
                    { staticClass: "md-between" },
                    [
                      _c("router-button-link", {
                        attrs: {
                          route: "manager.textures",
                          title: "К списку материалов"
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
                                  value: _vm.$v.$anyDirty && !_vm.$v.$invalid,
                                  expression: "$v.$anyDirty && !$v.$invalid"
                                }
                              ]
                            },
                            [
                              _c("control-button", {
                                on: {
                                  click: function($event) {
                                    return _vm.onUpdate("auto-close")
                                  }
                                }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("control-button", {
                            attrs: {
                              title: "Удалить",
                              icon: "delete",
                              color: "md-danger"
                            },
                            on: {
                              click: function($event) {
                                return _vm.onDelete("auto-close")
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
                  _c("md-card-content", [
                    _c("div", { staticClass: "md-layout md-gutter" }, [
                      _c(
                        "div",
                        { staticClass: "md-layout-item" },
                        [
                          _c("v-input", {
                            attrs: {
                              title: "Наименование",
                              icon: "title",
                              name: "name",
                              value: _vm.name,
                              vField: _vm.$v.name,
                              differ: true,
                              module: _vm.storeModule,
                              vRules: {
                                required: true,
                                unique: true,
                                minLength: true
                              }
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "md-layout-item" },
                        [
                          _c("v-input", {
                            attrs: {
                              title: "Цена",
                              icon: "attach_money",
                              name: "price",
                              value: _vm.price,
                              maxlength: 8,
                              vField: _vm.$v.price,
                              differ: true,
                              module: _vm.storeModule,
                              vRules: { required: true, numeric: true }
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "md-layout-item" },
                        [
                          _c("v-input", {
                            attrs: {
                              title: "Ширина",
                              icon: "straighten",
                              name: "width",
                              value: _vm.width,
                              maxlength: 8,
                              vField: _vm.$v.width,
                              differ: true,
                              module: _vm.storeModule,
                              vRules: { required: true, numeric: true }
                            }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "md-layout md-gutter mt-2" }, [
                      _c(
                        "div",
                        { staticClass: "md-layout-item" },
                        [
                          _c("v-image", {
                            attrs: {
                              title: "Миниатюра",
                              name: "thumb",
                              imgDefault: _vm.thumbPath,
                              vField: _vm.$v.thumb,
                              differ: true,
                              module: _vm.storeModule
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "md-layout-item" },
                        [
                          _c("v-image", {
                            attrs: {
                              title: "Образец",
                              name: "sample",
                              imgDefault: _vm.samplePath,
                              vField: _vm.$v.sample,
                              differ: true,
                              module: _vm.storeModule
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "md-layout-item" },
                        [
                          _c("v-image", {
                            attrs: {
                              title: "Фон",
                              name: "background",
                              imgDefault: _vm.backgroundPath,
                              vField: _vm.$v.background,
                              differ: true,
                              module: _vm.storeModule
                            }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "mt-5" }, [
                      _c(
                        "div",
                        { staticClass: "mt-5" },
                        [
                          _c("text-editor", {
                            attrs: {
                              value: _vm.description,
                              vField: _vm.$v.description,
                              differ: true,
                              module: _vm.storeModule
                            }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "mt-5" },
                      [
                        _c("v-switch", {
                          attrs: {
                            value: _vm.publish,
                            vField: _vm.$v.publish,
                            differ: true,
                            module: _vm.storeModule
                          }
                        })
                      ],
                      1
                    )
                  ])
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

/***/ "./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue":
/*!***********************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TextureEdit_vue_vue_type_template_id_90076520___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TextureEdit.vue?vue&type=template&id=90076520& */ "./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=template&id=90076520&");
/* harmony import */ var _TextureEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TextureEdit.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _TextureEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TextureEdit_vue_vue_type_template_id_90076520___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TextureEdit_vue_vue_type_template_id_90076520___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextureEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./TextureEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextureEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=template&id=90076520&":
/*!******************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=template&id=90076520& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextureEdit_vue_vue_type_template_id_90076520___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./TextureEdit.vue?vue&type=template&id=90076520& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Textures/TextureEdit.vue?vue&type=template&id=90076520&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextureEdit_vue_vue_type_template_id_90076520___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextureEdit_vue_vue_type_template_id_90076520___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);