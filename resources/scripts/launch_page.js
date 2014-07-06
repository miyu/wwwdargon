//http://stackoverflow.com/questions/2507030/email-validation-using-jquery
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function returnToForm() {
   $(".submission_response").remove();
   $("#signup_form").show().ScrollTo();
}

$(function() {
   $.QueryString = (function(a) {
      if (a == "") return {};
      var b = {};
      for (var i = 0; i < a.length; ++i)
      {
         var p=a[i].split('=');
         if (p.length != 2) continue;
         b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
      }
      return b;
   })(window.location.search.substr(1).split('&'));
   
   if($.QueryString["nojs"] == "1")
      return;
   
   var statusbar = $("#statusbar");
   var wrapper = $(".body-wrapper");
   var signup = $("#subscribe-view");
   var form = $("#signup_form");
   var submit = $("#signup_form_submit");
   var mask = $("<div></div>").addClass("ajax_mask");
   var submitFailedIndicator = $(".submitfailed");
   var additionalInfo = $("textarea");

   // mozilla hack - placeholders display strangely
   if (navigator.userAgent.match(/mozilla/i)){
      additionalInfo.attr("placeholder", "");
   }
   
   // update statusbar
   var status = $.QueryString["status"];
   if(typeof(status) === "undefined" || status == "0")
   {
      status = "0";
      statusbar.hide();
   }else if(status == "1" || status == "-1") {
      statusbar.show();
      statusbar.find(".text").html(
         status == "1" ? "<span>Your email address has been confirmed!</span> <span>Thank you for your time.</span>"
                       : "<span>Invalid Confirmation Code.</span> <span>Mail ItzWarty@gmail.com for assistance.</span>"
      );
         
      if(status == "1")
         statusbar.attr("data-status", "success");
      else
         statusbar.attr("data-status", "failure");         
   }else {
      statusbar.find(".text").text("Unknown Status " + status);
   }
   
   // left navigation list should be dynamic
   var viewNavList = $(".body-wrapper .info .description");
   var viewNavEntries = viewNavList.find("label");
   var selectedViewEntry = null;
   
   var navigateToView = function(navEntry, dohashupdate) {
      var viewMatch = null;
      var viewName = $(navEntry).find("input").attr("value");
      selectedViewEntry = navEntry;
      
      if(dohashupdate === true)
         window.location.hash = "#" + viewName.substring(0, viewName.length - 5);
      for(var i = 0; i < viewNavEntries.length; i++)  
      {
         var entry = $(viewNavEntries[i]);
         var entryViewName = $(entry.find("input")).attr("value");
         var entryView = $("#" + entryViewName);
         if(entryViewName === viewName)
         {
            entry.attr("class", "checked");
            entryView.css("display", "block");
            viewMatch = entryView;
         }
         else
         {
            entry.attr("class", "unchecked");
            entryView.css("display", "none");
            entryView.appendTo(entryView.parent());
         }
      }
      return viewMatch;
   };
   for(var i = 0; i < viewNavEntries.length; i++)
   {
      (function(){
         var entry = viewNavEntries[i];
         $(entry).click(
            function() {
               var view = navigateToView(entry, true);
               
               // not sure which one to use lol
               $("html").stop(true, true);
               $("body").stop(true, true);
               setTimeout(
                  function() {
                     $(view).ScrollTo();
                  }, 1
               );
            }
         );
      })();
   }
   
   // select default view. use window.location.hash or fallback to first entry
   // when we call updateToResize below, that'll set the selected view.
   selectedViewEntry = viewNavEntries[0];
   if(window.location.hash)
   {
      var desiredViewName = window.location.hash.substring(1) + "-view";
      for(var i = 0; i < viewNavEntries.length; i++)
      {
         var entry = viewNavEntries[i];
         var entryName = $($(entry).find("input")).attr("value")
         if(entryName == desiredViewName)
            selectedViewEntry = entry;
      }
   }
   
   // if the window gets small enough (<850px) show all divs again
   var previousInfoVisible;
   var updateToResize = function() {
      var infoVisible = $(".info").is(":visible");
      if(typeof(previousInfoVisible) === "undefined")
         previousInfoVisible = !infoVisible;
      
      if (!infoVisible && (infoVisible !== previousInfoVisible)) 
      { // navbar is not visible
         var selectedView = null;
         for(var i = 0; i < viewNavEntries.length; i++)
         {
            var entry = $(viewNavEntries[i]);
            var entryViewName = $(entry.find("input")).attr("value");
            var entryView = $("#" + entryViewName);
            entryView.css("display", "block");
            entryView.appendTo(entryView.parent());
            
            if(($(selectedViewEntry).find("input")).attr("value") === 
               ($(viewNavEntries[i]).find("input")).attr("value"))
               selectedView = entryView;
         }
         
         // not sure which one to use lol
         $("html").stop(true, true);
         $("body").stop(true, true);
         
         console.log(selectedViewEntry + " " + viewNavEntries[0]);
         console.log($(window).scrollTop() + " " + $(selectedView).offset().top);
         var viewBelowViewportTop = $(window).scrollTop() < $(selectedView).offset().top;
         var selectedViewIsFirst = ($(selectedViewEntry).is($(viewNavEntries[0])));
         var pageLoadScrollToHashtag = ($(window).scrollTop() == 0) && window.location.hash != "";
         console.log(viewBelowViewportTop + " " + selectedViewIsFirst + " " + pageLoadScrollToHashtag);
         
         if((selectedViewIsFirst && ($(window).scrollTop() != 0)) || 
            !selectedViewIsFirst ||
            pageLoadScrollToHashtag)
         {
            selectedView.ScrollTo();
         }
      }
      else if(infoVisible !== previousInfoVisible)
      { // navbar is visible
         var view = navigateToView(selectedViewEntry, false);

         var viewBelowViewportTop = $(window).scrollTop() < $(view).offset().top;
         var selectedViewIsFirst = ($(selectedViewEntry).is($(viewNavEntries[0])));
         
         if($(window).scrollTop() > $(view).offset().top)
            view.ScrollTo();
      }
      previousInfoVisible = infoVisible;
   };
   $(window).resize(updateToResize);
   updateToResize();
   
   // enable form autosave
   form.sayt({'autosave': true, 'autorecover': true, 'days': 7});
   
   // swap form submit button with ajax submitter
   submit.attr("type", "button");
   submit.click(function(){
      var email = $(form).find("[name=email]");
      var emailBad = email.parent("td").find(".badinput");
      var emailBadStart = email.parent("td").parent("tr").find(".required_input");
      if(!isEmail(email.val()))
      {
         emailBad.show();
         emailBadStart.show();
         $(form).ScrollTo();
      }
      else
      {
         emailBad.hide();
         emailBadStart.hide();
         
         form.append(mask);
         form.css({"height": "300px", "overflow": "hidden"})
         
         var xhr = $.post(
            "/do_subscribe.php",
            form.serialize() + "&nocache=" + new Date().getTime()
         ).done(function() {
            mask.remove();
            form.removeAttr('style'); 
            submitFailedIndicator.hide();
            
            $finished = $("<div class='submission_response'>" + xhr.responseText + "</div>");
            form.hide();
            signup.append($finished);
            
         }).fail(function() {
            mask.remove();
            form.removeAttr('style'); 
            submitFailedIndicator.show();
         });
      }
   });
});