/**
 * Kendo UI v2024.1.130 (http://www.telerik.com/kendo-ui)
 * Copyright 2024 Progress Software Corporation and/or one of its subsidiaries or affiliates. All rights reserved.
 *
 * Kendo UI commercial licenses may be obtained at
 * http://www.telerik.com/purchase/license-agreement/kendo-ui-complete
 * If you do not own a commercial license, this file shall be governed by the trial license terms.
 */
import"./kendo.html.base.js";var __meta__={id:"html.chiplist",name:"Html.ChipList",category:"web",description:"HTML rendering utility for Kendo UI for jQuery.",depends:["html.base"],features:[]};!function(e,t){var i=window.kendo,a=i.html.HTMLBase,n=a.extend({init:function(e,t){var i=this;a.fn.init.call(i,e,t),i.wrapper=i.element.addClass("k-chip-list"),i._applyAriaAttributes(t),i._addClasses()},options:{name:"HTMLChipList",size:"medium",stylingOptions:["size"]},_applyAriaAttributes:function(t){var i=this,a=((t=e.extend({selectable:"none"},t)).attributes||{})["aria-label"];"none"!==t.selectable?i.element.attr({"aria-multiselectable":"multiple"===t.selectable,role:"listbox","aria-label":a||i.element.attr("id")+" listbox","aria-orientation":"horizontal"}):i.element.removeAttr("role aria-label aria-multiselectable aria-orientation")}});e.extend(i.html,{renderChipList:function(t,i){return(undefined===arguments[0]||e.isPlainObject(arguments[0]))&&(i=t,t=e("<div></div>")),new n(t,i).html()},HTMLChipList:n}),i.cssProperties.registerPrefix("HTMLChipList","k-chip-list-")}(window.kendo.jQuery);var kendo$1=kendo;export{kendo$1 as default};
//# sourceMappingURL=kendo.html.chiplist.js.map
