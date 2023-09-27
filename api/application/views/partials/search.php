<div class="handle"></div>
<div id='slider'>
     
     <div id="menu-bar" class="left-shadow-overlay" style="transition: all 300ms ease; top: 0px; right: 0px;">
          
          <div id="refinesearchbg">
               <h1 id="flip">
                    Refine Search
               </h1>
               <div id="panel">
                    <form  class="slidingDiv" id="frmSearch" name="frmSearch" method="post">
                         <input type="hidden" name="" value="<?php echo isset($searchParams['budget']) ? $searchParams['budget'] : ''; ?>" />

                         <div class="field_label">
                              <input name="txtKeyword" id="txtKeyword" type="text" class="refinesearch-input"  placeholder="Keyword" 
                                     value="<?php echo isset($searchParams['keyword']) ? $searchParams['keyword'] : ''; ?>"/>
                         </div>

                         <div class="field_label">
                              Brand
                              <span class="" style="width:101%;">
                                   <?php
                                     $selectedBrands = (isset($searchParams['brand']) && !empty($searchParams['brand'])) ? explode(',', $searchParams['brand']) : array();
                                   ?>
                                   <select id="cmbBrand" name="cmbBrand[]" multiple="multiple" placeholder="Brand" class="SlectBox" style="width: 100%;float: left;">
                                        <?php if (!empty($brands)) { ?>
                                               <?php foreach ($brands as $key => $value) { ?>
                                                    <option value="<?php echo $value['brd_title']; ?>" 
                                                    <?php echo (in_array(strtolower($value['brd_title']), $selectedBrands)) ? "selected='true'" : ''; ?>
                                                            ><?php echo $value['brd_title']; ?></option>
                                                       <?php } ?>
                                                  <?php } ?>
                                   </select>
                              </span>
                         </div>

                         <div class="field_label">
                              Budget
                              <span class="" style="width:100%;">
                                   <?php
                                     $budget = '';
                                     if (isset($searchParams['budget']) && !empty($searchParams['budget'])) {
                                          $budget = abbr_number($searchParams['budget']);
                                     } else if (isset($searchParams['budget-from']) || isset($searchParams['budget-to'])) {
                                          $budgetFrom = isset($searchParams['budget-from']) ? $searchParams['budget-from'] : '';
                                          $budgetTo = isset($searchParams['budget-to']) ? $searchParams['budget-to'] : '';
                                          $budget = $budgetFrom . ' - ' . $budgetTo;
                                     }
                                   ?>
                                   <style>
                                        .bubble {
                                             position: absolute;background-color: #002a80;min-width: 18%;
                                             width: 243px;
                                        }
                                        .bubble::after {
                                             left: 50%;
                                        }
                                        .bubble::before {
                                             left: 50%;
                                        }
                                   </style>

                                   <input autocomplete="off" style="height: 35px;" value="<?php echo $budget; ?>" name="txtBudget" id="txtBudget" type="text" class="inputs-budget budget onlynumber keypressdisabled" 
                                          placeholder="Budget"/>
                                   <div class="bubble">
                                        <div style="background: #F2F2F2;width: 100%;min-height: 57px;">
                                             <input autocomplete="off" value="<?php echo isset($searchParams['budget-from']) ? $searchParams['budget-from'] : ''; ?>" type="text" name="txtBudgetFrom" id="txtBudgetFrom" class="inputs txtCustBudget onlynumber" style="margin: 10px; height: 28px; float: left;width: 38%;" />
                                             <span style="line-height: 50px;font-weight: bold; ">-</span>
                                             <input autocomplete="off" value="<?php echo isset($searchParams['budget-to']) ? $searchParams['budget-to'] : ''; ?>" type="text" name="txtBudgetTo" id="txtBudgetTo" class="inputs txtCustBudget onlynumber" style="margin: 10px; height: 28px; float: right;width: 38%;" />
                                             <ul class="liBudget">
                                                  <li>&#2352; 0</li>
                                                  <li value="25000">&#2352; 25.0 K +</li>
                                                  <li value="100000">&#2352; 1.0 Lacs +</li>
                                                  <li value="500000">&#2352; 5.0 Lacs +</li>
                                                  <li value="1000000">&#2352; 10.0 Lacs +</li>
                                             </ul>
                                        </div>
                                   </div>
                              </span>
                         </div>

                         <div class="field_label">
                              Fuel Type
                              <span class="" style="">
                                   <select id="cmbFualType" name="cmbFualType" placeholder="Brand" class="cmbFualType" style="width: 100%;float: left;">
                                        <option value="0">Select Fuel Type</option>
                                        <option value="diesel" <?php echo (isset($searchParams['fual-type']) && $searchParams['fual-type'] == 'diesel') ? "selected='selected'" : ''; ?>
                                                >Diesel</option>
                                        <option value="petrol" <?php echo (isset($searchParams['fual-type']) && $searchParams['fual-type'] == 'petrol') ? "selected='selected'" : ''; ?>
                                                >Petrol</option>
                                        <option value="gas" <?php echo (isset($searchParams['fual-type']) && $searchParams['fual-type'] == 'gas') ? "selected='selected'" : ''; ?>
                                                >Gas</option>
                                   </select>
                              </span>
                         </div>

                         <div class="field_label">
                              Kms driven 
                              <input value="<?php echo isset($searchParams['km-driven']) ? $searchParams['km-driven'] : ''; ?>" name="txtKmDriven" id="txtKmDriven" type="text" class="refinesearch-input" placeholder="Select kms driven " />
                         </div>
                         <div class="field_label">
                              Color
                              <input value="<?php echo isset($searchParams['color']) ? $searchParams['color'] : ''; ?>" name="txtColor" id="txtColor" type="text" class="refinesearch-input" placeholder="Select color " />
                         </div>

                         <input type="submit" name="send" value="Submit" class="eng-btn" >
                    </form>
               </div>
          </div>
     </div>
</div>