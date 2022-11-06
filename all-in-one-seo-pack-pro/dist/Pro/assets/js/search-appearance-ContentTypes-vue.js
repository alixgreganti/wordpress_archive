(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["search-appearance-ContentTypes-vue","search-appearance-partials-Advanced-vue","search-appearance-partials-CustomFields-vue","search-appearance-partials-Schema-vue","search-appearance-partials-TitleDescription-vue","search-appearance-partials-lite-CustomFields-vue","search-appearance-partials-lite-Schema-vue","search-appearance-partials-pro-CustomFields-vue","search-appearance-partials-pro-Schema-vue"],{"0844":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-advanced"},[s("core-settings-row",{attrs:{name:t.strings.robotsSetting},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-robots-meta",{attrs:{options:t.options.advanced.robotsMeta,mainOptions:t.options}})]},proxy:!0}])}),t.showBulk?s("core-settings-row",{attrs:{name:t.strings.bulkEditing,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:t.object.name+"BulkEditing",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:"disabled"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:"enabled"},{label:t.strings.readOnly,value:"read-only"}]},model:{value:t.options.advanced.bulkEditing,callback:function(e){t.$set(t.options.advanced,"bulkEditing",e)},expression:"options.advanced.bulkEditing"}})]},proxy:!0}],null,!1,3216224115)}):t._e(),t.noMetaBox||t.isUnlicensed&&"taxonomies"===t.type?t._e():s("core-settings-row",{attrs:{name:t.strings.otherOptions},scopedSlots:t._u([{key:"content",fn:function(){return[s("div",{staticClass:"other-options"},[s("base-toggle",{model:{value:t.options.advanced.showMetaBox,callback:function(e){t.$set(t.options.advanced,"showMetaBox",e)},expression:"options.advanced.showMetaBox"}},[t._v(" "+t._s(t.showMetaBox)+" ")])],1)]},proxy:!0}],null,!1,430458522)}),t.mainOptions.searchAppearance.advanced.useKeywords&&t.includeKeywords?s("core-settings-row",{attrs:{name:t.strings.keywords,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{attrs:{multiple:"",taggable:"",options:t.getJsonValue(t.options.advanced.keywords)||[],value:t.getJsonValue(t.options.advanced.keywords)||[],"tag-placeholder":t.strings.tagPlaceholder},on:{input:function(e){return t.options.advanced.keywords=t.setJsonValue(e)}}})]},proxy:!0}],null,!1,4182382651)}):t._e()],1)},i=[],o=s("5530"),a=s("2f62"),r=s("9c0e"),c={mixins:[r["d"],r["f"]],props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean,noMetaBox:Boolean,includeKeywords:Boolean},data:function(){return{titleCount:0,descriptionCount:0,strings:{robotsSetting:this.$t.__("Robots Meta Settings",this.$td),bulkEditing:this.$t.__("Bulk Editing",this.$td),readOnly:this.$t.__("Read Only",this.$td),otherOptions:this.$t.__("Other Options",this.$td),showDateInGooglePreview:this.$t.__("Show Date in Google Preview",this.$td),keywords:this.$t.__("Keywords",this.$td)}}},computed:Object(o["a"])(Object(o["a"])(Object(o["a"])({},Object(a["e"])({mainOptions:"options"})),Object(a["c"])(["isUnlicensed"])),{},{title:function(){return this.$t.sprintf(this.$t.__("%1$s Title",this.$td),this.object.singular)},showPostThumbnailInSearch:function(){return this.$t.sprintf(this.$t.__("Show %1$s Thumbnail in Google Custom Search",this.$td),this.object.singular)},showMetaBox:function(){return this.$t.sprintf(this.$t.__("Show %1$s Meta Box",this.$td),"AIOSEO")}})},l=c,u=(s("3d63"),s("2877")),p=Object(u["a"])(l,n,i,!1,null,null,null);e["default"]=p.exports},"0ee8":function(t,e,s){},"164d":function(t,e,s){},"2d4c":function(t,e,s){"use strict";var n=s("38d8"),i=s.n(n);i.a},"372a":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-search-appearance-content-types"},t._l(t.postTypes,(function(e,n){return s("core-card",{key:n,attrs:{slug:e.name+"SA"},scopedSlots:t._u([{key:"header",fn:function(){return[s("div",{staticClass:"icon dashicons",class:""+(e.icon||"dashicons-admin-post")}),s("div",{domProps:{innerHTML:t._s(e.label)}})]},proxy:!0},{key:"tabs",fn:function(){return[s("core-main-tabs",{attrs:{tabs:t.tabs,showSaveButton:!1,active:t.settings.internalTabs[e.name+"SA"],internal:""},on:{changed:function(s){return t.processChangeTab(e.name,s)}}})]},proxy:!0}],null,!0)},[s("transition",{attrs:{name:"route-fade",mode:"out-in"}},[s(t.settings.internalTabs[e.name+"SA"],{tag:"component",attrs:{object:e,separator:t.options.searchAppearance.global.separator,options:t.options.searchAppearance.dynamic.postTypes[e.name],type:"postTypes"}})],1)],1)})),1)},i=[],o=(s("4de4"),s("b0c0"),s("5530")),a=s("2f62"),r=s("0844"),c=s("3a4e"),l=s("5be7"),u=s("587e"),p={components:{Advanced:r["default"],CustomFields:c["default"],Schema:l["default"],TitleDescription:u["default"]},data:function(){return{internalDebounce:null,tabs:[{slug:"title-description",name:this.$t.__("Title & Description",this.$td),access:"aioseo_manage_seo",pro:!1},{slug:"schema",name:this.$t.__("Schema Markup",this.$td),access:"aioseo_manage_seo",pro:!0},{slug:"custom-fields",name:this.$t.__("Custom Fields",this.$td),access:"aioseo_manage_seo",pro:!0},{slug:"advanced",name:this.$t.__("Advanced",this.$td),access:"aioseo_manage_seo",pro:!1}]}},computed:Object(o["a"])(Object(o["a"])({},Object(a["e"])(["options","settings"])),{},{postTypes:function(){return this.$aioseo.postData.postTypes.filter((function(t){return"attachment"!==t.name}))}}),methods:Object(o["a"])(Object(o["a"])({},Object(a["b"])(["changeTab"])),{},{processChangeTab:function(t,e){var s=this;this.internalDebounce||(this.internalDebounce=!0,this.changeTab({slug:"".concat(t,"SA"),value:e}),setTimeout((function(){s.internalDebounce=!1}),50))}})},d=p,h=(s("a45d"),s("2877")),g=Object(h["a"])(d,n,i,!1,null,null,null);e["default"]=g.exports},"38d8":function(t,e,s){},"3a4e":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-custom-fields-view"},[t.isUnlicensed?t._e():s("custom-fields",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}),t.isUnlicensed?s("custom-fields-lite",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}):t._e()],1)},i=[],o=s("5530"),a=s("2f62"),r=s("e11a"),c=s("9e7b"),l={components:{CustomFields:r["default"],CustomFieldsLite:c["default"]},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean},computed:Object(o["a"])({},Object(a["c"])(["isUnlicensed"]))},u=l,p=s("2877"),d=Object(p["a"])(u,n,i,!1,null,null,null);e["default"]=d.exports},"3d63":function(t,e,s){"use strict";var n=s("7a06"),i=s.n(n);i.a},"4edb":function(t,e,s){"use strict";var n=s("164d"),i=s.n(n);i.a},"587e":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-title-description"},[s("core-settings-row",{attrs:{name:t.strings.showInSearchResults,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[t.edit?s("base-radio-toggle",{attrs:{name:t.object.name+"ShowInSearch",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:t.options.show,callback:function(e){t.$set(t.options,"show",e)},expression:"options.show"}}):t._e(),t.edit?t._e():s("base-radio-toggle",{attrs:{value:!0,name:t.object.name+"ShowInSearch",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.noIndexDescription)+" ")])]},proxy:!0}])}),t.edit&&t.options.show?s("core-settings-row",{attrs:{name:t.$constants.GLOBAL_STRINGS.preview},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-google-search-preview",{attrs:{title:t.options.title,separator:t.separator,description:t.options.metaDescription}})]},proxy:!0}],null,!1,3395425131)}):t._e(),t.options.show?s("core-settings-row",{attrs:{name:t.title},scopedSlots:t._u([{key:"content",fn:function(){return[t.edit?s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","tags-context":t.object.name+"Title","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"title")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddTitle)+" ")]},proxy:!0}],null,!1,3106947238),model:{value:t.options.title,callback:function(e){t.$set(t.options,"title",e)},expression:"options.title"}}):t._e(),t.edit?t._e():s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","tags-context":t.object.name+"Title","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"title")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddTitle)+" ")]},proxy:!0}],null,!1,3106947238)})]},proxy:!0}],null,!1,198146199)}):t._e(),t.options.show?s("core-settings-row",{attrs:{name:t.strings.metaDescription},scopedSlots:t._u([{key:"content",fn:function(){return[t.edit?s("core-html-tags-editor",{attrs:{"line-numbers":!1,description:"","tags-context":t.object.name+"Description","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"description")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddDescription)+" ")]},proxy:!0}],null,!1,1726597184),model:{value:t.options.metaDescription,callback:function(e){t.$set(t.options,"metaDescription",e)},expression:"options.metaDescription"}}):t._e(),t.edit?t._e():s("core-html-tags-editor",{attrs:{"line-numbers":!1,"tags-context":t.object.name+"Description","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"description")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddDescription)+" ")]},proxy:!0}],null,!1,1726597184)})]},proxy:!0}],null,!1,2372372956)}):t._e()],1)},i=[],o=s("9c0e"),a={mixins:[o["f"]],props:{type:{type:String,required:!0},object:{type:Object,required:!0},separator:{type:String,required:!0},options:{type:Object,required:!0},edit:{type:Boolean,default:function(){return!0}}},data:function(){return{titleCount:0,descriptionCount:0,strings:{showInSearchResults:this.$t.__("Show in Search Results",this.$td),clickToAddTitle:this.$t.__("Click on the tags below to insert variables into your title.",this.$td),metaDescription:this.$t.__("Meta Description",this.$td),clickToAddDescription:this.$t.__("Click on the tags below to insert variables into your meta description.",this.$td),noIndexDescription:this.$t.__('Selecting "No" will no-index this page.',this.$td)}}},watch:{show:function(t){this.options.advanced.robotsMeta.noindex=!t,t||(this.options.advanced.robotsMeta.default=!1)}},computed:{title:function(){return this.$t.sprintf(this.$t.__("%1$s Title",this.$td),this.object.singular)},show:function(){return this.options.show}},methods:{}},r=a,c=s("2877"),l=Object(c["a"])(r,n,i,!1,null,null,null);e["default"]=l.exports},"5be7":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-schema-view"},[t.isUnlicensed?t._e():s("schema",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}),t.isUnlicensed?s("schema-lite",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}):t._e()],1)},i=[],o=s("5530"),a=s("2f62"),r=s("781e"),c=s("9d33"),l={components:{Schema:r["default"],SchemaLite:c["default"]},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean},computed:Object(o["a"])({},Object(a["c"])(["isUnlicensed"]))},u=l,p=s("2877"),d=Object(p["a"])(u,n,i,!1,null,null,null);e["default"]=d.exports},"781e":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-schema"},[s("core-settings-row",{attrs:{name:t.strings.schemaType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{staticClass:"schema-type",attrs:{size:"medium",options:t.getSelectOptions("schemaTypes"),value:t.getCurrentOption("schemaTypes",t.options.schemaType)},on:{input:function(e){return t.options.schemaType=e.value}}})]},proxy:!0}])}),"WebPage"===t.options.schemaType&&0<t.getSelectOptions("webPageTypes").length?s("core-settings-row",{attrs:{name:t.strings.webPageType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{staticClass:"webpage-type",attrs:{size:"medium",options:t.getSelectOptions("webPageTypes"),value:t.getCurrentOption("webPageTypes",t.options.webPageType)},on:{input:function(e){return t.options.webPageType=e.value}}})]},proxy:!0}],null,!1,3344221424)}):t._e(),"Article"===t.options.schemaType?s("core-settings-row",{attrs:{name:t.strings.articleType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:t.object.name+"articleType",options:[{label:t.strings.article,value:"Article"},{label:t.strings.blogPost,value:"BlogPosting"},{label:t.strings.newsArticle,value:"NewsArticle"}]},model:{value:t.options.articleType,callback:function(e){t.$set(t.options,"articleType",e)},expression:"options.articleType"}})]},proxy:!0}],null,!1,3288395150)}):t._e()],1)},i=[],o=(s("7db0"),s("b0c0"),{props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0}},data:function(){return{schemaTypes:{post:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)}],page:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}],attachment:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)}],cpt:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)}]},webPageTypes:{post:[],page:[],attachment:[],cpt:[{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)},{value:"CollectionPage",label:this.$t.__("Collection Page",this.$tdPro)},{value:"ProfilePage",label:this.$t.__("Profile Page",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)},{value:"FAQPage",label:this.$t.__("FAQ Page",this.$tdPro)},{value:"QAPage",label:this.$t.__("QA Page",this.$tdPro)},{value:"RealEstateListing",label:this.$t.__("Real Estate Listing",this.$tdPro)}]},strings:{schemaType:this.$t.__("Schema Type",this.$tdPro),webPageType:this.$t.__("Web Page Type",this.$td),articleType:this.$t.__("Article Type",this.$tdPro),article:this.$t.__("Article",this.$tdPro),blogPost:this.$t.__("Blog Post",this.$tdPro),newsArticle:this.$t.__("News Article",this.$tdPro)}}},methods:{getSelectOptions:function(t){return"undefined"!==typeof this[t][this.object.name]?this[t][this.object.name]:this[t].cpt},getCurrentOption:function(t,e){return"undefined"!==typeof this[t][this.object.name]?this[t][this.object.name].find((function(t){return t.value===e})):this[t].cpt.find((function(t){return t.value===e}))}}}),a=o,r=(s("2d4c"),s("2877")),c=Object(r["a"])(a,n,i,!1,null,null,null);e["default"]=c.exports},"7a06":function(t,e,s){},"7c50":function(t,e,s){"use strict";var n=s("0ee8"),i=s.n(n);i.a},9267:function(t,e,s){},"9d33":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-schema-lite"},[s("core-blur",[s("core-settings-row",{attrs:{name:t.strings.schemaType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{staticClass:"schema-type",attrs:{size:"medium",options:t.schemaTypes,value:t.getSchemaTypeOption("Article")}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.articleType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:t.object.name+"articleType",value:"BlogPosting",options:[{label:t.strings.article,value:"Article"},{label:t.strings.blogPost,value:"BlogPosting"},{label:t.strings.newsArticle,value:"NewsArticle"}]}})]},proxy:!0}])})],1),s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("schema-markup","schema-markup-upsell",t.object.name+"-post-type"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("schema-markup",t.object.name,"home")},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0}])})],1)},i=[],o=(s("7db0"),{props:{type:{type:String,required:!0},object:{type:Object,required:!0}},data:function(){return{schemaTypes:[{value:"none",label:this.$t.__("None",this.$td)},{value:"Article",label:this.$t.__("Article",this.$td)}],strings:{schemaType:this.$t.__("Schema Type",this.$td),articleType:this.$t.__("Article Type",this.$td),article:this.$t.__("Article",this.$td),blogPost:this.$t.__("Blog Post",this.$td),newsArticle:this.$t.__("News Article",this.$td),ctaDescription:this.$t.sprintf(this.$t.__("%1$s %2$s allows you to customize the structured data markup on Posts, Pages, Categories, Tags, etc.",this.$td),"AIOSEO","Pro"),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Advanced Schema Markup",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Advanced Schema Markup is only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")}}},methods:{getSchemaTypeOption:function(t){return this.schemaTypes.find((function(e){return e.value===t}))}}}),a=o,r=(s("4edb"),s("2877")),c=Object(r["a"])(a,n,i,!1,null,null,null);e["default"]=c.exports},"9e7b":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-custom-fields"},[s("core-blur",[s("core-settings-row",{attrs:{name:t.strings.customFields,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-textarea",{attrs:{"min-height":200}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.customFieldsDescription)+" ")])]},proxy:!0}])})],1),s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("custom-fields","custom-fields-upsell",t.object.name+"-post-type"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("custom-fields",t.object.name,"home")},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0}])})],1)},i=[],o=(s("7db0"),s("5530")),a=s("2f62"),r={props:{type:{type:String,required:!0},object:{type:Object,required:!0}},data:function(){return{strings:{customFields:this.$t.__("Custom Fields",this.$td),customFieldsDescription:this.$t.__("List of custom field names to include in the SEO Page Analysis. Add one per line.",this.$td),ctaDescription:this.$t.sprintf(this.$t.__("%1$s %2$s gives you advanced customizations for our page analysis feature, letting you add custom fields to analyze.",this.$td),"AIOSEO","Pro"),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Custom Fields",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Custom Fields are only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")}}},computed:Object(o["a"])({},Object(a["e"])(["options"])),methods:{getSchemaTypeOption:function(t){return this.schemaTypes.find((function(e){return e.value===t}))}}},c=r,l=(s("7c50"),s("2877")),u=Object(l["a"])(c,n,i,!1,null,null,null);e["default"]=u.exports},a45d:function(t,e,s){"use strict";var n=s("9267"),i=s.n(n);i.a},e11a:function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-custom-fields"},[s("core-settings-row",{attrs:{name:t.strings.customFields,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-textarea",{attrs:{"min-height":200},model:{value:t.options.customFields,callback:function(e){t.$set(t.options,"customFields",e)},expression:"options.customFields"}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.customFieldsDescription)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"CHANGEME",!0))}})])]},proxy:!0}])})],1)},i=[],o=(s("7db0"),{props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0}},data:function(){return{strings:{customFields:this.$t.__("Custom Fields",this.$tdPro),customFieldsDescription:this.$t.__("List of custom field names to include in the SEO Page Analysis. Add one per line.",this.$tdPro)}}},methods:{getSchemaTypeOption:function(t){return this.schemaTypes.find((function(e){return e.value===t}))}}}),a=o,r=s("2877"),c=Object(r["a"])(a,n,i,!1,null,null,null);e["default"]=c.exports}}]);