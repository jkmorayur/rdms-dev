<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');
  /*
    | -------------------------------------------------------------------------
    | URI ROUTING
    | -------------------------------------------------------------------------
    | This file lets you re-map URI requests to specific controller functions.
    |
    | Typically there is a one-to-one relationship between a URL string
    | and its corresponding controller class/method. The segments in a
    | URL normally follow this pattern:
    |
    |	example.com/class/method/id/
    |
    | In some instances, however, you may want to remap this relationship
    | so that a different class/function is called than the one
    | corresponding to the URL.
    |
    | Please see the user guide for complete details:
    |
    |	http://codeigniter.com/user_guide/general/routing.html
    |
    | -------------------------------------------------------------------------
    | RESERVED ROUTES
    | -------------------------------------------------------------------------
    |
    | There area two reserved routes:
    |
    |	$route['default_controller'] = 'welcome';
    |
    | This route indicates which controller class should be loaded if the
    | URI contains no data. In the above example, the "welcome" class
    | would be loaded.
    |
    |	$route['404_override'] = 'errors/page_missing';
    |
    | This route will tell the Router what URI segments to use if those provided
    | in the URL cannot be matched to a valid route.
    |
   */

  $route['default_controller'] = "home";
  $route['404_override'] = 'pnf';

  $route['trash'] = "trash/index";
  
  $route['welcome/ses'] = "welcome/ses";
  $dynamicLink = array(
    'pre-owned-luxury-cars', 'used-audi-cars', 'used-audi-cars/(:any)',
    'used-bmw-cars', 'used-bmw-cars/(:any)',
    'used-mercedes-benz-cars', 'used-mercedes-benz-cars/(:any)',
    'used-lamborghini-cars', 'used-lamborghini-cars/(:any)',
    'used-porsche-cars', 'used-porsche-cars/(:any)',
    'used-volvo-cars', 'used-volvo-cars/(:any)',
    'used-jaguar-cars', 'used-jaguar-cars/(:any)',
    'used-land-rover-cars', 'used-land-rover-cars/(:any)',
    'used-lexus-cars', 'used-lexus-cars/(:any)',
    'used-mini-cooper-cars', 'used-mini-cooper-cars/(:any)',
    'used-bentley-cars', 'used-bentley-cars/(:any)',
    'used-harley-davidson', 'used-harley-davidson/(:any)',
    'used-toyota-cars', 'used-toyota-cars/(:any)',
    'used-harley-davidson-bikes', 'used-harley-davidson-bikes/(:any)',
    'used-triumph-bikes', 'used-triumph-bikes/(:any)', 'pre-owned-luxury-bikes',
    'used-kawasaki-bikes', 'used-kawasaki-bikes/(:any)',
    'used-bmw-motorrad', 'used-bmw-motorrad/(:any)',
    'used-ford-cars', 'used-ford-cars/(:any)',
    'used-tvs-bikes', 'used-tvs-bikes/(:any)',
    'used-royal-enfield-bikes', 'used-royal-enfield-bikes/(:any)',
    'used-ktm-bikes', 'used-ktm-bikes/(:any)',
    'used-jeep-cars','used-jeep-cars/(:any)',
    'used-benelli-bikes','used-benelli-bikes/(:any)',
    'used-ducati-bikes','used-ducati-bikes/(:any)',
  );
  $route['(' . implode('|', $dynamicLink) . ')'] = 'used_cars/index/$1/$2/$3';
  $route['products/(:num)'] = "products/index/$1";
  $route['products/product-details/(:any)'] = "products/product_details/$1";
  $route['products/catalog'] = "products/catalog/";
  $route['products/warranty'] = "products/warranty";
  $route['products/(:any)'] = "products/category/$1";

  $route['search/(:any)'] = "search/index/$1";
  $route['vehicle/removeImage/(:any)'] = "vehicle/removeImage/$1";
  $route['vehicle/removeVehicle/(:any)'] = "vehicle/removeVehicle/$1";
  $route['vehicle/removeTempImage/(:any)'] = "vehicle/removeTempImage/$1";
  $route['vehicle/setDefault/(:any)'] = "vehicle/setDefault/$1";
  $route['vehicle/setDefaultUpdate/(:any)'] = "vehicle/setDefaultUpdate/$1";
  $route['vehicle/(:any)'] = "vehicle/index/$1";
  $route['vehicle/emiCalculator'] = "vehicle/emiCalculator";

  
  $route['sell-your-vehicle/bindModel'] = "sell_your_vehicle/bindModel";
  $route['sell-your-vehicle/bindVariant'] = "sell_your_vehicle/bindVariant";
  $route['bind-model-by-brand'] = "sell_your_vehicle/getModelByBrand";
  $route['bind-variant-by-model'] = "sell_your_vehicle/getVariantByModel";
  
  $route['sell-your-vehicle'] = "sell_your_vehicle/index";
  $route['api/v1/sell-your-vehicle'] = "api2/rest/sell_your_vehicle";//jsk
  $route['api/v1/contact'] = "api2/rest/contact";
  $route['api/v1/subscribe'] = "api2/rest/subscribe";

  $route['advanced-search'] = "advanced_search/index";

  $route['new-arrivals'] = "home/new_arrivals";
  $route['vehicles-near-by-you'] = "home/vehicles_near_by_you";

  $route['terms-of-use'] = "terms_of_use";
  $route['privacy-policy'] = "privacy_policy";
  $route['app-privacy-policy'] = "app_privacy_policy";
    
  $route['blog/category/(:any)'] = "blog/category/$1";
  $route['blog/tag/(:any)'] = "blog/tag/$1";
  $route['blog/share/(:any)'] = "blog/share/$1";
  $route['blog/(:any)'] = "blog/index/$1";
  
  $route['careerback'] = "careerback/index";
  
  $route['search/connectWithSeller'] = "search/connectWithSeller";
  
  $route['api/v1/getbrands'] = "api/getBrands";
  $route['api/v1/getcars'] = "api/getCars";
  $route['api/v1/get_cars'] = "api/get_cars";
  $route['api/v1/cars'] = "api/get_cars";
  $route['api/v1/products'] = "api/get_cars_new";//jsk
  $route['api/v1/bmv'] = "api/bmv";//jk 26-04-2023
  
  //$route['api/v1/book-veh'] = "api/book_veh";
  $route['api/v1/book-veh'] = "api2/rest/book_veh";
  $route['api/v1/getcars/new'] = "api/getNew";
  $route['api/v1/getcars/highprice'] = "api/getHighprice";
  $route['api/v1/getcars/lowprice'] = "api/getLowprice";
  $route['api/v1/getcars/(:num)'] = "api/getCar/$1";
  $route['api/v1/getfeature/(:num)'] = "api/getFeatures/$1";
  $route['api/v1/getfeature'] = "api/getAllfeature";
  $route['api/v1/search'] = "api2/rest/search";
  $route['api/v1/newuser'] = "api2/rest/newuser";
  $route['api/v1/validate'] = "api2/rest/validate";
  $route['api/v1/sociallogin'] = "api2/rest/sociallogin";
  $route['api/v1/forgot'] = "api2/rest/forgot";
  $route['api/v1/secure/updatepassword'] = "api2/rest/updatepassword";
  $route['api/v1/user/productdetails'] = "api2/rest/uploaddetails";
  $route['api/v1/user/productimage'] = "api2/rest/uploadimages";
  $route['api/v1/user/imageandroid'] = "api2/rest/uploadimagesandroid";
  $route['api/v1/featureds'] = "api2/rest/featured";
  $route['api/v1/blogs'] = "api2/rest/blogs";
  $route['api/v1/plans'] = "api2/rest/plans";



  $route['api/v1/getmodel/(:num)'] = "api/getmodal/$1";
  $route['api/v1/getvariant'] = "api2/rest/getVariations";
  $route['api/v1/admin/unapproved'] = "apiadmin/admin/unapproved";
  $route['api/v1/admin/approved'] = "apiadmin/admin/approved";
  $route['api/v1/admin/approve'] = "apiadmin/admin/approve";
  $route['api/v1/admin/unapprove'] = "apiadmin/admin/unapprove";

  $route['api/v1/sendtoken'] = "api2/messaging/addtoken";
  $route['api/v1/sendmessage'] = "api2/messaging/addmessage";
  $route['api/v1/chatrooms'] = "api2/messaging/chatrooms";
  $route['api/v1/chatrooms/chat'] = "api2/messaging/chatmessage";
  $route['api/v1/sendnotification'] = "api2/messaging/notification";
  $route['api/v1/deleteroom'] = "api2/messaging/deletechat";
  $route['api/v1/deletetoken'] = "api2/messaging/deletetoken";


  $route['api/v1/getbanner'] = "api/getBanner";
  $route['api/v1/getshowrooms'] = "api/getShowrooms";
  $route['api/v1/getquestions'] = "api/getQuestions";

  $route['api/v1/slots'] = "api2/rest/slots";
  $route['api/v1/booking'] = "api2/rest/booking";
  $route['api/v1/feedback'] = "api2/rest/feedback";

  //JK
  $route['api/v1/user/login'] = "api2/rest/loginwithphone";
  $route['api/v1/user/verifymobile'] = "api2/rest/verifyphonenumber";
  $route['api/v1/user/resendloginotp'] = "api2/rest/resendloginotp";
  $route['api/v1/user/sendOtp'] = "api2/rest/sendotp";//jsk
  $route['api/v1/user/verify_mobile'] = "api2/rest/verifyphonenumberNew";
  $route['api/v1/generateToken'] = "api2/rest/generateToken";//jak
  $route['api/v2/getTokenData'] = "api2/rest/getTokenData";//jsk
  
  //Voxbay
  $route['api/v1/clrbridgingincomcallland'] = "api2/rest/clrbridgingincomcallland";
  $route['api/v1/clrbridgingcallanswdagent'] = "api2/rest/clrbridgingcallanswdagent";
  $route['api/v1/clrbridgingcalldisconnected'] = "api2/rest/clrbridgingcalldisconnected";
  $route['api/v1/clrbridgingcallcallend'] = "api2/rest/clrbridgingcallcallend";
  $route['api/v1/clrbridgingcallcallendtmp'] = "api2/rest/clrbridgingcallcallendtmp";


  $route['api/v1/clrbridginginicallout'] = "api2/rest/clrbridginginicallout";
  $route['api/v1/clrbridgingendoutcall'] = "api2/rest/clrbridgingendoutcall";
  $route['api/v1/httpstest'] = "api2/rest/httpstest";
  //V2
  
  //Get all cars for home page
  $route['api/v2/getcars'] = "api2/rest/getAllCars";
  $route['api/v2/getcars/(:num)'] = "api/getCar/$1";
  $route['api/v2/getcarstmp/(:num)'] = "api/getCartmp/$1";
  $route['api/v2/user/updateuser'] = "api2/rest/updateuser";
  $route['api/v2/appversions'] = "api2/rest/appversions";
  $route['api/v2/getbanner'] = "api/getBanner";
  
  $route['api/v2/getfueltypes'] = "api2/rest/getfueltypes";
  $route['api/v2/emicalculator'] = "api2/rest/emicalculator";
  $route['api/v2/emisettings'] = "api2/rest/emisettings";

  $route['api/v2/career'] = "api2/rest/career";
  $route['api/v2/sendCareer'] = "api2/rest/sendCareer";//

  $route['appdownload/index/(:any)'] = "appdownload/index/$1";
  $route['appdownload/dwn/(:any)'] = "appdownload/index/$1";
  $route['product/(:any)'] = "product/index/$1";
  $route['rd-app-qr'] = "appdownload/qr";
  $route['drive-into'] = "appdownload/driveinto";

  //Special promotion
  $route['special-promotion'] = "special_promotion/index";
  $route['special-promotion/success'] = "special_promotion/success";
  $route['special-promotion/investment'] = "special_promotion/investment";
  $route['special-promotion/mail'] = "special_promotion/mail";
  
  $route['special-promotion/(:any)'] = "special_promotion/index/$1";


  $route['comeonkerala/lucky-draw'] = 'comeonkerala/index';
  // $route['comeonkerala'] = 'comeonkerala/index';
  $route['highlight-residency-onam-activity'] = 'highlight_residency_onam_activity/index';

  //jsk//
  $route['api/v2/generateToken'] = "api2/rest/generateToken";
  $route['api/v2/getTokenData'] = "api2/rest/getTokenData";
  //-------------------- RDMS Start ------------------------------------------------------//
  $route['api/v/testlogin'] = "rdms_api/rest/testlogin";
  // $route['api/v2/testlogin'] = "api2/rest/testlogin";
  $route['api/authentication/login'] = 'rdms_api/rest/login';
  $route['api/authentication/registration'] = 'rdms_api/Authentication/registration';
  $route['api/authentication/user/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'rdms_api/rest/user/id/$1/format/$3$4';
  
  $route['api/mob/login'] = 'rdms_api/user/login';
  $route['api/v1/getbrands'] = "api/getBrands";
  
  $route['api/mob/divisions'] = 'rdms_api/rest/divisions';
  $route['api/mob/bindShowroomByDivision'] = 'rdms_api/rest/bindShowroomByDivision';
  $route['api/mob/getStaffsByShowroom'] = 'rdms_api/rest/getStaffsByShowroom';
  $route['api/mob/howDoCustKnow'] = 'rdms_api/rest/howDoCustKnow';
  $route['api/mob/brands'] = 'rdms_api/rest/brands';
  $route['api/mob/bindModel'] = 'rdms_api/rest/bindModel';
  $route['api/mob/bindVarient'] = 'rdms_api/rest/bindVarient';
  $route['api/mob/matchingInquiry'] = 'rdms_api/rest/matchingInquiry';
  $route['api/mob/regList'] = "rdms_api/rest/regList";
  //$route['api/mob/printTrackCard/(:num)/(:any)'] = 'rdms_api/rest/printTrackCard/id/$1/jk/$2'; 
  //$route['api/mob/printTrackCard/(:num)'] = "rdms_api/rest/printTrackCard/$1";
  
  $route['api/mob/printTrackCard'] = "rdms_api/rest/printTrackCard";
  $route['api/mob/addRegistration'] = "rdms_api/rest/addReg";
  $route['api/mob/menu'] = "rdms_api/rest/menu";
  $route['api/mob/mode_of_contact'] = "rdms_api/rest/modeOfContact";
  $route['api/mob/lead_types'] = "rdms_api/rest/leadType";
  $route['api/mob/km_ranges'] = "rdms_api/rest/kmRanges";
  $route['api/mob/km_field_text_or_select'] = "rdms_api/rest/km_field_text_or_select";
  $route['api/mob/years'] = "rdms_api/rest/years";
  //$route['api/mob/districts/(:any)'] = "rdms_api/rest/districts/$1";
  $route['api/mob/states'] = "rdms_api/rest/states";
  $route['api/mob/districts'] = "rdms_api/rest/districts";
  $route['api/mob/customer_status'] = "rdms_api/rest/customerStatus";
  //$route['api/mob/regiter_to_inquiry/(:any)'] = "rdms_api/rest/regiter_to_inquiry/$1";
  $route['api/mob/regiter_to_inquiry'] = "rdms_api/rest/regiter_to_inquiry";
  $route['api/mob/punchEnquiry'] = "rdms_api/rest/punchEnquiry";
  $route['api/mob/myregister'] = "rdms_api/rest/myregister";
  $route['api/mob/matchingInquiryByPhone'] = "rdms_api/rest/matchingInquiryByPhone";
  $route['api/mob/createEvaluation'] = "rdms_api/rest/createEvaluation";
  $route['api/mob/SaveEvaluation'] = "rdms_api/rest/SaveEvaluation";
  $route['api/mob/changeRegisterStatus'] = "rdms_api/rest/changeRegisterStatus";
  $route['api/mob/setRegisterFollowup'] = "rdms_api/rest/setRegisterFollowup";
  $route['api/mob/FollowUpCallTypes'] = "rdms_api/rest/FollowUpCallTypes";
  $route['api/mob/regFollowups'] = "rdms_api/rest/regFollowups";
  $route['api/mob/customerGrade'] = "rdms_api/rest/customerGrade";
  $route['api/mob/referal_types'] = "rdms_api/rest/referal_types";
  $route['api/mob/getAllRdStaffs'] = "rdms_api/rest/getAllRdStaffs";
  $route['api/mob/customerByPhone'] = "rdms_api/rest/customerByPhone";
  $route['api/mob/teleCallersSalesStaffs'] = "rdms_api/rest/teleCallersSalesStaffs"; //my Register-admin only- to show pending register
  $route['api/mob/regPendingCount'] = "rdms_api/rest/regPendingCount"; //my Register-admin only- to show pending register
  $route['api/mob/registration-edit-form'] = "rdms_api/rest/registration_edit_form";
  $route['api/mob/updateRegistration'] = "rdms_api/rest/updateRegistration";
  $route['api/mob/events'] = "rdms_api/rest/events";
  $route['api/mob/fuel'] = "rdms_api/rest/getfueltypes";
  $route['api/mob/vehicle_types'] = "rdms_api/rest/vehicle_types";
  $route['api/mob/colors'] = "rdms_api/rest/colors";
  $route['api/mob/price_ranges'] = "rdms_api/rest/price_ranges";
  $route['api/mob/enquiry_list'] = "rdms_api/rest/enquiry_list";
  $route['api/mob/enquiry-edit'] = "rdms_api/rest/enquiry_edit";
  $route['api/mob/purchase_period'] = "rdms_api/rest/purchase_period";
  $route['api/mob/ac_insurance_transmission'] = "rdms_api/rest/ac_insurance_transmission"; //purch enq and valuavation
  $route['api/mob/enquiryUpdate'] = "rdms_api/rest/enquiry_update";//same
  $route['api/mob/enquiry_update'] = "rdms_api/rest/enquiry_update";//same
  //$route['api/mob/enquiry_update'] = "rdms_api/rest/enquiry_update";
  $route['api/mob/all_followup'] = "rdms_api/rest/all_followup";
  $route['api/mob/missed_followup'] = "rdms_api/rest/missed_followup";
  $route['api/mob/viewFollowup'] = "rdms_api/rest/viewFollowup";
  $route['api/mob/followup_status'] = "rdms_api/rest/followup_status";
  $route['api/mob/submit_change_enquiry_status'] = "rdms_api/rest/changeStatus";
  $route['api/mob/stock_vehicles'] = "rdms_api/rest/stockVehicles";
  $route['api/mob/company_vehicles'] = "rdms_api/rest/companyVehicles";
  $route['api/mob/preference_types'] = "rdms_api/rest/preference_types"; //select bx vaues
  $route['api/mob/preferences'] = "rdms_api/rest/preferences"; //table vw
  $route['api/mob/rto'] = "rdms_api/rest/rto";
  $route['api/mob/submit_preference'] = "rdms_api/rest/submit_preference";
  $route['api/mob/submit_procrmnt_req'] = "rdms_api/rest/submitProcrmntReq";
  $route['api/mob/get_travel_modes'] = "rdms_api/rest/travelModes";
  $route['api/mob/fleet_veh'] = "rdms_api/rest/fleetVehicles";
  $route['api/mob/travel_with'] = "rdms_api/rest/travelWith";
  $route['api/mob/submit_home_visit'] = "rdms_api/rest/storeHomeVisit";
  $route['api/mob/getSingleFollowup'] = "rdms_api/rest/getSingleFollowup";
  $route['api/mob/editFollowUp'] = "rdms_api/rest/editFollowUp";
  $route['api/mob/quickUpdateFollowup'] = "rdms_api/rest/quickUpdateFollowup";
  $route['api/mob/mod_of_contacts_followup'] = "rdms_api/rest/mod_of_contacts_followup";
  $route['api/mob/staffCanAssignEnquires'] = "rdms_api/rest/staffCanAssignEnquires";
  $route['api/mob/submit_reassignenquiry'] = "rdms_api/rest/reassignenquiry";
  $route['api/mob/changeTestDriveHomeVisit'] = "rdms_api/rest/changeTestDriveHomeVisit";
  $route['api/mob/reserveVehicleView'] = "rdms_api/rest/reserveVehicleView";
  $route['api/mob/bindVehicleDetails'] = "rdms_api/rest/bindVehicleDetails";
  $route['api/mob/eval_pending_list'] = "rdms_api/rest/eval_pending_list";
  $route['api/mob/eval_list'] = "rdms_api/rest/eval_pending_list";
  $route['api/mob/eval_list_search'] = "rdms_api/rest/evaluation_ajax";
  $route['api/mob/evaluators'] = "rdms_api/rest/getAllEvaluators";
  $route['api/mob/sales_exe'] = "rdms_api/rest/getEnquiryHandingMembers";
  $route['api/mob/cmb_types'] = "rdms_api/rest/cmb_types";
  $route['api/mob/evl_status'] = "rdms_api/rest/evl_status";
  $route['api/mob/edit_evaluation'] = "rdms_api/rest/edit_evaluation";
  $route['api/mob/full_body_checkup_detail_by_master'] = "rdms_api/rest/fullBodyCheckupDetailByMaster";
  $route['api/mob/val_doc_types'] = "rdms_api/rest/val_doc_types";
  $route['api/mob/updateDocumentType'] = "rdms_api/rest/updateDocumentType";
  $route['api/mob/deleteDocument'] = "rdms_api/rest/deleteDocument";
  $route['api/mob/purchase_types'] = "rdms_api/rest/purchase_types";
  $route['api/mob/uploadFile'] = "rdms_api/rest/uploadFile";
  $route['api/mob/delete-val-vehicle-image'] = "rdms_api/rest/deleteValuationVehicleImage";
  $route['api/mob/add-new-vehicle-fature'] = "rdms_api/rest/newvehiclefature";
  $route['api/mob/updateEvaluation'] = "rdms_api/rest/updateEvaluation";
  $route['api/mob/submit_reserve_veh'] = "rdms_api/rest/reserveVehicle";
  $route['api/mob/paymentmod'] = "rdms_api/rest/getPaymentMod";
  $route['api/mob/done_by'] = "rdms_api/rest/doneBy";
  $route['api/mob/get_settings_by_key'] = "rdms_api/rest/get_settings_by_key"; //
  $route['api/mob/getRestResponse'] = "rdms_api/rest/getRestResponse"; //
  $route['api/mob/getRefurbDetails'] = "rdms_api/rest/getRefurbDetails"; //
  $route['api/mob/getEvaluationPrint'] = "rdms_api/rest/getEvaluationPrint"; //
  $route['api/mob/submitRefurbs'] = "rdms_api/rest/refurbisheReturn"; //
  $route['api/mob/getRefurbStatus'] = "rdms_api/rest/getRefurbStatus"; //
  $route['api/mob/update_refurb_status'] = "rdms_api/rest/update_refurb_status"; //
  $route['api/mob/printevaluation'] = "rdms_api/rest/printevaluation"; //
  $route['api/mob/track_card'] = "rdms_api/rest/track_card"; //
  $route['api/mob/tracklist'] = "rdms_api/rest/tracklist"; //
  $route['api/mob/trackingLog'] = "rdms_api/rest/trackingLog"; //
  $route['api/mob/out_pass'] = "rdms_api/rest/out_pass"; //
  $route['api/mob/submit_out_pass'] = "rdms_api/rest/submit_out_pass"; //
  $route['api/mob/check_in_list'] = "rdms_api/rest/check_in_list"; //
  $route['api/mob/generateOutPass'] = "rdms_api/rest/generateOutPass"; //
  $route['api/mob/editGatePass'] = "rdms_api/rest/editGatePass"; //
  $route['api/mob/updateGatePass'] = "rdms_api/rest/updateGatePass"; //
  $route['api/mob/check_in_view'] = "rdms_api/rest/check_in_view"; //
  $route['api/mob/updateCheckIn'] = "rdms_api/rest/check_in_update"; //
  $route['api/mob/booking_enquiries'] = "rdms_api/rest/booking_enquiries"; //
  $route['api/mob/deliverd_vehicles'] = "rdms_api/rest/deliverdvehicle"; //
  $route['api/mob/vehDetailsByValId'] = "rdms_api/rest/vehDetailsByValId"; //
  $route['api/mob/changeStatusRequest'] = "rdms_api/rest/changeStatusRequest"; //
  $route['api/mob/purchase_check_list'] = "rdms_api/rest/purchase_check_list"; //
  $route['api/mob/view_purchase_check_list'] = "rdms_api/rest/view_purchase_check_list"; //
  $route['api/mob/edit_purchase_check_list'] = "rdms_api/rest/edit_purchase_check_list"; //
  $route['api/mob/add_purchase_check_list'] = "rdms_api/rest/add_purchase_check_list"; //
  $route['api/mob/getChkDtls'] = "rdms_api/rest/getChkDtls"; //
  $route['api/mob/web_view_print_track_card'] = "rdms_api/rest/web_view_print_track_card"; //
  $route['api/mob/web_view_valuation_repot'] = "rdms_api/rest/web_view_valuation_repot"; //
  $route['api/mob/getAllStaffInSales'] = "rdms_api/rest/getAllStaffInSales"; //
  $route['api/mob/sendBackRegister'] = "rdms_api/rest/sendBackRegister"; //
  $route['api/mob/reg_droped'] = "rdms_api/rest/reg_droped"; //
  $route['api/mob/getConnectedCallByRegister'] = "rdms_api/rest/getConnectedCallByRegister"; //
  $route['api/mob/reghistory'] = "rdms_api/rest/reghistory"; //
  $route['api/mob/print_obf'] = "rdms_api/rest/print_obf"; //
  $route['api/mob/vehicleDetails'] = "rdms_api/rest/vehicleDetails"; //
  $route['api/mob/vehicleInformation'] = "rdms_api/rest/vehicleInformation"; //
  $route['api/mob/viewVehicleStatus'] = "rdms_api/rest/viewVehicleStatus"; //
  $route['api/mob/submitVehicleStatus'] = "rdms_api/rest/viewVehicleStatusSubmit"; //
  $route['api/mob/enq_types'] = "rdms_api/rest/enq_types"; //
  $route['api/mob/staff_name_by_id'] = "rdms_api/rest/getStaffNameById"; //
  $route['api/mob/insurance-details'] = "rdms_api/rest/insuranceDetails";//jsk news
  
  
  //End RDMS//
  
  $route['api/v1/testApi'] = "api/testApi";///test
  //@jsk//
  
  