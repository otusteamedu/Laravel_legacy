(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[38],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _mixins_base__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/mixins/base */ "./resources/manager/js/mixins/base.js");
/* harmony import */ var _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/mixins/crudMethods */ "./resources/manager/js/mixins/crudMethods.js");
/* harmony import */ var _custom_components_VForm_VSelect__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/custom_components/VForm/VSelect */ "./resources/manager/js/custom_components/VForm/VSelect.vue");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

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
//
//
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
  name: 'ImageEdit',
  components: {
    VSelect: _custom_components_VForm_VSelect__WEBPACK_IMPORTED_MODULE_4__["default"]
  },
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_2__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__["updateMethod"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__["deleteMethod"]],
  props: {
    id: {
      type: [Number, String],
      required: true
    },
    result: []
  },
  data: function data() {
    return {
      storeModule: 'images',
      responseData: false,
      controlSaveVisibilities: false,
      redirectRoute: {
        name: 'manager.images'
      }
    };
  },
  validations: {
    image: {
      touch: false
    },
    publish: {
      touch: false
    },
    topics: {
      touch: false
    },
    colors: {
      touch: false
    },
    interiors: {
      touch: false
    },
    tags: {
      touch: false
    },
    owner: {
      touch: false
    },
    description: {
      touch: false
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapState"])('images', {
    item: function item(state) {
      return state.item;
    },
    image: function image(state) {
      return state.fields.image;
    },
    publish: function publish(state) {
      return state.fields.publish;
    },
    topics: function topics(state) {
      return state.fields.topics;
    },
    colors: function colors(state) {
      return state.fields.colors;
    },
    interiors: function interiors(state) {
      return state.fields.interiors;
    },
    owner: function owner(state) {
      return state.fields.owner_id;
    },
    tags: function tags(state) {
      return state.fields.tags;
    },
    description: function description(state) {
      return state.fields.description;
    }
  }), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapState"])({
    ownerList: function ownerList(state) {
      return state.subCategories.itemsByType.owners;
    },
    tagList: function tagList(state) {
      return state.subCategories.itemsByType.tags;
    }
  }), {
    topicList: function topicList() {
      return this.$store.getters['categories/getItemsByType']('topics');
    },
    colorList: function colorList() {
      return this.$store.getters['categories/getItemsByType']('colors');
    },
    interiorList: function interiorList() {
      return this.$store.getters['categories/getItemsByType']('interiors');
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapActions"])({
    showAction: 'images/show',
    clearFieldsAction: 'images/clearFields',
    indexCategoryAction: 'categories/index',
    indexSubcategoryAction: 'subCategories/indexByType'
  }), {
    onUpdate: function onUpdate() {
      return this.update({
        sendData: {
          formData: {
            image: this.image,
            publish: +this.publish,
            topics: this.topics,
            colors: this.colors,
            interiors: this.interiors,
            owner_id: +this.owner,
            tags: this.tags,
            description: this.description
          },
          id: this.id
        },
        title: this.item.article,
        successText: 'Изображение обновлено!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    },
    onDelete: function onDelete() {
      return this["delete"]({
        payload: this.id,
        title: this.item.article,
        alertText: "\u0438\u0437\u043E\u0431\u0440\u0430\u0436\u0435\u043D\u0438\u0435 \xAB".concat(this.item.article, "\xBB"),
        successText: 'Изображение удалено!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function () {
    var _created = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
      var _this = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return this.clearFieldsAction();

            case 2:
              _context.next = 4;
              return this.showAction(this.id).then(function () {
                return _this.indexCategoryAction();
              }).then(function () {
                return _this.indexSubcategoryAction('tags');
              }).then(function () {
                return _this.indexSubcategoryAction('owners');
              }).then(function () {
                _this.setPageTitle("\u0418\u0437\u043E\u0431\u0440\u0430\u0436\u0435\u043D\u0438\u0435 \xAB".concat(_this.item.article, "\xBB"));

                _this.responseData = true;
              }).then(function () {
                _this.$v.$reset();

                _this.controlSaveVisibilities = true;
              })["catch"](function () {
                _this.$router.go(-1) ? _this.$router.go(-1) : _this.$router.push(_this.redirectRoute);
              });

            case 4:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, this);
    }));

    function created() {
      return _created.apply(this, arguments);
    }

    return created;
  }()
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=template&id=9c47aea0&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=template&id=9c47aea0& ***!
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
                { staticClass: "mt-0" },
                [
                  _c(
                    "md-card-content",
                    { staticClass: "md-between" },
                    [
                      _c(
                        "md-button",
                        {
                          staticClass: "md-info md-just-icon",
                          on: {
                            click: function($event) {
                              _vm.$router.go(-1)
                                ? _vm.$router.go(-1)
                                : _vm.$router.push(_vm.redirectRoute)
                            }
                          }
                        },
                        [
                          _c("md-icon", [_vm._v("arrow_back")]),
                          _vm._v(" "),
                          _c(
                            "md-tooltip",
                            { attrs: { "md-direction": "right" } },
                            [_vm._v("Назад")]
                          )
                        ],
                        1
                      ),
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
                                    _vm.$v.$anyDirty,
                                  expression:
                                    "controlSaveVisibilities && $v.$anyDirty"
                                }
                              ]
                            },
                            [
                              _c("control-button", {
                                on: { click: _vm.onUpdate }
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
                  _c("card-icon-header", {
                    attrs: { title: "Информация", icon: "info" }
                  }),
                  _vm._v(" "),
                  _c("md-card-content", [
                    _c("h4", { staticClass: "card-title mb-0" }, [
                      _vm._v("Артикул")
                    ]),
                    _vm._v(" "),
                    _c("h3", { staticClass: "mt-0" }, [
                      _c("small", [_vm._v(_vm._s(_vm.item.article))])
                    ]),
                    _vm._v(" "),
                    _c("h4", { staticClass: "card-title mb-0" }, [
                      _vm._v("Форма")
                    ]),
                    _vm._v(" "),
                    _c("h3", { staticClass: "mt-0" }, [
                      _c("small", [_vm._v(_vm._s(_vm.item.format))])
                    ]),
                    _vm._v(" "),
                    _c("h4", { staticClass: "card-title mb-0" }, [
                      _vm._v("Просмотры")
                    ]),
                    _vm._v(" "),
                    _c("h3", { staticClass: "mt-0" }, [
                      _c("small", [_vm._v(_vm._s(_vm.item.views))])
                    ]),
                    _vm._v(" "),
                    _c("h4", { staticClass: "card-title mb-0" }, [
                      _vm._v("Лайки")
                    ]),
                    _vm._v(" "),
                    _c("h3", { staticClass: "mt-0" }, [
                      _c("small", [_vm._v(_vm._s(_vm.item.likes))])
                    ]),
                    _vm._v(" "),
                    _c("h4", { staticClass: "card-title mb-0" }, [
                      _vm._v("Заказы")
                    ]),
                    _vm._v(" "),
                    _c("h3", { staticClass: "mt-0" }, [
                      _c("small", [_vm._v(_vm._s(_vm.item.orders))])
                    ])
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "md-card",
                [
                  _c("card-icon-header", {
                    attrs: { icon: "description", title: "" }
                  }),
                  _vm._v(" "),
                  _c(
                    "md-card-content",
                    [
                      _c("v-textarea", {
                        attrs: {
                          icon: "title",
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
              _c(
                "md-card",
                [
                  _c(
                    "md-card-header",
                    { staticClass: "md-card-header-icon md-card-header-green" },
                    [
                      _c(
                        "div",
                        { staticClass: "card-icon" },
                        [_c("md-icon", [_vm._v("settings")])],
                        1
                      ),
                      _vm._v(" "),
                      _c("h3", { staticClass: "title" }, [_vm._v("Установки")])
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "md-card-content",
                    [
                      _vm.topicList.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Темы",
                              placeholder: "Выберите темы",
                              multiple: true,
                              name: "topics",
                              vField: _vm.$v.topics,
                              differ: true,
                              value: _vm.topics,
                              options: _vm.topicList,
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.colorList.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Цвета",
                              placeholder: "Выберите цвета",
                              multiple: true,
                              name: "colors",
                              vField: _vm.$v.colors,
                              differ: true,
                              value: _vm.colors,
                              options: _vm.colorList,
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.interiorList.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Интерьеры",
                              placeholder: "Выберите интерьеры",
                              multiple: true,
                              name: "interiors",
                              vField: _vm.$v.interiors,
                              differ: true,
                              value: _vm.interiors,
                              options: _vm.interiorList,
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.tagList.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Теги",
                              placeholder: "Выберите теги",
                              multiple: true,
                              name: "tags",
                              vField: _vm.$v.tags,
                              differ: true,
                              value: _vm.tags,
                              options: _vm.tagList,
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.ownerList.length
                        ? _c("v-select", {
                            attrs: {
                              title: "Владельцы",
                              placeholder: "Выберите владельца",
                              name: "owner_id",
                              vField: _vm.$v.owner,
                              differ: true,
                              value: _vm.owner,
                              options: _vm.ownerList,
                              defaultValue: 0,
                              defaultTitle: "Свое",
                              module: _vm.storeModule
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _c("v-image", {
                        attrs: {
                          name: "image",
                          vField: _vm.$v.image,
                          imgDefault: _vm.item.path,
                          module: _vm.storeModule
                        }
                      }),
                      _vm._v(" "),
                      _c("v-switch", {
                        attrs: {
                          vField: _vm.$v.publish,
                          differ: true,
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
          )
        ])
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue":
/*!*******************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ImageEdit_vue_vue_type_template_id_9c47aea0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ImageEdit.vue?vue&type=template&id=9c47aea0& */ "./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=template&id=9c47aea0&");
/* harmony import */ var _ImageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ImageEdit.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ImageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ImageEdit_vue_vue_type_template_id_9c47aea0___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ImageEdit_vue_vue_type_template_id_9c47aea0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Images/ImageEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=template&id=9c47aea0&":
/*!**************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=template&id=9c47aea0& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageEdit_vue_vue_type_template_id_9c47aea0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageEdit.vue?vue&type=template&id=9c47aea0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Images/ImageEdit.vue?vue&type=template&id=9c47aea0&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageEdit_vue_vue_type_template_id_9c47aea0___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageEdit_vue_vue_type_template_id_9c47aea0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);