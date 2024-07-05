/**
 * Kendo UI v2024.1.130 (http://www.telerik.com/kendo-ui)
 * Copyright 2024 Progress Software Corporation and/or one of its subsidiaries or affiliates. All rights reserved.
 *
 * Kendo UI commercial licenses may be obtained at
 * http://www.telerik.com/purchase/license-agreement/kendo-ui-complete
 * If you do not own a commercial license, this file shall be governed by the trial license terms.
 */
import"./kendo.dataviz.themes.js";var __meta__={id:"circularprogressBar",name:"CircularProgressBar",category:"web",description:"The Circular ProgressBar component represents an SVG loader",depends:["core","dataviz.themes"]};!function(e,t){window.kendo.dataviz=window.kendo.dataviz||{};var n=kendo.dataviz,i=n.interpolateValue,r=kendo.drawing,o=kendo.ui,a=o.Widget,s=r.Surface,l=kendo.geometry,h=r.Animation,c=r.Arc,u=n.limitValue,d=n.round,g=r.Group,m=h.extend({init:function(e,t){h.fn.init.call(this,e,t);var n=this.options,i=t.endColor,r=t.startColor,o=Math.abs(n.newAngle-n.oldAngle)/n.duration*1e3;n.duration=u(o,150,800),this.element=e,r!==i&&(this.startColor=new kendo.Color(r),this.color=new kendo.Color(i))},step:function(e){var t=this,n=t.options,r=t.startColor,o=t.color,a=i(n.oldAngle,n.newAngle,e);if(this.element.geometry().setEndAngle(a),o){var s=d(i(r.r,o.r,e)),l=d(i(r.g,o.g,e)),h=d(i(r.b,o.b,e));this.element.stroke(new kendo.Color(s,l,h).toHex())}}}),p=a.extend({init:function(e,t){a.fn.init.call(this,e,t),this.theme=function(e){var t=n.ui.themes||{},i=e.theme||"",r=i.toLowerCase();if(-1!=n.SASS_THEMES.indexOf(r))return n.autoTheme().gauge;return(t[i]||t[r]||{}).gauge}(this.options),this._value=this.options.value,this.element.addClass("k-gauge"),this.redraw(),this._centerTemplate(),this._aria()},options:{name:"CircularProgressBar",ariaRole:!1,theme:"default",centerTemplate:"",color:"",colors:[],transitions:!0,pointerWidth:5,indeterminate:!1,label:null,labelId:null},events:[],value:function(e){var t=this;if(undefined===e)return t._value;e=t._restrictValue(e),t._centerSvgElements(),t._pointerChange(t._value,e),t._value=e,t._centerTemplate(),t._updateProgress()},redraw:function(){this._initSurface(),this._buildVisual(),this._draw()},resize:function(){var e=this.options.transitions;this.options.transitions=!1,this._initSurface(),this._buildVisual(),this._draw(),this._centerTemplate(),this.options.transitions=e},destroy:function(){var e=this;e.announce&&e.announce.remove(),a.fn.destroy.call(e)},_aria:function(){var t=this,n=t.options,i=t.value()||0,r=t.element;n.ariaRole&&(r.attr({role:"progressbar"}),n.indeterminate||r.attr({"aria-valuemin":0,"aria-valuemax":100}),n.labelId?r.attr("aria-labelledby",n.labelId):n.label&&r.attr("aria-label",n.label),t.announce=e('<span aria-live="polite" class="k-sr-only k-progress-announce"></span>'),t.announce.appendTo(e("body")),n.indeterminate?t.announce.text("Loading..."):(r.attr("aria-valuenow",i),t.announce.text(i+"%")))},_restrictValue:function(e){return e<0?0:e>100?100:e},_updateProgress:function(){var e=this,t=e.options,n=e.value()||0;t.ariaRole&&!t.indeterminate&&(e.element.attr("aria-valuenow",n),e.announce&&e.announce.text(n+"%"))},_centerSvgElements:function(){var e=this._getCenter();this.circle._geometry.center.x===e.x&&this.circle._geometry.center.y===e.y||(this.circle._geometry.center.x=e.x,this.circle._geometry.center.y=e.y,this.arc._geometry.center.x=e.x,this.arc._geometry.center.y=e.y,this.circle.geometryChange(),this.arc.geometryChange())},_centerTemplate:function(){var e,t,n;this.options.centerTemplate?(t=kendo.template(this.options.centerTemplate),(n=this._getCenterElement()).html(t({color:this._getColor(this.value()),value:this.value()})),e=this._centerTemplatePosition(n.width(),n.height()),n.css(e)):this._centerElement&&(this._centerElement.remove(),this._centerElement=null)},_getCenterElement:function(){var t=this._centerElement;return t||(t=this._centerElement=e("<div></div>").addClass("k-arcgauge-label"),this.element.append(t)),t},_pointerChange:function(e,t){this.options.transitions?new m(this.arc,{oldAngle:this._slotAngle(e),startColor:this._getColor(e),newAngle:this._slotAngle(t),endColor:this._getColor(t)}).play():(this.arc.stroke(this._getColor(t)),this.arc.geometry().setEndAngle(this._slotAngle(t)))},_draw:function(){var e,t,n=this.surface;n.clear(),n.draw(this._visuals),this.options.indeterminate?(e=n.element.find("path"),t=this._getCenter(),e[0].innerHTML=kendo.format('<animateTransform attributeName="transform" type="rotate" from="0 {0} {1}" to="360 {0} {1}" dur="1s" repeatCount="indefinite" />',t.x,t.y)):this.options.transitions&&new m(this.arc,{oldAngle:this._slotAngle(0),startColor:this._getColor(0),newAngle:this._slotAngle(this.value()),endColor:this._getColor(this.value())}).play()},_buildVisual:function(){var e=this._visuals=new g,t=this._getCenter(),n=this._getColor(this.value())||this.theme.pointer.color,i=Math.min(t.x,t.y)-5-this.options.pointerWidth,o=new l.Circle([t.x,t.y],i+this.options.pointerWidth/2),a=this.circle=new r.Circle(o,{fill:{color:"none"},stroke:{color:this.theme.scale.rangePlaceholderColor,width:this.options.pointerWidth}});e.append(a),this.options.indeterminate?this.arc=this._createArc(360,i,t,n):this.arc=this._createArc(this._slotAngle(this.value()),i,t,n),e.append(this.arc)},_slotAngle:function(e){return(e-0)/100*360+90+180},_getColor:function(e){var t=this.options,i=t.colors,r=t.color,o=n.isNumber(e)?e:0;if(i)for(var a=0;a<i.length;a++){var s=i[a],l=s.color,h=s.from;void 0===h&&(h=0);var c=s.to;if(void 0===c&&(c=100),h<=o&&o<=c)return l}return r},_createArc:function(e,t,n,i){var r=this.options.pointerWidth,o=new l.Arc([n.x,n.y],{radiusX:t+r/2,radiusY:t+r/2,startAngle:270,endAngle:e});return new c(o,{stroke:{width:r,color:this.options.color||i,opacity:this.options.opacity}})},_centerTemplatePosition:function(e,t){var n,i,r=this._getSize(),o=this._getCenter(),a=o.x-e/2,s=o.y-t/2;return e<r.width&&(n=a+e,a=Math.max(a,0),n>r.width&&(a-=n-r.width)),t<r.height&&(i=s+t)>r.height&&(s-=i-r.height),{left:a,top:s}},_getCenter:function(){var e=this._getSize();return new n.Point(e.width/2,e.height/2)},_getSize:function(){var e=this.element,t=200,n=200,i=e[0].offsetWidth,r=e[0].offsetHeight;return i||(i=t),r||(r=n),{width:i,height:r}},_surfaceElement:function(){return this.surfaceElement||(this.surfaceElement=document.createElement("div"),this.element[0].appendChild(this.surfaceElement)),this.surfaceElement},_initSurface:function(){var e=this.options,t=this.surface,i=this._surfaceElement(),r=this._getSize();n.elementSize(i,r),t?(this.surface.clear(),this.surface.resize()):this.surface=s.create(i,{type:e.renderAs})}});o.plugin(p)}(window.kendo.jQuery);var kendo$1=kendo;export{kendo$1 as default};
//# sourceMappingURL=kendo.circularprogressbar.js.map
