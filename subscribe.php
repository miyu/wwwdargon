<?php
require_once(__DIR__. "/include/wyvern_jr.php");
$wyvern = new WyvernJr(true);
$wyvern->increment_hits("p_subscribe", true);
?>
<!DOCTYPE>
<html>
   <head>
      <meta name="viewport" content="width=device-width, minimum-scale=0.5, maximum-scale=2.0" />
      <meta name="description" content="The Dargon Project's goal is to facilitate the creation, distribution, and installation of League of Legends modifications. Over time, Dargon has become more than just that, though you'll have to wait until the end of the year for more information.">
      <meta name="keywords" content="League,of,Legends,addon,game,modifications,dargon,raf,manager,skin,installer,ultimate,v3,custom,skin,map,sound,user,interface,beta,alpha">
      <meta name="author" content="Warty">

      <link href="/resources/styles/launch_page.css" rel="stylesheet" type="text/css"/>
      <title>Coming Soon - The Dargon Project</title>
      <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
      <script src="/resources/scripts/jquery.cookie.min.js" type="text/javascript"></script>
      <script src="/resources/scripts/sayt.min.jquery.js" type="text/javascript"></script>
      <script src="/resources/scripts/jquery.scrollto.min.js" type="text/javascript"></script>
      <script src="/resources/scripts/jquery.form.min.js" type="text/javascript"></script>
      <script src="/resources/scripts/launch_page.js" type="text/javascript"></script>
      <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-45587145-3']);
        _gaq.push(['_trackPageview']);

        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

      </script>
   </head>
   <body>
      <header>
         <h1>The Dargon Project</h1>
         
         <ul>
            <li>Home</li>
         </ul>
      </header>
      <div id="statusbar" data-status="caution">
         <span class="text">JavaScript is required for this site to be fully functional.</span>
      </div>
      <div class="hero">
         <div class="logo-container-host">
            <div class="logo-container"></div>
         </div>
      </div>
      <nav class="prebody">
         <div class="update">What is Dargon?</div>
      </nav>
      <div class="body-wrapper-container">
         <div class="body-wrapper">
            <div class="info">
               <div class="description">
                  <h2>Navigation</h2>
                  <label><input type="radio" name="selected-view" value="description-view" checked="checked">An Introduction to Dargon</label> 
                  <label><input type="radio" name="selected-view" value="subscribe-view">Get Updated + Testing Signups</label>
                 
                  <!--
                  <h2>Dargon</h2>
                  <h3>Coming Soon&trade;</h3>
<div class="addthis_toolbox addthis_default_style addthis_32x32_style" style="position: inherit; display: inline-block; white-space: nowrap; margin-top: 0.2em; padding-right:0; width:112px;">
<a class="addthis_button_compact"></a>
<a class="addthis_button_twitter at300b"></a>
<a class="addthis_button_facebook at300b"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52887af9291a17d9"></script>
                  -->
               </div>
            </div>
            <div class="view-container">
               <section class="view-content" id="description-view">
                  <h2>An Introduction to Dargon</h2>
                  <h3>: : What is The Dargon Project? : :</h3>
                  <p>
                     In a nutshell, we began developing Dargon in 2011 with the goal of facilitating the creation, distribution, and installation of League of Legends modifications.
                  </p>
                  <h3>: : Who is in The Dargon Development Team? : :</h3>
                  <p>
                     The Dargon Development Team consists of a tiny group of software developers and one graphics designer. Our members include the creator of RAF Manager and a major contributor to Skin Installer Ultimate. 
                  </p>
                  <h3>: : When are you launching your client? : :</h3>
                  <p>
                     We'll be publicly releasing our client before the end of the calendar year. In the meantime, we'll be running various closed tests to ensure that our software runs properly in a variety of software and hardware environments.
                  </p>
                  <h3>: : How is Dargon different from its alternatives? : :</h3>
                  <p>
                     We believe our alternatives approach applying modifications in a fundamentally incorrect and unsafe way because they are built upon an outdated abstraction of the way League of Legends handles resources.
                  </p>
                  <p>
                     We are making a better, safer implementation.
                  </p>
                  <h3>: : How can I get involved? : :</h3>
                  <p>
                     Getting involved is simple and your involvement is up to you. You can assist us in many ways, from contributing code to simply testing our application.
                  </p>
                  <p>
                     Fill out <a onclick="$('input[value=\'subscribe-view\']').click()">this form</a> to subscribe for updates from our team.
                  </p>
               </section>
               <section class="view-content" id="subscribe-view">
                  <section>
                     <h2>Subscribe for Updates</h2>
                     <p>
                        You've been asking for a new build of Dargon since 2011 and the wait is almost over. In the coming weeks we'll be launching something exciting and we want you to be a part of that.
                     </p>
                     <p>
                        2014 will be awesome. Don't believe us? You'll see.
                     </p>
                  </section>
                  <form id="signup_form" action="/do_subscribe" method="post">
                     <table cellspacing="0">
                        <tr class="submitfailed" style="display:none;">
                           <td colspan="2">
                              <p style="text-align:center; color:#D91111;">
                                 The form failed to submit (errno <span>#</span>).
                              </p>
                           </td>
                        </tr>
                        <tr class="email-row">
                           <td>Email<sup class="required_input" style="color: red; display:none;">*</sup>:</td>
                           <td>
                              <input name="email" type="text" placeholder="username@example.com">
                              <span class="badinput">A valid email address is required.</span>
                           </td>
                        </tr>
                        <tr class="iama-row"
                            onselectstart='return false;' 
                            onmousedown='return false;'>
                           <td>Interests:<br/>
                              <span style="color: #7F7F7F; font-size: 0.6em;">(Optional)</span><span style="visibility:hidden; line-height: 1px;">:</span>
                           </td>
                           <td class="data-array">
                              <span>- General -</span>
                              <div><label><input name="i_alpha"      type="checkbox">Alpha Testing</label></div>
                              <div><label><input name="i_addon"      type="checkbox">Modification Installation</label></input></div>
                              <div><label><input name="i_beta"       type="checkbox">Beta Testing</label></div>
                              <div><label><input name="i_charity"    type="checkbox">Dargon for Charity</label></div>
                              <div><label><input name="i_feedback"   type="checkbox">Providing Feedback</label></div>

                              <span>- Contributing to The Dargon Project -</span>
                              <div><label><input name="c_sw"         type="checkbox">Software Engineering</label></div>
                              <div><label><input name="c_webdesign"  type="checkbox">Web Design</label></div>
                              <div><label><input name="c_re"         type="checkbox">Reverse Engineering</label></div>
                              <div><label><input name="c_webdev"     type="checkbox">Web Development</label></div>
                              <div><label><input name="c_macos"      type="checkbox">MacOS Development</label></div>
                              <div><label><input name="c_mobile"     type="checkbox">Mobile Development</label></div>
                              <div><label><input name="c_linux"      type="checkbox">Linux Development</label></div>

                              <span></span>

                              <div><label><input name="c_uxweb"      type="checkbox">UX Design (Web)</label></div>
                              <div><label><input name="c_gdesign"    type="checkbox">Graphics Design</label></div>
                              <div><label><input name="c_uxdesktop"  type="checkbox">UX Design (Desktop)</label></div>
                              <div><label><input name="c_gillust"    type="checkbox">Graphics Illustration</label></div>

                              <div><label><input name="c_community"  type="checkbox">Community</label></div>
                              <div><label><input name="c_audio"      type="checkbox">Audio Production</label></div>
                              <div><label><input name="c_outreach"   type="checkbox">Outreach</label></div>
                              <div><label><input name="c_video"      type="checkbox">Video Production</label></div>

                              <div><label><input name="c_qa"         type="checkbox">Quality Assurance</label></div>
                              <div><label><input name="c_local"      type="checkbox">Localization</label></div>
                              <div><label><input name="c_support"    type="checkbox">End-User Support</label></div>
                              <div><label><input name="c_textcomp"   type="checkbox">Text Composition</label></div>
                           </td>
                        </tr>
                        <tr class="iama-row">
                           <td>Experience:<br/>
                              <span style="color: #7F7F7F; font-size: 0.6em;">(Optional)</span><span style="visibility:hidden; line-height: 1px;">:</span>
                           </td>
                           <td class="data-array">
                              <span>- Skin Installers -</span>
                              <div><label><input name="e_rdp"        type="checkbox">RAF Dump/Pack</label></div>
                              <div><label><input name="e_siu"        type="checkbox">Skin Installer Ultimate</label></div>
                              <div><label><input name="e_rm"         type="checkbox">RAF Manager</label></div>

                              <span>- Content Creation -</span>
                              <div><label><input name="e_cs_simple"  type="checkbox">Custom Skin (simple)</label></div>
                              <div><label><input name="e_map_text"   type="checkbox">Map Retexturing</label></div>
                              <div><label><input name="e_cs_adv"     type="checkbox">Custom Skin (adv)</label></div>
                              <div><label><input name="e_map_model"  type="checkbox">Map Remodelling</label></div>

                              <span>- Additional Information -</span>
                              <div class="text">
                                 <textarea name="add_info" rows="7"
                                           placeholder="Is there anything extra that you want to tell us?
                                                        &nbsp;
                                                        Contributors: Resume links accepted, not required.
                                                        Localization: spoken languages & experience
                                                        &nbsp;Programmers: experience & languages
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Artists: portfolios"></textarea>
                              </div>                           
                           </td>
                        </tr>
                        <tr>
                           <td></td>
                           <td class="submit-host">
                              <input type="reset" value="Reset Form"/>
                              <input id="signup_form_submit" type="submit" class="submit" value="Submit Form"/>
                           </td>
                        </tr>
                     </table>
                  </form>
               </section>
            </div>
         </div>
      </div>
      <footer>
         <div class="farewell">
            <span><a href="mailto:ItzWarty@gmail.com">Email</a> : : <a href="http://www.twitter.com/ItzWarty/">Twitter</a></span>
         </div>
         <div class="legal">
            <span>The Dargon Project &copy; 2011-2013 ItzWarty All Rights Reserved</span>
         </div>
      </footer>
   </body>
</html>