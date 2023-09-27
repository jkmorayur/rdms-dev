<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
$route['404_override'] = '';

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

$route['sell-your-vehicle/bindModel'] = "sell_your_vehicle/bindModel";
$route['sell-your-vehicle/bindVariant'] = "sell_your_vehicle/bindVariant";
$route['sell-your-vehicle'] = "sell_your_vehicle/index";

$route['advanced-search'] = "advanced_search/index";

$route['new-arrivals'] = "home/new_arrivals";
$route['vehicles-near-by-you'] = "home/vehicles_near_by_you";

$route['terms-of-use'] = "terms_of_use";
$route['privacy-policy'] = "privacy_policy";

$route['seo/sitemap\.xml'] = "seo/sitemap";
/* End of file routes.php */
/* Location: ./application/config/routes.php */