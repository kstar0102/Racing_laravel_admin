"use strict";(self.webpackChunkreact_typscript_racing_site_frontend=self.webpackChunkreact_typscript_racing_site_frontend||[]).push([[518],{4260:(e,a,l)=>{l.d(a,{Ab:()=>c,O$:()=>s,Pb:()=>r,ed:()=>i,ry:()=>t,tN:()=>n});const t=[{value:"00",label:"00"},{value:"05",label:"05"},{value:"10",label:"10"},{value:"15",label:"15"},{value:"20",label:"20"},{value:"25",label:"25"},{value:"30",label:"30"},{value:"35",label:"35"},{value:"40",label:"40"},{value:"45",label:"45"},{value:"50",label:"50"},{value:"55",label:"55"}],n=[{value:"13",label:"13"},{value:"14",label:"14"},{value:"15",label:"15"},{value:"16",label:"16"},{value:"17",label:"17"},{value:"18",label:"18"},{value:"19",label:"19"},{value:"20",label:"20"},{value:"21",label:"21"},{value:"22",label:"22"},{value:"23",label:"23"},{value:"00",label:"00"},{value:"01",label:"01"},{value:"02",label:"02"}],s=[{value:"1",label:"1\u6708"},{value:"2",label:"2\u6708"},{value:"3",label:"3\u6708"},{value:"4",label:"4\u6708"},{value:"5",label:"5\u6708"},{value:"6",label:"6\u6708"},{value:"7",label:"7\u6708"},{value:"8",label:"8\u6708"},{value:"9",label:"9\u6708"},{value:"10",label:"10\u6708"},{value:"11",label:"11\u6708"},{value:"12",label:"12\u6708"}],r=[{value:"1R",label:"1R"},{value:"2R",label:"2R"},{value:"3R",label:"3R"},{value:"4R",label:"4R"},{value:"5R",label:"5R"},{value:"6R",label:"6R"},{value:"7R",label:"7R"},{value:"8R",label:"8R"},{value:"9R",label:"9R"},{value:"10R",label:"10R"},{value:"11R",label:"11R"},{value:"12R",label:"12R"}],c=[{value:"0",label:"\u30e6\u30fc\u30b6\u30fc"},{value:"1",label:"\u7ba1\u7406\u8005"},{value:"2",label:"\u30b9\u30fc\u30d1\u30fc\u30e6\u30fc\u30b6\u30fc"}],i=e=>{for(let a=0;a<e.length;a++){const l=e[a];return!(e.filter((e=>e==l)).length>1)}}},5518:(e,a,l)=>{l.r(a),l.d(a,{default:()=>N});var t=l(2791),n=l(899),s=l(6303),r=l(3655),c=l(1678),i=l(3636),o=l(4664),d=l(1006),u=l(5535),p=l(834),m=l(1460),v=l(9434),h=l(1672),b=l(5985),x=(l(5462),l(4260)),Z=l(184);const{Text:g}=r.default,f=()=>{const e=[{title:"\u958b\u50ac\u65e5",dataIndex:"event_date",key:"event_date",width:"20%"},{title:"\u958b\u50ac\u5834\u6240",dataIndex:"event_place",key:"event_place",width:"10%",render:(e,a)=>(0,Z.jsx)("div",{children:(0,Z.jsx)(s.Z,{color:"purple",horizontal:!0,className:"cursor",style:{marginRight:15},children:a.places.name})})},{title:"Race",dataIndex:"race_number",key:"race_number"},{title:"\u30ec\u30fc\u30b9\u540d",dataIndex:"race_name",key:"race_name"},{title:"\u5099\u8003",dataIndex:"action",key:"action",width:"20%",render:(e,a)=>{let l=!0;return y.map((e=>{e.race_management_id==a.id&&(l=!1)})),(0,Z.jsxs)("div",{children:[(0,Z.jsx)(s.Z,{color:"red",horizontal:!0,className:"cursor",style:{marginRight:15},onClick:()=>P(a),children:"\u7de8 \u96c6"}),y.length?l?(0,Z.jsx)(c.Z,{status:"success",text:"\u4e88\u60f3\u5165\u529b"}):(0,Z.jsx)(c.Z,{status:"error",text:"\u4e88\u60f3\u5909\u66f4"}):(0,Z.jsx)(c.Z,{status:"success",text:"\u4e88\u60f3\u5165\u529b"})]})},ellipsis:!0}],[a,l]=(0,t.useState)(),[n,r]=(0,t.useState)(!1),[f,N]=(0,t.useState)({pagination:{current:1,pageSize:10}}),j=(0,v.I0)(),{expected_race_data:_,expected_battle_data:y}=(0,v.v9)((e=>e.expectedReducer)),{userData:R}=(0,v.v9)((e=>e.authReducer)),[w,E]=(0,t.useState)(!1),[C,T]=(0,t.useState)(!1),[k,G]=(0,t.useState)([]),[A,D]=(0,t.useState)([0,0,0,0,0,0]),[z,S]=(0,t.useState)([!1,!1,!1,!1,!1,!1]);(0,t.useEffect)((()=>{r(!0),j({type:h.Z.GETEXPECTEDRACEDATA}),j({type:h.Z.GETEXPECTEDBATTLEDATA,payload:R.id})}),[]);const P=e=>{const a=new Date,[l,t,n]=e.event_date.split("-"),s=new Date(l,t-1,n,e.hour_data,e.minute_data);if(a>new Date(s.getTime()+12e4))b.Am.error("\u30ec\u30fc\u30b9\u304c\u59cb\u307e\u3063\u305f\u305f\u3081\u3001\u4e88\u60f3\u30d0\u30c8\u30eb\u5165\u529b\u304c\u3067\u304d\u307e\u305b\u3093\u3002");else{E(!0);const a=e.running_horses.map((e=>({value:e.id,label:e.name})));T(e),G(a);[...y].map((a=>a.race_management_id==e.id&&(D([a.double_circle,a.single_circle,a.triangle,a.five_star,a.hole,a.disappear]),!0)))}},K=()=>{E(!1),T(!1),D([0,0,0,0,0,0])};(0,t.useEffect)((()=>{_.length&&(r(!1),l(_))}),[_]);const I=()=>{if((0,x.ed)(A)){const e={user_id:R.id,race_management_id:C.id,expected_battle_data:A};j({type:h.Z.CREATEEXPECTEDBATTLE,payload:e}),E(!1),T(!1),D([0,0,0,0,0,0]),S([!1,!1,!1,!1,!1,!1])}else b.Am.error("\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002")},B=(e,a)=>{const l=[...A];if(l.includes(a)){const a=z.map(((a,l)=>l==e));S(a),b.Am.error("\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002")}else l[e]=a,D(l)};return(0,Z.jsxs)(Z.Fragment,{children:[(0,Z.jsx)(Z.Fragment,{children:(0,Z.jsx)(i.Z,{columns:e,rowKey:e=>e.id,dataSource:a,pagination:f.pagination,loading:n,onChange:(e,a,t,n)=>{var s;N({pagination:e,filters:a,...t}),e.pageSize!==(null===(s=f.pagination)||void 0===s?void 0:s.pageSize)&&l([])},locale:{emptyText:(0,Z.jsx)(o.Z,{description:"\u30c7\u30fc\u30bf\u304c\u3042\u308a\u307e\u305b\u3093"})},scroll:{x:!0}})}),(0,Z.jsxs)(d.Z,{open:w,onCancel:K,closable:!1,footer:()=>(0,Z.jsxs)("div",{className:"w-full flex justify-center items-center",children:[(0,Z.jsx)("div",{className:"w-40 pr-6",children:(0,Z.jsx)(p.Z,{className:"w-full",secondary:!0,onClick:K,children:"\u30ad\xa0\u30e3\xa0\u30f3\xa0\u30bb\xa0\u30eb"})}),(0,Z.jsx)("div",{className:"w-40 pr-6",children:(0,Z.jsx)(p.Z,{className:"w-full",primary:!0,onClick:I,children:"\u767b\xa0\xa0\xa0\xa0\xa0\xa0\xa0\u9332"})})]}),children:[C&&(0,Z.jsx)(m.Z,{info:!0,header:"".concat(C.event_date.slice(5)," \xa0 ").concat(C.places.name," ").concat(C.race_number," \xa0 ").concat(C.race_name," \xa0 ").concat(C.hour_data," : ").concat(C.minute_data," \u767a\u8d70")}),(0,Z.jsxs)("div",{className:"flex items-center pt-5",children:[(0,Z.jsx)(s.Z,{color:"red",horizontal:!0,className:"w-24",children:"\u25ce :"}),(0,Z.jsx)(u.Z,{value:k.length&&(A[0]?A[0]:"\u9078\u629e\u3057\u3066\u304f\u3060\u3055\u3044\u3002"),className:"w-full",onChange:e=>B(0,e),options:k})]}),z[0]&&(0,Z.jsx)(g,{type:"danger",className:"pl-24",children:"\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002"}),(0,Z.jsxs)("div",{className:"flex items-center pt-5",children:[(0,Z.jsx)(s.Z,{color:"red",horizontal:!0,className:"w-24",children:"\u25cb :"}),(0,Z.jsx)(u.Z,{value:k.length&&(A[1]?A[1]:"\u9078\u629e\u3057\u3066\u304f\u3060\u3055\u3044\u3002"),className:"w-full",onChange:e=>B(1,e),options:k})]}),z[1]&&(0,Z.jsx)(g,{type:"danger",className:"pl-24",children:"\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002"}),(0,Z.jsxs)("div",{className:"flex items-center pt-5",children:[(0,Z.jsx)(s.Z,{color:"red",horizontal:!0,className:"w-24",children:"\u25b2 :"}),(0,Z.jsx)(u.Z,{value:k.length&&(A[2]?A[2]:"\u9078\u629e\u3057\u3066\u304f\u3060\u3055\u3044\u3002"),className:"w-full",onChange:e=>B(2,e),options:k})]}),z[2]&&(0,Z.jsx)(g,{type:"danger",className:"pl-24",children:"\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002"}),(0,Z.jsxs)("div",{className:"flex items-center pt-5",children:[(0,Z.jsx)(s.Z,{color:"red",horizontal:!0,className:"w-24",children:"\u2606 :"}),(0,Z.jsx)(u.Z,{value:k.length&&(A[3]?A[3]:"\u9078\u629e\u3057\u3066\u304f\u3060\u3055\u3044\u3002"),className:"w-full",onChange:e=>B(3,e),options:k})]}),z[3]&&(0,Z.jsx)(g,{type:"danger",className:"pl-24",children:"\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002"}),(0,Z.jsxs)("div",{className:"flex items-center pt-5",children:[(0,Z.jsx)(s.Z,{color:"red",horizontal:!0,className:"w-24",children:"\u7a74 :"}),(0,Z.jsx)(u.Z,{value:k.length&&(A[4]?A[4]:"\u9078\u629e\u3057\u3066\u304f\u3060\u3055\u3044\u3002"),className:"w-full",onChange:e=>B(4,e),options:k})]}),z[4]&&(0,Z.jsx)(g,{type:"danger",className:"pl-24",children:"\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002"}),(0,Z.jsxs)("div",{className:"flex items-center pt-5",children:[(0,Z.jsx)(s.Z,{color:"red",horizontal:!0,className:"w-24",children:"\u6d88 :"}),(0,Z.jsx)(u.Z,{value:k.length&&(A[5]?A[5]:"\u9078\u629e\u3057\u3066\u304f\u3060\u3055\u3044\u3002"),className:"w-full",onChange:e=>B(5,e),options:k})]}),z[5]&&(0,Z.jsx)(g,{type:"danger",className:"pl-24",children:"\u4e88\u60f3\u304c\u88ab\u3063\u3066\u3044\u307e\u3059\u3002"})]})]})},N=()=>(0,Z.jsxs)(n.Z,{raised:!0,style:{backgroundColor:"#f5deb3"},children:[(0,Z.jsx)("div",{className:"pb-3",children:(0,Z.jsx)(s.Z,{as:"a",color:"orange",ribbon:!0,children:"\u4e88 \u60f3 \u30d0 \u30c8 \u30eb"})}),(0,Z.jsx)(f,{})]})},1460:(e,a,l)=>{l.d(a,{Z:()=>_});var t=l(7462),n=l(4578),s=l(4517),r=l(8182),c=l(2791),i=l(7826),o=l(6755),d=l(6246),u=l(5831),p=l(1126),m=l(2836);function v(e){var a=e.children,l=e.className,n=e.content,s=(0,r.Z)("content",l),i=(0,o.Z)(v,e),p=(0,d.Z)(v,e);return c.createElement(p,(0,t.Z)({},i,{className:s}),u.kK(a)?n:a)}v.handledProps=["as","children","className","content"],v.propTypes={};const h=v;function b(e){var a=e.children,l=e.className,n=e.content,s=(0,r.Z)("header",l),i=(0,o.Z)(b,e),p=(0,d.Z)(b,e);return c.createElement(p,(0,t.Z)({},i,{className:s}),u.kK(a)?n:a)}b.handledProps=["as","children","className","content"],b.propTypes={},b.create=(0,p.u5)(b,(function(e){return{content:e}}));const x=b;var Z=l(4210);function g(e){var a=e.children,l=e.className,n=e.content,s=(0,r.Z)("content",l),i=(0,o.Z)(g,e),p=(0,d.Z)(g,e);return c.createElement(p,(0,t.Z)({},i,{className:s}),u.kK(a)?n:a)}g.handledProps=["as","children","className","content"],g.propTypes={},g.defaultProps={as:"li"},g.create=(0,p.u5)(g,(function(e){return{content:e}}));const f=g;function N(e){var a=e.children,l=e.className,n=e.items,s=(0,r.Z)("list",l),i=(0,o.Z)(N,e),p=(0,d.Z)(N,e);return c.createElement(p,(0,t.Z)({},i,{className:s}),u.kK(a)?(0,Z.Z)(n,f.create):a)}N.handledProps=["as","children","className","items"],N.propTypes={},N.defaultProps={as:"ul"},N.create=(0,p.u5)(N,(function(e){return{items:e}}));const j=N;var _=function(e){function a(){for(var a,l=arguments.length,t=new Array(l),n=0;n<l;n++)t[n]=arguments[n];return(a=e.call.apply(e,[this].concat(t))||this).handleDismiss=function(e){var l=a.props.onDismiss;l&&l(e,a.props)},a}return(0,n.Z)(a,e),a.prototype.render=function(){var e=this.props,l=e.attached,n=e.children,v=e.className,b=e.color,Z=e.compact,g=e.content,f=e.error,N=e.floating,_=e.header,y=e.hidden,R=e.icon,w=e.info,E=e.list,C=e.negative,T=e.onDismiss,k=e.positive,G=e.size,A=e.success,D=e.visible,z=e.warning,S=(0,r.Z)("ui",b,G,(0,i.lG)(Z,"compact"),(0,i.lG)(f,"error"),(0,i.lG)(N,"floating"),(0,i.lG)(y,"hidden"),(0,i.lG)(R,"icon"),(0,i.lG)(w,"info"),(0,i.lG)(C,"negative"),(0,i.lG)(k,"positive"),(0,i.lG)(A,"success"),(0,i.lG)(D,"visible"),(0,i.lG)(z,"warning"),(0,i.sU)(l,"attached"),"message",v),P=T&&c.createElement(m.Z,{name:"close",onClick:this.handleDismiss}),K=(0,o.Z)(a,this.props),I=(0,d.Z)(a,this.props);return u.kK(n)?c.createElement(I,(0,t.Z)({},K,{className:S}),P,m.Z.create(R,{autoGenerateKey:!1}),(!(0,s.Z)(_)||!(0,s.Z)(g)||!(0,s.Z)(E))&&c.createElement(h,null,x.create(_,{autoGenerateKey:!1}),j.create(E,{autoGenerateKey:!1}),(0,p.BU)(g,{autoGenerateKey:!1}))):c.createElement(I,(0,t.Z)({},K,{className:S}),P,n)},a}(c.Component);_.handledProps=["as","attached","children","className","color","compact","content","error","floating","header","hidden","icon","info","list","negative","onDismiss","positive","size","success","visible","warning"],_.propTypes={},_.Content=h,_.Header=x,_.List=j,_.Item=f},4210:(e,a,l)=>{l.d(a,{Z:()=>o});var t=l(6754),n=l(8619),s=l(5809),r=l(2104);const c=function(e,a){var l=-1,t=(0,r.Z)(e)?Array(e.length):[];return(0,s.Z)(e,(function(e,n,s){t[++l]=a(e,n,s)})),t};var i=l(8567);const o=function(e,a){return((0,i.Z)(e)?t.Z:c)(e,(0,n.Z)(a,3))}}}]);
//# sourceMappingURL=518.1d096a14.chunk.js.map