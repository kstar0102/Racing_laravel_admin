"use strict";(self.webpackChunkreact_typscript_racing_site_frontend=self.webpackChunkreact_typscript_racing_site_frontend||[]).push([[418],{9205:(e,t,n)=>{n.d(t,{Z:()=>l});var r=n(2791),i=n(3636),a=n(4664),o=n(184);const l=e=>{let{columns_data:t,ranking_data:n}=e;const[l,s]=(0,r.useState)(),[d,u]=(0,r.useState)(!0),[c,p]=(0,r.useState)({pagination:{current:1,pageSize:10}});(0,r.useEffect)((()=>{u(!1),s(n)}),[n]);return(0,o.jsx)(o.Fragment,{children:(0,o.jsx)(i.Z,{columns:t,rowKey:e=>e.id,dataSource:l,pagination:c.pagination,loading:d,onChange:(e,t,n)=>{p({pagination:e,filters:t,...n})},locale:{emptyText:(0,o.jsx)(a.Z,{description:"\u30c7\u30fc\u30bf\u304c\u3042\u308a\u307e\u305b\u3093"})},scroll:{x:!0}})})}},7418:(e,t,n)=>{n.r(t),n.d(t,{default:()=>de});var r=n(9205),i=n(6303),a=n(899),o=n(2791),l=n(5623),s=n(7003),d=n(4705),u=n(2806);function c(e,t){let[n,r]=(0,o.useState)(e),i=(0,u.E)(e);return(0,d.e)((()=>r(i.current)),[i,r,...t]),n}var p=n(4159),f=n(5612),v=n(9904),x=n(4190),b=n(7369),g=n(4672),h=n(2953),m=n(981),R=n(4510),y=n(4381),O=n(2740);var w,S=((w=S||{})[w.None=1]="None",w[w.Focusable=2]="Focusable",w[w.Hidden=4]="Hidden",w);let I=(0,f.yV)((function(e,t){let{features:n=1,...r}=e,i={ref:t,"aria-hidden":2===(2&n)||void 0,style:{position:"fixed",top:1,left:1,width:1,height:0,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...4===(4&n)&&2!==(2&n)&&{display:"none"}}};return(0,f.sY)({ourProps:i,theirProps:r,slot:{},defaultTag:"div",name:"Hidden"})}));function T(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[];for(let[r,i]of Object.entries(e))E(n,L(t,r),i);return n}function L(e,t){return e?e+"["+t+"]":t}function E(e,t,n){if(Array.isArray(n))for(let[r,i]of n.entries())E(e,L(t,r.toString()),i);else n instanceof Date?e.push([t,n.toISOString()]):"boolean"==typeof n?e.push([t,n?"1":"0"]):"string"==typeof n?e.push([t,n]):"number"==typeof n?e.push([t,"".concat(n)]):null==n?e.push([t,""]):T(n,t,e)}var j=n(5718),k=n(3654);var P,z,C=n(4420),_=n(1195),M=((z=M||{})[z.Open=0]="Open",z[z.Closed=1]="Closed",z),A=(e=>(e[e.Single=0]="Single",e[e.Multi=1]="Multi",e))(A||{}),D=(e=>(e[e.Pointer=0]="Pointer",e[e.Other=1]="Other",e))(D||{}),N=((P=N||{})[P.OpenListbox=0]="OpenListbox",P[P.CloseListbox=1]="CloseListbox",P[P.GoToOption=2]="GoToOption",P[P.Search=3]="Search",P[P.ClearSearch=4]="ClearSearch",P[P.RegisterOption=5]="RegisterOption",P[P.UnregisterOption=6]="UnregisterOption",P[P.RegisterLabel=7]="RegisterLabel",P);function F(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:e=>e,n=null!==e.activeOptionIndex?e.options[e.activeOptionIndex]:null,r=(0,m.z2)(t(e.options.slice()),(e=>e.dataRef.current.domRef.current)),i=n?r.indexOf(n):null;return-1===i&&(i=null),{options:r,activeOptionIndex:i}}let Z={1:e=>e.dataRef.current.disabled||1===e.listboxState?e:{...e,activeOptionIndex:null,listboxState:1},0(e){if(e.dataRef.current.disabled||0===e.listboxState)return e;let t=e.activeOptionIndex,{isSelected:n}=e.dataRef.current,r=e.options.findIndex((e=>n(e.dataRef.current.value)));return-1!==r&&(t=r),{...e,listboxState:0,activeOptionIndex:t}},2(e,t){var n;if(e.dataRef.current.disabled||1===e.listboxState)return e;let r=F(e),i=(0,g.d)(t,{resolveItems:()=>r.options,resolveActiveIndex:()=>r.activeOptionIndex,resolveId:e=>e.id,resolveDisabled:e=>e.dataRef.current.disabled});return{...e,...r,searchQuery:"",activeOptionIndex:i,activationTrigger:null!=(n=t.trigger)?n:1}},3:(e,t)=>{if(e.dataRef.current.disabled||1===e.listboxState)return e;let n=""!==e.searchQuery?0:1,r=e.searchQuery+t.value.toLowerCase(),i=(null!==e.activeOptionIndex?e.options.slice(e.activeOptionIndex+n).concat(e.options.slice(0,e.activeOptionIndex+n)):e.options).find((e=>{var t;return!e.dataRef.current.disabled&&(null==(t=e.dataRef.current.textValue)?void 0:t.startsWith(r))})),a=i?e.options.indexOf(i):-1;return-1===a||a===e.activeOptionIndex?{...e,searchQuery:r}:{...e,searchQuery:r,activeOptionIndex:a,activationTrigger:1}},4:e=>e.dataRef.current.disabled||1===e.listboxState||""===e.searchQuery?e:{...e,searchQuery:""},5:(e,t)=>{let n={id:t.id,dataRef:t.dataRef},r=F(e,(e=>[...e,n]));return null===e.activeOptionIndex&&e.dataRef.current.isSelected(t.dataRef.current.value)&&(r.activeOptionIndex=r.options.indexOf(n)),{...e,...r}},6:(e,t)=>{let n=F(e,(e=>{let n=e.findIndex((e=>e.id===t.id));return-1!==n&&e.splice(n,1),e}));return{...e,...n,activationTrigger:1}},7:(e,t)=>({...e,labelId:t.id})},G=(0,o.createContext)(null);function V(e){let t=(0,o.useContext)(G);if(null===t){let t=new Error("<".concat(e," /> is missing a parent <Listbox /> component."));throw Error.captureStackTrace&&Error.captureStackTrace(t,V),t}return t}G.displayName="ListboxActionsContext";let Q=(0,o.createContext)(null);function B(e){let t=(0,o.useContext)(Q);if(null===t){let t=new Error("<".concat(e," /> is missing a parent <Listbox /> component."));throw Error.captureStackTrace&&Error.captureStackTrace(t,B),t}return t}function K(e,t){return(0,v.E)(t.type,Z,e,t)}Q.displayName="ListboxDataContext";let U=o.Fragment;let Y=f.AN.RenderStrategy|f.AN.Static;let H=(0,f.yV)((function(e,t){let{value:n,defaultValue:r,form:i,name:a,onChange:s,by:u=((e,t)=>e===t),disabled:c=!1,horizontal:x=!1,multiple:b=!1,...h}=e;const y=x?"horizontal":"vertical";let w=(0,p.T)(t),[L=(b?[]:void 0),E]=function(e,t,n){let[r,i]=(0,o.useState)(n),a=void 0!==e,l=(0,o.useRef)(a),s=(0,o.useRef)(!1),d=(0,o.useRef)(!1);return!a||l.current||s.current?!a&&l.current&&!d.current&&(d.current=!0,l.current=a,console.error("A component is changing from controlled to uncontrolled. This may be caused by the value changing from a defined value to undefined, which should not happen.")):(s.current=!0,l.current=a,console.error("A component is changing from uncontrolled to controlled. This may be caused by the value changing from undefined to a defined value, which should not happen.")),[a?e:r,(0,k.z)((e=>(a||i(e),null==t?void 0:t(e))))]}(n,s,r),[j,P]=(0,o.useReducer)(K,{dataRef:(0,o.createRef)(),listboxState:1,options:[],searchQuery:"",labelId:null,activeOptionIndex:null,activationTrigger:1}),z=(0,o.useRef)({static:!1,hold:!1}),C=(0,o.useRef)(null),_=(0,o.useRef)(null),M=(0,o.useRef)(null),A=(0,k.z)("string"==typeof u?(e,t)=>{let n=u;return(null==e?void 0:e[n])===(null==t?void 0:t[n])}:u),D=(0,o.useCallback)((e=>(0,v.E)(N.mode,{1:()=>L.some((t=>A(t,e))),0:()=>A(L,e)})),[L]),N=(0,o.useMemo)((()=>({...j,value:L,disabled:c,mode:b?1:0,orientation:y,compare:A,isSelected:D,optionsPropsRef:z,labelRef:C,buttonRef:_,optionsRef:M})),[L,c,b,j]);(0,d.e)((()=>{j.dataRef.current=N}),[N]),(0,O.O)([N.buttonRef,N.optionsRef],((e,t)=>{var n;P({type:1}),(0,m.sP)(t,m.tJ.Loose)||(e.preventDefault(),null==(n=N.buttonRef.current)||n.focus())}),0===N.listboxState);let F=(0,o.useMemo)((()=>({open:0===N.listboxState,disabled:c,value:L})),[N,c,L]),Z=(0,k.z)((e=>{let t=N.options.find((t=>t.id===e));t&&q(t.dataRef.current.value)})),V=(0,k.z)((()=>{if(null!==N.activeOptionIndex){let{dataRef:e,id:t}=N.options[N.activeOptionIndex];q(e.current.value),P({type:2,focus:g.T.Specific,id:t})}})),B=(0,k.z)((()=>P({type:0}))),Y=(0,k.z)((()=>P({type:1}))),H=(0,k.z)(((e,t,n)=>e===g.T.Specific?P({type:2,focus:g.T.Specific,id:t,trigger:n}):P({type:2,focus:e,trigger:n}))),J=(0,k.z)(((e,t)=>(P({type:5,id:e,dataRef:t}),()=>P({type:6,id:e})))),W=(0,k.z)((e=>(P({type:7,id:e}),()=>P({type:7,id:null})))),q=(0,k.z)((e=>(0,v.E)(N.mode,{0:()=>null==E?void 0:E(e),1(){let t=N.value.slice(),n=t.findIndex((t=>A(t,e)));return-1===n?t.push(e):t.splice(n,1),null==E?void 0:E(t)}}))),X=(0,k.z)((e=>P({type:3,value:e}))),$=(0,k.z)((()=>P({type:4}))),ee=(0,o.useMemo)((()=>({onChange:q,registerOption:J,registerLabel:W,goToOption:H,closeListbox:Y,openListbox:B,selectActiveOption:V,selectOption:Z,search:X,clearSearch:$})),[]),te={ref:w},ne=(0,o.useRef)(null),re=(0,l.G)();return(0,o.useEffect)((()=>{ne.current&&void 0!==r&&re.addEventListener(ne.current,"reset",(()=>{null==E||E(r)}))}),[ne,E]),o.createElement(G.Provider,{value:ee},o.createElement(Q.Provider,{value:N},o.createElement(R.up,{value:(0,v.E)(N.listboxState,{0:R.ZM.Open,1:R.ZM.Closed})},null!=a&&null!=L&&T({[a]:L}).map(((e,t)=>{let[n,r]=e;return o.createElement(I,{features:S.Hidden,ref:0===t?e=>{var t;ne.current=null!=(t=null==e?void 0:e.closest("form"))?t:null}:void 0,...(0,f.oA)({key:n,as:"input",type:"hidden",hidden:!0,readOnly:!0,form:i,name:n,value:r})})})),(0,f.sY)({ourProps:te,theirProps:h,slot:F,defaultTag:U,name:"Listbox"}))))})),J=(0,f.yV)((function(e,t){var n;let r=(0,s.M)(),{id:i="headlessui-listbox-button-".concat(r),...a}=e,d=B("Listbox.Button"),u=V("Listbox.Button"),v=(0,p.T)(d.buttonRef,t),x=(0,l.G)(),m=(0,k.z)((e=>{switch(e.key){case b.R.Space:case b.R.Enter:case b.R.ArrowDown:e.preventDefault(),u.openListbox(),x.nextFrame((()=>{d.value||u.goToOption(g.T.First)}));break;case b.R.ArrowUp:e.preventDefault(),u.openListbox(),x.nextFrame((()=>{d.value||u.goToOption(g.T.Last)}))}})),R=(0,k.z)((e=>{if(e.key===b.R.Space)e.preventDefault()})),O=(0,k.z)((e=>{if((0,h.P)(e.currentTarget))return e.preventDefault();0===d.listboxState?(u.closeListbox(),x.nextFrame((()=>{var e;return null==(e=d.buttonRef.current)?void 0:e.focus({preventScroll:!0})}))):(e.preventDefault(),u.openListbox())})),w=c((()=>{if(d.labelId)return[d.labelId,i].join(" ")}),[d.labelId,i]),S=(0,o.useMemo)((()=>({open:0===d.listboxState,disabled:d.disabled,value:d.value})),[d]),I={ref:v,id:i,type:(0,y.f)(e,d.buttonRef),"aria-haspopup":"listbox","aria-controls":null==(n=d.optionsRef.current)?void 0:n.id,"aria-expanded":0===d.listboxState,"aria-labelledby":w,disabled:d.disabled,onKeyDown:m,onKeyUp:R,onClick:O};return(0,f.sY)({ourProps:I,theirProps:a,slot:S,defaultTag:"button",name:"Listbox.Button"})})),W=(0,f.yV)((function(e,t){let n=(0,s.M)(),{id:r="headlessui-listbox-label-".concat(n),...i}=e,a=B("Listbox.Label"),l=V("Listbox.Label"),u=(0,p.T)(a.labelRef,t);(0,d.e)((()=>l.registerLabel(r)),[r]);let c=(0,k.z)((()=>{var e;return null==(e=a.buttonRef.current)?void 0:e.focus({preventScroll:!0})})),v=(0,o.useMemo)((()=>({open:0===a.listboxState,disabled:a.disabled})),[a]);return(0,f.sY)({ourProps:{ref:u,id:r,onClick:c},theirProps:i,slot:v,defaultTag:"label",name:"Listbox.Label"})})),q=(0,f.yV)((function(e,t){var n;let r=(0,s.M)(),{id:i="headlessui-listbox-options-".concat(r),...a}=e,d=B("Listbox.Options"),u=V("Listbox.Options"),h=(0,p.T)(d.optionsRef,t),m=(0,l.G)(),y=(0,l.G)(),O=(0,R.oJ)(),w=null!==O?(O&R.ZM.Open)===R.ZM.Open:0===d.listboxState;(0,o.useEffect)((()=>{var e;let t=d.optionsRef.current;t&&0===d.listboxState&&t!==(null==(e=(0,j.r)(t))?void 0:e.activeElement)&&t.focus({preventScroll:!0})}),[d.listboxState,d.optionsRef]);let S=(0,k.z)((e=>{switch(y.dispose(),e.key){case b.R.Space:if(""!==d.searchQuery)return e.preventDefault(),e.stopPropagation(),u.search(e.key);case b.R.Enter:if(e.preventDefault(),e.stopPropagation(),null!==d.activeOptionIndex){let{dataRef:e}=d.options[d.activeOptionIndex];u.onChange(e.current.value)}0===d.mode&&(u.closeListbox(),(0,x.k)().nextFrame((()=>{var e;return null==(e=d.buttonRef.current)?void 0:e.focus({preventScroll:!0})})));break;case(0,v.E)(d.orientation,{vertical:b.R.ArrowDown,horizontal:b.R.ArrowRight}):return e.preventDefault(),e.stopPropagation(),u.goToOption(g.T.Next);case(0,v.E)(d.orientation,{vertical:b.R.ArrowUp,horizontal:b.R.ArrowLeft}):return e.preventDefault(),e.stopPropagation(),u.goToOption(g.T.Previous);case b.R.Home:case b.R.PageUp:return e.preventDefault(),e.stopPropagation(),u.goToOption(g.T.First);case b.R.End:case b.R.PageDown:return e.preventDefault(),e.stopPropagation(),u.goToOption(g.T.Last);case b.R.Escape:return e.preventDefault(),e.stopPropagation(),u.closeListbox(),m.nextFrame((()=>{var e;return null==(e=d.buttonRef.current)?void 0:e.focus({preventScroll:!0})}));case b.R.Tab:e.preventDefault(),e.stopPropagation();break;default:1===e.key.length&&(u.search(e.key),y.setTimeout((()=>u.clearSearch()),350))}})),I=c((()=>{var e,t,n;return null!=(n=null==(e=d.labelRef.current)?void 0:e.id)?n:null==(t=d.buttonRef.current)?void 0:t.id}),[d.labelRef.current,d.buttonRef.current]),T=(0,o.useMemo)((()=>({open:0===d.listboxState})),[d]),L={"aria-activedescendant":null===d.activeOptionIndex||null==(n=d.options[d.activeOptionIndex])?void 0:n.id,"aria-multiselectable":1===d.mode||void 0,"aria-labelledby":I,"aria-orientation":d.orientation,id:i,onKeyDown:S,role:"listbox",tabIndex:0,ref:h};return(0,f.sY)({ourProps:L,theirProps:a,slot:T,defaultTag:"ul",features:Y,visible:w,name:"Listbox.Options"})})),X=(0,f.yV)((function(e,t){let n=(0,s.M)(),{id:r="headlessui-listbox-option-".concat(n),disabled:i=!1,value:a,...l}=e,c=B("Listbox.Option"),v=V("Listbox.Option"),b=null!==c.activeOptionIndex&&c.options[c.activeOptionIndex].id===r,h=c.isSelected(a),m=(0,o.useRef)(null),R=(0,_.x)(m),y=(0,u.E)({disabled:i,value:a,domRef:m,get textValue(){return R()}}),O=(0,p.T)(t,m);(0,d.e)((()=>{if(0!==c.listboxState||!b||0===c.activationTrigger)return;let e=(0,x.k)();return e.requestAnimationFrame((()=>{var e,t;null==(t=null==(e=m.current)?void 0:e.scrollIntoView)||t.call(e,{block:"nearest"})})),e.dispose}),[m,b,c.listboxState,c.activationTrigger,c.activeOptionIndex]),(0,d.e)((()=>v.registerOption(r,y)),[y,r]);let w=(0,k.z)((e=>{if(i)return e.preventDefault();v.onChange(a),0===c.mode&&(v.closeListbox(),(0,x.k)().nextFrame((()=>{var e;return null==(e=c.buttonRef.current)?void 0:e.focus({preventScroll:!0})})))})),S=(0,k.z)((()=>{if(i)return v.goToOption(g.T.Nothing);v.goToOption(g.T.Specific,r)})),I=(0,C.g)(),T=(0,k.z)((e=>I.update(e))),L=(0,k.z)((e=>{I.wasMoved(e)&&(i||b||v.goToOption(g.T.Specific,r,0))})),E=(0,k.z)((e=>{I.wasMoved(e)&&(i||b&&v.goToOption(g.T.Nothing))})),j=(0,o.useMemo)((()=>({active:b,selected:h,disabled:i})),[b,h,i]);return(0,f.sY)({ourProps:{id:r,ref:O,role:"option",tabIndex:!0===i?void 0:-1,"aria-disabled":!0===i||void 0,"aria-selected":h,disabled:void 0,onClick:w,onFocus:S,onPointerEnter:T,onMouseEnter:T,onPointerMove:L,onMouseMove:L,onPointerLeave:E,onMouseLeave:E},theirProps:l,slot:j,defaultTag:"li",name:"Listbox.Option"})})),$=Object.assign(H,{Button:J,Label:W,Options:q,Option:X});var ee=n(8195);const te=o.forwardRef((function(e,t){let{title:n,titleId:r,...i}=e;return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true",ref:t,"aria-labelledby":r},i),n?o.createElement("title",{id:r},n):null,o.createElement("path",{fillRule:"evenodd",d:"M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z",clipRule:"evenodd"}))}));const ne=o.forwardRef((function(e,t){let{title:n,titleId:r,...i}=e;return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true",ref:t,"aria-labelledby":r},i),n?o.createElement("title",{id:r},n):null,o.createElement("path",{fillRule:"evenodd",d:"M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z",clipRule:"evenodd"}))}));var re=n(9434),ie=n(349),ae=n(184);const oe=[{id:1,name:"\u6708\u9593\u30e9\u30f3\u30ad\u30f3\u30b0"},{id:2,name:"\u5e74\u9593\u30e9\u30f3\u30ad\u30f3\u30b0"},{id:3,name:"\u4e0a\u534a\u671f\u30e9\u30f3\u30ad\u30f3\u30b0"},{id:4,name:"\u4e0b\u534a\u671f\u30e9\u30f3\u30ad\u30f3\u30b0"}];function le(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return t.filter(Boolean).join(" ")}const se=[{title:"\u9806\u4f4d",dataIndex:"rank",sorter:(e,t)=>e.rank-t.rank,width:"9%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.rank,"\u4f4d"]})},{title:"\u540d\u524d",dataIndex:"name",sorter:(e,t)=>e.name.localeCompare(t.name),width:"9%"},{title:"\u56de\u6570",dataIndex:"number_times",sorter:(e,t)=>e.number_times-t.number_times,width:"9%"},{title:"pt",dataIndex:"point",sorter:(e,t)=>parseInt(t.point.replace(",",""))-parseInt(e.point.replace(",","")),width:"9%"},{title:"\u25ce",dataIndex:"double_circle",sorter:(e,t)=>e.double_circle-t.double_circle,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.double_circle,"%"]})},{title:"\u25cb",dataIndex:"single_circle",sorter:(e,t)=>e.single_circle-t.single_circle,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.single_circle,"%"]})},{title:"\u25b2",dataIndex:"triangle",sorter:(e,t)=>e.triangle-t.triangle,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.triangle,"%"]})},{title:"\u2606",dataIndex:"five_star",sorter:(e,t)=>e.five_star-t.five_star,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.five_star,"%"]})},{title:"\u7a74",dataIndex:"hole",sorter:(e,t)=>e.hole-t.hole,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.hole,"%"]})},{title:"\u6d88",dataIndex:"disappear",sorter:(e,t)=>e.disappear-t.disappear,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.disappear,"%"]})},{title:"\u5358",dataIndex:"single",sorter:(e,t)=>e.single-t.single,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.single,"%"]})},{title:"\u8907",dataIndex:"multiple",sorter:(e,t)=>e.multiple-t.multiple,width:"8%",render:(e,t)=>(0,ae.jsxs)("span",{children:[t.multiple,"%"]})}],de=()=>{const[e,t]=(0,o.useState)(oe[0]),n=(0,re.I0)(),{ranking_data:l}=(0,re.v9)((e=>e.rankingReducer)),[s,d]=(0,o.useState)([]);return(0,o.useEffect)((()=>{n({type:ie.Z.GETRANKINGDATA,payload:1})}),[]),(0,o.useEffect)((()=>{n({type:ie.Z.GETRANKINGDATA,payload:e.id})}),[e]),(0,o.useEffect)((()=>{d(l)}),[l]),(0,ae.jsxs)("div",{children:[(0,ae.jsx)(i.Z,{as:"a",color:"red",tag:!0,children:"\u4e88\u60f3\u30e9\u30f3\u30ad\u30f3\u30b0"}),(0,ae.jsxs)(a.Z,{raised:!0,style:{backgroundColor:"#f5deb3"},children:[(0,ae.jsx)($,{value:e,onChange:t,children:t=>{let{open:n}=t;return(0,ae.jsx)(ae.Fragment,{children:(0,ae.jsxs)("div",{className:"relative mt-2 pb-5",children:[(0,ae.jsxs)($.Button,{className:"relative cursor-default w-full lg:w-1/5 rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6",children:[(0,ae.jsx)("span",{className:"flex items-center",children:(0,ae.jsx)("span",{className:"ml-3 block truncate",children:e.name})}),(0,ae.jsx)("span",{className:"pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2",children:(0,ae.jsx)(te,{className:"h-5 w-5 text-gray-400","aria-hidden":"true"})})]}),(0,ae.jsx)(ee.u,{show:n,as:o.Fragment,leave:"transition ease-in duration-100",leaveFrom:"opacity-100",leaveTo:"opacity-0",children:(0,ae.jsx)($.Options,{className:"absolute z-10 mt-1 max-h-56 w-full lg:w-1/5 overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm",children:oe.map((e=>(0,ae.jsx)($.Option,{className:e=>{let{active:t}=e;return le(t?"bg-indigo-600 text-white":"text-gray-900","relative cursor-default select-none py-2 pl-3 pr-9")},value:e,children:t=>{let{selected:n,active:r}=t;return(0,ae.jsxs)(ae.Fragment,{children:[(0,ae.jsx)("div",{className:"flex items-center",children:(0,ae.jsx)("span",{className:le(n?"font-semibold":"font-normal","ml-3 block truncate"),children:e.name})}),n?(0,ae.jsx)("span",{className:le(r?"text-white":"text-indigo-600","absolute inset-y-0 right-0 flex items-center pr-4"),children:(0,ae.jsx)(ne,{className:"h-5 w-5","aria-hidden":"true"})}):null]})}},e.id)))})})]})})}}),(0,ae.jsx)(r.Z,{columns_data:se,ranking_data:s})]})]})}}}]);
//# sourceMappingURL=418.68f54990.chunk.js.map