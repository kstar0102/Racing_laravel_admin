"use strict";(self.webpackChunkreact_typscript_racing_site_frontend=self.webpackChunkreact_typscript_racing_site_frontend||[]).push([[158],{9205:(e,l,r)=>{r.d(l,{Z:()=>d});var a=r(2791),n=r(3636),s=r(4664),i=r(184);const d=e=>{let{columns_data:l,ranking_data:r,data_status:d}=e;const[c,t]=(0,a.useState)(),[o,_]=(0,a.useState)(!0),[h,x]=(0,a.useState)({pagination:{current:1,pageSize:10}});(0,a.useEffect)((()=>{console.log(r),t(r)}),[r]),(0,a.useEffect)((()=>{d&&_(!1)}),[d]);return(0,i.jsx)(i.Fragment,{children:(0,i.jsx)(n.Z,{columns:l,rowKey:e=>e.id,dataSource:c,pagination:h.pagination,loading:o,onChange:(e,l,r)=>{x({pagination:e,filters:l,...r})},locale:{emptyText:(0,i.jsx)(s.Z,{description:"\u30c7\u30fc\u30bf\u304c\u3042\u308a\u307e\u305b\u3093"})},scroll:{x:!0}})})}},1158:(e,l,r)=>{r.r(l),r.d(l,{default:()=>Z});var a=r(2791),n=r(9434),s=r(6303),i=r(834),d=r(899),c=r(3825),t=r(1460),o=r(8900),_=r(349),h=r(8434),x=r(9205),j=r(7689),g=r(184);const Z=()=>{const{userData:e}=(0,n.v9)((e=>e.authReducer)),{my_ranking_data:l,my_ranking_status:r}=(0,n.v9)((e=>e.rankingReducer)),Z=(0,n.I0)(),u=(0,j.s0)();(0,a.useEffect)((()=>{Z({type:_.Z.GETMYPAGEUSERDATA,payload:e.id})}),[]);const p=[{title:"\u30ec\u30fc\u30b9\u540d",dataIndex:"rank",sorter:!0,width:"9%",render:(e,l)=>(0,g.jsx)("span",{children:l.race_managements.race_name})},{title:"\u25ce",dataIndex:"double_circle",sorter:!0,width:"8%",render:(e,l)=>(0,g.jsxs)("span",{children:[l.double_circle?(0,g.jsx)(s.Z,{circular:!0,color:"red",children:" \u7684"}):(0,g.jsx)(s.Z,{circular:!0,color:"blue",children:" \u4e0d"})," ",l.double_circles.name]})},{title:"\u25cb",dataIndex:"single_circle",sorter:!0,width:"8%",render:(e,l)=>(0,g.jsxs)("span",{children:[l.single_circle?(0,g.jsx)(s.Z,{circular:!0,color:"red",children:" \u7684"}):(0,g.jsx)(s.Z,{circular:!0,color:"blue",children:" \u4e0d"})," ",l.single_circles.name]})},{title:"\u25b2",dataIndex:"triangle",sorter:!0,width:"8%",render:(e,l)=>(0,g.jsxs)("span",{children:[l.triangle?(0,g.jsx)(s.Z,{circular:!0,color:"red",children:" \u7684"}):(0,g.jsx)(s.Z,{circular:!0,color:"blue",children:" \u4e0d"})," ",l.triangles.name]})},{title:"\u2606",dataIndex:"five_star",sorter:!0,width:"8%",render:(e,l)=>(0,g.jsxs)("span",{children:[l.five_star?(0,g.jsx)(s.Z,{circular:!0,color:"red",children:" \u7684"}):(0,g.jsx)(s.Z,{circular:!0,color:"blue",children:" \u4e0d"})," ",l.five_stars.name]})},{title:"\u7a74",dataIndex:"hole",sorter:!0,width:"8%",render:(e,l)=>(0,g.jsxs)("span",{children:[l.hole?(0,g.jsx)(s.Z,{circular:!0,color:"red",children:" \u7684"}):(0,g.jsx)(s.Z,{circular:!0,color:"blue",children:" \u4e0d"})," ",l.holes.name]})},{title:"\u6d88",dataIndex:"disappear",sorter:!0,width:"8%",render:(e,l)=>(0,g.jsxs)("span",{children:[l.disappear?(0,g.jsx)(s.Z,{circular:!0,color:"red",children:" \u7684"}):(0,g.jsx)(s.Z,{circular:!0,color:"blue",children:" \u4e0d"})," ",l.disappears.name]})}];return(0,g.jsxs)("div",{className:"pt-6",children:[(0,g.jsx)("div",{className:"lg:pl-8 pb-2",children:(0,g.jsx)(i.Z,{primary:!0,onClick:()=>u(-1),children:"\u3000\u623b\u3000\u308b\u3000"})}),(0,g.jsxs)("div",{className:"flex flex-col md:flex-row",children:[(0,g.jsxs)("div",{className:"w-full lg:w-2/5 lg:p-8 pb-5",children:[(0,g.jsx)(s.Z,{as:"a",color:"red",tag:!0,children:"\u57fa\u3000\u672c\u3000\u60c5\u3000\u5831"}),(0,g.jsx)(d.Z,{raised:!0,style:{backgroundColor:"#f5deb3"},children:(0,g.jsxs)("div",{className:"flex min-h-full flex-1 flex-col justify-center px-6 lg:px-8",children:[(0,g.jsx)("div",{className:"mt-10 sm:mx-auto sm:w-full sm:max-w-sm",children:(0,g.jsx)("img",{src:h.Gg+"".concat(e.image_url?e.image_url:"DEFAULT.PNG"),style:{margin:"auto"}})}),(0,g.jsxs)(c.Z,{divided:!0,selection:!0,children:[(0,g.jsxs)(c.Z.Item,{children:[(0,g.jsx)(s.Z,{color:"red",horizontal:!0,children:"\u304a\u540d\u524d"}),0!==e.length&&e.login_id]}),(0,g.jsxs)(c.Z.Item,{children:[(0,g.jsx)(s.Z,{color:"purple",horizontal:!0,children:"\u4fdd\u6709\u30dd\u30a4\u30f3\u30c8"}),0!==e.length&&e.user_pt,"\u30dd\u30a4\u30f3\u30c8"]}),(0,g.jsxs)(c.Z.Item,{children:[(0,g.jsx)(s.Z,{color:"red",horizontal:!0,children:"\u30e9\u30f3\u30af"}),void 0!==l.badge_grade&&(0,g.jsx)("img",{src:h.A7+h.dC[l.badge_grade],style:{margin:"auto"},width:200})]})]}),(0,g.jsx)("div",{style:{margin:"auto"},children:(0,g.jsx)(i.Z,{secondary:!0,style:{margin:"10px"},onClick:()=>u("/setting"),children:"\u3000\u7de8\u3000\u96c6\u3000"})})]})})]}),(0,g.jsxs)("div",{className:"w-full lg:w-3/5 lg:p-8",children:[(0,g.jsx)(s.Z,{as:"a",color:"red",tag:!0,children:"\u4e88\u3000\u60f3\u3000\u6210\u3000\u7e3e"}),(0,g.jsxs)(d.Z,{raised:!0,style:{backgroundColor:"#f5deb3"},children:[(0,g.jsx)(t.Z,{info:!0,header:"\u3000\u53c2\u3000\u52a0\u3000\u56de\u3000\u6570\u3000\uff1a\u3000".concat(void 0!==l.times?l.times:0,"\u3000\u56de\u3000")}),(0,g.jsx)("div",{className:"mb-3 overflow-x-auto",children:(0,g.jsxs)(o.Z,{celled:!0,unstackable:!0,compact:"very",children:[(0,g.jsx)(o.Z.Header,{children:(0,g.jsxs)(o.Z.Row,{children:[(0,g.jsx)(o.Z.HeaderCell,{}),(0,g.jsx)(o.Z.HeaderCell,{children:"Pt"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u25ce"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u3007"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u25b2"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u2606"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u7a74"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u6d88"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u5358\u7387"}),(0,g.jsx)(o.Z.HeaderCell,{children:"\u8907\u7387"})]})}),0!==l.length&&(0,g.jsxs)(o.Z.Body,{children:[(0,g.jsxs)(o.Z.Row,{children:[(0,g.jsx)(o.Z.Cell,{children:"\u6708\u9593"}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.point,"pt"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.double_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.single_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.triangle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.five_star,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.hole,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.disappear,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.single,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.month_ranking_data.multiple,"%"]})]}),(0,g.jsxs)(o.Z.Row,{children:[(0,g.jsx)(o.Z.Cell,{children:"\u5e74\u9593"}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.point,"pt"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.double_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.single_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.triangle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.five_star,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.hole,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.disappear,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.single,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.year_ranking_data.multiple,"%"]})]}),(0,g.jsxs)(o.Z.Row,{children:[(0,g.jsx)(o.Z.Cell,{children:"\u4e0a\u671f"}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.point,"pt"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.double_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.single_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.triangle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.five_star,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.hole,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.disappear,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.single,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.first_half_year_ranking_data.double_circle,"%"]})]}),(0,g.jsxs)(o.Z.Row,{children:[(0,g.jsx)(o.Z.Cell,{children:"\u4e0b\u671f"}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.point,"pt"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.double_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.single_circle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.triangle,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.five_star,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.hole,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.disappear,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.single,"%"]}),(0,g.jsxs)(o.Z.Cell,{children:[l.second_half_year_ranking_data.double_circle,"%"]})]})]})]})}),(0,g.jsxs)("div",{className:"grid grid-cols-4 gap-4 pb-5",children:[(0,g.jsxs)(s.Z,{color:"violet",horizontal:!0,size:"large",children:["\u5358\u52dd\u306e\u56de\u6570 : ",l.single_win,"\u56de"]}),(0,g.jsxs)(s.Z,{color:"teal",horizontal:!0,size:"large",children:["\u8907\u52dd\u306e\u56de\u6570 : ",l.double_win,"\u56de"]}),(0,g.jsxs)(s.Z,{color:"green",horizontal:!0,size:"large",children:["\u99ac\u9023\u306e\u56de\u6570 : ",l.horse_racing_win,"\u56de"]}),(0,g.jsxs)(s.Z,{color:"brown",horizontal:!0,size:"large",children:["\uff13\u9023\u8907\u306e\u56de\u6570 : ",l.triple_racing_win,"\u56de"]})]}),(0,g.jsx)(x.Z,{columns_data:p,ranking_data:l.total_ranking_data,data_status:r})]})]})]})]})}}}]);
//# sourceMappingURL=158.aa2e23a8.chunk.js.map