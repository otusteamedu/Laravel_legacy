(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[55],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _custom_components_Tables_TableActions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/custom_components/Tables/TableActions */ "./resources/manager/js/custom_components/Tables/TableActions.vue");
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




/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'PermissionList',
  components: {
    TableActions: _custom_components_Tables_TableActions__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_2__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__["deleteMethod"]],
  data: function data() {
    return {
      responseData: false,
      storeModule: 'permissions'
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])('permissions', ['items'])),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])('permissions', {
    indexAction: 'index'
  }), {
    onDelete: function onDelete(item) {
      return this["delete"]({
        payload: item.id,
        title: item.display_name,
        alertText: "\u043F\u0440\u0438\u0432\u0438\u043B\u0435\u0433\u0438\u044E \xAB".concat(item.display_name, "\xBB"),
        storeModule: this.storeModule,
        successText: 'Привилегия удалена!'
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.indexAction().then(function () {
      _this.setPageTitle('Привилегии');

      _this.responseData = true;
    })["catch"](function () {
      return _this.$router.push({
        name: 'manager.dashboard'
      });
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&":
/*!******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a& ***!
  \******************************************************************************************************************************************************************************************************************************************/
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
    ? _c("div", { staticClass: "md-layout" }, [
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
                      attrs: { title: "В панель управления" }
                    }),
                    _vm._v(" "),
                    _c("router-button-link", {
                      attrs: {
                        title: "Создать привилегию",
                        icon: "add",
                        color: "md-success",
                        route: "manager.permissions.create"
                      }
                    })
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c("div", { staticClass: "space-1" }),
            _vm._v(" "),
            _c(
              "md-card",
              [
                _c("card-icon-header", {
                  attrs: { title: "Список Привилегий", icon: "assignment" }
                }),
                _vm._v(" "),
                _c(
                  "md-card-content",
                  [
                    _vm.items.length
                      ? [
                          _c("md-table", {
                            staticClass:
                              "paginated-table table-striped table-hover",
                            scopedSlots: _vm._u(
                              [
                                {
                                  key: "md-table-row",
                                  fn: function(ref) {
                                    var item = ref.item
                                    return _c(
                                      "md-table-row",
                                      {},
                                      [
                                        _c(
                                          "md-table-cell",
                                          {
                                            staticStyle: { width: "50px" },
                                            attrs: { "md-label": "#" }
                                          },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.id) +
                                                "\n                            "
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Имя" } },
                                          [
                                            _c(
                                              "span",
                                              { staticClass: "md-subheading" },
                                              [
                                                _vm._v(
                                                  _vm._s(item.display_name)
                                                )
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Алиас" } },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.name) +
                                                "\n                            "
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Описание" } },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.description) +
                                                "\n                            "
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Действия" } },
                                          [
                                            _c("table-actions", {
                                              attrs: {
                                                item: item,
                                                subPath: _vm.storeModule
                                              },
                                              on: { delete: _vm.onDelete }
                                            })
                                          ],
                                          1
                                        )
                                      ],
                                      1
                                    )
                                  }
                                }
                              ],
                              null,
                              false,
                              3396054559
                            ),
                            model: {
                              value: _vm.items,
                              callback: function($$v) {
                                _vm.items = $$v
                              },
                              expression: "items"
                            }
                          })
                        ]
                      : [
                          _c("div", { staticClass: "alert alert-info" }, [
                            _c("span", [
                              _c("h3", [_vm._v("У Вас еще нет привилегий!")])
                            ])
                          ])
                        ]
                  ],
                  2
                )
              ],
              1
            )
          ],
          1
        )
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue":
/*!*****************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PermissionList.vue?vue&type=template&id=588fa43a& */ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&");
/* harmony import */ var _PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PermissionList.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./PermissionList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&":
/*!************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a& ***!
  \************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./PermissionList.vue?vue&type=template&id=588fa43a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);