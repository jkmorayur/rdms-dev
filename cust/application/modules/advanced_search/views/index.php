<link rel="stylesheet" type="text/css" href="styles/style.css"/>
<link rel="stylesheet" type="text/css" href="styles/metro2.css"/>
<style type="text/css">
    .header-support{color:#039de2;}
    #refinesearchbg{width:100%;}
</style>

<script src="scripts/jquery.sumoselect.js"></script>
<link href="styles/sumoselect.min.css" rel="stylesheet" />

<script type="text/javascript">
    $(document).ready(function() {
        $('.SlectBox').SumoSelect({
            csvDispCount: 3
        });
    });

</script>
<div id="inner-wrapper">
    <div id="inner-inner">
        <div class="matterbg">
            <div id="refinesearchbg">
                <h1>Advanced Search</h1>
                <form method="post" class="frmAdvSearch">
                    <div class="field_new">
                        Keyword
                        <span class="field_label" style="width:101%;">
                            <input type="text" name="txtKeyword" id="txtKeyword" class="refinesearch-input" placeholder="Keyword"/>
                        </span>
                    </div>

                    <div class="field_new field_new-margin">
                        Brand
                        <span class="" style="width:101%;">
                            <?php
                            $selectedBrands = (isset($searchParams['brand']) && !empty($searchParams['brand'])) ? explode(',', $searchParams['brand']) : array();
                            ?>
                            <select id="cmbBrand" name="cmbBrand[]" multiple="multiple" placeholder="Brand" class="SlectBox" style="width: 100%;float: left;">
                                <?php if (!empty($brands)) { ?>
                                    <?php foreach ($brands as $key => $value) { ?>
                                        <option value="<?php echo $value['brd_title']; ?>"><?php echo $value['brd_title']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </span>
                    </div>

                    <div class="field_new">
                        Color
                        <span class="field_label" style="width:101%;">
                            <input type="text" name="txtColor" id="txtColor" class="refinesearch-input" placeholder="Color" />
                        </span>
                    </div>

                    <div class="field-inner" style="border: none;">
                        <div class="field_new">
                            <span style="float: left;width: 100%;">Price Range</span>
                            <div style="width: 45%;float: left;">
                                <span class="css4-metro-dropdown" style="width:101%;">
                                    <select name="txtBudgetFrom" id="txtBudgetFrom">
                                        <option value="">From</option>
                                        <option value="0">&#2352; 0</option>
                                        <option value="25000">&#2352; 25.0 K +</option>
                                        <option value="100000">&#2352; 1.0 Lacs +</option>
                                        <option value="500000">&#2352; 5.0 Lacs +</option>
                                        <option value="1000000">&#2352; 10.0 Lacs +</option>
                                    </select>
                                </span>
                            </div>
                            <div style="width: 45%;float: right;">
                                <span class="css4-metro-dropdown" style="width:101%;">
                                    <select name="txtBudgetTo" id="txtBudgetTo">
                                        <option value="">To</option>
                                        <option value="0">&#2352; 0</option>
                                        <option value="25000">&#2352; 25.0 K +</option>
                                        <option value="100000">&#2352; 1.0 Lacs +</option>
                                        <option value="500000">&#2352; 5.0 Lacs +</option>
                                        <option value="1000000">&#2352; 10.0 Lacs +</option>
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="field_new field_new-margin">
                            <span style="float: left;width: 100%;">Year</span>
                            <div style="width: 45%;float: left;">
                                <span class="field_label" style="width:101%;">
                                    <input type="text" name="txtModelFrom" id="txtModelFrom" class="refinesearch-input" placeholder="From" />
                                </span>
                            </div>
                            <div style="width: 45%;float: right;">
                                <span class="field_label" style="width:101%;">
                                    <input type="text" name="txtModelTo" id="txtModelTo" class="refinesearch-input" placeholder="To"/>
                                </span>
                            </div>
                        </div>
                        <div class="field_new">
                            Kms driven
                            <span class="field_label" style="width:101%;">
                                <input type="text" name="txtKmDriven" id="txtKmDriven" class="refinesearch-input" placeholder="Kms driven" />
                            </span>
                        </div>
                        <div class="field_new">
                            Fuel Type
                            <span class="css4-metro-dropdown" style="width:101%;">
                                <select name="cmbFualType" id="cmbFualType">
                                    <option value="0">Select Fuel Type</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="gas">Gas</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <input type="submit" name="send" value="Submit" class="eng-btn">
                </form>
            </div> <!--refinesearchbg-->
        </div><!--matterbg-->
        <div style="clear:both"></div>
    </div><!--inner-inner-->
</div><!--inner-wrapper-->