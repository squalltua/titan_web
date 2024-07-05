/**
 * Kendo UI v2024.1.130 (http://www.telerik.com/kendo-ui)
 * Copyright 2024 Progress Software Corporation and/or one of its subsidiaries or affiliates. All rights reserved.
 *
 * Kendo UI commercial licenses may be obtained at
 * http://www.telerik.com/purchase/license-agreement/kendo-ui-complete
 * If you do not own a commercial license, this file shall be governed by the trial license terms.
 */
import"./kendo.core.js";var __meta__={id:"html.base",name:"Html.Base",category:"web",description:"",depends:["core"],features:[]};!function(e,t){var a=window.kendo,s=a.Class;a.html=a.html||{};var n=s.extend({init:function(t,a){this.element=e(t),delete(a=a||{}).name,this._initOptions(a)},options:{stylingOptions:[]},_addClasses:function(){var e=this,t=e.options,s=t.stylingOptions,n=e.wrapper.data("added-classes");s=s.map((function(e){var s;return"themeColor"!==e||(s=a.cssProperties.getValidClass({widget:t.name,propName:"fillMode",value:t.fillMode}))&&0!==s.length?a.cssProperties.getValidClass({widget:t.name,propName:e,value:t[e],fill:t.fillMode}):""})),n&&e.wrapper.removeClass(n.join(" ")),e.wrapper.data("added-classes",s),e.wrapper.addClass(s.join(" "))},html:function(){return this.wrapper[0].outerHTML}});e.extend(a.html,{HTMLBase:n})}(window.kendo.jQuery);var kendo$1=kendo;export{kendo$1 as default};
//# sourceMappingURL=kendo.html.base.js.map
