/*!
 DMXzone Dropzone
 Version: 1.0.8
 (c) 2020 DMXzone.com
 @build 2020-07-31 17:34:01
 */
dmx.Component("dropzone",{extends:"input",initialData:{file:null,files:[],lastError:""},attributes:{accept:{type:String,default:""},message:{type:String,default:"Drop files here or click to upload."},thumbs:{type:String,default:"true"},"thumb-width":{type:Number,default:100},"thumb-height":{type:Number,default:100}},methods:{remove:function(e){this.remove(e)},reset:function(){this.reset()}},render:function(e){this.form=this.$node.form,this.idx=0,this.form&&this.form.dmxExtraData?(this.message=document.createElement("div"),this.message.className="dmxDropzoneMessage",this.message.innerHTML=this.props.message,this.dropzone=document.createElement("div"),this.dropzone.style.cssText=this.$node.style.cssText,this.dropzone.className=this.$node.className,this.dropzone.classList.add("dmxDropzone"),this.dropzone.appendChild(this.message),this.dropzone.addEventListener("click",this.click.bind(this)),this.dropzone.addEventListener("dragover",this.dragover.bind(this)),this.dropzone.addEventListener("dragenter",this.dragenter.bind(this)),this.dropzone.addEventListener("dragleave",this.dragleave.bind(this)),this.dropzone.addEventListener("drop",this.drop.bind(this)),this.$node.addEventListener("change",this.change.bind(this)),this.form.addEventListener("reset",this.reset.bind(this)),dmx.dom.replace(this.$node,this.dropzone),requestAnimationFrame(this.addSubmitHandler.bind(this))):console.warn("Filedrop can only work on a serverconnect form!")},addSubmitHandler:function(){this.form.dmxComponent.addEventListener("submit",this.submit.bind(this))},update:function(e){var t=this.props.message;this.$node.accept=this.props.accept,this.data.files.length?t+=" ("+this.data.files.length+" files)":this.data.file&&(t+=" ("+this.data.file.name+")"),this.message&&this.message.innerHTML!=t&&(this.message.innerHTML=t)},click:function(e){this.$node.click()},change:function(e){this.addFiles(e.target.files),this.$node.value="",this.$node.type="",this.$node.type="file"},dragover:function(e){var t;e.preventDefault(),e.stopPropagation();try{t=e.dataTransfer.effectAllowed}catch(e){}e.dataTransfer.dropEffect="move"==t||"linkMove"==t?"move":"copy"},dragenter:function(e){e.preventDefault(),e.stopPropagation(),this.dropzone.classList.add("dmxDropzoneHover")},dragleave:function(e){this.dropzone.classList.remove("dmxDropzoneHover")},drop:function(e){if(e.preventDefault(),e.stopPropagation(),this.dropzone.classList.remove("dmxDropzoneHover"),e.dataTransfer){var t=e.dataTransfer.files;if(t.length){var i=e.dataTransfer.items;i&&i.length&&i[0].webkitGetAsEntry?this.addFilesFromItems(i):this.addFiles(t)}}},getValidationRules:function(){for(var e=[],t=0;t<this.$node.attributes.length;t++){var i=this.$node.attributes[t];if(/^data-rule-/.test(i.name)){var s=i.name.substr(10).toLowerCase(),a=this.$node.getAttribute("data-msg-"+s),r=i.value;e.push({rule:s,param:r,message:a})}}return e},validate:function(t){if(this.props.accept&&!this.props.accept.split(/\s*,\s*/g).some(function(e){if("."==e.charAt(0)){if(t.name.match(new RegExp("\\"+e+"$","i")))return!0}else if(/(audio|video|image)\/\*/i.test(e)){if(t.type.match(new RegExp("^"+e.replace(/\*/g,".*")+"$","i")))return!0}else if(t.type.toLowerCase()==e.toLowerCase())return!0;return!1}))return this.$node.getAttribute("data-msg-accept")||"This file type is not allowed for upload.";for(var e=this.getValidationRules(),i=0;i<e.length;i++){var s=e[i].rule,a=e[i].param,r=e[i].message;switch(s){case"minsize":if(t.size<a)return(r||"Please select a file of at least {0} bytes.").replace("{0}",a);break;case"maxsize":if(t.size>a)return(r||"Please select a file of no more than {0} bytes.").replace("{0}",a);break;case"maxtotalsize":for(var n=0,o=0;o<this.data.files.length;o++)n+=this.data.files[o].size;if(n+t.size>a)return(r||"Total size of selected files should be no more than {0} bytes.").replace("{0}",a);break;case"maxfiles":if(this.data.files.length>=a)return(r||"Please select no more than {0} files.").replace("{0}",a)}}return null},setErrorMessage:function(e){var t="dmxValidationError"+this.form.getAttribute("id")+(this.$node.getAttribute("name")||this.$node.getAttribute("id")),i=document.getElementById(t);i||((i=document.createElement(dmx.bootstrap4forms?"div":"span")).id=t,i.className=dmx.bootstrap4forms?"invalid-feedback":dmx.bootstrap3forms?"help-block":"dmxValidator-error",this.dropzone.insertAdjacentElement("afterend",i)),dmx.bootstrap4forms&&(this.dropzone.classList.add("form-control"),e?(this.dropzone.classList.remove("is-valid"),this.dropzone.classList.add("is-invalid")):(this.dropzone.classList.remove("is-invalid"),this.dropzone.classList.add("is-valid"))),i.textContent=e},submit:function(e){if(dmx.rules){this.setErrorMessage("");var t={type:"file",files:this.$node.multiple?this.data.files:this.data.file?[this.data.file]:[]};if(this.$node.hasAttribute("required")&&!t.files.length){var i=this.$node.getAttribute("data-msg-required")||"This field is required.";return this.setErrorMessage(i),e.preventDefault(),!1}for(var s=this.getValidationRules(),a=0;a<s.length;a++){var r=s[a].rule,n=s[a].param;if(dmx.rules[r]&&!dmx.rules[r].validity(t,n)){i=s[a].message||dmx.rules[r].message;return i=Array.isArray(n)?i.replace(/\{(\d)\}/g,function(e,t){return n[t]}):i.replace(/\{0\}/g,n),this.setErrorMessage(i),e.preventDefault(),!1}}}},reset:function(){this.form.dmxExtraData[this.$node.name]&&(Array.isArray(this.form.dmxExtraData[this.$node.name])?this.form.dmxExtraData[this.$node.name].forEach(function(e){e.thumb&&e.thumb.remove()}):this.form.dmxExtraData[this.$node.name].thumb&&this.form.dmxExtraData[this.$node.name].thumb.remove());var e="dmxValidationError"+this.form.getAttribute("id")+(this.$node.getAttribute("name")||this.$node.getAttribute("id")),t=document.getElementById(e);t&&t.parentNode&&t.parentNode.removeChild(t),dmx.bootstrap4forms&&(this.dropzone.classList.remove("is-valid"),this.dropzone.classList.remove("is-invalid")),this.form.dmxExtraData[this.$node.name]=null,this.set("files",[]),this.set("file",null)},remove:function(t,e){if(e&&(e.preventDefault(),e.stopPropagation()),this.$node.multiple){var i=this.data.files.findIndex(function(e){return e.id==t});-1!=i&&(this.data.files.splice(i,1),this.form.dmxExtraData[this.$node.name][i].thumb.remove(),this.form.dmxExtraData[this.$node.name].splice(i,1),dmx.requestUpdate())}else this.data.file&&(this.data.file=null,this.form.dmxExtraData[this.$node.name].thumb.remove(),this.form.dmxExtraData[this.$node.name]=null,dmx.requestUpdate())},createThumb:function(e){var t=document.createElement("div");t.className="dmxDropzoneThumb",t.title=e.name,t.style.setProperty("width",(parseInt(this.props["thumb-width"])||100)+"px"),t.style.setProperty("height",(parseInt(this.props["thumb-height"])||100)+"px"),t.addEventListener("click",this.remove.bind(this,e.id));var i=document.createElement("div");i.className="dmxDropzoneFilename",i.textContent=e.name,t.appendChild(i);var s=document.createElement("div");s.className="dmxDropzoneFilesize",s.textContent=this.formatSize(e.size),t.appendChild(s),e.thumb=t,this.dropzone.appendChild(t)},formatSize:function(e,t,i){if(isNaN(e)||!isFinite(e))return"Invalid Size";t=t||1;for(var s=i?1024:1e3,a=i?["KiB","MiB","GiB","TiB"]:["KB","MB","GB","TB"],r=3;0<=r;r--){var n=Math.pow(s,r+1);if(n<=e){e/=n;var o=Math.pow(10,t);return(e=Math.round(e*o)/o)+a[r]}}return e+"B"},resize:function(e,o){var d=document.createElement("img"),h=parseInt(this.props["thumb-width"])||100,l=parseInt(this.props["thumb-height"])||100;d.onload=function(){var e=document.createElement("canvas"),t=e.getContext("2d"),i=d.width,s=d.height;h=Math.min(h,i),l=Math.min(l,s);var a=h/l;(h<i||l<s)&&(a<i/s?i=s*a:s=i/a),e.width=h,e.height=l;var r=(d.width-i)/2,n=(d.height-s)/2;t.drawImage(d,r,n,i,s,0,0,h,l),o(e.toDataURL())},d.src=e},addFile:function(t){var e=this.validate(t);if(e)this.setErrorMessage(e);else{this.setErrorMessage(""),this.$node.multiple?(this.form.dmxExtraData[this.$node.name]=this.form.dmxExtraData[this.$node.name]||[],this.form.dmxExtraData[this.$node.name].push(t)):(this.remove(),this.form.dmxExtraData[this.$node.name]=t),t.id=++this.idx;var i={id:t.id,date:(t.lastModified?new Date(t.lastModified):t.lastModifiedDate).toISOString(),name:t.name,size:t.size,type:t.type,dataUrl:null};"false"!=this.props.thumbs&&this.createThumb(t),-1===t.type.indexOf("image/")||t.reader||(t.reader=new FileReader,t.reader.onload=function(e){i.dataUrl=e.target.result,t.thumb&&this.resize(i.dataUrl,function(e){t.thumb.style.setProperty("background-image","url("+e+")")}),dmx.requestUpdate()}.bind(this),t.reader.readAsDataURL(t)),this.$node.multiple?this.set("files",this.data.files.concat([i])):this.set("file",i)}},addFiles:function(e){dmx.array(e).forEach(function(e){this.addFile(e)},this)},addFilesFromItems:function(e){dmx.array(e).forEach(function(e){var t;e.webkitGetAsEntry&&(t=e.webkitGetAsEntry())?t.isFile?this.addFile(e.getAsFile()):t.isDirectory&&this.addFilesFromDirectory(t):e.getAsFile&&(e.kind&&"file"!=e.kind||this.addFile(e.getAsFile()))},this)},addFilesFromDirectory:function(e,t){var i=e.createReader(),s=function(){i.readEntries(function(e){e.length&&e.forEach(function(e){e.isFile?e.file(function(e){e.fullPath=t+"/"+e.name,this.addFile(e)}.bind(this)):e.isDirectory&&this.addFilesFromDirectory(e,t+"/"+e.name)},this),s()}.bind(this),function(e){console.warn(e)}.bind(this))}.bind(this);s()}});
//# sourceMappingURL=../maps/dmxDropzone.js.map
