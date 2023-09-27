<section class="inner_pages">
     <div class="container">
          <div class="row" style="padding:0px 0px 20px 0px">
               <div class="col-sm-12" style="margin-bottom: 20px;">
                    <div class="contact_box" style="margin-bottom: 0px;">
                         <div class="col-sm-12 padding_0">
                              <div class="form_section" style="padding:0px;">
                                   <img src="images/350.png"/>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-sm-12">
                    <div class="contact_box" style="margin-bottom: 0px;">
                         <div class="col-sm-12 padding_0">
                              <div class="form_section">
                                   <div class="col-sm-12" style="text-align: center;">
                                        <h2>Lucky draw</h2>
                                   </div>
                                   <form id="frmComonKerala" method="post" enctype="multipart/form-data" onsubmit="return checkIfOneContactEntered();">
                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                  <input required name="eeld_name" type="text" class="form-control" placeholder="Your name" autocomplete="off">
                                             </div>
                                             <div class="form-group">
                                                  <input readonly value="91" name="eeld_phone_in_code" class="form-control" 
                                                         style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;"/>
                                                  <div style="width:65%;float: right;margin-bottom: 20px;">
                                                       <input name="eeld_phone_in" type="number" class="txtINDNumber form-control numOnlyWithoutMsg" placeholder="Indian number"
                                                              autocomplete="off" style="border-radius: 0px 50px 50px 0px;">
                                                  </div> 
                                             </div>
                                        </div>
                                        <div class="col-sm-6" style="float: left;">
                                             <div class="form-group">
                                                  <input readonly value="971" name="eeld_phone_nri_code" class="form-control" 
                                                         style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;"/>
                                                  <div style="width:65%;float: right;margin-bottom: 20px;">
                                                       <input required name="eeld_phone_nri" type="number" class="txtNRINumber form-control numOnlyWithoutMsg" 
                                                              autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="NRI number">
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                  <input  autocomplete="off" required autocomplete="off" type="text" name="eeld_location"  class="form-control" placeholder="Your location">
                                             </div>
                                        </div>

                                        <!-- Refer a friend -->
                                        <div class="col-sm-12">
                                             <div class="col-sm-12" style="text-align: center;">
                                                  <h2>Refer a friend 
                                                       <!-- <i style="float:right;cursor: pointer;" class="btnNewReference">+</i> -->
                                                  </h2>
                                             </div>
                                             <div class="col-sm-12">
                                                  <div class="form-group">
                                                       <input required autocomplete="off" autocomplete="off" type="text" name="refer[eve_ref_name][]" class="form-control" placeholder="Friend name">
                                                  </div>
                                             </div>

                                             <div class="col-sm-12" style="float:left;">
                                                  <div class="form-group">
                                                       <input value="971" type="text" readonly name="refer[eve_mobile_ref_non_india_code][]" class="form-control" 
                                                            style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;">
                                                       <div style="width:65%;float: right;margin-bottom: 20px;">
                                                            <input name="refer[eve_mobile_non_india][]" type="text" class="txtNRINumberRef form-control numOnlyWithoutMsg" 
                                                                 autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="NRI Contact number">
                                                       </div>
                                                  </div> 
                                             </div>

                                             <div class="col-sm-12" style="float:left;">
                                                  <div class="form-group">
                                                       <input value="91" type="text" readonly name="refer[eve_mobile_ref_india_code][]" class="form-control" 
                                                            style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;">
                                                       <div style="width:65%;float: right;margin-bottom: 20px;">
                                                            <input name="refer[eve_mobile_india][]" type="text" class="txtINDNumberRef form-control numOnlyWithoutMsg" 
                                                                 autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="Indian Contact number">
                                                       </div>
                                                  </div> 
                                             </div>

                                             <div class="col-sm-12" style="float: left;width: 100%;">
                                                  <div class="form-group">
                                                       <input autocomplete="off" autocomplete="off" type="text" name="refer[eve_ref_location][]"  class="form-control" placeholder="Your location">
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="divRefere"></div>
                                        <!-- -->

                                        <div class="col-sm-12" style="float: left;">     
                                             <div class="form-group" style="text-align: center;">
                                                  <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>      
                                                  <div class="msgContactus"></div>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- -->
     <div class="container">
          <div class="row" style="padding:0px 0px 20px 0px">
               <div class="col-sm-12">
                    <div class="contact_box" style="margin-bottom: 0px;">
                         <div class="col-sm-12 padding_0">
                              <div class="form_section">
                                   <div class="col-sm-12" style="text-align: center;">
                                        <h2>About us</h2>
                                   </div>

                                   <h2 class="h2">റോയൽ ഡ്രൈവ്: ഒരു പ്രവാസി കൂട്ടായ്മയുടെ പരിശ്രമങ്ങൾ ചരിത്രമായി മാറിയ കഥ !! </h2>

                                   <p>ലക്ഷ്വറി സ്വപ്നം കാണാൻ മാത്രം ഉള്ളതാണെന്നും സാധാരണക്കാരന്റെ ബഡ്ജറ്റിൽ അത് അസാധ്യമാണെന്നും വിശ്വസിച്ചിരുന്ന ഒരു വലിയ ജനതയ്ക്ക് സ്വപ്നതുല്യമായ ലക്ഷ്വറി വാഹനങ്ങൾ സുപരിചിതമാക്കിക്കൊണ്ടാണ് റോയൽ ഡ്രൈവ് സൗത്ത് ഇന്ത്യയിൽ തുടക്കം കുറിക്കുന്നത്.
                                        പ്രീ-ഓൺഡ് ലക്ഷ്വറി വാഹനങ്ങളെ വിശ്വസനീയതയോടെ വാങ്ങാനും പരിപൂർണ്ണ സംതൃപ്തിയോടെ ഉപയോഗിക്കാനും പഠിപ്പിച്ച  സൗത്ത് ഇന്ത്യയിലെ ഏറ്റവും വലിയ പ്രീ-ഓൺഡ് ലക്ഷ്വറി വെഹിക്കിൾ ഡീലറാണ് റോയൽ ഡ്രൈവ്. തുടർച്ചയായ പരിശ്രമങ്ങൾ കൊണ്ടും പ്രതിബദ്ധത കൊണ്ടും ജീവിതത്തിലും ബിസിനസിലും വിജയിച്ച മുജീബ് റഹ്മാൻ എന്ന സംരംഭകന്റെ ഏറ്റവും മികച്ച സംരംഭം.!!
                                        2007 ൽ വിദേശത്ത് നിന്നും കേരളത്തിലേക്ക് മടങ്ങുമ്പോൾ അടങ്ങാത്ത വാഹനപ്രേമം മുറുക്കെപിടിച്ച് ഒരുപറ്റം പ്രവാസിസുഹൃത്തുക്കൾക്കൊപ്പം അദ്ദേഹം ആരംഭിച്ച ആ ചെറിയ തുടക്കം ഇന്ന് ലക്ഷ്വറിയുടെ ദൂരങ്ങൾ അതിവേഗം സഞ്ചരിച്ചുകൊണ്ടിരിക്കുന്നു. 

                                        പ്രീ-ഓൺഡ് ലക്ഷ്വറി വാഹനങ്ങൾ വാങ്ങാനും വിൽക്കാനും എക്സ്ചേഞ്ച് ചെയ്യാനും ഉപഭോക്താക്കൾക്കായി സുതാര്യമായ പ്ലാറ്റ്ഫോമാണ് റോയൽ ഡ്രൈവ് ഒരുക്കിയിരിക്കുന്നത്.
                                        പ്രീ-ഓൺഡ് കാറുകൾ വാങ്ങിക്കുമ്പോൾ ഉണ്ടാവാറുള്ള അതിന്റെ ടെക്നിക്കൽ വശങ്ങളെ കുറിച്ചുള്ള ആശങ്ക ഇവിടെ പരിഹരിക്കപ്പെടുന്നു. അനുഭവസ്ഥരായ ടെക്‌നീഷ്യന്മാരാൽ വിദഗ്ധപരിശോധന പൂർത്തിയാക്കിയ ശേഷം മാത്രമേ റോയൽ ഡ്രൈവ് വാഹനങ്ങൾ ഉപഭോക്താക്കളിലേക്ക് എത്തിക്കുന്നുള്ളു. കൂടാതെ വ്യക്തികളിൽ നിന്നും പ്രീ-ഓൺഡ് വാഹനങ്ങൾ വാങ്ങിക്കുമ്പോൾ ഉള്ള പരിമിതികൾ ഷോറൂം പർച്ചേസിൽ പരിഹരിക്കപ്പെടുന്നു. ഒരു പുതിയ വാഹനം വാങ്ങുന്ന പ്രതീതിയിൽ തന്നെ ഷോറൂമിലെത്തി നിങ്ങളുടെ ഇഷ്ട പ്രീ-ഓൺഡ് ലക്ഷ്വറി വാഹനം വാങ്ങാവുന്നതാണ്. 
                                   </p>

                                   <h2 class="h2">റോയൽ ഡ്രൈവ് സ്മാർട്ട്‌ </h2>

                                   <p>പ്രീ-ഓൺഡ് പ്രീമിയം വാഹനങ്ങൾക്ക് മാത്രമായി (5 ലക്ഷം മുതൽ 25 ലക്ഷം ബഡ്ജറ്റിൽ) 'റോയൽ ഡ്രൈവ് സ്മാർട്ട്‌' എന്ന പേരിൽ ഒരു സ്ഥാപനം റോയൽ ഡ്രൈവിന്റെ കീഴിൽ മലപ്പുറത്ത്  പ്രവർത്തിക്കുന്നു. ഈ വർഷം അവസാനത്തോടെ കോഴിക്കോടും കൊച്ചിയിലും ഒപ്പം അടുത്ത വർഷം റോയൽ ഡ്രൈവ് സ്മാർട്ടിന്റെ 25 യൂണിറ്റുകൾ കേരളത്തിലുടനീളം തുടങ്ങാൻ റോയൽ ഡ്രൈവ് പദ്ധതിയിടുന്നുണ്ട്. </p>

                                   <h2 class="h2">റോയൽ ഡ്രൈവ് കെയർ </h2>

                                   <p>വാഹനങ്ങൾക്ക് നല്ല സർവീസ് ഫെസിലിറ്റീസ് ലഭ്യമാക്കുന്നതിനും മാർക്കറ്റിൽ മികച്ച പ്രീമിയം  സർവീസ് സെന്ററുകളുടെ കുറവ് നികത്തുന്നതിനും വേണ്ടി കേരളത്തിൽ ‘റോയൽ ഡ്രൈവ് കെയർ’ എന്ന പേരിൽ  4 മൾട്ടിബ്രാൻഡ് സർവീസ് സെന്ററുകൾ ആരംഭിക്കാനാണ് റോയൽ ഡ്രൈവ് തീരുമാനിച്ചിരിക്കുന്നത്. ആദ്യത്തെ സർവീസ് സെന്റർ കോഴിക്കോട് ജില്ലയിൽ ഈ വർഷം  നവംബറിൽ ആരംഭിക്കുന്നു. 

                                        റോയൽ ഡ്രൈവ് സ്വയം വികസിപ്പിച്ചെടുത്തതും നിലവിൽ ഉപയോഗിച്ച് കൊണ്ടിരിക്കുന്നതുമായ RDMS (ROYAL DRIVE MANAGEMENT SYSTEM) എന്ന അതിനൂതന ഓപ്പറേഷണൽ സോഫ്റ്റ്‌വെയറിന്റെ പിൻബലത്തോടെ ഏതാനും വർഷങ്ങൾക്കകം റോയൽ ഡ്രൈവിന്റെ ശ്യംഖല വ്യാപിപ്പിക്കാനാണ് പദ്ധതി. 

                                        സുതാര്യവും ആത്മാർത്ഥവുമായ ഇടപാടുകളിൽ നിന്നും നേടിയെടുത്ത 90%+ സംതൃപ്തരായ ഉപഭോക്താക്കളാണ് റോയൽ ഡ്രൈവിന്റെ തുടർന്നുള്ള യാത്രകളുടെ കരുത്ത്. 

                                        2014-ന് ശേഷമിറങ്ങിയ മാരുതി മുതൽ  Rolls-Royce വരെയുള്ള ഏതു കാറും റോയൽ ഡ്രൈവിൽ നിങ്ങൾക്ക് പൂർണ്ണ വിശ്വാസ്യതയോടെ വിൽക്കാം. ഇടനിലക്കാരുടെ അനാവശ്യ ഇടപെടലുകളില്ലാതെ, മാർക്കറ്റിലെ മികച്ച വിലയിൽ, സ്പോട്ട് പേയ്മെന്റോട്  നിങ്ങളുടെ കാർ റോയൽ ഡ്രൈവ് വാങ്ങിക്കുന്നു. 

                                        അനുദിനം വളരാൻ അനിവാര്യമായ നിക്ഷേപത്തെ റോയൽ ഡ്രൈവ് എല്ലായിപ്പോളും സ്വാഗതം ചെയ്യുന്നു. അഭ്യുദയാകാംക്ഷികളായ ഒരു കൂട്ടം നിക്ഷേപകരാണ് എല്ലായിപ്പോഴും റോയൽ ഡ്രൈവിന്റെ വിജയത്തിൽ വലിയൊരു പങ്ക് വഹിക്കുന്നത്. ബാങ്ക് ലോണുകളോ മറ്റു ബാധ്യതകളോയില്ലാതെ വിജയകരമായി മുന്നോട്ടുപോകുന്നുവെന്നതാണ് ഈ സ്ഥാപനത്തിന്റെ പ്രൗഢി.
                                        റോയൽ ഡ്രൈവിന്റെ മൾട്ടി ബ്രാന്റഡ് ഷോറൂമിൽ എല്ലാ ലക്ഷ്വറി ബ്രാന്റുകളും വാഹനപ്രേമികൾക്കായി ഒരുക്കിയിട്ടുണ്ട്. നിങ്ങളുടെ ഏറ്റവും പ്രിയപ്പെട്ട ഏതു ലക്ഷ്വറി ബ്രാന്റും റോയൽ ഡ്രൈവ് ഷോറൂമിലെ വിശാലമായ കളക്ഷനിൽ നിന്നും തന്നെ തിരഞ്ഞെടുക്കാവുന്നതാണ്. ഇത് നിങ്ങളുടെ പർച്ചേസിനെ കൂടുതൽ  എളുപ്പമാക്കുകയും സുഗമമാക്കുകയും ചെയ്യുന്നു. ഒരു പുതിയ Mercedes C ക്ലാസ്സ്‌ വാഹനം വാങ്ങാൻ ഉദ്ദേശിക്കുന്ന ഒരു ഉപഭോക്താവിന് അതേ ബഡ്ജറ്റിൽ റോയൽ ഡ്രൈവിൽ നിന്നും ഒരു S ക്ലാസ്സ്‌ റേഞ്ചിലുള്ള പ്രീ-ഓൺഡ് ലക്ഷ്വറി കാർ വാങ്ങാൻ സാധിക്കുന്നതാണ്. ഇതുവഴി ഓരോ ഉപഭോക്താവിന്റെയും ലക്ഷ്വറി സ്വപ്‌നങ്ങൾ സഫലീകരിക്കുകയാണ് റോയൽ ഡ്രൈവ്. 
                                   </p>

                                   <h2 class="h2">റോയൽ ഡ്രൈവ് പ്രീ-ഓൺഡ് ലക്ഷ്വറി ബൈക്കുകൾ </h2>

                                   <p>വിപണിയിലെ ഏറ്റവും ട്രെന്റിയായ പ്രീ-ഓൺഡ് ലക്ഷ്വറി ബൈക്കുകളും റോയൽ ഡ്രൈവിൽ ഉപഭോക്താക്കൾക്കായി ഒരുക്കുന്നു.മികച്ച ഗുണനിലവാരമുള്ള, സ്റ്റൈലിഷായ പ്രീ-ഓൺഡ് ലക്ഷ്വറി ബൈക്കുകൾ പുത്തൻ ബൈക്കുകൾ വാങ്ങുന്ന വിശ്വാസത്തോടെ റോയൽ ഡ്രൈവിൽ നിന്നും വാങ്ങിക്കാം. 

                                        ഉയർന്ന ഗുണനിലവാരം, മാർക്കറ്റിലെ മികച്ച പ്രൈസ് എന്നിവ എക്കാലവും ഉറപ്പുവരുത്തുന്ന റോയൽ ഡ്രൈവിന്റെ യാത്ര മലപ്പുറത്ത് തുടങ്ങി കോഴിക്കോട്, എറണാകുളം എന്നീ ജില്ലകളിലൂടെ സഞ്ചരിച്ച് ഇപ്പോൾ ഇന്ത്യയിലെ മറ്റു സംസ്ഥാനങ്ങളിലേക്കും വിദേശത്തേക്കും വ്യാപിക്കാൻ തയ്യാറെടുത്തിരിക്കുന്നു. വളർച്ചയുടെ ഓരോ ഘട്ടങ്ങളിലും റോയൽ ഡ്രൈവ് കൂടുതൽ മൂല്യങ്ങളെ ചേർത്തുപിടിച്ചുകൊണ്ടും അവയെ ബിസിനസ്സിലുടനീളം പ്രാവർത്തികമാക്കിക്കൊണ്ടും 2031-ഓട് കൂടി 100 മില്യൺ ഡോളർ മൂല്യമുള്ള ഗ്ലോബൽ കമ്പനിയായി വളരുകയെന്നതാണ് റോയൽ ഡ്രൈവ് ലക്ഷ്യമിടുന്നത്. 
                                        ദക്ഷിണേന്ത്യക്കാരുടെ സ്വപ്നങ്ങളിൽ ലക്ഷ്വറി ശീലമാക്കിയ റോയൽ ഡ്രൈവ് കൂടുതൽ കരുത്തോടെ ജൈത്രയാത്ര തുടരുന്നു...!! </p>

                                   <p>വാഹനങ്ങൾ വാങ്ങാനും വിൽക്കാനും എക്സ്ചേഞ്ച് ചെയ്യാനും : <a href="tel:917594849090">+91 75948 49090</a></p>

                                   <p>ഇൻവെസ്റ്റ്മെന്റ് ആവശ്യങ്ങൾക്കായി : <a href="tel:918606803333">+91 86068 03333</a></p>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- <div class="col-sm-4">
                    <div class="contact_box" style="margin:10px 0px 1px 0px;">
                         <div class="col-sm-12 padding_0">
                              <div class="form_section">
                                   <img src="images/lucky-draw.jpeg"/>
                              </div>
                         </div>
                    </div>
               </div> -->
          </div>
     </div>
     <!-- -->
</section>

<!--<a href="tel:917594849090">+91 75948 49090</a>-->
<!--<a href="tel:918606803333">+91 86068 03333</a>-->

<?php if ($success = $this->session->flashdata('app_success')): ?>
     <div id="note"><?php echo $success; ?></div>
<?php endif ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/modernizr.custom.80028.js"></script>

<script>
     /*WhatsApp copy past number*/
     function checkIfOneContactEntered() {
          var txtNRINumber = $('.txtNRINumberRef').val().trim();
          var txtINDNumber = $('.txtINDNumberRef').val().trim();

          if (txtNRINumber == '' && txtINDNumber == '') {
               alert("Please enter at least one phone number");
               if (txtNRINumber == '') {
                    $('.txtNRINumberRef').focus();
               } else {
                    $('.txtNRINumberRef').focus();
               }
               return false;
          } else {
               return true;
          }
     }
     $(document).ready(function () {
          $('.radUseThisAsWhatsApp1').click(function () {
               $('.txtWhatsApp').val($('.txtNRINumber').val());
          });
          $('.radUseThisAsWhatsApp2').click(function () {
               $('.txtWhatsApp').val($('.txtINDNumber').val());
          });
     });
     $(document).on('click', '.btnNewReference', function () {
          $('.divRefere').append($('.divTmpRefer').html());
     });
     $(document).on('click', '.btnRemoveReference', function () {
          $(this).parent('h2').parent('div').parent('div').remove();
     });
</script>
<style>
     input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
     }
     /* Firefox */
     input[type=number] {
          -moz-appearance: textfield;
     }
     .h2 {
          position: relative;
     }
     .h2:after {
          position: absolute;
          content: "";
          background: #ffcb05;
          height: 3px;
          width: 120px;
          left: 0;
          bottom: -10px;
     }
     .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
          background-color:#fff;
     }
     .col-sm-6, col-sm-12 {
          position: inherit !important;
     }
     #note {
          position: absolute;
          z-index: 6001;
          top: 0;
          left: 0;
          right: 0;
          background: #fde073;
          text-align: center;
          line-height: 2.5;
          overflow: hidden; 
          -webkit-box-shadow: 0 0 5px black;
          -moz-box-shadow:    0 0 5px black;
          box-shadow:         0 0 5px black;
     }
     .cssanimations.csstransforms #note {
          -webkit-transform: translateY(-50px);
          -webkit-animation: slideDown 2.5s 1.0s 1 ease forwards;
          -moz-transform:    translateY(-50px);
          -moz-animation:    slideDown 2.5s 1.0s 1 ease forwards;
     }

     #close {
          position: absolute;
          right: 10px;
          top: 9px;
          text-indent: -9999px;
          background: url(images/close.png);
          height: 16px;
          width: 16px;
          cursor: pointer;
     }
     .cssanimations.csstransforms #close {
          display: none;
     }

     @-webkit-keyframes slideDown {
          0%, 100% { -webkit-transform: translateY(-50px); }
          10%, 90% { -webkit-transform: translateY(0px); }
     }
     @-moz-keyframes slideDown {
          0%, 100% { -moz-transform: translateY(-50px); }
          10%, 90% { -moz-transform: translateY(0px); }
     }
     .input-group-text {
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-align: center;
          -ms-flex-align: center;
          align-items: center;
          padding: 0.375rem 0.75rem;
          margin-bottom: 0;
          font-size: 1rem;
          font-weight: 400;
          line-height: 1.5;
          color: #495057;
          text-align: center;
          white-space: nowrap;
          position: absolute;
          border-radius: 0.25rem;
          margin-top: 13px;
     }
     .input-group-append, .input-group-prepend {
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
     }
     .input-group-prepend {
          margin-right: -1px;
     }
     .btn-primary.disabled, .btn-primary.disabled.active, .btn-primary.disabled:active, 
     .btn-primary.disabled:focus, .btn-primary.disabled:hover, .btn-primary[disabled], 
     .btn-primary[disabled].active, .btn-primary[disabled]:active, .btn-primary[disabled]:focus, 
     .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary, fieldset[disabled] 
     .btn-primary.active, fieldset[disabled] .btn-primary:active, fieldset[disabled] 
     .btn-primary:focus, fieldset[disabled] .btn-primary:hover {
          background-color: #b2b5b8;
          border-color: #b2b5b8;
     }
     @media (max-width:390px) {
          .form-control {
               padding: 9px 9px 9px 20px;
          }
          input[type="radio"], input[type="checkbox"] {
               margin: -2px 0 0;
          }
          .form_section {
               padding: -3px 25px 10px 25px !important;
          }
          .padding_0 {
               padding-left: 0px;
               padding-right: 0px;
          }
          .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
               padding-left: 0px;
               padding-right: 0px;
          }
     }
     @media (max-width:767px) { 
          .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{
               padding-left: 0px;
               padding-right: 0px;
          }
     }
</style>

<div class="divTmpRefer" style="display:none;">
     <div class="col-sm-12">
          <div class="col-sm-12">
               <h2>Refer a friend 
                    <i style="float:right;cursor: pointer;" class="btnRemoveReference">-</i>
               </h2>
          </div>
          <div class="col-sm-12">
               <div class="form-group">
                    <input autocomplete="off" autocomplete="off" type="text" name="refer[eve_ref_name][]" class="form-control" placeholder="Friend name">
               </div>
          </div>

          <div class="col-sm-12" style="float:left;">
                                                  <div class="form-group">
                                                       <input value="971" type="text" readonly name="refer[eve_mobile_ref_non_india_code][]" class="form-control" 
                                                            style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;">
                                                       <div style="width:65%;float: right;margin-bottom: 20px;">
                                                            <input name="refer[eve_mobile_non_india][]" type="text" class="txtNRINumber form-control numOnlyWithoutMsg" 
                                                                 autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="NRI Contact number">
                                                       </div>
                                                  </div> 
                                             </div>

                                             <div class="col-sm-12" style="float:left;">
                                                  <div class="form-group">
                                                       <input value="91" type="text" readonly name="refer[eve_mobile_ref_india_code][]" class="form-control" 
                                                            style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;">
                                                       <div style="width:65%;float: right;margin-bottom: 20px;">
                                                            <input name="refer[eve_mobile_india][]" type="text" class="txtINDNumber form-control numOnlyWithoutMsg" 
                                                                 autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="Indian Contact number">
                                                       </div>
                                                  </div> 
                                             </div>

          <div class="col-sm-12">
               <div class="form-group">
                    <input autocomplete="off" autocomplete="off" type="text" name="refer[eve_ref_job][]"  class="form-control" placeholder="Your location">
               </div>
          </div>

          <div class="col-sm-12" style="float: left;">
               <div class="form-group">
                    <input autocomplete="off" autocomplete="off" type="text" name="refer[eve_ref_location][]"  class="form-control" placeholder="Your location">
               </div>
          </div>
     </div>
</div>