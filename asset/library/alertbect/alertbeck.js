(function(e){e.alertbeck=function(t,n){var r={type:"alert",title:"Alert!",content:"Your alert message",textTrue:"Ok",textFalse:"Cancel"};var t=e.extend(r,t);var i='     <div id="alertbeck_overlay"></div>     <div id="alertbeck_box">       <div class="alertbeck_title">'+t.title+'</div>       <div class="alertbeck_content">'+t.content+'</div>       <div class="alertbeck_footer">         <div class="alertbeck_btngroup">           <a href="javascript:;" id="alertbeck_true" class="true">'+t.textTrue+'</a>           <a href="javascript:;" id="alertbeck_false" class="false">'+t.textFalse+"</a>         </div>       </div>     </div>     ";e("body").append(i);if(t.type=="alert")e("#alertbeck_false").remove();e("#alertbeck_box").fadeIn();e("#alertbeck_true").click(function(){if(t.type=="confirm")n(true);e("#alertbeck_overlay, #alertbeck_box").fadeOut("slow",function(){e(this).remove()})});e("#alertbeck_false").click(function(){if(t.type=="confirm")n(false);e("#alertbeck_overlay, #alertbeck_box").fadeOut("slow",function(){e(this).remove()})})}})(jQuery)