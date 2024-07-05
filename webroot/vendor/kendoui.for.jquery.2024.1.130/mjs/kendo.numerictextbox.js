/**
 * Kendo UI v2024.1.130 (http://www.telerik.com/kendo-ui)
 * Copyright 2024 Progress Software Corporation and/or one of its subsidiaries or affiliates. All rights reserved.
 *
 * Kendo UI commercial licenses may be obtained at
 * http://www.telerik.com/purchase/license-agreement/kendo-ui-complete
 * If you do not own a commercial license, this file shall be governed by the trial license terms.
 */
import"./kendo.core.js";import"./kendo.userevents.js";import"./kendo.floatinglabel.js";import"./kendo.html.button.js";import"./kendo.icons.js";let $=kendo.jQuery;function addInputPrefixSuffixContainers({widget:e,wrapper:t,options:n,prefixInsertBefore:a,suffixInsertAfter:r}){var i,o,l=n.prefixOptions,s=n.suffixOptions,p=l.template||l.icon,u=s.template||s.icon,d=(r=r||a,n.layoutFlow),c=d?"vertical"==d?"horizontal":"vertical":"horizontal",_=`<span class="k-input-separator k-input-separator-${"vertical"==d?"horizontal":"vertical"}"></span>`;l&&p&&((i=t.children(".k-input-prefix"))[0]||(i=$(`<span class="k-input-prefix k-input-prefix-${c}" />`),a?i.insertBefore(a):i.prependTo(t)),l.icon&&i.html(kendo.html.renderIcon({icon:l.icon})),l.template&&i.html(kendo.template(l.template)({})),l.separator&&$(_).insertAfter(i)),s&&u&&((o=t.children(".k-input-suffix"))[0]||(o=$(`<span class="k-input-suffix k-input-suffix-${c}" />`).appendTo(t),r?o.insertAfter(r):o.appendTo(t)),s.icon&&o.html(kendo.html.renderIcon({icon:s.icon})),s.template&&o.html(kendo.template(s.template)({})),s.separator&&$(_).insertBefore(o)),e._prefixContainer=i,e._suffixContainer=o}var __meta__={id:"numerictextbox",name:"NumericTextBox",category:"web",description:"The NumericTextBox widget can format and display numeric, percentage or currency textbox.",depends:["core","userevents","floatinglabel","html.button","icons"]};!function(e,t){var n=window.kendo,a=n.caret,r=n.keys,i=n.html,o=n.ui,l=o.Widget,s=n._activeElement,p=n._extractFormat,u=n.parseFloat,d=n.support.placeholder,c=n.getCulture,_="change",f="disabled",m="readonly",v="k-input-inner",h="spin",x=".kendoNumericTextBox",b="mouseenter"+x+" "+("mouseleave"+x),g="k-focus",w="k-hover",k="focus",y=".",T="k-selected",C="k-disabled",A="k-invalid",L="aria-disabled",I=/^(-)?(\d*)$/,E=null,H=e.isPlainObject,O=e.extend,S=l.extend({init:function(a,r){var i,o,s,u,d,c=this,_=r&&r.step!==t;l.fn.init.call(c,a,r),r=c.options,a=c.element.on("focusout"+x,c._focusout.bind(c)).attr("role","spinbutton"),r.placeholder=r.placeholder||a.attr("placeholder"),i=c.min(a.attr("min")),o=c.max(a.attr("max")),s=c._parse(a.attr("step")),r.min===E&&i!==E&&(r.min=i),r.max===E&&o!==E&&(r.max=o),_||s===E||(r.step=s),c._initialOptions=O({},r),d=a.attr("type"),c._reset(),c._wrapper(),c._arrows(),c._validation(),c._input(),n.support.mobileOS?c._text.on("touchend"+x+" "+k+x,(function(){n.support.browser.edge?c._text.one(k+x,(function(){c._focusin()})):c._focusin(),c.selectValue()})):c._text.on(k+x,c._click.bind(c)),a.attr("aria-valuemin",r.min!==E?r.min*r.factor:r.min).attr("aria-valuemax",r.max!==E?r.max*r.factor:r.max),r.format=p(r.format),(u=r.value)==E&&(u="number"==d?parseFloat(a.val()):a.val()),c.value(u),!r.enable||a.is("[disabled]")||e(c.element).parents("fieldset").is(":disabled")?c.enable(!1):c.readonly(a.is("[readonly]")),c._label(),c._ariaLabel(c._text),c._applyCssClasses(),addInputPrefixSuffixContainers({widget:c,wrapper:c.wrapper,options:c.options,prefixInsertBefore:c._text,suffixInsertAfter:c._validationIcon}),c.floatingLabel&&c.floatingLabel.refresh(),n.notify(c)},options:{name:"NumericTextBox",decimals:E,enable:!0,restrictDecimals:!1,min:E,max:E,value:E,step:1,round:!0,culture:"",format:"n",spinners:!0,placeholder:"",selectOnFocus:!1,factor:1,upArrowText:"Increase value",downArrowText:"Decrease value",label:null,size:"medium",fillMode:"solid",rounded:"medium",prefixOptions:{separator:!0},suffixOptions:{separator:!0}},events:[_,h],_editable:function(e){var t=this,n=t.element,a=e.disable,r=e.readonly,i=t._text.add(n),o=t.wrapper.off(b);t._toggleText(!0),t._upArrowEventHandler.unbind("press"),t._downArrowEventHandler.unbind("press"),n.off("keydown"+x).off("keyup"+x).off("input"+x).off("paste"+x),t._inputLabel&&t._inputLabel.off(x),r||a?(o.addClass(a?C:"").removeClass(a?"":C),i.attr(f,a).attr(m,r).attr(L,a)):(o.removeClass(C).on(b,t._toggleHover),i.prop(f,!1).prop(m,!1).attr(L,!1),t._upArrowEventHandler.bind("press",(function(e){e.preventDefault(),t._spin(1),t._upArrow.addClass(T)})),t._downArrowEventHandler.bind("press",(function(e){e.preventDefault(),t._spin(-1),t._downArrow.addClass(T)})),t.element.on("keydown"+x,t._keydown.bind(t)).on("keyup"+x,t._keyup.bind(t)).on("paste"+x,t._paste.bind(t)).on("input"+x,t._inputHandler.bind(t)),t._inputLabel&&t._inputLabel.on("click"+x,t.focus.bind(t)))},readonly:function(e){this._editable({readonly:e===t||e,disable:!1}),this.floatingLabel&&this.floatingLabel.readonly(e===t||e)},enable:function(e){this._editable({readonly:!1,disable:!(e=e===t||e)}),this.floatingLabel&&this.floatingLabel.enable(e=e===t||e)},setOptions:function(e){var n=this;l.fn.setOptions.call(n,e),n.wrapper.toggleClass("k-expand-padding",!n.options.spinners),n._text.prop("placeholder",n.options.placeholder),n._placeholder(n.options.placeholder),n.element.attr({"aria-valuemin":n.options.min!==E?n.options.min*n.options.factor:n.options.min,"aria-valuemax":n.options.max!==E?n.options.max*n.options.factor:n.options.max}),n.options.format=p(n.options.format),n._upArrowEventHandler.destroy(),n._upArrowEventHandler=null,n._downArrowEventHandler.destroy(),n._downArrowEventHandler=null,n._arrowsWrap.remove(),n._arrows(),n._applyCssClasses(),n._inputLabel&&(n._inputLabel.off(x),n._inputLabel.remove(),n.floatingLabel&&(n.floatingLabel.destroy(),n._floatingLabelContainer&&n.wrapper.unwrap())),n._label(),e.enable!==t||e.readonly!==t?n._editable({readonly:e.readonly,disable:!e.enable}):n._editable({readonly:n.element.attr("readonly")!==t?Boolean(n.element.attr("readonly")):n.options.readonly,disable:n.element.attr("disabled")!==t?Boolean(n.element.attr("disabled")):!n.options.enable}),e.value!==t&&n.value(e.value)},destroy:function(){var e=this;e._inputLabel&&(e._inputLabel.off(x),e.floatingLabel&&e.floatingLabel.destroy()),e.element.add(e._text).add(e._upArrow).add(e._downArrow).off(x),e._upArrowEventHandler.destroy(),e._downArrowEventHandler.destroy(),e._form&&e._form.off("reset",e._resetHandler),l.fn.destroy.call(e)},min:function(e){return this._option("min",e)},max:function(e){return this._option("max",e)},step:function(e){return this._option("step",e)},value:function(e){var n=this;if(e===t)return n._value;(e=n._parse(e))===n._adjust(e)&&(n._update(e),n._old=n._value,n.floatingLabel&&n.floatingLabel.refresh())},focus:function(){this._focusin()},_adjust:function(e){var t=this.options,n=t.min,a=t.max;return e===E||(n!==E&&e<n?e=n:a!==E&&e>a&&(e=a)),e},_arrows:function(){var t,a=this,r=function(){clearTimeout(a._spinning),t.removeClass(T)},i=a.options,o=i.spinners,l=a.element;(t=l.siblings(".k-icon-button"))[0]||(t=e(F("increase",i.upArrowText,i)+F("decrease",i.downArrowText,i)).appendTo(a.wrapper),a._arrowsWrap=t.wrapAll('<span class="k-input-spinner k-spin-button"/>').parent()),o||(t.parent().toggle(o),a.wrapper.addClass("k-expand-padding")),a._upArrow=t.eq(0),a._upArrowEventHandler=new n.UserEvents(a._upArrow,{release:r}),a._downArrow=t.eq(1),a._downArrowEventHandler=new n.UserEvents(a._downArrow,{release:r})},_validation:function(){var t=this.element;this._validationIcon=e(n.ui.icon({icon:"exclamation-circle",iconClass:"k-input-validation-icon k-hidden"})).insertAfter(t)},_blur:function(){var e=this;e._toggleText(!0),e._change(e.element.val())},_click:function(e){var t=this;clearTimeout(t._focusing),t._focusing=setTimeout((function(){var n,r,i,o=e.target,l=a(o)[0],s=o.value.substring(0,l),p=t._format(t.options.format),u=p[","],d=0;u&&(r=new RegExp("\\"+u,"g"),i=new RegExp("(-)?("+p.symbol+")?([\\d\\"+u+"]+)(\\"+p[y]+")?(\\d+)?")),i&&(n=i.exec(s)),n&&(d=n[0].replace(r,"").length,-1!=s.indexOf("(")&&t._value<0&&d++),t._focusin(),a(t.element[0],d),t.selectValue()}))},selectValue:function(){this.options.selectOnFocus&&this.element[0].select()},_getFactorValue:function(e){var t=this.options.factor;return t&&1!==t&&null!==(e=n.parseFloat(e))&&(e/=t),e},_change:function(e){var t=this;e=t._getFactorValue(e),t._update(e),e=t._value,t._old!=e&&(t._old=e,t._typing||t.element.trigger(_),t.trigger(_)),t._typing=!1},_culture:function(e){return e||c(this.options.culture)},_focusin:function(){var e=this;e.wrapper.addClass(g),e._toggleText(!1),e.element[0].focus()},_focusout:function(){var e=this;clearTimeout(e._focusing),e.wrapper.removeClass(g).removeClass(w),e._blur(),e._removeInvalidState()},_format:function(e,t){var n=this._culture(t).numberFormat;return(e=e.toLowerCase()).indexOf("c")>-1?n=n.currency:e.indexOf("p")>-1&&(n=n.percent),n},_input:function(){var t,a=this,r=a.options,i=a.element.addClass(v).show()[0],o=i.accessKey;(t=a.wrapper.find(y+v).first()).length<2&&(t=e('<input type="text"/>').attr(n.attr("validate"),!1).insertBefore(i));try{i.setAttribute("type","text")}catch(e){i.type="text"}t[0].title=i.title,t[0].tabIndex=i.tabIndex,t[0].style.cssText=i.style.cssText,t.prop("placeholder",r.placeholder),o&&(t.attr("accesskey",o),i.accessKey=""),a._text=t.addClass(i.className).attr({role:"spinbutton","aria-valuemin":r.min!==E?r.min*r.factor:r.min,"aria-valuemax":r.max!==E?r.max*r.factor:r.max,autocomplete:"off"})},_keydown:function(e){var t=this,n=e.keyCode;n===r.NUMPAD_DOT&&(t._numPadDot=!0),n!=r.DOWN?n!=r.UP?n!=r.ENTER?(n!=r.TAB&&(t._typing=!0),t._cachedCaret=a(t.element)):t._change(t.element.val()):t._step(1):t._step(-1)},_keyup:function(){this._removeInvalidState()},_inputHandler:function(){var e=this.element,t=e.val(),n=this.options.min,r=this._format(this.options.format),i=r[y],o=null!==n&&n>=0&&"-"===t.charAt(0);this._numPadDot&&i!==y&&(t=t.replace(y,i),this.element.val(t),this._numPadDot=!1),this._isPasted&&this._parse(t)&&(t=this._parse(t).toString().replace(y,r[y])),this._numericRegex(r).test(t)&&!o?this._oldText=t:(this._blinkInvalidState(),this.element.val(this._oldText),this._cachedCaret&&(a(e,this._cachedCaret[0]),this._cachedCaret=null)),this._isPasted=!1},_blinkInvalidState:function(){var e=this;e._addInvalidState(),clearTimeout(e._invalidStateTimeout),e._invalidStateTimeout=setTimeout(e._removeInvalidState.bind(e),100)},_addInvalidState:function(){this.wrapper.addClass(A),this._validationIcon.removeClass("k-hidden")},_removeInvalidState:function(){var e=this;e.wrapper.removeClass(A),e._validationIcon.addClass("k-hidden"),e._invalidStateTimeout=null},_numericRegex:function(e){var t=this,n=e[y],a=t.options.decimals,r="*";return n===y&&(n="\\"+n),a===E&&(a=e.decimals),0===a&&t.options.restrictDecimals?I:(t.options.restrictDecimals&&(r="{0,"+a+"}"),t._separator!==n&&(t._separator=n,t._floatRegExp=new RegExp("^(-)?(((\\d+("+n+"\\d"+r+")?)|("+n+"\\d"+r+")))?$")),t._floatRegExp)},_paste:function(e){var t=this,n=e.target,a=n.value,r=t._format(t.options.format);t._isPasted=!0,setTimeout((function(){var e=t._parse(n.value);e===E?t._update(a):(n.value=e.toString().replace(y,r[y]),t._adjust(e)===e&&t._numericRegex(r).test(n.value)||(a=t._getFactorValue(n.value),t._update(a)))}))},_option:function(e,n){var a=this,r=a.element,i=a.options;if(n===t)return i[e];((n=a._parse(n))||"step"!==e)&&(i[e]=n,r.add(a._text).attr("aria-value"+e,n),r.attr(e,n))},_spin:function(e,t){var n=this;t=t||500,clearTimeout(n._spinning),n._spinning=setTimeout((function(){n._spin(e,50)}),t),n._step(e)},_step:function(e){var t=this,n=t.element,a=t._value,r=t._parse(n.val())||0,i=t.options.decimals||2;s()!=n[0]&&t._focusin(),t.options.factor&&r&&(r/=t.options.factor),r=+(r+t.options.step*e).toFixed(i),r=t._adjust(r),t._update(r),t._typing=!1,a!==r&&t.trigger(h)},_toggleHover:function(t){e(t.currentTarget).toggleClass(w,"mouseenter"===t.type)},_toggleText:function(e){var t=this;t._text.toggle(e),e?t._text.removeAttr("aria-hidden"):t._text.attr("aria-hidden","true"),t.element.toggle(!e)},_parse:function(e,t){return u(e,this._culture(t),this.options.format)},_round:function(e,t){return(this.options.round?n._round:B)(e,t)},_update:function(e){var t,a,r=this,i=r.options,o=i.factor,l=i.format,s=i.decimals,p=r._culture(),u=r._format(l,p);s===E&&(s=u.decimals),(a=(e=r._parse(e,p))!==E)&&(e=parseFloat(r._round(e,s),10)),r._value=e=r._adjust(e),r._placeholder(n.toString(e,l,p)),a?(o&&(e=parseFloat(r._round(e*o,s),10)),-1!==(e=e.toString()).indexOf("e")&&(e=r._round(+e,s)),t=e,e=e.replace(y,u[y])):(e=null,t=null),r.element.val(e),r._oldText=e,r.element.add(r._text).attr("aria-valuenow",t)},_placeholder:function(e){var t=this._text;t.val(e),d||e||t.val(this.options.placeholder),t.attr("title",this.element.attr("title")||t.val())},_label:function(){var a,r,i=this,o=i.element,l=i.options,s=o.attr("id");null!==l.label&&(a=!!H(l.label)&&l.label.floating,r=H(l.label)?l.label.content:l.label,a&&(i._floatingLabelContainer=i.wrapper.wrap("<span></span>").parent(),i.floatingLabel=new n.ui.FloatingLabel(i._floatingLabelContainer,{widget:i})),n.isFunction(r)&&(r=r.call(i)),r||(r=""),s||(s=l.name+"_"+n.guid(),o.attr("id",s)),i._inputLabel=e("<label class='k-label k-input-label' for='"+s+"'>"+r+"</label>'").insertBefore(i.wrapper),i.element.attr("disabled")===t&&i.element.attr("readonly")===t&&i._inputLabel.on("click"+x,i.focus.bind(i)))},_wrapper:function(){var e,t=this.element,n=t[0];(e=t.parents(".k-numerictextbox")).is("span.k-numerictextbox")||(e=t.hide().wrap("<span/>").parent()),e[0].style.cssText=n.style.cssText,n.style.width="",this.wrapper=e.addClass("k-numerictextbox k-input").addClass(n.className).removeClass("input-validation-error").css("display","")},_reset:function(){var t=this,n=t.element,a=n.attr("form"),r=a?e("#"+a):n.closest("form");r[0]&&(t._resetHandler=function(){setTimeout((function(){t.value(n[0].value),t.max(t._initialOptions.max),t.min(t._initialOptions.min)}))},t._form=r.on("reset",t._resetHandler))}});function F(e,t,n){var a="increase"===e?"caret-alt-up":"caret-alt-down",r="increase"===e?"increase":"decrease";return i.renderButton('<button role="button" tabindex="-1" unselectable="on" class="k-spinner-'+r+'" aria-label="'+t+'" title="'+t+'"></button>',O({},n,{icon:a,shape:null,rounded:null}))}function B(e,t){var n=parseFloat(e,10).toString().split(y);return n[1]&&(n[1]=n[1].substring(0,t)),n.join(y)}n.cssProperties.registerPrefix("NumericTextBox","k-input-"),n.cssProperties.registerValues("NumericTextBox",[{prop:"rounded",values:n.cssProperties.roundedValues.concat([["full","full"]])}]),o.plugin(S)}(window.kendo.jQuery);var kendo$1=kendo;export{kendo$1 as default};
//# sourceMappingURL=kendo.numerictextbox.js.map
