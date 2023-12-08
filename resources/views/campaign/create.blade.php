@extends(decide_template())
@php
    $dragNDrop = (isActiveAddon('Drag & Drop Email Builder') || isActiveAddon('Drag &amp; Drop Email Builder')) && routeAccess('drag_and_drop_builder');
@endphp
@section('title', $page_data['title'])

@section('page_styles')
<style type="text/css">
  .gjs-pn-btn.fa.fa-download{
    display: none;
  }
  .preview-label {
      min-width: 200px;
  }
  @if($id_==3)
  #dyntags{
    visibility: hidden !important;
  }
  @endif
  .form-group.row .kt-switch.mt0 {margin-top: -5px !important}
  .mh40 {min-height: 40px !important;}
  #email_pre_header_text {
      margin-top: 5px;
  }
  [data-gjs-type="wrapper"] {
        padding-bottom: 20px;
  }
  .gjs-rte-toolbar {
    width: 105% !important;
}
.fa, .fas {
    font-family: 'Font Awesome 5 Free' !important;
    font-weight: 900;
}
.col-md-12.p-0, .col-md-9.p-0, .col-md-8.p-0, .col-md-6.p-0 {
    padding: 0;
}
.col.p-0 {
    padding: 0;
}
.kt-heading.kt-heading--md {
    margin-bottom: 10px;
}
</style>
<link href="/resources/assets/css/campaign-create.css?v={{$local_version}}" rel="stylesheet" type="text/css">
<link href="/themes/default/css/sweetalert2.min.css" rel="stylesheet" type="text/css">

@if($dragNDrop && $id_==2)
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/resources/assets/css/stylesheets-grapes.min.css">
<style>
    .gjs-pn-btn {
   
    
    font-size: 20px !important;
   
}
</style>
@endif
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/lib.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.input.js" type="text/javascript"></script>
<script src="/themes/default/js/repeater.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.ba-htmldoc.js" type="text/javascript"></script>
<script type="text/javascript">
var CKEDITOR_BASEPATH = '/js/libs/ckeditor/';
</script>
 <script src="/js/libs/ckeditor/ckeditor.js"></script>
    <script src="/js/libs/ckeditor/plugins/font/plugin.js"></script>
    <script src="/js/libs/ckeditor/plugins/colorbutton/plugin.js"></script>
    <script src="/js/libs/ckeditor/plugins/zsuploader/plugin.js"></script>
    <script src="/js/libs/ckeditor/plugins/smiley/plugin.js"></script>
    <script src="/js/libs/ckfinder/ckfinder.js"></script>
    <!-- <script src="/themes/default/js/vue.js"></script> -->
    <script src="/themes/default/js/sweetalert2.min.js" type="text/javascript"></script>
     <script>

        editor = CKEDITOR.replace( 'content_html', {
            fullPage: true,
            allowedContent: true,
            height: 320
        });

        // enter work as <br> instead <p>
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
        CKFinder.setupCKEditor( editor );
        //  CKEDITOR.config.extraPlugins = 'imageuploader,preview,font,';
        CKEDITOR.dtd.$editable.li = 1;
        CKEDITOR.config.allowedContent = true;

        CKEDITOR.config.extraPlugins = 'preview,font,colorbutton,justify,bidi,language,emojione';
        CKEDITOR.config.language_list = ['en:English','ar:Arabic:rtl', 'fr:French', 'he:Hebrew:rtl', 'es:Spanish'];
        CKEDITOR.config.defaultLanguage = 'en';
        //  CKEDITOR.config.extraPlugins = 'preview,font,smiley,uploadimage';

        //  config.uploadUrl = '/uploader/upload.php';

    </script>


<script> 
  $('.m-select2').select2({
          templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
       
      $("body").on("click" , ".kt-menu__link,.kt-notification__item,.btn-signout", function() { 
          var url = $(this).attr('href');
          
         // return false;
          if(url!=='javascript:;'){
             
            $(".swal2-confirm").css("background-color", "#dd3333");
            $(".swal2-cancel").css("background-color", "#95a0a8");
            Swal.fire({
                title: "",
                text: "{!! trans('broadcasts.add_new.form.leave_page_message') !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "{{trans('broadcasts.keep_editing')}}",
                confirmButtonText: "{{trans('broadcasts.leave')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = $(this).attr('href');
                    // console.log(url);
                    window.location.href = url;
                }
            }); 
              
              return false;
         }
          
      });     
    </script>

<script> 
      $("body").on("click" , "#sending_node", function() { 
          $("#customDomains").hide();
          $("#preview_sending_type").val(0);
          $("#domain").removeAttr("required");
      });      
      //create
      $("body").on("click" , "#custom_domain", function() { 
          $("#customDomains").show();
          $("#preview_sending_type").val(1);
          $("#domain").addAttr("required");
      });

      @if($dragNDrop && ($id_ ==2 || $id_==3))
        $(document).ready(function () {
              $("#varbs").click(function() {
                  $("#dyntags").toggle();
              });
        });
      @endif

      @if($dragNDrop && $id_==3)
     $('#myiframe').contents().find('.builder-close').on('click',function(e){
        e.preventDefault();
        hideFrame();
      });
      function hideFrame() {
         
            $('#campaign-builder-panel').hide();
            $('#panel-1').show();
            $('#panel-2').show();
            $('#panel-3').show();
            $('ul.page-sidebar-menu').removeClass("page-sidebar-menu-closed");
            $('body.page-header-fixed').removeClass("page-sidebar-closed");
            $('.license_attributes').show();

            $(document).find('body').removeClass("kt-aside--minimize");
            $(document).find('#kt_aside_toggler').removeClass("kt-aside__brand-aside-toggler--active");
            $(document).find('#kt_aside_toggler').click();
            $(document).find('.pagetitle').show();
        }
    @endif
    </script> 
    

@if($dragNDrop && $id_==2)
<!-- Editor Script -->
 <script src="/themes/default/js/grapes.min.js"></script>
 <script src="/themes/default/js/grapesjs-plugin-ckeditor.min.js"></script>
 <script src="/themes/default/js/newsletter.js"></script>
  
<script type="text/javascript">
   var images = [
        <?php
        $path = 'storage/users/'.Auth::user()->id.'/media/images';
        foreach (glob("$path/*")  as $key => $file) {
           echo "'/".addslashes($file)."',";
        }
        $path1 = 'storage/users/'.Auth::user()->id.'/broadcasts/images/builder_images';
        foreach (glob("$path1/*")  as $file1) {
           echo "'/".addslashes($file1)."',";
        }
        ?>
      ];
//       grapesjs.plugins.add('link-editor', function(editor, options) {
//   options = options || {};

//   editor.Commands.add("open-link-editor", {
//     run: function(editor, sender, data) {
//       data.component = data.component || editor.getSelected();

//       var modalHTML = `
// <div>
// <div style="float: left; width: 48%;">
// <div style="padding-bottom: 10px;">
// <div>
// <label for="selectedLinkTypeID">Link Type</label>
// </div>
// <div class="gjs-field gjs-field-select">
// <div class="gjs-input-holder">
// <select id="selectedLinkTypeID" v-model="selectedLinkTypeID">
// <option v-for="linkType in linkTypes" v-if="!linkType.links || linkType.links.length > 0" v-bind:value="linkType.id">@{{ linkType.name }}</option>
// </select>
// </div>
// <div class="gjs-sel-arrow"><div class="gjs-d-s-arrow"></div></div>
// </div>
// </div>
// <div style="padding-bottom: 10px;">
// <div>
// <label for="selectedLink">@{{ selectedLinkType.friendlyLinkLabel }}</label>
// </div>
// <div class="gjs-field gjs-field-select" v-if="selectedLinkType.links">
// <div class="gjs-input-holder">
// <select class="gjs-field" v-model="selectedLink">
// <option v-for="link in links" v-bind:value="link.value">@{{ link.label }}</option>
// </select>
// </div>
// <div class="gjs-sel-arrow"><div class="gjs-d-s-arrow"></div></div>
// </div>
// <div class="gjs-field gjs-field-text" v-if="!selectedLinkType.links">
// <div class="gjs-input-holder">
// <input type="text" v-model="href" placeholder="Enter custom URL" v-if="selectedLinkTypeID =='custom\'">
// <input type="text" v-model="emailAddress" placeholder="Enter email address" v-if="selectedLinkTypeID =='email\'">
// </div>
// </div>
// </div>
// <div style="padding-bottom: 10px;" v-if="selectedLinkType.id =='email\'">
// <div>
// <label>Subject</label>
// </div>
// <div class="gjs-field gjs-field-text">
// <div class="gjs-input-holder">
// <input type="text" v-model="emailSubject" placeholder="Enter email subject">
// </div>
// </div>
// </div>
// <div style="padding-bottom: 10px;" v-if="selectedLinkType.id =='email\'">
// <div>
// <label>Body</label>
// </div>
// <div class="gjs-field gjs-field-text">
// <div class="gjs-input-holder">
// <input type="text" v-model="emailBody" placeholder="Enter email body content">
// </div>
// </div>
// </div>
// </div>
// <div style="float: right; width: 48%;">
// <div style="padding-bottom: 10px;">
// <div>
// <label for="linkContent">Link Text</label>
// </div>
// <div class="gjs-field gjs-field-text">
// <div class="gjs-input-holder">
// <input type="text" id="linkContent" v-model="content" placeholder="Enter link text content">
// </div>
// </div>
// </div>
// <div style="padding-bottom: 10px;">
// <div>
// <label for="linkTitle">Link Title</label>
// </div>
// <div class="gjs-field gjs-field-text">
// <div class="gjs-input-holder">
// <input type="text" v-model="title" placeholder="Enter title (appears as a tooltip on hover)">
// </div>
// </div>
// </div>
// </div>
// <div style="clear: both; padding-top: 20px;">
// <button class="gjs-btn-prim" v-on:click="save">Save</button>
// </div>
// </div>
// `;

//       editor.Modal
//         .setTitle("Edit Link")
//         .setContent("<div id='modalContentContainer'></div>")
//         .open();

//       new Vue({
//         template: modalHTML,
//         data: {
//           href: data.component.get("attributes").href || "",
//           title: data.component.get("attributes").title || "",
//           content: (data.component.get("content") || "").trim(), // remove any unexpected whitespace (not sure where it comes from)

//           emailAddress: "",
//           emailSubject: "",
//           emailBody: "",

//           linkTypes: [
//             { id: "custom", name: "Custom URL", friendlyLinkLabel: "URL" },
//             { id: "email", name: "Email Address", friendlyLinkLabel: "Email" }
//           ],
//           selectedLinkTypeID: "custom",
//           selectedLink: ""
//         },
//         computed: {
//           links: function() {
//             return this.selectedLinkType.links || [];
//           },
//           selectedLinkType: function() {
//             var self = this;

//             var matchingCategories = self.linkTypes.filter(function(linkType) {
//               return linkType.id == self.selectedLinkTypeID;
//             });

//             return matchingCategories.length > 0 ? matchingCategories[0] : {};
//           }
//         },
//         watch: {
//           selectedLink: function() {
//             this.href = this.selectedLink;
//           }
//         },
//         methods: {
//           save: function() {
//             var attributes = data.component.get("attributes");
//             attributes.href = this.getHref();
//             attributes.title = this.title;

//             data.component.set("attributes", attributes);
//             data.component.set("content", this.content);

//             // render the view so that the dom element does not have any outdated attributes
//             data.component.view.render();

//             editor.Modal.close();
//           },
//           getHref: function() {
//             var href = this.href;

//             if (this.selectedLinkTypeID == "email") {
//               var queryStringParts = [];
//               if (this.emailSubject.length > 0) {
//                 queryStringParts.push("subject=" + encodeURIComponent(this.emailSubject));
//               };
//               if (this.emailBody.length > 0) {
//                 queryStringParts.push("body=" + encodeURIComponent(this.emailBody));
//               };
//               href = "mailto:" + this.emailAddress + "?" + queryStringParts.join("&");
//             };

//             return href;
//           }
//         },
//         mounted: function() {
//           var self = this;

//           options.links && options.links.forEach(function(linkGroup) {
//             self.linkTypes.push({
//               id: linkGroup.category,
//               name: linkGroup.category,
//               friendlyLinkLabel: linkGroup.category,
//               links: linkGroup.links
//             });
//           });

//           if (self.href.toLowerCase().indexOf("mailto:") == 0 && self.href.indexOf("?") > 0) {
//             self.selectedLinkTypeID = "email";

//             self.emailAddress = self.href.split("?")[0].replace("mailto:", "");

//             self.href.split("?")[1].split("&")
//               .map(function(queryStringParam) {
//               return queryStringParam.split("=");
//             })
//               .forEach(function(queryStringParam) {
//               if (queryStringParam[0] == "subject" && queryStringParam.length > 0) {
//                 self.emailSubject = decodeURIComponent(queryStringParam[1]);
//               };
//               if (queryStringParam[0] == "body" && queryStringParam.length > 0) {
//                 self.emailBody = decodeURIComponent(queryStringParam[1]);
//               };
//             });
//           } else {
//             self.linkTypes.forEach(function(linkType) {
//               (linkType.links || []).forEach(function(link) {
//                 if (link.value == self.href) {
//                   self.selectedLinkTypeID = linkType.id;
//                   self.selectedLink = link.value;
//                 };
//               });
//             });
//           };
//         }
//       }).$mount("#modalContentContainer");
//     }
//   });

//   // open link modal when double clicking a link component
//   var linkType = editor.DomComponents.getType('link');
//   editor.DomComponents.addType('link', {
//     model: linkType.model,
//     view: linkType.view.extend({
//       events: {
//         "dblclick": "editLink"
//       },
//       editLink: function(e) {
//         e.stopImmediatePropagation(); // prevent the RTE from opening

//         editor.runCommand("open-link-editor", {
//           component: this.model
//         });
//       }
//     })
//   });

//   // open link editor when adding link from RTE
//   var linkRTEAction = editor.RichTextEditor.remove("link");
//   linkRTEAction.result = function(rte) {
//     // insert the link with a specific href value so we can find it later
//     rte.exec("createLink", "__new__");

//     editor.getSelected().view.disableEditing();

//     // find the newly created link
//     var linkComponents = getAllComponents().filter(function(component) {
//       return (component.get("attributes").href || "") == "__new__";
//     });
//     if (linkComponents.length > 0) {
//       var linkComponent = linkComponents[0]; // ideally there should only be 1 that matched the filter

//       // remove the placeholder href value
//       var attributes = linkComponent.get("attributes");
//       attributes.href = "";
//       linkComponent.set("attributes", attributes);

//       editor.runCommand("open-link-editor", {
//         component: linkComponent
//       });
//     } else {
//       console.error("could not find inserted link");
//     };
//   };

//   editor.RichTextEditor.add("link", linkRTEAction);

//   function getAllComponents(component) {
//     component = component || editor.DomComponents.getWrapper();

//     var components = component.get("components").models;
//     component.get("components").forEach(function(component) {
//       components = components.concat(getAllComponents(component));
//     });

//     return components;
//   };

// });


function loadModules(editor){
  // Loading Modules
    const blockManager = editor.BlockManager;
    var template_name="{{ isset($campaign->template) ? $campaign->template:'blank' }}";
  $.getJSON('{{ route("loadModules")}}',{template:template_name,bid:{{$campaign->id}} }, function(data) {
          $.each(data,function(i,template){
            var path=`"/public/editor/templates/main/blocks/`+(i.replace('/','_'))+`/`+template.thumbnail+`"`;
            var name=i.substring(5);
            if(template_name !="blank"){
              path=`"/storage/users/{{$campaign->user_id}}/broadcasts/{{$campaign->id}}/${template_name}/blocks/`+(i.replace('/','_'))+`/`+template.thumbnail+`"`; 
              name =i;
            }
             blockManager.add(i, {
                label: `<label style="cursor: all-scroll;">`+name+`</label> <br> <img style="max-width: 100%;pointer-events: none;" src=${path}> `,
                content:template.content ,
                category: { id:'modules',label:'Modules',order:2,open: true},
                attributes: {
                  title: i,
                  class: "grapesjs-modules",
                }
              });
          });

       });
  }
  // Code is commented for later use
  function loadTemplates(editor){
  //Loading Templates
    // const blockManager = editor.BlockManager;
    //        $.getJSON('{{ route("loadTemplates")}}', function(data) {
    //       $.each(data,function(i,template){
    //          blockManager.add(i, {
    //             label: `<label>`+i+`</label> <br> <img style="max-width: 100%;" src="/public/editor/templates/main/templates/`+i+`/`+template.thumbnail+`"> `,
    //             content:template.content ,
    //              category: { id:'templates',label:'Templates',order:3,open: false},
    //             attributes: {
    //               title: i,
    //               class: "grapesjs-modules",
    //             }
    //           });
    //       });

    //    });

  } 
  // drag & drop editor
  var editor = grapesjs.init({
      container : '#editor',
      fromElement: 1,
      noticeOnUnload: false,
      plugins: ['gjs-preset-newsletter',loadModules,loadTemplates,'gjs-plugin-ckeditor'],
      pluginsOpts: {
        'gjs-preset-newsletter': {
          categoryLabel: {id:'newsletter',label:'Sections',order:1,open: false}
        },
      'gjs-plugin-ckeditor': {
            position: 'center',
            options: {
              startupFocus: true,
              extraAllowedContent: '*(*);*{*}', // Allows any class and any inline style
              allowedContent: true, // Disable auto-formatting, class removing, etc.
              enterMode: CKEDITOR.ENTER_BR,
              extraPlugins: 'sharedspace,justify,colorbutton,panelbutton,font',
              toolbar: [
                { name: 'styles', items: ['Font', 'FontSize' ] },
                ['Bold', 'Italic', 'Underline', 'Strike'],
                {name: 'paragraph', items : [ 'NumberedList', 'BulletedList']},
                {name: 'links', items: ['Link', 'Unlink']},
                {name: 'colors', items: [ 'TextColor', 'BGColor' ]},
              ],
            }
          }
      },
     assetManager: {
          assets: images,
          upload: '{{ route("uploadMultipleImages") }}',
          uploadName: 'files', // The name used in POST to pass uploaded files
          params: {_token: '{{ csrf_token() }}' },
          multiUpload: true,
          autoAdd: 0,
          modalTitle: 'Select Image',
        },
      storageManager: {
      id: 'gjs-',             // Prefix identifier that will be used inside storing and loading
      type: 'local',          // Type of the storage
      autosave: false,         // Store data automatically
      autoload: false,         // Autoload stored data on init
      stepsBeforeSave: 3,     // If autosave enabled, indicates how many changes are necessary before store method is triggered
      storeComponents: 0,  // Enable/Disable storing of components in JSON format
      storeStyles: 0,      // Enable/Disable storing of rules in JSON format
      storeHtml: 0,        // Enable/Disable storing of components as HTML string
      storeCss: 0,         // Enable/Disable storing of rules as CSS string,
    },
   
  });
   var pnm = editor.Panels;
    pnm.addButton('options', [{
        id: 'undo',
        className: 'fa fa-undo',
        attributes: {title: 'Undo'},
        command: function(){ editor.runCommand('core:undo') }
      },{
        id: 'redo',
        className: 'fa fa-repeat',
        attributes: {title: 'Redo'},
        command: function(){ editor.runCommand('core:redo') }
      },{
        id: 'clear-all',
        className: 'fa fa-trash icon-blank',
        attributes: {title: 'Clear canvas'},
        command: {
          run: function(editor, sender) {
            sender && sender.set && sender.set('active', false)
            if(confirm('Are you sure to clean the canvas?')){
              editor.DomComponents.clear();
              setTimeout(function(){
                localStorage.clear()
              },0)
            }
          }
        }
      }

      ]);

    // Open Style Manager when selecting an element
    editor.on('component:selected', () => {
     const openSmBtn = editor.Panels.getButton('views', 'open-sm');
     openSmBtn.set('active', 1);
     });
        // The upload is started
    editor.on('asset:upload:start', () => {
      // startAnimation();
    });

    // The upload is ended (completed or not)
    editor.on('asset:upload:end', (response) => {

    });

    // Error handling
    editor.on('asset:upload:error', (err) => {
      toastr.error(err.replace(/\"/g,''));
    });

    // Do something on response
    editor.on('asset:upload:response', (response) => {
     // Get the Asset Manager module first
        const am = editor.AssetManager;
        var images= editor.AssetManager.getConfig().assets;
        $.each(response.data,function(i,img){
          if($.inArray( img, images ) === -1){
               am.add([
              {
                src: img,
              },
            ]);
          }
          
        });

    });
    editor.on('load',
    function() {
      setTimeout(function(){
        var html_string=$('#editorHtml').val().replace(/<!--.*?-->/sg, "");
        var extra = $.htmlDoc(html_string).find('body').find('meta,title').length;
        
        if(extra){
        var html='';
        }else{
            var html = $.htmlDoc( html_string ).find('body').html();    
        }
        if(!html){
          var html = html_string;
        }
        editor.setComponents(html);
        $('.blockUI').remove();
        $('#editorHtml').val(html);
      },3000);
const styleManager = editor.StyleManager;
var property = styleManager.addProperty("typography",{
  name: 'Direction',
  property: 'direction',
  type: 'select',
  defaults: 'initial',
  list: [{
    value: 'initial',
    name: 'Initial',
   },{
     value: 'inherit',
     name: 'Inherit',
   },{
     value: 'ltr',
     name: 'LTR',
   },{
     value: 'rtl',
     name: 'RTL',
   }],
}, { at: 8 });
    });
  

   // Make span and anchor editable
     CKEDITOR.dtd.$editable.span = 1
     CKEDITOR.dtd.$editable.a = 1    

    // select variable from system variable and additional tag
    function selectTag(field, ckeditor_id) {
        if(field == 'Unsubscribe Link')
            field = '<a href="%%unsubscribelink%%">{{trans('broadcasts.unsubscribe')}}</a>';
        else if(field == 'Confirm Link')
            field = '<a href="%%confirmurl%%">{{trans('broadcasts.confirm')}}</a>';
        else
            field = '%%'+field+'%%';
            copy(field);
    }
    function replaceVariable(ckeditor_id,selectID){
        var field = $("#"+selectID).val();
        if(field!=""){
            if(selectID=='spintags_variables'){
                selectSpintag(field, ckeditor_id)
            }
            else if(selectID=='dynamic_content_variables'){
                field = "[["+field+"]]";
                selectDynamicContent(field, ckeditor_id)
            }else{
                selectTag(field, ckeditor_id); 
            }  
            setTimeout(function() {
                 $("#"+selectID).val(null).trigger('change.select2');
            }, 300);
        }
        
    }
    // select spintags
    function selectSpintag(spintag, ckeditor_id) {
        spintag = '{'+'{'+spintag+'}'+'}';
        copy(spintag);
    }
    // select Dynamic tag
    function selectDynamicContent(dynamic_content, ckeditor_id) {
        dynamic_content = dynamic_content;
        copy(dynamic_content);
    }
    // add selected variable in ck editor
    function copy(field) {
        var copyText =  $('#tag_value').val(field);
        $("#tag_value").css("display", "block");
        / Select the text field /
        copyText.select();
        / Copy the text inside the text field /
        document.execCommand("copy");
        $("#tag_value").css("display", "none");
        toastr.success("Tag value "+field+" successfully copied.", "Response Copied");
    }
   
        function insertHTML() {
            var html = editor.runCommand('gjs-get-inlined-html');
            var head = $("#js-head").val();
            var footer = $("#js-footer").val();
            // var html = (head+html+footer);
             $('#editorHtml').val(html);
           // sessionStorage.setItem('html',html);
            $('#campaign-builder-panel').hide();
            $('#panel-1').show();
            $('#panel-2').show();
            $('ul.page-sidebar-menu').removeClass("page-sidebar-menu-closed");
            $('body.page-header-fixed').removeClass("page-sidebar-closed");
            $('.license_attributes').show();
            
        }
    </script> 
@endif
@if(in_array('Emojis', whmcsAddOns()))
    <!-- <link href="/themes/default/js/emojis/jquery.emojipicker.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="/themes/default/js/emojis/jquery.emojipicker.js"></script>
    <link href="/themes/default/js/emojis/jquery.emojipicker.tw.css" rel="stylesheet">
    <script src="/themes/default/js/emojis/jquery.emojis.js"></script>  -->
    <script src="/themes/default/js/emojies/emojies.min.js"></script>
@endif
        

<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/campaign.js" type="text/javascript"></script>

<script>
@if( $id_ !=2)
    function selectTag(field, ckeditor_id) {
        if(field == 'Unsubscribe Link')
            field = '<a href="%%unsubscribelink%%">{{trans('broadcasts.unsubscribe')}}</a>';
        else if(field == 'Confirm Link')
            field = '<a href="%%confirmurl%%">{{trans('broadcasts.confirm')}}</a>';
        else if(field == 'web_version')
            field = '<a href="%%web_version%%">{{trans('broadcasts.web_version')}}</a>';
        else
            field = '%%'+field+'%%';
        CKEDITOR.instances[ckeditor_id].insertHtml(field);
        
        
        
    }
    function replaceVariable(ckeditor_id,selectID){
        var field = $("#"+selectID).val();
        if(field!=""){
            if(selectID=='spintags_variables'){
                selectSpintag(field, ckeditor_id)
            }
            else if(selectID=='dynamic_content_variables'){
                field = "[["+field+"]]";
                selectDynamicContent(field, ckeditor_id)
            }else{
                selectTag(field, ckeditor_id); 
            }  
            setTimeout(function() {
                 $("#"+selectID).val(null).trigger('change.select2');
            }, 300);
        }
        
    }
    function selectSpintag(spintag, ckeditor_id) {
        spintag = '{'+'{'+spintag+'}'+'}';
        CKEDITOR.instances[ckeditor_id].insertText(spintag);
    }
    function selectDynamicContent(dynamic_content, ckeditor_id) {
        dynamic_content = dynamic_content;
        CKEDITOR.instances[ckeditor_id].insertText(dynamic_content);
    }
    @endif
    @php
    $user  = auth()->user();
    $storage_path  = "/storage/users/{$user->id}/broadcasts/".$campaign->id;
    @endphp
    $('#copyAsText').click(function() {
        @if($id_==2) // For grapesjs editor
        var content_html=$('#editorHtml').val();
        copyAsText(content_html);
        @elseif($id_==3)  // For builderjs  editor
        var r = (Math.random() + 1).toString(36).substring(7);
        var tempUrl = "{{$storage_path.'/'.$campaign->template}}/index.html?key="+r;
          jQuery.get(tempUrl, function(data) {
            copyAsText(data);
          });
        @else
        var content_html = CKEDITOR.instances['content_html'].getData(); // For CK editor editor
        copyAsText(content_html);
        @endif
    });
 function copyAsText(content_html){
     jQuery('#content_js').html(content_html).find('a').each(function(){
                 var href=jQuery(this).attr('href');
                 var label=jQuery(this).text();
                 if( href && href !="#"){
                 var link= (label && label !="") ? label +":"+ href:href;
                 }else{
                  var link=label;
                 }
                 jQuery(this).replaceWith(link);
            });
            // Removing extra spaces e.g newline, tabs etc with single one
            content_html=jQuery('#content_js').html();
            $(".blockUI").show();
             $.ajax({
                url: "{{ route('converHtmlToText') }}",
                type: "POST",
                data: {html: content_html},
                success: function(result) {
                        $(".blockUI").hide();
                        $('#content_text').val(result);
                },
                error: function(err) {
                        $(".blockUI").hide();
                }
            });
    }
    function checkSpamScore()
    {
       @if($id_==2)
        var content_html=$('#editorHtml').val(); // For grapesjs editor
        @else
        var content_html = CKEDITOR.instances['content_html'].getSnapshot(); // For CK editor editor
        @endif
        var subject = $("#subjectt").val();

        if(content_html == "<p><br></p>" || content_html == "" || content_html == "<br>"){
            alert('{{trans('broadcasts.message.empty_html_contents')}}');
            return false;
        }
        if(subject == ""){
            alert('{{trans('broadcasts.message.empty_subject_field')}}');
            return false;
        }

        $(".blockUI").show();

        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/spam/score',
            type: "POST",
            data: {content_html: content_html, subject: subject},
            success: function(result) {

                var obj = JSON.parse(result);

                if(obj.success == true){
                    $(".blockUI").hide();
                    $("#spam-score-modal").modal('show');
                    $('#statusss').html('Success');
                    $('#scoreee').html(obj.score);
                }
                else{
                    $(".blockUI").hide();
                    alert("{{trans('broadcasts.message.alert_error')}}");
                }
            }
        });
    }

        @if($id_==2)
        $('#pr').click(function(){
        var html=$('#editorHtml').val();
         $('#content_').html(html);
         });

         function campaignBuilder() {
                $('#campaign-builder-panel').show();
                $('#panel-1').hide();
                $('#panel-2').hide();
                $('#panel-3').hide();
                $('ul.page-sidebar-menu').addClass("page-sidebar-menu-closed");
                $('body.page-header-fixed').addClass("page-sidebar-closed");
                $('.license_attributes').hide();
            }
        function exitCampaignBuilder() {
                $('#campaign-builder-panel').hide();
                $('#panel-1').show();
                $('#panel-2').show();
                $('#panel-3').show();
                $('ul.page-sidebar-menu').removeClass("page-sidebar-menu-closed");
                $('body.page-header-fixed').removeClass("page-sidebar-closed");
                $('.license_attributes').show();
                 // var html = editor.runCommand('gjs-get-inlined-html');
              // $('#editorHtml').val(html);
            }    
        @endif

        @if($id_==3)

        $(document).on('click','#pr',function(){
         var r = (Math.random() + 1).toString(36).substring(7);
         var tempUrl = "{{$storage_path}}/"+$(this).attr('data-id')+"/index.html?key="+r;
          jQuery.get(tempUrl, function(data) {
             $("#preview_html #content_").html(data);
          });
         });
         var oneTimeLoad=0;

         function campaignBuilder() {
          <?php 

          $is_builder_addon_active=\DB::table('addons')->where('name','Builder')->where('status',"active")->first();
            if($is_builder_addon_active){
                 $response=verify_license();    
            if($response !="success"){
            ?>
               Command: toastr["error"] ("{{ addslashes($response)}}"); 
               return;
                
             <?php }} ?> 
          
             if(oneTimeLoad==0)
            document.getElementById('myiframe').contentDocument.location.reload(true);
                    $('#campaign-builder-panel').show();
                    $('#panel-1').hide();
                    $('#panel-2').hide();
                    $('#panel-3').hide();
                    $('ul.page-sidebar-menu').addClass("page-sidebar-menu-closed");
                    $('body.page-header-fixed').addClass("page-sidebar-closed");
                    $('.license_attributes').hide();
               
                    oneTimeLoad=1;
             $(document).find('body').addClass("kt-aside--minimize");
             $(document).find('#kt_aside_toggler').addClass("kt-aside__brand-aside-toggler--active");
             $(document).find('.pagetitle').hide();
            }

        @endif
   
      


    function isValidUrl(url){

        if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(url)) {
            return 1;
        } else {
            return 0;
        }
    }
    // fetch url content
    function fetchURLContents()
    {
        var url = $("#complete_url").val();

        if(url == "") {
            Command: toastr["error"] ("{{trans('broadcasts.message.alert_request')}}"); 
            $("#complete_url").focus();
            return false;
        }

        var valid_url = this.isValidUrl(url);

        if(valid_url === 0) {
          Command: toastr["error"] ("{{trans('broadcasts.message.alert_warning')}}"); 
          $("#complete_url").focus();
          return false;
        }

        else {

            $(".blockUI").show();
            var downloadImage = 0;
            if($("#downloadImage").is(':checked')) {
                downloadImage = 1;
            }
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/url/contents',
                type: "POST",
                data: {url: url,'downloadImage':downloadImage},
                success: function(result) {
                    if(result != null){
                        if(result=="invalid_url"){
                            Command: toastr["error"] ("{{trans('broadcasts.message.alert_request')}}"); 
                            $("#complete_url").focus();
                            CKEDITOR.instances.content_html.setData(""); 
                            ///return false;  
                        }else{
                            var html = result;
                            //CKEDITOR.instances.content_html.insertHtml(html);
                            CKEDITOR.instances.content_html.setData(html); 
                        }
                        $("#fetch-url").hide();
                        $('.modal-backdrop').hide();
                        $(".blockUI").hide();
                    }

                }
            });

        }

    }
    //cke_button cke_button__link cke_button_off
    $(document).ready(function () {
        $(document).on("click",".cke_button__link",function(e){
            //var selection = editor.getSelection();
            //console.log(selection);
            //alert( selection.getType() );  
            var selection = editor.getSelection();
            var range = selection.getRanges()[0];
            var cursor_position = range.startOffset;
            var endOffset = range.endOffset;
            //var ranges = editor.getSelection().getRanges();
            // console.log(cursor_position);
            // console.log(endOffset);
            //var h = editor.container.$.clientHeight;
            ///console.log(h);
        })
      $("#get-url").click(function() {
        // console.log("url");
        if($("#fetchURL").is(":visible")) {
          $("#fetchURL").slideUp();
          $("#fetchURLDownload").slideUp();
          $("#get-url").removeClass("url-show");
        } else {
          $("#fetchURL").slideDown();
          $("#fetchURLDownload").slideDown();
          $("#get-url").addClass("url-show");
          $("#complete_url").val("");
        }
        //$("this").toggleClass('url-show');
      });

        setTimeout(function(){
            $("#kt_content>.alert-success").slideUp();
        }, 1500);

        $('#group-id').select2({
            placeholder: "Choose Group",
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        
    });
</script>
<script src="/themes/default/js/jquery.dm-uploader.min.js" type="text/javascript"></script>
<script src="/themes/default/js/demo-ui.js" type="text/javascript"></script>
<script type="text/html" id="files-template">
    <li class="media">
        <div class="media-body mb-1">
            <p class="mb-2">
                <strong class="filename">%%filename%%</strong>  <span class="text-muted">{{trans('broadcasts.waiting')}}</span>
            <div class="progress progress-striped mb-2">
                <div class="progress-bar progress-bar-success progress-bar-animated"
                     role="progressbar"
                     style="width: 0%"
                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            </p>
            <div class="la la-close font-red pull-right removeFile" data-file=""></div>
            <hr class="mt-1 mb-1" />
        </div>
    </li>
</script>
<script type="text/javascript">
    var token = "{{ csrf_token() }}";

    $(function(){

        $(document).on("click", ".removeFile", function() {
            var file_name = $(this).parent().children('p.mb-2').find('.filename').html();
            var list_block_id = $(this).parent().parent().attr('id');
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/imgDel',
                type: "POST",
                data: {"_token": token, "file_name": file_name,'campaign_id':$('#campaign-id').val()},
                success: function(result) {
                    if(result=='success'){
                        $("#"+list_block_id).remove();
                        $("#imgMsg").append("<li> "+ file_name+" {{trans('broadcasts.message.successfully_moved')}} </li>");
                    }

                }
            });
        });

        $(document).on("click", ".removeFile2", function() {
            var file_name = $(this).parent().children('p.mb-2').find('.filename').html();

            var list_block_id = $(this).parent().parent().attr('id');
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/imgDel2',
                type: "POST",
                data: {"_token": token, "file_name": file_name, "campaign_id": $("#campaign-id").val()},
                success: function(result) {
                    if(result=='success'){
                        $("#"+list_block_id).remove();
                        $("#imgMsg").append("<li> "+ file_name+" {{trans('broadcasts.message.successfully_moved')}} </li>");
                        return false;
                    }

                }
            });

        });

        /*
         * For the sake keeping the code clean and the examples simple this file
         * contains only the plugin configuration & callbacks.
         *
         * UI functions ui_* can be located in: demo-ui.js
         */
    $('#drag-and-drop-zone').dmUploader({ //
        url: app_url+'/broadcasts/multiupload?id='+$("#campaign-id").val(),
        maxFileSize: 10000000, // 3 Megs
        onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
        },
        onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
        },
        onInit: function(){
            // Plugin is ready to use
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.penguin_initialized')}}:)', 'info');
        },
        onComplete: function(){
            // All files in the queue are processed (success or error)
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.all_pending_transfers_finished')}}');
        },
        onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.new_file_added')}} #' + id);
            ui_multi_add_file(id, file);
        },
        onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.starting_the_upload_of')}} #' + id);
            ui_multi_update_file_status(id, 'uploading', '{{trans('broadcasts.add_new.form.drag_drop_zone.uploading')}}...');
            ui_multi_update_file_progress(id, 0, '', true);
        },
        onUploadCanceled: function(id) {
            // Happens when a file is directly canceled by the user.
            ui_multi_update_file_status(id, 'warning', '{{trans('broadcasts.add_new.form.drag_drop_zone.canceled_by_user')}}');
            ui_multi_update_file_progress(id, 0, 'warning', false);
        },
        onUploadProgress: function(id, percent){
            // Updating file progress
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            // A file was successfully uploaded
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.server_response_for_file')}} #' + id + ': ' + JSON.stringify(data));
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.upload_of_file')}} #' + id + ' COMPLETED', 'success');
            ui_multi_update_file_status(id, 'success', '{{trans('broadcasts.add_new.form.drag_drop_zone.upload_complete')}}');
            ui_multi_update_file_progress(id, 100, 'success', false);
        },
        onUploadError: function(id, xhr, status, message){
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);
        },
        onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.plugin_cannot_be_used_here')}}', 'danger');
        },
        onFileSizeError: function(file){
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.file')}} \'' + file.name + '\' {{trans('broadcasts.add_new.form.drag_drop_zone.cannot_be_added')}}: {{trans('broadcasts.add_new.form.drag_drop_zone.add.size_excess_limit')}}', 'danger');
        }

    })
});
</script>
@if(in_array('Emojis', whmcsAddOns()))
    <!-- <script type="text/javascript">
        $(document).ready(function(e) {
            $('#subjectt').emojiPicker();
        });
    </script> -->
<style type="text/css">.emoji-picker{margin:0 .5em;border:1px solid #999;border-radius:5px;box-shadow:0 0 3px 1px #ccc;background:#fff;width:20.5rem;height:27.5rem;font-family:Arial,Helvetica,sans-serif}.emoji-picker__content{padding:.5em;height:20.5rem}.emoji-picker__preview{height:2em;padding:.5em;border-top:1px solid #999;display:flex;flex-direction:row;align-items:center}.emoji-picker__preview-emoji{font-size:2em;margin-right:.25em}.emoji-picker__preview-name{color:#666;font-size:.85em;overflow-wrap:break-word;word-break:break-all}.emoji-picker__tabs{margin:0;padding:0;display:flex}.emoji-picker__tab{list-style:none;display:inline-block;padding:0 .5em;cursor:pointer;flex-grow:1;text-align:center}.emoji-picker__tab.active{border-bottom:3px solid #4f81e5;color:#4f81e5}.emoji-picker__tab-body{display:none;margin-top:.5em}.emoji-picker__tab-body h2{font-size:.75rem;text-transform:uppercase;color:#333;margin:0}.emoji-picker__tab-body.active{display:block}.emoji-picker__emojis{height:18rem;overflow-y:scroll;display:flex;flex-wrap:wrap;align-content:flex-start;width:calc(1.3rem * 1.5 * 10);margin:auto}.emoji-picker__emoji{background:0 0;border:none;border-radius:5px;cursor:pointer;font-size:1.3rem;width:1.5em;height:1.5em;padding:0;margin:0}.emoji-picker__emoji:hover{background:#e8f4f9}.emoji-picker__search-container{margin:.5em;position:relative;height:2em;display:flex}.emoji-picker__search-container input{box-sizing:border-box;width:100%;border-radius:5px;border:1px solid #ccc;padding-right:2em}.emoji-picker__search-icon{position:absolute;color:#ccc;width:1em;height:1em;right:.75em;top:calc(50% - .5em)}.emoji-picker__search-not-found{color:#666;text-align:center;margin-top:2em}.emoji-picker__search-not-found-icon{font-size:3em}.emoji-picker__search-not-found h2{margin:.5em 0;font-size:1em}.emoji-block>input#subjectt,#email_pre_header_input {border-top-right-radius: 0;border-bottom-right-radius: 0;} button#emoji-button>svg , #emoji-button-pre-header >svg {width: 20px;height: 20px;} button#emoji-button,#emoji-button-pre-header {border: 1px solid #bec4d0 !important;border-left: 0 !important;width: 40px;text-align: center;align-items: center;justify-content: center;display: flex;border-top-right-radius: 4px;border-bottom-right-radius: 4px;} .emoji-picker__tab>svg {font-size: 20px;} .emoji-picker__tab.active {border-bottom: 3px solid #0f997f;color: #0f997f;} .emoji-picker__preview {height: 4.5em;margin-top: 1em;}</style>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    EmojiButton(document.querySelector('#emoji-button'), function (emoji) {
      document.getElementById('subjectt').value += emoji;
    });
    EmojiButton(document.querySelector('#emoji-button-pre-header'), function (emoji) {
      document.getElementById('email_pre_header_input').value += emoji;
    });
  });
</script>
@endif
<script type="text/javascript">
    var KTFormRepeater = function() {
        var demo1 = function() {
            $('#kt_repeater_3').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    if(confirm('{{ trans("common.message.alert_confirm") }}')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        };
        var demo4 = function() {
            $('#kt_repeater_4').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    if(confirm('@lang("common.message.delete_warning")')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        }
        return {
            init: function() {
                demo1();
                demo4();
            }
        };
    }();
    jQuery(document).ready(function() {
        KTFormRepeater.init();
        $('#enable_preheader').change(function(){
          if($(this).is(':checked')){
            $('#email_pre_header_text').show();
          }else{
            $('#email_pre_header_text').hide();
          }
        });
        $('#enable_preheader').change();
    });
</script>
@endsection

@section(decide_content())

    <div id="modal-loading" class="modals" data-name="JFSsiODO">
        <i class="la la-spinner fa-spin fa-5x"></i>
    </div>

    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="hpvyppzC">
            {{ Session::get('msg') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" data-name="yOvVMYsq">
            {{ Session::get('error') }}
        </div>
    @endif

    @if($errors->any())
        <!-- For PHP validations errors-->
        <div class="alert alert-danger" data-name="XyKLfLjL">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- will be used to show any messages -->
    <div id="msg" class="display-hide" data-name="tJKOeYPO">
        <button class="close" data-close="alert"></button>
        <span id='msg-text' class="alert-text"><span>
    </div>
    @if($dragNDrop && $id_==2)
    <div class="row" id="campaign-builder-panel" style="display: none;" data-name="hcHqjDoo">
        <div class="col-md-12" data-name="XKIWaeXZ">
    <?php /*      
  <?php $common=headerFooter(isset($campaign->template) ? $campaign->template:'blank');?>

<input  id="js-head" type="hidden" name="head" value='{{  htmlspecialchars($common['head'],ENT_QUOTES,'UTF-8') }}' />
<input  id="js-footer" type="hidden" name="footer" value='{{  htmlspecialchars($common['footer'],ENT_QUOTES,'UTF-8')}}' />
*/?>  
 <!-- Main Sidebar -->
  <div id="email-builder" data-name="piBXPVUa">
   
    <div class="main-container" data-name="nYCcyKUK">
        
        <!-- Holder Container -->
        <div class="holder-container" data-name="slQZiPgA">
            <!-- Top Sidebar -->

            <div class="sidebar-top" data-name="eNebndhd">
               <button type="button" class="btn-main item btn btn-success btn-xs" onClick="insertHTML()">{{trans('broadcasts.insert')}}</button>
               <button type="button" class="btn-main item btn btn-success btn-xs" onClick="exitCampaignBuilder()">{{trans('broadcasts.exit')}}</button>
                <span class="item btn btn-success btn-xs" title="{{trans('broadcasts.insert_dynamic_fields')}}" id="varbs">{{trans('broadcasts.dynamic_fields')}}</span>
            </div>

            <input type="text" id="tag_value" value="" style="display: none"/>
            <div id="dyntags" data-name="wUEKUuoa">{{dynamicTags(0, 2, 'content_html',auth()->id())}}</div>
            <!-- Editor Container -->
            <div class="editor-container" data-name="zAuyshYL">
                <!-- Editor Area -->

                <div class="editor" id='editor' data-type="editor" data-name="eZMLSidu">
                    

                    <style>
  
  .row{
    vertical-align:top;
  }
  .main-body{
    min-height:150px;
    padding: 5px;
    width:100%;
    height:100%;
    background-color:rgb(234, 236, 237);
  }
  .c926{
    color:rgb(158, 83, 129);
    width:100%;
    font-size:50px;
  }
  .cell.c849{
    width:11%;
  }
  .c1144{
    padding: 10px;
    font-size:17px;
    font-weight: 300;
  }
  .card{
    min-height:150px;
    padding: 5px;
    margin-bottom:20px;
    height:0px;
  }
  .card-cell{
    background-color:rgb(255, 255, 255);
    overflow:hidden;
    border-radius: 3px;
    padding: 0;
    text-align:center;
  }
  .card.sector{
    background-color:rgb(255, 255, 255);
    border-radius: 3px;
    border-collapse:separate;
  }
  .c1271{
    width:100%;
    margin: 0 0 15px 0;
    font-size:50px;
    color:rgb(120, 197, 214);
    line-height:250px;
    text-align:center;
  }
  .table100{
    width:100%;
  }
  .c1357{
    min-height:150px;
    padding: 5px;
    margin: auto;
    height:0px;
  }
  .darkerfont{
    color:rgb(65, 69, 72);
  }
  .button{
    font-size:12px;
    padding: 10px 20px;
    background-color:rgb(217, 131, 166);
    color:rgb(255, 255, 255);
    text-align:center;
    border-radius: 3px;
    font-weight:300;
  }
  .table100.c1437{
    text-align:left;
  }
  .cell.cell-bottom{
    text-align:center;
    height:51px;
  }
  .card-title{
    font-size:25px;
    font-weight:300;
    color:rgb(68, 68, 68);
  }
  .card-content{
    font-size:13px;
    line-height:20px;
    color:rgb(111, 119, 125);
    padding: 10px 20px 0 20px;
    vertical-align:top;
  }
  .container{
    font-family: Helvetica, serif;
    min-height:150px;
    padding: 5px;
    margin:auto;
    height:0px;
    width:90%;
    max-width:550px;
  }
  .cell.c856{
    vertical-align:middle;
  }
  .container-cell{
    vertical-align:top;
    font-size:medium;
    padding-bottom:50px;
  }
  .c1790{
    min-height:150px;
    padding: 5px;
    margin:auto;
    height:0px;
  }
  .table100.c1790{
    min-height:30px;
    border-collapse:separate;
    margin: 0 0 10px 0;
  }
 .gjs-editor-cont .fa {
    font-weight: 400;
}


  .browser-link{
    font-size:12px;
  }
  .top-cell{
    text-align:right;
    color:rgb(152, 156, 165);
  }
  .table100.c1357{
    margin: 0;
    border-collapse:collapse;
  }
  .c1769{
    width:30%;
  }
  .c1776{
    width:70%;
  }
  .c1766{
    margin: 0 auto 10px 0;
    padding: 5px;
    width:100%;
    min-height:30px;
  }
  .cell.c1769{
    width:11%;
  }
  .cell.c1776{
    vertical-align:middle;
  }
  .c1542{
    margin: 0 auto 10px auto;
    padding:5px;
    width:100%;
  }
  .card-footer{
    padding: 20px 0;
    text-align:center;
  }
  .c2280{
    height:150px;
    margin:0 auto 10px auto;
    padding:5px 5px 5px 5px;
    width:100%;
  }
  .c2421{
    padding:10px;
  }
  .c2577{
    padding:10px;
  }
  .footer{
    margin-top: 50px;
    color:rgb(152, 156, 165);
    text-align:center;
    font-size:11px;
    padding: 5px;
  }
  .quote {
    font-style: italic;
  }


  .list-item{
    height:auto;
    width:100%;
    margin: 0 auto 10px auto;
    padding: 5px;
  }
  .list-item-cell{
    background-color:rgb(255, 255, 255);
    border-radius: 3px;
    overflow: hidden;
    padding: 0;
  }
  .list-cell-left{
    width:30%;
    padding: 0;
  }
  .list-cell-right{
    width:70%;
    color:rgb(111, 119, 125);
    font-size:13px;
    line-height:20px;
    padding: 10px 20px 0px 20px;
  }
  .list-item-content{
    border-collapse: collapse;
    margin: 0 auto;
    padding: 5px;
    height:150px;
    width:100%;
  }
  .list-item-image{
    color:rgb(217, 131, 166);
    font-size:45px;
    width: 100%;
  }
  img{
    max-width: 100%;
  }
  @media only screen and (max-width: 640px) {
    body { margin: 0px; width: auto !important; font-family: 'Open Sans', Arial, Sans-serif !important;}
.table-inner { width: 90% !important;  max-width: 90%!important;}
.table-full { width: 100%!important; max-width: 100%!important; text-align: center !important;}
.full-width { width: 100%!important; max-width: 100%!important;  display: block;}
.full-width >.grid-item-image, .list-cell-left > img {
width: 100%;
}
}

@media only screen and (max-width: 479px) {
  body { margin: 0px; width: auto !important; font-family: 'Open Sans', Arial, Sans-serif !important;}
  .table-inner{ width: 90% !important; text-align: center !important;}
.table-full { width: 100%!important; max-width: 100%!important; text-align: center !important;}
.full-width { width: 100%!important; max-width: 100%!important;  display: block;}
.full-width >.grid-item-image, .list-cell-left > img {
width: 100%;
}

}
.gjs-rte-toolbar {
    width: 100% !important;
    left: 0 !important;
}

ul.social-media-list img {
    padding: 5px;
    border-radius: 5px;
    background-color: lightblue;
    width: 36px;
    height: 36px;
}
ul.social-media-list {
    list-style-type: none;
    margin: 0;
    padding: 0;
    font-size: 0px; /* eliminate space between li */
    display: inline-block;
}
  ul.social-media-list li {
    display: inline-block;
}
.social-media-list a {
    display: inline-block;
    padding: 7px 7px;
}
[data-gjs-type="wrapper"] {
    padding-bottom: 35px;
}
                      </style>
                        </div> <!-- /.editor -->
                    </div>
                </div>
            </div>
          </div>  
        </div>
    </div>
      @endif
      @if($dragNDrop && $id_==3)
    <div class="row" id="campaign-builder-panel" style="display: none;" data-name="hcHqjDoo">
        <div class="col-md-12" data-name="XKIWaeXZ">
          

 <!-- Main Sidebar -->
  <div id="email-builder" data-name="piBXPVUa">
   
    <div class="main-container" data-name="nYCcyKUK">
        
        <!-- Holder Container -->
        <div class="holder-container" data-name="slQZiPgA">
            <!-- Top Sidebar -->

            <div class="sidebar-top" style="display:none;" data-name="eNebndhd">
                <span class="item btn btn-success btn-xs" title="{{trans('broadcasts.insert_dynamic_fields')}}" id="varbs">{{trans('broadcasts.dynamic_fields')}}</span>
            </div>

            <input type="text" id="tag_value" value="" style="display: none"/>
            <div id="dyntags" data-name="wUEKUuoa">{{dynamicTags(0, 2, 'content_html',auth()->id())}}</div>
            <!-- Editor Container -->
            <div class="editor-container" data-name="zAuyshYL">
                <!-- Editor Area -->

                <?php 
                $site_url=url('');
                $user_id=auth()->id();
                $role_id=auth()->user()->role_id;
                $cfn=$campaign->template;
                $src= isset($campaign->id) ? "$site_url/Addons/Builder/Editor/design.php?id={$cfn}&type=custom&role_id={$role_id}&site_url={$site_url}&user_id={$user_id}&b_id={$campaign->id}":"$site_url/Addons/Builder/Editor?site_url={$site_url}&user_id={$user_id}&template={$cfn}";
                ?>
                <div class="editor" id='editor' data-name="eZMLSidu">
                    <iframe id="myiframe" width="100%" height="1500px"  src="{{$src}}"></iframe>

                        </div> <!-- /.editor -->
                    </div>
                </div>
            </div>
          </div>  
        </div>
    </div>
      @endif
<div id="content_js" style="display: none" data-name="wIgDseTv"></div>
    <div class="col-md-8 create-form" id="panel-1" data-name="njkbKFxN">
        <!-- BEGIN CAMPAIGN FORM-->
        @if ($page_data['action'] == 'add')
        <form accept-charset="UTF-8" action="{{ route('broadcasts.store') }}" method="POST" id="campaign-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
        <input type="hidden" id="action" value="add">
        @else
        <form accept-charset="UTF-8" action="{{ route('broadcasts.update',  $campaign->id) }}" method="POST" id="campaign-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <input type="hidden" id="action" value="edit">
            <input type="hidden" id="campaign-id" value="{{$campaign->id}}">
            <input type="hidden" name="_method" value="PUT">
            @endif
            <input type="hidden" id="btnAction" name="btnAction" value="0">
            <input id="is_campaign_builder" name="is_campaign_builder" value="{{$id_}}" type="hidden">
            <input id="editorHtml" name="editorHtml" value="{{ isset($campaign->content_html) ? $campaign->content_html : '' }}" type="hidden">
            <input type="hidden"  name="_type" value="{{ $id_ }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="content_url_hide_show" value="{{ isset($campaign->content_url) ? $campaign->content_url : '' }}">
            <div class="row" data-name="WqDakVjW">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="qsEOQVyE">
                    <div class="kt-portlet__head" data-name="CtSWWSNH">
                        <div class="kt-portlet__head-label" data-name="KCZmumUU">
                            <h3 class="kt-portlet__head-title">{{trans('broadcasts.add_new.form.heading')}}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" data-name="vcpKcqZZ">
                        <div class="form-body" data-name="sxqjadQm">
                            <div class="form-group row" data-name="NPyVvZge">
                                <div class="col-md-6" data-name="NODsswti">
                                    <label class="col-form-label">{{trans('broadcasts.add_new.form.broadcast_name')}}
                                        <span class="required"> * </span>
                                         {!! popover( 'broadcasts.add_new.form.broadcast_name_help','common.description' ) !!}
                                    </label>
                                    <div class="input-icon right" data-name="SgRVFezb">
                                        <input type="text" name="name" id="campaign_name" class="form-control" value="{{isset($campaign->name) ? $campaign->name : '' }}" required />
                                    </div>
                                </div>
                                <div class="col-md-6" data-name="fYJZmoSl">
                                    <label class="col-form-label">{{trans('common.label.group')}}
                                        <span class="required"> * </span>
                                        <span   data-toggle="tooltip"  title="{{trans('broadcasts.add_new_group')}}" >
                                            <a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square fa-fw"></i></a>
                                        </span>
                                         {!! popover( 'common.label.group_help','common.description' ) !!}
                                    </label>
                                    <select class="form-control m-select2" name="group_id" id="group-id" data-placeholder="{{trans('broadcasts.choose_group')}}">
                                        <option value="">{{trans('broadcasts.choose_group')}}</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ (isset($campaign->group_id) && $campaign->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12" data-name="npxFaOka">
                                    <label class="col-form-label">{{trans('broadcasts.add_new.form.email_subject')}}
                                        <span class="required"> * </span>
                                         {!! popover( 'broadcasts.add_new.form.email_subject_help','common.description' ) !!}
                                    </label>
                                    <div class="input-icon right d-flex @if(in_array('Emojis', whmcsAddOns())) emoji-block @endif" data-name="JULSCteP">
                                        <!-- data-emoji="true" -->
                                        <input  type="text" name="subject" id="subjectt" class="form-control" value="{{isset($campaign->subject) ? $campaign->subject : '' }}" required />
                                        @if(in_array('Emojis', whmcsAddOns()))
                                        <button id="emoji-button" type="button"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="smile" class="svg-inline--fa fa-smile fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm4 72.6c-20.8 25-51.5 39.4-84 39.4s-63.2-14.3-84-39.4c-8.5-10.2-23.7-11.5-33.8-3.1-10.2 8.5-11.5 23.6-3.1 33.8 30 36 74.1 56.6 120.9 56.6s90.9-20.6 120.9-56.6c8.5-10.2 7.1-25.3-3.1-33.8-10.1-8.4-25.3-7.1-33.8 3.1z"></path></svg></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mh40" data-name="MjXkBXHJ">
                                  <div class="col-md-4" data-name="EyanVFfa">
                                    <label class="col-form-label">
                                      @lang('broadcasts.add_new.form.enable_preheader')
                                        {!! popover( 'broadcasts.add_new.form.enable_preheader_help','common.description' ) !!}
                                    </label>
                                          <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12 mt0">
                                            <label>
                                                <input type="checkbox" id="enable_preheader" name="enable_preheader" @if( isset($campaign->enable_preheader) && $campaign->enable_preheader=="on") checked @endif>
                                                <span></span>
                                            </label>
                                        </span>
                                  </div>
                                <div class="col-md-12" id="email_pre_header_text" data-name="ULmIVUNw" style="display:none;">
                                  <div class="input-icon right d-flex @if(in_array('Emojis', whmcsAddOns())) emoji-block @endif" data-name="JOULSCteP">
                                  <input id="email_pre_header_input" placeholder="@lang('broadcasts.add_new.form.enable_preheader')" class="form-control" type="text"  name="email_pre_header_text" value="{{isset($campaign->email_pre_header_text) ? $campaign->email_pre_header_text : '' }}">
                                  <button id="emoji-button-pre-header" type="button"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="smile" class="svg-inline--fa fa-smile fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm4 72.6c-20.8 25-51.5 39.4-84 39.4s-63.2-14.3-84-39.4c-8.5-10.2-23.7-11.5-33.8-3.1-10.2 8.5-11.5 23.6-3.1 33.8 30 36 74.1 56.6 120.9 56.6s90.9-20.6 120.9-56.6c8.5-10.2 7.1-25.3-3.1-33.8-10.1-8.4-25.3-7.1-33.8 3.1z"></path></svg></button>
                                </div>
                                </div>
                            </div>
                            <div class="form-group row hide" data-name="KYdcMHni">
                                    
                                <div class="col-md-12" data-name="dIRtzwTB">
                                    <label class="col-form-label">
                                        {{trans('broadcasts.add_new.form.campaign_builder')}}
                                    </label>
                                    <div class="input-icon right" data-name="qkorkGOS">
                                        @if($dragNDrop)
                                                @if(isset($campaign) && $campaign->is_campaign_builder!=0 || !isset($campaign))
                                                    <button type="button" class="btn btn-primary btn-xs" onClick="campaignBuilder()">{{trans('broadcasts.add_new.form.campaign_builder')}}
                                                        <i class="fa fa-envelope"></i>
                                                    </button>
                                                @endif
                                        @endif


                                        <a href="#fetch-url" data-toggle="modal">
                                            <button type="button" class="btn btn-primary btn-xs">{{trans('broadcasts.add_new.form.get_content_from_url')}}
                                                <i class="fa fa-exchange"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row" id="fetchURL" data-name="RPMzNMvq">
                                <div class="col-md-12" data-name="ulTmfaYL">
                                    <label class="col-form-label">{{ trans('broadcasts.add_new.form.campaign_url') }} {!! popover( 'broadcasts.add_new.form.fetch_url_help','common.description' ) !!}</label>
                                    <div class="input-group" data-name="aoMNVTmc">
                                        <input type="text" name="complete_url" id="complete_url" class="form-control" placeholder="{{trans('broadcasts.add_new.form.get_content_from_url')}}" value="{{ isset($campaign->url) ? $campaign->url : '' }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success btn-get" type="button" onclick="fetchURLContents()">{{trans('broadcasts.add_new.form.get')}}</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row {{$id_=='1'?'':'hide'}}" id="fetchURLDownload" data-name="pxLnxmMV">
                                <div class="col-md-12" data-name="UoIOyCso">
                                     <div id="switch" data-name="cPSyJrbR">
                                        <label class="col-form-label text-left" for="downloadImage">
                                           {{trans('broadcasts.add_new.form.download_image')}} {!! popover( 'broadcasts.add_new.form.fetch_images_help','common.description' ) !!}
                                        </label>
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                           <label>
                                               <input type="checkbox"  id="downloadImage" name="downloadImage" />
                                               <span></span>
                                           </label>
                                       </span>
                                   </div>
                                </div>
                            </div>
                             @if($dragNDrop)
                                @if(isset($campaign) && $campaign->is_campaign_builder!=0 || !isset($campaign))
                                    <div class="form-group {{ ($id_==2 || $id_==3) || (isset($campaign) && ($campaign->is_campaign_builder == 2 || $campaign->is_campaign_builder == 3)) ?'':'hide'}} row" id="getBuilder" data-name="KligQtVR">
                                        <label class="control-label">{{ trans('broadcasts.add_new.form.campaign_builder') }} </label>
                                        <div class="col-md-12" data-name="mMNtIzNs">
                                            <div class="campBuildBlk" data-name="BWLIiYmE">
                                                <button type="button" onClick="campaignBuilder()" title="{{ trans('broadcasts.add_new.form.load_campaign_builder') }}" class="btn btn-builder btn-default btn-lg">{{ trans('broadcasts.add_new.form.edit_content_area') }}</button>
                                                <a id="pr" href="#preview_html" class="pageview" data-toggle="modal"><i class="la la-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @endif
                            <div class="form-group row d-block {{ ($id_==2 || $id_==3)  || (isset($campaign) && ($campaign->is_campaign_builder == 2 || $campaign->is_campaign_builder == 3)) ?'hide':''}}" data-name="kVJEduPm">
                                <label class="col-form-label pl12">{{trans('broadcasts.add_new.form.html_body')}}
                                    <span class="required"> * </span>
                                    {!! popover( 'broadcasts.add_new.form.html_body_help','common.description' ) !!}
                                </label>
                                <a href="javascript:;" id="get-url" class="text-info pull-right"><i class="fa fa-times"></i><i class="fa fa-link"></i> {{trans('broadcasts.add_new.form.fetch_url')}}</a>
                                <div class="col-md-12" data-name="kwLSbirx">
                                    <div class="input-icon right" id="firsttext" data-name="gcPDvuQu">
                                        @if($page_data['action'] == "add")
                                            <textarea id="content_html" name="content_html" class="content_html_new">
                                            {{ request()->get('content_html')}}
                                            </textarea>
                                        @else
                                            <textarea id="content_html" name="content_html">
                                                {!! $campaign->content_html !!}
                                            </textarea>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>

                            <!-- dynamic tags start -->
                            <div class="" data-name="uJUISPXo">
                                @php
                                    $ckeditor_id = 'content_html';
                                @endphp
                                @if($id_!=2 && $id_!=3)
                                    @if($adminOnClient)
                                        {{ dynamicTags(1, 2, $ckeditor_id,$campaign->user_id) }}
                                        @else
                                        {{ dynamicTags(1, 2, $ckeditor_id) }}
                                    @endif
                                    <!-- dynamic tags end -->

                                <div class="form-group row tools" data-name="mXjEifSy">
                                        
                                    <div class="col-md-12" data-name="OqPeKiLt">
                                        <label class="col-form-label">{{trans('common.form.buttons.tools')}}
                                        </label>
                                        <div class="input-icon right" data-name="MuZYUEDF">
                                            <button class="btn btn-info btn-xs" type="button" id="spam_score_check" onClick="checkSpamScore()">{{trans('broadcasts.add_new.form.check_spam_score')}}
                                                <i class="fa fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <div class="form-group row" data-name="aDsYLzqz"><label class="col-md-3 col-form-label">{{ trans('broadcasts.add_new.form.actions') }} </label>
                                        <div class="col-md-12" data-name="fdzEgstg">

                                            <div class="btn-group dropup" data-name="XRkGjbHs"><a href="javascript:void(0)" data-toggle="dropdown" id="copyAsText" class="btn btn-info  btn-xs dropdown-toggle">{{ trans('broadcasts.copy_as_text') }}</a>
                                                <div id="htmltotext" style="display:none" data-name="LVSqSfXD">

                                                </div>
                                            </div>
                                            <div class="btn-group dropup" data-name="IKMBdPXB">
                                                <button class="btn btn-info btn-xs" type="button" id="spam_score_check" onClick="checkSpamScore()">{{trans('broadcasts.add_new.form.check_spam_score')}}
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>


                            <div class="form-group row" data-name="TjXkBXHJ">
                                    
                                <div class="col-md-12" data-name="DLmIVUNw">
                                    <label class="col-form-label">{{trans('broadcasts.add_new.form.text_body')}}
                                        <span class="required"> * </span>
                                        {!! popover( 'broadcasts.add_new.form.text_body_help','common.description' ) !!}
                                    </label>
                                    <div class="input-icon right" data-name="yPUMlPXB">
                                        <textarea id="content_text" name="content_text" class="form-control" rows="15" required>{{isset($campaign->content_text) ? $campaign->content_text : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="kt_repeater_3" data-name="zIkkXkWD">
                                <div class="form-group row mb0" data-name="ddBCWtfQ">
                                        
                                    <div class="col-md-12"  data-repeater-list="files" data-name="DFLOgdHW">
                                        <label class="col-form-label">{{trans('broadcasts.add_new.form.attach_file')}}
                                           {!! popover( 'broadcasts.add_new.form.attach_file_help','common.description' ) !!}
                                        </label>
                                        <div id="drag-and-drop-zone" class="dm-uploader mt-repeater" data-name="kCIZQUZU">
                                            <div data-repeater-item data-name="QRUCodsP">
                                                <div data-repeater-item="" class="mt-repeater-item" data-name="KgPtMYMa">
                                                    <div class="row mt-repeater-row" data-name="xhoCIHHo">

                                                        <div class="btn btn-block fonttest" data-name="YvaAszjs">
                                                            <i class="la la-cloud-upload" aria-hidden="true"></i>
                                                            {{trans('broadcasts.add_new.form.drop_or_browse_file_here')}}
                                                            <input type="file" title='Click to add Files' />
                                                        </div>
                                                        @if ($page_data['action'] == 'add')
                                                            <ul class="list-unstyled p-2 flex-column col" id="files">
                                                                <li class="text-muted text-center empty">{{trans('common.message.no_files_uploaded')}}</li>
                                                            </ul>
                                                        @else
                                                            <ul class="list-unstyled p-2 flex-column col" id="files">
                                                                @for($i = 0; $i < $files_count; $i++)
                                                                    <li class="media" id='old_attachment_{{ $i }}'>
                                                                        <div class="media-body mb-1" data-name="MSRtwpRx">
                                                                            <p class="mb-2">
                                                                                <strong class="filename">{{ $attached_files[$i]['basename'] }}</strong>
                                                                                <div class="progress progress-striped" data-name="BjZgWPhQ">
                                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" data-name="jnoUSnZH">100%</div>
                                                                                </div>
                                                                            </p>
                                                                            <div class="la la-close font-red pull-right removeFile2" data-name="zpEoPjnv"></div>
                                                                            <hr class="mt-1 mb-1" />
                                                                        </div>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        @endif
                                                        <ul id="imgMsg"></ul>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (!empty($attached_files))
                                {{--<div class="form-group row" data-name="brnmDybm">
                                        
                                    <div class="col-md-12" data-name="GPixaOdA">
                                        <label class="col-form-label">{{trans('broadcasts.add_new.form.previous_attachment')}}</label>
                                        @for($i = 0; $i < $files_count; $i++)
                                        <span id='attachment_{{ $i }}'>
                                            <a href="javascript:;" onclick="window.open('/assets/users/campaigns/{{ Auth::user()->id }}/{{ $campaign->id }}/{{ $attached_files[$i]['basename'] }}')">{{ $attached_files[$i]['basename'] }} </a>
                                            <i class="fa fa-remove remove-attachment" data-id="{{ $i }}"></i>
                                            <input type="hidden" id="old_attachment_name_{{ $i }}" value="{{ $attached_files[$i]['basename'] }}">
                                            <input type="hidden" name="old_attachments[]" id="old_attachment_{{ $i }}" value="">
                                        </span>
                                        @endfor

                                    </div>
                                </div>--}}
                            @endif

                            <div class="form-group row mb0">
                                <div class="col-md-12">
                                    <div class="kt-heading kt-heading--md">
                                        {{ trans('broadcasts.additional_header.heading') }}
                                    </div>
                                    <p>{{ trans('broadcasts.additional_header.description') }}<br>
                                        <small>{{ trans('broadcasts.additional_header.note') }}</small>
                                    </p>
                                </div>
                            </div>

                            <div id="kt_repeater_4" >
                                <div class="form-group row mb0">
                                    <div class="col-md-6  p-0" data-repeater-list="subscriber_filter">
                                        <label class="col-form-label col-md-12 pl12">
                                            {{ trans('broadcasts.additional_header.title') }}
                                            {!! popover('sending_nodes.add_new.form.additional_headers_help','common.description') !!}
                                        </label>
                                        @if(isset($additional_headers) && is_array($additional_headers))
                                            <div class="mt-repeater" >
                                                <div data-repeater-item >
                                                    @foreach($additional_headers as $key => $value)
                                                        <div data-repeater-item class="mt-repeater-item" >
                                                            <div class="row mt-repeater-row">
                                                                <div class="col-md-6">
                                                                    <input type="text" name="header" placeholder="Header" class="form-control" value="{{ isset($value->header) ? $value->header : '' }}">
                                                                    <span class="clnfld">:</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <input type="text" name="header_value" placeholder="Value" class="form-control" value="{{ isset($value->header_value) ? $value->header_value : ''  }}">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm  btn-cancel"><i class="la la-remove"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                        <div class="mt-repeater">
                                            <div data-repeater-item="" class="mt-repeater-item">
                                                <div class="row mt-repeater-row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="header" placeholder="Header" class="form-control" value="">
                                                        <span class="clnfld">:</span>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="header_value" placeholder="Value" class="form-control" value="">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm  btn-cancel"><i class="la la-remove"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" id="btn-new">
                                    <div class="col">
                                        <div data-repeater-create="" class="btn btn btn-info btn-sm">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>{{ trans('broadcasts.additional_header.btn_add') }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot" data-name="KYbzxMxZ">
                        <div class="form-actions" data-name="JITPvObk">
                            <div class="row" data-name="rbrjXTOm">
                                <div class="col-md-12" data-name="obFXgzKx">
                                    {{-- @if ($page_data['action'] == 'add')
                                    <button type="submit" name="save" class="btn btn-success" value="save">{{trans('common.form.buttons.save')}}</button>
                                    <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save_and_keep_editing')}}</button>
                                    <button type="submit" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                                    @else
                                    <button type="submit" name="save" class="btn btn-success" value="save">{{trans('common.form.buttons.save')}}</button>
                                    <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save_and_keep_editing')}}</button>
                                    <button type="submit" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                                    @endif --}}
                                    <button type="submit" name="save" class="btn btn-success" id="DbSave" value="save" onclick="$('#btnAction').val(0)">{{trans('common.form.buttons.save')}}</button>
                                    <button type="submit" name="edit" class="btn btn-success" value="edit" onclick="$('#btnAction').val(1)">{{trans('common.form.buttons.save_and_keep_editing')}}</button>
                                    <button type="submit" name="save_add" class="btn btn-success" value="save_add" onclick="$('#btnAction').val(2)">{{trans('common.form.buttons.save_add')}}</button>
                                    <a href="{{ route('broadcasts.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END CAMPAIGN FORM-->
    </div>
    <div class="col-md-8 create-form" id="panel-2" data-name="ytLOzniE">
        <!-- BEGIN SEND PREVIEW FORM-->
        <form action="" method="POST" id="send_preview_email" class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="campaign-id" name="campaign_id" value="{{ (isset($campaign->id)) ? $campaign->id : ''}}">
            <div class="row" data-name="queeCIUZ">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="jnOuyxTZ">
                    <div class="kt-portlet__head" data-name="wqhZxHbm">
                        <div class="kt-portlet__head-label" data-name="pOgtUflE">
                            <h3 class="kt-portlet__head-title">{{trans('broadcasts.send_preview.form.heading')}}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" data-name="DgdVbEiJ">
                        <div class="form-body" data-name="RlZklpNo">
                        <?php 
                              $broadcast_sender_info = getSetting('broadcast_sender_info');
                              if($broadcast_sender_info != "on") {
                          ?>
                        <div class="form-group row" data-name="hPPpdhUK">
                              <label class="col-form-label pl12 preview-label">
                              {{trans('broadcasts.add_new.form.select_serder_info')}}
                                  {!! popover( 'broadcasts.add_new.form.select_module_desc' ,'common.description' ) !!}
                              </label>
                              <div class="pl12" data-name="rUGcKJXu">
                                <div class="kt-radio-inline" >
                                    <label  class="kt-radio">
                                        <input checked type="radio" name="sending_domain" value="0" id="custom_domain">
                                        {{trans('broadcasts.add_new.form.select_domain')}}
                                        <span></span>
                                      
                                    </label>

                                    <label  class="kt-radio">
                                        <input type="radio" name="sending_domain" value="1" id="sending_node">
                                        {{trans('broadcasts.add_new.form.from_sending_node')}}
                                        <span></span>
                                    </label>
                                  
                                    
                                </div>
                              </div>
                          </div>
                          <?php } ?>
                            <input type="hidden" name="preview_sending_type" id="preview_sending_type" value="1">
                            <div class="form-group row" id="customDomains">
                                <div class="col-md-12">
                                    <label class="col-form-label ">{{trans('broadcasts.send_preview.form.domain_to_use_for_preview')}}
                                        <span class="required"> * </span>
                                        {!! popover( 'broadcasts.send_preview.form.domain_to_use_for_preview_description','common.description' ) !!}
                                    </label>
                                    <select class="form-control m-select2" name="domain" id="domain" required="">
                                       

                                        <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                        @php $disableFlag = 0; @endphp
                                        <optgroup label="{{trans('lists.eligible_domains')}}"> 
                                        @foreach($domain_maskings as $domain)
                                            @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')
                                            <option value="{{ $domain->id }}" >{{ $domain->domain }}  </option>
                                            @else 
                                                @php 
                                                    $disableTxt = "inactive";
                                                    if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                    if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                
                                                @endphp
                                                @php $disableFlag = 1; @endphp
                                            @endif
                                        @endforeach
                                        </optgroup>
                                        @if($disableFlag)
                                        <optgroup label="{{trans('lists.ineligible_domains')}}"> 
                                        @foreach($domain_maskings as $domain)
                                            @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')
                                            
                                            @else 
                                                @php 
                                                    $disableTxt = "inactive";
                                                    if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                    if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                
                                                @endphp
                                                <option disabled value="{{ $domain->id }}" >{{ $domain->domain }}  <small>({{$disableTxt}}) </small></option>
                                            @endif
                                        @endforeach
                                        </optgroup>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" data-name="SNqlksVd">
                                <div class="col-md-12" data-name="qWKSRtpm">
                                    <label class="col-form-label">{{trans('broadcasts.send_preview.form.smtp_to_use_for_preview')}}
                                        <span class="required"> * </span>
                                        {!! popover( 'broadcasts.send_preview.form.smtp_to_use_for_preview_description','common.description' ) !!}
                                    </label>
                                    <select class="form-control m-select2" name="smtp" id="smpt">
                                        @foreach($group_smtps as $key => $group)
                                            <optgroup label="{{$key}}">
                                                @foreach($group as $smtp)
                                                    <option value="{{ $smtp['id'] }}">
                                                        {{ $smtp['name'] }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" data-name="FyGxptXk">
                                    
                                <div class="col-md-12" data-name="akGmLQPC">
                                    <label class="col-form-label">{{trans('broadcasts.send_preview.form.send_preview_to_email')}}
                                        <span class="required"> * </span>
                                        {!! popover( 'broadcasts.send_preview.form.send_preview_to_email_description','common.description' ) !!}
                                    </label>
                                    <div class="input-icon right" data-name="pPVMukFF">
                                        <input type="email" name="preview_email" class="form-control" value="" required>
                                        <small style="padding: 3px"> {{trans('drip_campaigns.add_new.tab3.system_variable')}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" data-name="YKoLqKCB">
                                    
                                <div class="col-md-12" data-name="DFBQthKT">
                                    <label class="col-form-label">{{trans('broadcasts.send_preview.form.custom_variable_contact_email_id')}}
                                      <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('broadcasts.send_preview.form.custom_variable_contact_email_id_Helptext')}}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <div class="input-icon right" data-name="cEkbehzb">
                                        <input type="number" name="custom_variable_email" class="form-control popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="{{trans('Contact ID')}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" data-name="korJWUYQ">
                            <div class="row" data-name="KTDwNVib">
                                <div class="col-md-12" data-name="YgHBybUp">
                                    <button type="submit" id="preview-campaign" class="btn btn-success" {{ $is_new_record ? "disabled" : "" }}>{{trans('broadcasts.send_preview.form.send_preview_button')}}</button>
                                    <br>
                                    @if(isset($campaign))
                                    {!!trans('broadcasts.send_preview.note')!!}
                                    @else
                                    {!!trans('broadcasts.send_preview.new_note')!!}
                                    @endif
                                    <br>
                                    <span id="mail-sent-msg"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END SEND PREVIEW FORM-->
    </div>
    <!-- Add New Group Modal -->
    <div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="AtPKbhHK">
        <div class="modal-dialog" data-name="nVdHcgyj">
            <div class="modal-content" data-name="gnyWoKws">
                <div id="msg-group" class="display-hide" data-name="qdztjdtQ">
                <span id='msg-text-group'><span>
                </div>
                <div class="modal-header" data-name="vezJzYUJ">
                    <h5 class="modal-title">{{trans('broadcasts.add_new_group')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body" data-name="fZEVBOCz">
                    <form action="" id="frm-group" method="post" class="kt-form kt-form--label-right">
                        @for ($i = 1; $i < 2; $i++)
                            <div class="form-group row" data-name="lbubgrin">
                                <label class="col-md-3 col-form-label" >{{trans('broadcasts.group')}} </label>
                                </label>
                                <div class="col-md-8" data-name="LlgGyWSK">
                                    <input type="text" id="group_name"   name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }}>
                                </div>
                            </div>
                        @endfor
                        <div class="form-actions" data-name="CyxxQyDb">
                            <div class="row" data-name="gzYMpces">
                                <div class="offset-md-3 col-md-8" data-name="ttyvhnkS">
                                    <button type="submit" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                                    <button type="reset" class="btn btn-default">{{trans('common.form.buttons.reset')}}</button>
                                    <input type="hidden" value="3" name="section_id">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add New Group Modal -->

    <!-- Campaign Builder Email Preview Modal -->
    <div id="preview_html" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="gjdDLaEE">
        <div class="modal-dialog modal-lg" data-name="OSKEgspQ">
            <div class="modal-content" data-name="MUkFwvoN">
                <div class="modal-header" data-name="vKvPDqGY">
                    <h5 class="modal-title">{{trans('broadcasts.email_preview')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body scroll scroll-700" data-name="vFnUPWoi">
                    <button type="button" id="preview" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div id="content_" data-name="aUVwDAbF"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Campaign Builder Email Preview Modal -->

    <!-- Check Spam Score Modal -->
    <div id="spam-score-modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="CTeUQyhv">
        <div class="modal-dialog modal-lg" data-name="rFAHiHaQ">
            <div class="modal-content" data-name="MmyXqORv">
                <div id="msg-group" class="display-hide" data-name="yGOhCdnj">
                <span id='msg-text-group'><span>
                </div>
                <div class="modal-header" data-name="OTeBqwpO">
                    <h5 class="modal-title">{{trans('broadcasts.check_spam_score_modal.heading')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body" data-name="iNdWpnFH">
                    <div class="alert alert-success" role="alert" data-name="yuJroqvk">
                        <div class="alert-text" data-name="FMvcMLBa">
                            <h4 class="alert-heading">{{ trans('broadcasts.check_spam_score_modal.note') }}:</h4>
                            <p>{{ trans('broadcasts.check_spam_score_modal.note_msg1') }}</p>
                            <p>{{ trans('broadcasts.check_spam_score_modal.note_msg2') }}</p>
                        </div>
                    </div>
                    <table class="table">
                        <tr>
                            <th style="width: 50%; border-top: 0;">{{ trans('broadcasts.check_spam_score_modal.status') }}</th>
                            <td style="width: 50%; border-top: 0;" id="statusss"></td>
                        </tr>
                        <tr>
                            <th>{{ trans('broadcasts.check_spam_score_modal.score') }}</th>
                            <td id="scoreee"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer" data-name="qwnRtGle">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Check Spam Score Modal -->
   
@endsection