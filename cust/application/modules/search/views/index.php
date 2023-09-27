<section class="inner_pages">
     <div class="container">
          <div class="row">  
               <form class="filter-search slidingDiv" id="frmSearch" name="frmSearch">  
                    <input type="hidden" name="" value="<?php echo isset($searchParams['budget']) ? $searchParams['budget'] : '';?>" />
                    <div class="col-sm-4">
                         <div class="filter_box">
                              <h2>Filter Results</h2>           
                              <div class="form-group">
                                   <input type="text" class="form-control txtKeyword" placeholder="keyword" name="txtKeyword" 
                                          value="<?php echo isset($searchParams['keyword']) ? $searchParams['keyword'] : '';?>"/>
                              </div>
                              <div class="form-group">
                                   <?php
                                     $selectedBrands = (isset($searchParams['brand']) && !empty($searchParams['brand'])) ? explode(',', $searchParams['brand']) : array();
                                   ?>
                                   <label class="control-label" for="inputDefault">Brand</label>
                                   <select class="form-control SlectBox inputs cmbBrand" multiple="multiple" name="cmbBrand[]">
                                        <?php foreach ((array) $brands as $key => $value) {?>
                                               <option value="<?php echo $value['brd_title'];?>" 
                                                       <?php echo (in_array(strtolower($value['brd_title']), $selectedBrands)) ? "selected='true'" : '';?>>
                                                            <?php echo $value['brd_title'];?>
                                               </option>
                                               <?php
                                          }
                                        ?>
                                   </select>
                              </div>           
                              <div class="form-group">

                                   <label class="control-label col-sm-12 padding_0" for="inputDefault">Budget</label>
                                   <?php
                                     $budget = '';
                                     $budgetFrom = '';
                                     $budgetTo = '';
                                     if (isset($searchParams['budget']) && !empty($searchParams['budget'])) {
                                          $budget = abbr_number($searchParams['budget']);
                                     } else if (isset($searchParams['budget-from']) || isset($searchParams['budget-to'])) {
                                          $budgetFrom = isset($searchParams['budget-from']) ? $searchParams['budget-from'] : '';
                                          $budgetTo = isset($searchParams['budget-to']) ? $searchParams['budget-to'] : '';
                                          $budget = $budgetFrom . ' - ' . $budgetTo;
                                     }
                                   ?>
                                   <div class="col-xs-6 padding_left0">
                                        <input type="text" class="txtBudgetFrom form-control txtCustBudget onlynumber" placeholder="From" 
                                               name="txtBudgetFrom" value="<?php echo $budgetTo;?>" autocomplete="off"/>
                                   </div>
                                   <div class="col-xs-6 padding_right0">
                                        <input autocomplete="off" value="<?php echo $budgetTo;?>" type="text" name="txtBudgetTo" 
                                               class="form-control txtCustBudget onlynumber txtBudgetTo" placeholder="To"/>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <label class="control-label" for="inputDefault">Fuel type</label>
                                   <select name="cmbFualType" placeholder="Brand" class="cmbFualType form-control cmbFualType">
                                        <option value="0">Select Fuel Type</option>
                                        <option value="diesel" <?php echo (isset($searchParams['fual-type']) && $searchParams['fual-type'] == 'diesel') ? "selected='selected'" : '';?>
                                                >Diesel</option>
                                        <option value="petrol" <?php echo (isset($searchParams['fual-type']) && $searchParams['fual-type'] == 'petrol') ? "selected='selected'" : '';?>
                                                >Petrol</option>
                                        <option value="gas" <?php echo (isset($searchParams['fual-type']) && $searchParams['fual-type'] == 'gas') ? "selected='selected'" : '';?>
                                                >Gas</option>
                                   </select>
                              </div>
                              <div class="form-group">
                                   <label class="control-label" for="inputDefault">Kms driven</label>
                                   <input value="<?php echo isset($searchParams['km-driven']) ? $searchParams['km-driven'] : '';?>" name="txtKmDriven" type="text" 
                                          class="form-control txtKmDriven onlynumber" placeholder="Enter kms driven" />

                              </div> 
                              <div class="form-group">
                                   <label class="control-label" for="inputDefault">Color</label>
                                   <input value="<?php echo isset($searchParams['color']) ? $searchParams['color'] : '';?>" name="txtColor" type="text" 
                                          class="form-control txtColor" placeholder="Select color"/>

                              </div>        
                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                   <a href="" class="clear"> Clear</a>            
                              </div>
                         </div>
                    </div>
               </form>

               <div class="col-sm-8 padding_0">
                    <div class="col-sm-12 result_sec">
                         <h2><span><?php echo isset($searchResult['product_details']) ? count($searchResult['product_details']) : 0; ?> vehicles found</span></h2>
                    </div>
                    <div class="bs-example search_results">
                         <div class="col-sm-12">
                              <ul class="nav-tabs pull-right">
                                   <li>Sortby : </li>
                                   <li class="searchSort <?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'popular') ? 'active' : ''?>" sort-key="popular"><a href="#popular" data-toggle="tab">Popular</a></li>
                                   <li class="searchSort <?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'new') ? 'active' : ''?>" sort-key="new"><a href="#latest" data-toggle="tab">New</a></li>                
                                   <li class="searchSort <?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'high-price') ? 'active' : ''?>" sort-key="high-price"><a href="#H_price" data-toggle="tab">High Price </a></li>
                                   <li class="searchSort <?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'low-price') ? 'active' : ''?>" sort-key="low-price"><a href="#L_price" data-toggle="tab">Low Price </a></li>
                              </ul>
                         </div>
                         <div class="tab-content">
                              <div id="popular">
                                   <div id="Latest_tab" >
                                        <?php
                                          if (!empty($searchResult['product_details'])) {
                                               foreach ($searchResult['product_details'] as $key => $value) {
                                                    $name = $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name'];
                                                    echo ($key != 0 && $key % 6 == 0) ? '</div>' : '';
                                                    echo ($key == 0 || $key % 6 == 0) ? '<div class="item">' : '';
                                                    $link = '';
                                                    if($value['prd_rd_mini'] == 1) {
                                                        $link =  'https://rdsmart.in/vehicle/' . $value['prd_id'] . '-' . get_url_string($value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name']);    
                                                    } else {
                                                        $link = site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']);
                                                    }
                                                    ?>

                                                    <a title="<?php echo $name;?>" href="<?php echo $link; ?>" class="hproduct-bg">
                                                         <?php
                                                         $img = '';
                                                         if (isset($value['default_image']) && !empty($value['default_image'])) {
                                                              $img = $value['default_image']['pdi_image'];
                                                         } else {
                                                              $img = isset($value['product_images'][0]['pdi_image']) ? $value['product_images'][0]['pdi_image'] : '';
                                                         }
                                                         ?>
                                                         <div class="col-sm-4 wow fadeInUp" data-wow-offset="10" <?php echo $key > 0 ? ' data-wow-delay="0.2s"' : '';?>>
                                                              <div class="product_box">
                                                                   <div class="image_box">
                                                                        <?php echo img(array('src' => PRODUCT_BASE_URL . $img, 'alt' => $value['prd_name']));?>
                                                                        <?php echo ($value['prd_booked'] == 1 && $value['prd_soled'] != 1) ? '<div class="booked">Reserved</div>' : '';?>
                                                                        <?php echo ($value['prd_soled'] == 1) ? '<div class="sold booked">Sold Out</div>' : '';?>
                                                                        <?php if ($value['prd_booked'] != 1 && $value['prd_soled'] != 1) {?>
                                                                        <p class="price"> <?php echo ($value['prd_price'] > 0) ? '₹ ' . get_in_currency_format($value['prd_price']) : '';?></p>
                                                                        <?php } ?>
                                                                   </div>
                                                                   <div class="info_box">
                                                                        <h3 style="font-size: 16px;"><?php echo get_snippet($name, 2);?></h3> 
                                                                        <p class=""><?php echo $value['prd_year'];?>  |  <?php echo number_format($value['prd_km_run']);?>kms</p>
                                                                   </div>
                                                              </div>
                                                         </div>
                                                    </a>
                                                    <?php
                                                    echo ($key == (count($searchResult['product_details']) - 1)) ? '</div>' : '';
                                               }
                                          }
                                        ?>                 
                                   </div>                   
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>