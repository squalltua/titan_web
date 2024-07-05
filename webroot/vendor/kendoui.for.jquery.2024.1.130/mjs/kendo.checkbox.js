/**
 * Kendo UI v2024.1.130 (http://www.telerik.com/kendo-ui)
 * Copyright 2024 Progress Software Corporation and/or one of its subsidiaries or affiliates. All rights reserved.
 *
 * Kendo UI commercial licenses may be obtained at
 * http://www.telerik.com/purchase/license-agreement/kendo-ui-complete
 * If you do not own a commercial license, this file shall be governed by the trial license terms.
 */
import"./kendo.toggleinputbase.js";import"./kendo.html.input.js";var __meta__={id:"checkbox",name:"CheckBox",category:"web",description:"The CheckBox widget is used to display boolean value input.",depends:["toggleinputbase","html.input"]};!function(e,o){var n=window.kendo,t=n.ui,d=t.ToggleInputBase.extend({options:{name:"CheckBox",checked:null,enabled:!0,encoded:!0,label:null,rounded:"medium",size:"medium"},RENDER_INPUT:n.html.renderCheckBox,NS:".kendoCheckBox",value:function(e){return"string"==typeof e&&(e="true"===e),this.check.apply(this,[e])}});n.cssProperties.registerPrefix("CheckBox","k-checkbox-"),n.cssProperties.registerValues("CheckBox",[{prop:"rounded",values:n.cssProperties.roundedValues.concat([["full","full"]])}]),t.plugin(d)}(window.kendo.jQuery);var kendo$1=kendo;export{kendo$1 as default};
//# sourceMappingURL=kendo.checkbox.js.map
