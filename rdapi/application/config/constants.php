<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  /*
    |--------------------------------------------------------------------------
    | File and Directory Modes
    |--------------------------------------------------------------------------
    |
    | These prefs are used when checking and setting modes when working
    | with the file system.  The defaults are fine on servers with proper
    | security, but you may wish (or even need) to change the values in
    | certain environments (Apache running a separate process for each
    | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
    | always be used to set the mode correctly.
    |
   */
  define('FILE_READ_MODE', 0644);
  define('FILE_WRITE_MODE', 0666);
  define('DIR_READ_MODE', 0755);
  define('DIR_WRITE_MODE', 0777);

  /*
    |--------------------------------------------------------------------------
    | File Stream Modes
    |--------------------------------------------------------------------------
    |
    | These modes are used when working with fopen()/popen()
    |
   */

  define('FOPEN_READ', 'rb');
  define('FOPEN_READ_WRITE', 'r+b');
  define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
  define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
  define('FOPEN_WRITE_CREATE', 'ab');
  define('FOPEN_READ_WRITE_CREATE', 'a+b');
  define('FOPEN_WRITE_CREATE_STRICT', 'xb');
  define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

  define('TABLE_PREFIX', 'rana_');
  define('TABLE_PREFIX_PORTAL', 'cpnl_');
  define('UPLOAD_PATH', './assets/uploads/');

  define('DEFAULT_THUMB_H', 200);
  define('DEFAULT_THUMB_W', 200); 
  
  define('FILE_UPLOAD_PATH', '../assets/uploads/'); 
  
  
  define('EMAIL_CONTACT', 'teleclt@royaldrive.in');
  define('EMAIL_CAREER', 'hr@royaldrive.in');
  define('MAIL_FROM_NAME', 'Royaldrive'); 
  
  define('STATIC_TITLE', '  | Royal Drive | Kerala');
  
  define('SMTP_HOST', 'mail.royaldrive.in');
  define('SMTP_PORT', 465);
  define('SMTP_USER', 'trash@royaldrive.in');
  define('SMTP_PASS', 'tr{@ubT)l#[1');
  
  //Voxbay call status
  define('VB_CONNECTED', 18);
  define('VB_CANCEL', 19);
  define('VB_BUSY', 20);
  define('VB_CHANUNAVAIL', 21);
  define('VB_CONGESTION', 22);
  define('VB_NOANSWER', 23);
  define('VB_NOT_CONNECTED', 24);
  define('ADMIN_ID', 100);
  
  define('FUAL', serialize(array(array('ful_id' => 1, 'ful_title' => 'Petrol'), array('ful_id' => 2, 'ful_title' => 'Diesel'), array('ful_id' => 3, 'ful_title' => 'Gas'),
      array('ful_id' => 4, 'ful_title' => 'Hybrid'), array('ful_id' => 5, 'ful_title' => 'Electric'), array('ful_id' => 6, 'ful_title' => 'CNG'))));
      define('FUALS', serialize(array('2' => 'Diesel', '1' => 'Petrol', '3' => 'Gas', '4' => 'Hybrid', '5' => 'Electric', '6' => 'CNG')));
  define('FUAL_ADMIN', serialize(array('1' => 'Petrol', '2' => 'Diesel', '3' => 'Gas', '4' => 'Hybrid', '5' => 'Electric', '6' => 'CNG')));
  define('Showrooms', serialize(array(1 => 'Malappuram', 2 => 'Calicut', 3 => 'Kochi')));

  //define('PRODUCT_BASE_URL', 'https://royaldrive.s3.ap-south-1.amazonaws.com/products/');
  define('PRODUCT_BASE_URL', 'https://royaldrive.in/assets/uploads/product/');
  #rdlive
  
  #new API//
  define('reg_new_register', 0);
define('reg_alrd_inq_punched', 1);
#define('Showrooms', serialize(array(1 => 'Malappuram', 2 => 'Calicut', 3 => 'Kochi')));
define('loss_of_sale_or_buy', 4);
define('enq_lost', 5);
define('sale_closed', 6);
define('enq_req_drop', 2);
define('enq_droped', 3);
define('GRP_SALES_OFFICER', 8);
define('FOLLOWUP_CALL_TYPES', serialize(array(3 => 'Call not attend', 12 => 'Line busy', 13 => 'Not reachable')));
define('FOLLOWUP_CALL_TYPES_API', serialize(array(
  array('id' => 3, 'tittle' => 'Call not attend'), array('id' => 12, 'tittle' => 'Line busy'), array('id' => 13, 'tittle' => 'Not reachable')
)));
define('FOLLOW_UP_STATUS', serialize(array('1' => 'Hot+', '2' => 'Hot', '3' => 'Warm', '4' => 'Cold')));
define(
  'ENQUIRY_UP_STATUS',
  serialize([
    array(
      'id' => 1,
      'title' => 'Hot+'
    ),
    array(
      'id' => 2,
      'title' => 'Hot'
    ),
    array(
      'id' => 3,
      'title' => 'Warm'
    ),
    array(
      'id' => 4,
      'title' => 'Cold'
    )
  ])
);
define('ENQUIRY_TYPES', serialize(array('1' => 'Sales', '2' => 'Purchase', '3' => 'EXchange')));
define('MODE_OF_CONTACT_FOLLOW_UP', serialize(array('1' => 'Telephone', '2' => 'Direct meet', '3' => 'Showroom visit')));
define('MODE_OF_CONTACT_FOLLOW_UP_API', serialize(array(
  array('id' => 1, 'title' => 'Telephone'), array('id' => 2, 'title' => 'Direct meet'), array('id' => 3, 'title' => 'Showroom visit')
)));

define('MODE_OF_CONTACT', [array(
  '1' => 'CUG-RD-IN', //cug
  '27' => 'Courtesy call', //?
  //      '25' => 'CUG-RD-OUT',
  '9' => 'Walk in',
  '7' => 'OLX-RD',
  '16' => 'Car Wale',
  '14' => 'Car Trade',
  '2' => 'WhatsApp',
  '3' => 'Mail',
  '4' => 'Facebook-RD', //rd fb account
  '5' => 'Events',
  '6' => 'Referal-Own', //referl
  '8' => 'Fasttrack', //print
  '10' => 'C/O MD',
  '11' => 'C/O VP',
  '12' => 'C/O CEO',
  '13' => 'C/O Others',
  '15' => 'Just Dial', //web
  '17' => 'Field',
  '18' => 'CUG-Own',
  '19' => 'OLX-Own',
  '20' => 'Facebook-Own', //staff fb
  '21' => 'Telecall-RD',
  '22' => 'Google',
  '23' => 'Instagram-RD',
  '24' => 'India mart-RD',
  '26' => 'Web enquiry-RD-OUT',
  '28' => 'Happy call',
  '30' => 'Referal'
)]);
define(
  'CALL_TYPE',
  serialize([
    array(
      'id' => 1,
      'name' => 'Qualified lead'
    ),
    array(
      'id' => 2,
      'name' => 'Non qualified lead'
    ),
    array(
      'id' => 3,
      'name' => 'Call not attend'
    ),
    array(
      'id' => 4,
      'name' => 'Wrong number'
    ),
    array(
      'id' => 5,
      'name' => 'Just inquiry'
    ),
    array(
      'id' => 6,
      'name' => 'NRI Call'
    ),
    array(
      'id' => 7,
      'name' => 'Net call'
    ),
    array(
      'id' => 8,
      'name' => 'Demo call'
    ),
    array(
      'id' => 9,
      'name' => 'Advertisement'
    ),
    array(
      'id' => 10,
      'name' => 'Duplicate call already assigned'
    ),
    array(
      'id' => 11,
      'name' => 'Waiting for reply'
    )
  ])
);

define('inquiry_reopened', 14);
define('YEAR_RANGE_START', 1989);
define('assign_to_other_staff', 15);


define(
  'KM_field_select_or_text',
  serialize([
    array(
      'type' => '1', //text_field
      //'type' => '2',//select_box
    )
  ])
);
define('REFERAL_TYPES', serialize(array(1 => 'Broker', 2 => 'NVS', 3 => 'Dealer', 4 => 'RD Staff', 5 => 'RD Customer')));
// define('ENQ_VEHICLE_TYPES', serialize(array(
//   1 => 'SUV', 2 => 'Sedan', 3 => 'Convertible', 4 => 'Coupe',
//   5 => 'MUV-MPV', 6 => 'Sports', 7 => 'Hatchback',
//   8 => 'Cruiser bike', 9 => 'Sport bike', 10 => 'Off road bike', 
//   11 => 'Super luxury cars', 12 => 'Compact SUV', 13 => 'Saloon'
//               )
//       )
// );
define('ENQ_VEHICLE_TYPES', serialize(array(
  array('id' => 1, 'title' => 'SUV'), array('id' => 2, 'title' => 'Sedan'), array('id' => 3, 'title' => 'Convertible'),
  array('id' => 4, 'title' => 'Coupe'), array('id' => 5, 'title' => 'MUV-MPV'), array('id' => 6, 'title' => 'Sports'),
  array('id' => 7, 'title' => 'Hatchback'), array('id' => 8, 'title' => 'Cruiser bike'), array('id' => 9, 'title' => 'Sport bike'),
  array('id' => 10, 'title' => 'Off road bike'), array('id' => 11, 'title' => 'Super luxury cars'), array('id' => 12, 'title' => 'Compact SUV'),
  array('id' => 13, 'title' => 'Saloon'),
)));
define('PURCHASE_PERIOD', serialize(array(
  array('id' => 1, 'title' => 'Immediate'), array('id' => 2, 'title' => 'With in 1 Month'), array('id' => 3, 'title' => 'With in 3 Month'),
)));
define('AC', serialize(array(
  array('id' => 1, 'title' => 'W/o'), array('id' => 2, 'title' => 'Single'), array('id' => 3, 'title' => 'Dual'), array('id' => 4, 'title' => 'Multi')
)));
define('INSURANCE_TYPES', serialize(array(
  array('id' => 1, 'title' => 'RTI'), array('id' => 2, 'title' => 'Platinum/Gold/Silver'), array('id' => 3, 'title' => 'B2B'), array('id' => 4, 'title' => 'First Class')
  , array('id' => 5, 'title' => 'Second Class'), array('id' => 6, 'title' => 'Third party')
)));
define('Transmission', serialize(array(
  array('id' => 1, 'title' => 'M/T'), array('id' => 2, 'title' => 'A/T'), array('id' => 3, 'title' => 'S/T'),
)));

define('Fleet_veh', serialize(array(
  array('id' => 1, 'title' => 'Company Vehicle'), array('id' => 2, 'title' => 'Stock Vehicle'), array('id' => 3, 'title' => 'Own vehicle'),
)));
define('Comprossr', serialize(array(
  array('id' => 1, 'title' => 'Single'), array('id' => 2, 'title' => 'Doule'),
)));

define('Foll_status_for_MG', serialize(array(
  array('id' => 1, 'title' => 'Re-open'), array('id' => 2, 'title' => 'Request for drop an inquiry'), array('id' => 3, 'title' => 'Request for Loss of sale/purchase'), array('id' => 4, 'title' => 'Request for close')
  , array('id' => 5, 'title' => 'Second Class'), array('id' => 6, 'title' => 'Third party')
)));
define('Foll_status', serialize(array(
  array('id' => 2, 'title' => 'Request for drop an inquiry'), array('id' => 3, 'title' => 'Request for Loss of sale/purchase'), array('id' => 4, 'title' => 'Request for close')
  , array('id' => 5, 'title' => 'Second Class'), array('id' => 6, 'title' => 'Third party')
)));

define('PREFERENCE_KEYS', serialize(array(
  array('id' => 1, 'title' => 'Color'), array('id' => 2, 'title' => 'Registration'), array('id' => 3, 'title' => 'Other State'), array('id' => 4, 'title' => 'Vehicle type')
  , array('id' => 5, 'title' => 'RTO')
)));
define('add_stock', 39);
define('vehicle_evaluated', 12);
define('cancl_book', 29);

define('EVL_TYPES', serialize(array(
  array('id' => 0, 'title' => 'All Type'), array('id' => 1, 'title' => 'Our own'), array('id' => 2, 'title' => 'Park and sale'), array('id' => 3, 'title' => 'Park and sale with customer')
  , array('id' => '1,2', 'title' => 'Our own and Park and sale')
)));

define('purchase_types', serialize(array(
  array('id' => 1, 'title' => 'Own'), array('id' => 4, 'title' => 'Park and sale with dealer'), array('id' => 3, 'title' => 'Park and sale with customer')
  , array('id' => 5, 'title' => 'Exchange'), array('id' => 6, 'title' => 'Buy back'), array('id' => 7, 'title' => 'Sales return')
)));
define('EVL_STATUS', serialize(array(
  array('id' => -1, 'title' => 'All Status'), array('id' => 0, 'Our own' => 'Pending'), array('id' => 1, 'title' => 'Active'), array('id' => 39, 'title' => 'Stock veh')
)));

define('VAL_DOCUMENT_TYPE', serialize(array(
  array('id' => 1, 'title' => 'RC'), array('id' => 2, 'title' => 'Insurance'), array('id' => 3, 'title' => 'Form 29'), array('id' => 4, 'title' => 'Form 30')
  , array('id' => 5, 'title' => 'Spec'), array('id' => 6, 'title' => 'Tax token'), array('id' => 7, 'title' => 'Pollution'), array('id' =>8, 'title' => 'NOC')
  , array('id' =>9, 'title' => 'Service history'), array('id' =>10, 'title' => 'Purchase Customer Aadhaar'), array('id' =>11, 'title' => 'Purchase Customer PAN')
)));

define('PAYMENT_MOD', serialize(array(
  array('id' => 1, 'title' => 'Cheque'), array('id' => 2, 'title' => 'Cash'), array('id' => 3, 'title' => 'G-pay'), array('id' => 4, 'title' => 'Swiping')
  , array('id' => 5, 'title' => 'RTGS'), array('id' => 6, 'title' => 'NEFT')
)));
define('DONE_BY', serialize(array(
  array('id' => 1, 'title' => 'RD'), array('id' => 2, 'title' => 'Customer')
)));
//
define('vehicle_booked', 13);
define('confm_book', 28);
define('rfi_loan_approved', 42);
define('dc_ready_to_del', 43);
define('EVALUATION_TYPES', serialize(array('1' => 'Own', '4' => 'Park and sale with dealer', '3' => 'Park and sale with customer', '5' => 'Exchange', '6' => 'Buy back', '7' => 'Sales return')));
define('reg_droped_API', serialize(array(
  'id' => 17
)));
define('ENQUIRY_TYPES_API', serialize(array(
  array('id' => 1, 'title' => 'Sales'), array('id' => 2, 'title' => 'Purchase')
  , array('id' => 3, 'title' => 'EXchange')
)));
//

  #End new APi 

  define('MOU_VEH_IDENT_COMPONENTS', serialize(array(
//    1 => 'Engine Number',
//    2 => 'Chassis Number',
      3 => 'Gear box')
  ));//JK