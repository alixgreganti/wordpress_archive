(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["search-appearance-Media-vue","search-appearance-lite-ImageSeo-vue","search-appearance-partials-Advanced-vue","search-appearance-partials-Schema-vue","search-appearance-partials-TitleDescription-vue","search-appearance-partials-lite-Schema-vue","search-appearance-partials-pro-CustomFields-vue","search-appearance-partials-pro-Schema-vue","search-appearance-pro-ImageSeo-vue","search-appearance-pro-ImageSeoActivate-vue"],{"0844":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-advanced"},[s("core-settings-row",{attrs:{name:t.strings.robotsSetting},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-robots-meta",{attrs:{options:t.options.advanced.robotsMeta,mainOptions:t.options}})]},proxy:!0}])}),t.showBulk?s("core-settings-row",{attrs:{name:t.strings.bulkEditing,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:t.object.name+"BulkEditing",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:"disabled"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:"enabled"},{label:t.strings.readOnly,value:"read-only"}]},model:{value:t.options.advanced.bulkEditing,callback:function(e){t.$set(t.options.advanced,"bulkEditing",e)},expression:"options.advanced.bulkEditing"}})]},proxy:!0}],null,!1,3216224115)}):t._e(),t.noMetaBox||t.isUnlicensed&&"taxonomies"===t.type?t._e():s("core-settings-row",{attrs:{name:t.strings.otherOptions},scopedSlots:t._u([{key:"content",fn:function(){return[s("div",{staticClass:"other-options"},[s("base-toggle",{model:{value:t.options.advanced.showMetaBox,callback:function(e){t.$set(t.options.advanced,"showMetaBox",e)},expression:"options.advanced.showMetaBox"}},[t._v(" "+t._s(t.showMetaBox)+" ")])],1)]},proxy:!0}],null,!1,430458522)}),t.mainOptions.searchAppearance.advanced.useKeywords&&t.includeKeywords?s("core-settings-row",{attrs:{name:t.strings.keywords,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{attrs:{multiple:"",taggable:"",options:t.getJsonValue(t.options.advanced.keywords)||[],value:t.getJsonValue(t.options.advanced.keywords)||[],"tag-placeholder":t.strings.tagPlaceholder},on:{input:function(e){return t.options.advanced.keywords=t.setJsonValue(e)}}})]},proxy:!0}],null,!1,4182382651)}):t._e()],1)},a=[],n=s("5530"),o=s("2f62"),r=s("9c0e"),l={mixins:[r["d"],r["f"]],props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean,noMetaBox:Boolean,includeKeywords:Boolean},data:function(){return{titleCount:0,descriptionCount:0,strings:{robotsSetting:this.$t.__("Robots Meta Settings",this.$td),bulkEditing:this.$t.__("Bulk Editing",this.$td),readOnly:this.$t.__("Read Only",this.$td),otherOptions:this.$t.__("Other Options",this.$td),showDateInGooglePreview:this.$t.__("Show Date in Google Preview",this.$td),keywords:this.$t.__("Keywords",this.$td)}}},computed:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(o["e"])({mainOptions:"options"})),Object(o["c"])(["isUnlicensed"])),{},{title:function(){return this.$t.sprintf(this.$t.__("%1$s Title",this.$td),this.object.singular)},showPostThumbnailInSearch:function(){return this.$t.sprintf(this.$t.__("Show %1$s Thumbnail in Google Custom Search",this.$td),this.object.singular)},showMetaBox:function(){return this.$t.sprintf(this.$t.__("Show %1$s Meta Box",this.$td),"AIOSEO")}})},c=l,u=(s("3d63"),s("2877")),d=Object(u["a"])(c,i,a,!1,null,null,null);e["default"]=d.exports},"164d":function(t,e,s){},"2b0d":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-search-appearance-content-types"},[s("core-card",{attrs:{slug:t.postType.name+"SA"},scopedSlots:t._u([{key:"header",fn:function(){return[s("div",{staticClass:"icon dashicons",class:""+(t.postType.icon||"dashicons-admin-post")}),s("div",{domProps:{innerHTML:t._s(t.postType.label)}})]},proxy:!0},{key:"before-tabs",fn:function(){return[s("core-settings-row",{attrs:{name:t.strings.redirectAttachmentUrls,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"redirectAttachmentUrls",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:"disabled",activeClass:"dark"},{label:t.strings.attachment,value:"attachment"},{label:t.strings.attachmentParent,value:"attachment_parent"}]},model:{value:t.options.searchAppearance.dynamic.postTypes.attachment.redirectAttachmentUrls,callback:function(e){t.$set(t.options.searchAppearance.dynamic.postTypes.attachment,"redirectAttachmentUrls",e)},expression:"options.searchAppearance.dynamic.postTypes.attachment.redirectAttachmentUrls"}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.attachmentUrlsDescription)+" ")])]},proxy:!0}])})]},proxy:!0},"disabled"===t.options.searchAppearance.dynamic.postTypes.attachment.redirectAttachmentUrls?{key:"tabs",fn:function(){return[s("core-main-tabs",{attrs:{tabs:t.tabs,showSaveButton:!1,active:t.settings.internalTabs[t.postType.name+"SA"],internal:""},on:{changed:function(e){return t.processChangeTab(t.postType.name,e)}}})]},proxy:!0}:null],null,!0)},["disabled"===t.options.searchAppearance.dynamic.postTypes.attachment.redirectAttachmentUrls?s("transition",{attrs:{name:"route-fade",mode:"out-in"}},[s(t.settings.internalTabs[t.postType.name+"SA"],{tag:"component",attrs:{object:t.postType,separator:t.options.searchAppearance.global.separator,options:t.options.searchAppearance.dynamic.postTypes[t.postType.name],type:"postTypes"}})],1):t._e()],1),s("core-card",{attrs:{slug:"imageSeo","header-text":t.strings.imageSeo}},[t.isUnlicensed||!t.imageSeoIsActive||t.imageSeoUpgrade?t._e():s("image-seo"),t.isUnlicensed||t.imageSeoIsActive||!t.imageSeoCanActivate||t.imageSeoUpgrade?t._e():s("image-seo-activate"),t.isUnlicensed||t.imageSeoUpgrade?s("image-seo-lite"):t._e()],1)],1)},a=[],n=(s("4de4"),s("7db0"),s("b0c0"),s("5530")),o=s("2f62"),r=s("0844"),l=s("e11a"),c=s("5be7"),u=s("587e"),d=s("e619"),p=s("398d"),g=s("ab06"),h={components:{Advanced:r["default"],CustomFields:l["default"],Schema:c["default"],TitleDescription:u["default"],ImageSeo:d["default"],ImageSeoActivate:p["default"],ImageSeoLite:g["default"]},data:function(){return{internalDebounce:!1,strings:{redirectAttachmentUrls:this.$t.__("Redirect Attachment URLs",this.$td),attachment:this.$t.__("Attachment",this.$td),attachmentParent:this.$t.__("Attachment Parent",this.$td),attachmentUrlsDescription:this.$t.__("We recommended redirecting attachment URL's back to the attachment since the default WordPress attachment pages have little SEO value.",this.$td),imageSeo:this.$t.__("Image SEO",this.$td)},tabs:[{slug:"title-description",name:this.$t.__("Title & Description",this.$td),access:"aioseo_manage_seo",pro:!1},{slug:"Schema",name:this.$t.__("Schema Markup",this.$td),access:"aioseo_manage_seo",pro:!0},{slug:"advanced",name:this.$t.__("Advanced",this.$td),access:"aioseo_manage_seo",pro:!1}]}},computed:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(o["c"])(["isUnlicensed"])),Object(o["e"])(["options","settings","addons"])),{},{postType:function(){return this.$aioseo.postData.postTypes.filter((function(t){return"attachment"===t.name}))[0]},imageSeoIsActive:function(){var t=this.addons.find((function(t){return"aioseo-image-seo"===t.sku}));return t&&t.isActive},imageSeoUpgrade:function(){var t=this.addons.find((function(t){return"aioseo-image-seo"===t.sku}));return!t||t.requiresUpgrade},imageSeoCanActivate:function(){var t=this.addons.find((function(t){return"aioseo-image-seo"===t.sku}));return t&&!t.isActive}}),methods:Object(n["a"])(Object(n["a"])({},Object(o["b"])(["changeTab"])),{},{processChangeTab:function(t,e){var s=this;this.internalDebounce||(this.internalDebounce=!0,this.changeTab({slug:"".concat(t,"SA"),value:e}),setTimeout((function(){s.internalDebounce=!1}),50))}})},m=h,b=(s("6d2e"),s("2877")),_=Object(b["a"])(m,i,a,!1,null,null,null);e["default"]=_.exports},"2d4c":function(t,e,s){"use strict";var i=s("38d8"),a=s.n(i);a.a},"38d8":function(t,e,s){},"398d":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-image-seo"},[s("core-blur",[s("core-settings-row",{attrs:{name:t.strings.titleAttributeFormat},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","default-tags":["image_title","separator_sa","site_title","alt_tag"]},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddVariablesTitleTag)+" ")]},proxy:!0}])})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.stripPunctuationTitleAttribute,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{value:!1,name:"stripTitlePunctuation",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:!0}]}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.altTagAttributeFormat},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","default-tags":["image_title","separator_sa","site_title","alt_tag"]},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddVariablesAltTag)+" ")]},proxy:!0}])})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.stripPunctuationForAltAttribute,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{value:!1,name:"stripAltPunctuation",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:!0}]}})]},proxy:!0}])})],1),s("cta",{attrs:{"cta-link":t.$aioseo.urls.aio.featureManager+"&aioseo-activate=aioseo-image-seo","same-tab":"","cta-button-action":"","cta-button-loading":t.activationLoading,"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getDocUrl("imageSeo"),"feature-list":[t.strings.setTitleAttributes,t.strings.setAltTagAttributes,t.strings.stripPunctuationTitles,t.strings.stripPunctuationAltTags]},on:{"cta-button-click":t.activateAddon},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.imageSeoHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.failed?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.activateError)+" ")]):t._e(),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0},{key:"learn-more-text",fn:function(){return[t._v(" "+t._s(t.strings.learnMoreText)+" ")]},proxy:!0}])})],1)},a=[],n=(s("7db0"),s("5530")),o=s("2f62"),r={data:function(){return{failed:!1,activationLoading:!1,strings:{imageSeoHeader:this.$t.__("Enable Advanced SEO for Images on your Site",this.$tdPro),titleAttributeFormat:this.$t.__("Title Attribute Format",this.$tdPro),stripPunctuationTitleAttribute:this.$t.__("Strip Punctuation for Title Attributes",this.$tdPro),clickToAddVariablesTitleTag:this.$t.__("Click on the tags below to insert variables into your title attribute.",this.$tdPro),altTagAttributeFormat:this.$t.__("Alt Tag Attribute Format",this.$tdPro),clickToAddVariablesAltTag:this.$t.__("Click on the tags below to insert variables into your alt tag attribute.",this.$tdPro),stripPunctuationForAltAttribute:this.$t.__("Strip Punctuation for Alt Attributes",this.$tdPro),ctaDescription:this.$t.__("The Image SEO module is a premium feature that enables you to globally control the Title Attribute and Alt Text for attachment pages and images that are embedded in your content. These can be set based on a specified format, similar to the Title Format settings in the Global Settings menu.",this.$tdPro),ctaButtonText:this.$t.__("Activate Image SEO",this.$tdPro),learnMoreText:this.$t.__("Learn more about Image SEO",this.$tdPro),setTitleAttributes:this.$t.__("Set title attributes",this.$td),setAltTagAttributes:this.$t.__("Set alt tag attributes",this.$td),stripPunctuationTitles:this.$t.__("Strip punctuation for titles",this.$td),stripPunctuationAltTags:this.$t.__("Strip punctuation for alt tags",this.$td),activateError:this.$t.__("An error occurred while activating the addon. Please upload it manually or contact support for more information.",this.$td)}}},computed:Object(n["a"])({},Object(o["e"])(["addons","tags"])),methods:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(o["b"])(["installPlugins","getTags"])),Object(o["d"])(["updateAddon"])),{},{activateAddon:function(){var t=this;this.failed=!1,this.activationLoading=!0;var e=this.addons.find((function(t){return"aioseo-image-seo"===t.sku}));this.installPlugins([{plugin:e.basename}]).then((function(s){if(s.body.failed.length)return t.activationLoading=!1,void(t.failed=!0);t.getTags().then((function(){t.activationLoading=!1,e.isActive=!0,t.updateAddon(e)}))})).catch((function(){t.activationLoading=!1}))}})},l=r,c=s("2877"),u=Object(c["a"])(l,i,a,!1,null,null,null);e["default"]=u.exports},"3d63":function(t,e,s){"use strict";var i=s("7a06"),a=s.n(i);a.a},"4edb":function(t,e,s){"use strict";var i=s("164d"),a=s.n(i);a.a},"587e":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-title-description"},[s("core-settings-row",{attrs:{name:t.strings.showInSearchResults,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[t.edit?s("base-radio-toggle",{attrs:{name:t.object.name+"ShowInSearch",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:t.options.show,callback:function(e){t.$set(t.options,"show",e)},expression:"options.show"}}):t._e(),t.edit?t._e():s("base-radio-toggle",{attrs:{value:!0,name:t.object.name+"ShowInSearch",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.noIndexDescription)+" ")])]},proxy:!0}])}),t.edit&&t.options.show?s("core-settings-row",{attrs:{name:t.$constants.GLOBAL_STRINGS.preview},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-google-search-preview",{attrs:{title:t.options.title,separator:t.separator,description:t.options.metaDescription}})]},proxy:!0}],null,!1,3395425131)}):t._e(),t.options.show?s("core-settings-row",{attrs:{name:t.title},scopedSlots:t._u([{key:"content",fn:function(){return[t.edit?s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","tags-context":t.object.name+"Title","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"title")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddTitle)+" ")]},proxy:!0}],null,!1,3106947238),model:{value:t.options.title,callback:function(e){t.$set(t.options,"title",e)},expression:"options.title"}}):t._e(),t.edit?t._e():s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","tags-context":t.object.name+"Title","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"title")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddTitle)+" ")]},proxy:!0}],null,!1,3106947238)})]},proxy:!0}],null,!1,198146199)}):t._e(),t.options.show?s("core-settings-row",{attrs:{name:t.strings.metaDescription},scopedSlots:t._u([{key:"content",fn:function(){return[t.edit?s("core-html-tags-editor",{attrs:{"line-numbers":!1,description:"","tags-context":t.object.name+"Description","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"description")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddDescription)+" ")]},proxy:!0}],null,!1,1726597184),model:{value:t.options.metaDescription,callback:function(e){t.$set(t.options,"metaDescription",e)},expression:"options.metaDescription"}}):t._e(),t.edit?t._e():s("core-html-tags-editor",{attrs:{"line-numbers":!1,"tags-context":t.object.name+"Description","default-tags":t.$tags.getDefaultTags(t.type,t.object.name,"description")},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddDescription)+" ")]},proxy:!0}],null,!1,1726597184)})]},proxy:!0}],null,!1,2372372956)}):t._e()],1)},a=[],n=s("9c0e"),o={mixins:[n["f"]],props:{type:{type:String,required:!0},object:{type:Object,required:!0},separator:{type:String,required:!0},options:{type:Object,required:!0},edit:{type:Boolean,default:function(){return!0}}},data:function(){return{titleCount:0,descriptionCount:0,strings:{showInSearchResults:this.$t.__("Show in Search Results",this.$td),clickToAddTitle:this.$t.__("Click on the tags below to insert variables into your title.",this.$td),metaDescription:this.$t.__("Meta Description",this.$td),clickToAddDescription:this.$t.__("Click on the tags below to insert variables into your meta description.",this.$td),noIndexDescription:this.$t.__('Selecting "No" will no-index this page.',this.$td)}}},watch:{show:function(t){this.options.advanced.robotsMeta.noindex=!t,t||(this.options.advanced.robotsMeta.default=!1)}},computed:{title:function(){return this.$t.sprintf(this.$t.__("%1$s Title",this.$td),this.object.singular)},show:function(){return this.options.show}},methods:{}},r=o,l=s("2877"),c=Object(l["a"])(r,i,a,!1,null,null,null);e["default"]=c.exports},"5be7":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-schema-view"},[t.isUnlicensed?t._e():s("schema",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}),t.isUnlicensed?s("schema-lite",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}):t._e()],1)},a=[],n=s("5530"),o=s("2f62"),r=s("781e"),l=s("9d33"),c={components:{Schema:r["default"],SchemaLite:l["default"]},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean},computed:Object(n["a"])({},Object(o["c"])(["isUnlicensed"]))},u=c,d=s("2877"),p=Object(d["a"])(u,i,a,!1,null,null,null);e["default"]=p.exports},"6d2e":function(t,e,s){"use strict";var i=s("be6d"),a=s.n(i);a.a},"781e":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-schema"},[s("core-settings-row",{attrs:{name:t.strings.schemaType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{staticClass:"schema-type",attrs:{size:"medium",options:t.getSelectOptions("schemaTypes"),value:t.getCurrentOption("schemaTypes",t.options.schemaType)},on:{input:function(e){return t.options.schemaType=e.value}}})]},proxy:!0}])}),"WebPage"===t.options.schemaType&&0<t.getSelectOptions("webPageTypes").length?s("core-settings-row",{attrs:{name:t.strings.webPageType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{staticClass:"webpage-type",attrs:{size:"medium",options:t.getSelectOptions("webPageTypes"),value:t.getCurrentOption("webPageTypes",t.options.webPageType)},on:{input:function(e){return t.options.webPageType=e.value}}})]},proxy:!0}],null,!1,3344221424)}):t._e(),"Article"===t.options.schemaType?s("core-settings-row",{attrs:{name:t.strings.articleType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:t.object.name+"articleType",options:[{label:t.strings.article,value:"Article"},{label:t.strings.blogPost,value:"BlogPosting"},{label:t.strings.newsArticle,value:"NewsArticle"}]},model:{value:t.options.articleType,callback:function(e){t.$set(t.options,"articleType",e)},expression:"options.articleType"}})]},proxy:!0}],null,!1,3288395150)}):t._e()],1)},a=[],n=(s("7db0"),s("b0c0"),{props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0}},data:function(){return{schemaTypes:{post:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)}],page:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}],attachment:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)}],cpt:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)}]},webPageTypes:{post:[],page:[],attachment:[],cpt:[{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)},{value:"CollectionPage",label:this.$t.__("Collection Page",this.$tdPro)},{value:"ProfilePage",label:this.$t.__("Profile Page",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)},{value:"FAQPage",label:this.$t.__("FAQ Page",this.$tdPro)},{value:"QAPage",label:this.$t.__("QA Page",this.$tdPro)},{value:"RealEstateListing",label:this.$t.__("Real Estate Listing",this.$tdPro)}]},strings:{schemaType:this.$t.__("Schema Type",this.$tdPro),webPageType:this.$t.__("Web Page Type",this.$td),articleType:this.$t.__("Article Type",this.$tdPro),article:this.$t.__("Article",this.$tdPro),blogPost:this.$t.__("Blog Post",this.$tdPro),newsArticle:this.$t.__("News Article",this.$tdPro)}}},methods:{getSelectOptions:function(t){return"undefined"!==typeof this[t][this.object.name]?this[t][this.object.name]:this[t].cpt},getCurrentOption:function(t,e){return"undefined"!==typeof this[t][this.object.name]?this[t][this.object.name].find((function(t){return t.value===e})):this[t].cpt.find((function(t){return t.value===e}))}}}),o=n,r=(s("2d4c"),s("2877")),l=Object(r["a"])(o,i,a,!1,null,null,null);e["default"]=l.exports},"7a06":function(t,e,s){},"9d33":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-schema-lite"},[s("core-blur",[s("core-settings-row",{attrs:{name:t.strings.schemaType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-select",{staticClass:"schema-type",attrs:{size:"medium",options:t.schemaTypes,value:t.getSchemaTypeOption("Article")}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.articleType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:t.object.name+"articleType",value:"BlogPosting",options:[{label:t.strings.article,value:"Article"},{label:t.strings.blogPost,value:"BlogPosting"},{label:t.strings.newsArticle,value:"NewsArticle"}]}})]},proxy:!0}])})],1),s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("schema-markup","schema-markup-upsell",t.object.name+"-post-type"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("schema-markup",t.object.name,"home")},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0}])})],1)},a=[],n=(s("7db0"),{props:{type:{type:String,required:!0},object:{type:Object,required:!0}},data:function(){return{schemaTypes:[{value:"none",label:this.$t.__("None",this.$td)},{value:"Article",label:this.$t.__("Article",this.$td)}],strings:{schemaType:this.$t.__("Schema Type",this.$td),articleType:this.$t.__("Article Type",this.$td),article:this.$t.__("Article",this.$td),blogPost:this.$t.__("Blog Post",this.$td),newsArticle:this.$t.__("News Article",this.$td),ctaDescription:this.$t.sprintf(this.$t.__("%1$s %2$s allows you to customize the structured data markup on Posts, Pages, Categories, Tags, etc.",this.$td),"AIOSEO","Pro"),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Advanced Schema Markup",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Advanced Schema Markup is only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")}}},methods:{getSchemaTypeOption:function(t){return this.schemaTypes.find((function(e){return e.value===t}))}}}),o=n,r=(s("4edb"),s("2877")),l=Object(r["a"])(o,i,a,!1,null,null,null);e["default"]=l.exports},ab06:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-image-seo"},[s("core-blur",[s("core-settings-row",{attrs:{name:t.strings.titleAttributeFormat},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","default-tags":["image_title","separator_sa","site_title","alt_tag"]},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddVariablesTitleTag)+" ")]},proxy:!0}])})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.stripPunctuationTitleAttribute,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{value:!1,name:"stripTitlePunctuation",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:!0}]}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.altTagAttributeFormat},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","default-tags":["image_title","separator_sa","site_title","alt_tag"]},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddVariablesAltTag)+" ")]},proxy:!0}])})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.stripPunctuationForAltAttribute,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{value:!1,name:"stripAltPunctuation",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:!0}]}})]},proxy:!0}])})],1),s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("image-seo","image-seo-upsell"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("image-seo",null,"home"),"feature-list":[t.strings.setTitleAttributes,t.strings.setAltTagAttributes,t.strings.stripPunctuationTitles,t.strings.stripPunctuationAltTags]},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.imageSeoUpgrade&&t.imageSeoPlans?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.thisFeatureRequires)+" "),s("strong",[t._v(t._s(t.imageSeoPlans))])]):t._e(),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0}])})],1)},a=[],n=(s("7db0"),s("a15b"),s("d81d"),s("5530")),o=s("8103"),r=s.n(o),l=s("2f62"),c={data:function(){return{strings:{titleAttributeFormat:this.$t.__("Title Attribute Format",this.$td),stripPunctuationTitleAttribute:this.$t.__("Strip Punctuation for Title Attributes",this.$td),clickToAddVariablesTitleTag:this.$t.__("Click on the tags below to insert variables into your title attribute.",this.$td),altTagAttributeFormat:this.$t.__("Alt Tag Attribute Format",this.$td),clickToAddVariablesAltTag:this.$t.__("Click on the tags below to insert variables into your alt tag attribute.",this.$td),stripPunctuationForAltAttribute:this.$t.__("Strip Punctuation for Alt Attributes",this.$td),thisFeatureRequires:this.$t.__("This feature requires one of the following plans:",this.$td),ctaDescription:this.$t.__("The Image SEO module is a premium feature that enables you to globally control the Title Attribute and Alt Text for attachment pages and images that are embedded in your content. These can be set based on a specified format, similar to the Title Format settings in the Global Settings menu.",this.$tdPro),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Image SEO",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Image SEO is only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro"),setTitleAttributes:this.$t.__("Set title attributes",this.$td),setAltTagAttributes:this.$t.__("Set alt tag attributes",this.$td),stripPunctuationTitles:this.$t.__("Strip punctuation for titles",this.$td),stripPunctuationAltTags:this.$t.__("Strip punctuation for alt tags",this.$td)}}},computed:Object(n["a"])(Object(n["a"])({},Object(l["e"])(["addons"])),{},{imageSeoUpgrade:function(){var t=this.addons.find((function(t){return"aioseo-image-seo"===t.sku}));return!t||t.requiresUpgrade},imageSeoPlans:function(){var t=this.addons.find((function(t){return"aioseo-image-seo"===t.sku}));return t?t.currentLevels.map((function(t){return r()(t)})).join(", "):null}})},u=c,d=s("2877"),p=Object(d["a"])(u,i,a,!1,null,null,null);e["default"]=p.exports},be6d:function(t,e,s){},e11a:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-custom-fields"},[s("core-settings-row",{attrs:{name:t.strings.customFields,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-textarea",{attrs:{"min-height":200},model:{value:t.options.customFields,callback:function(e){t.$set(t.options,"customFields",e)},expression:"options.customFields"}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.customFieldsDescription)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"CHANGEME",!0))}})])]},proxy:!0}])})],1)},a=[],n=(s("7db0"),{props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0}},data:function(){return{strings:{customFields:this.$t.__("Custom Fields",this.$tdPro),customFieldsDescription:this.$t.__("List of custom field names to include in the SEO Page Analysis. Add one per line.",this.$tdPro)}}},methods:{getSchemaTypeOption:function(t){return this.schemaTypes.find((function(e){return e.value===t}))}}}),o=n,r=s("2877"),l=Object(r["a"])(o,i,a,!1,null,null,null);e["default"]=l.exports},e619:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-image-seo"},[s("core-settings-row",{attrs:{name:t.strings.titleAttributeFormat},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","tags-context":"imageSeoTitle","default-tags":["image_title","separator_sa","site_title"]},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddVariablesTitleTag)+" ")]},proxy:!0}]),model:{value:t.options.image.format.title,callback:function(e){t.$set(t.options.image.format,"title",e)},expression:"options.image.format.title"}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.stripPunctuationTitleAttribute,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"stripTitlePunctuation",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:t.options.image.stripPunctuation.title,callback:function(e){t.$set(t.options.image.stripPunctuation,"title",e)},expression:"options.image.stripPunctuation.title"}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.altTagAttributeFormat},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{attrs:{"line-numbers":!1,single:"","tags-context":"imageSeoAlt","default-tags":["alt_tag","separator_sa","site_title"]},scopedSlots:t._u([{key:"tags-description",fn:function(){return[t._v(" "+t._s(t.strings.clickToAddVariablesAltTag)+" ")]},proxy:!0}]),model:{value:t.options.image.format.altTag,callback:function(e){t.$set(t.options.image.format,"altTag",e)},expression:"options.image.format.altTag"}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.strings.stripPunctuationForAltAttribute,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"stripAltPunctuation",options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:t.options.image.stripPunctuation.altTag,callback:function(e){t.$set(t.options.image.stripPunctuation,"altTag",e)},expression:"options.image.stripPunctuation.altTag"}})]},proxy:!0}])})],1)},a=[],n=s("5530"),o=s("2f62"),r={data:function(){return{strings:{titleAttributeFormat:this.$t.__("Title Attribute Format",this.$tdPro),stripPunctuationTitleAttribute:this.$t.__("Strip Punctuation for Title Attributes",this.$tdPro),clickToAddVariablesTitleTag:this.$t.__("Click on the tags below to insert variables into your title attribute.",this.$tdPro),altTagAttributeFormat:this.$t.__("Alt Tag Attribute Format",this.$tdPro),clickToAddVariablesAltTag:this.$t.__("Click on the tags below to insert variables into your alt tag attribute.",this.$tdPro),stripPunctuationForAltAttribute:this.$t.__("Strip Punctuation for Alt Attributes",this.$tdPro)}}},computed:Object(n["a"])({},Object(o["e"])(["options"]))},l=r,c=s("2877"),u=Object(c["a"])(l,i,a,!1,null,null,null);e["default"]=u.exports}}]);