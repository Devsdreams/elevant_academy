<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/page_not_found';
$route['certificate/(:any)']        = "addons/certificate/generate_certificate/$1";

//course bundles
$route['course_bundles/(:any)']                                = "addons/course_bundles/index/$1";
$route['course_bundles']                                    = "addons/course_bundles";
$route['course_bundles/search/(:any)']                        = "addons/course_bundles/search/$1";
$route['course_bundles/search/(:any)/(:any)']                = "addons/course_bundles/search/$1/$1";
$route['bundle_details/(:any)/(:any)']                      = "addons/course_bundles/bundle_details/$1";
$route['bundle_details/(:any)']                              = "addons/course_bundles/bundle_details/$1/$1";
$route['course_bundles/buy/(:any)']                          = "addons/course_bundles/buy/$1";
$route['home/my_bundles']                                      = "addons/course_bundles/my_bundles";
$route['home/bundle_invoice/(:any)']                          = "addons/course_bundles/invoice/$1";
//end course bundles

//ebook
$route['ebook/ebook_details/(:any)/(:any)'] = "addons/ebook/ebook_details/$1/$2";
$route['ebook'] = "addons/ebook/ebooks";
$route['ebook_manager/all_ebooks'] = "addons/ebook_manager/all_ebooks";
$route['ebook_manager/add_ebook'] = "addons/ebook_manager/add_ebook";
$route['ebook_manager/payment_history'] = "addons/ebook_manager/payment_history";
$route['ebook_manager/category'] = "addons/ebook_manager/category";
$route['ebook/buy/(:any)'] = "addons/ebook/buy/$1";
$route['home/my_ebooks'] = "addons/ebook/my_ebooks";
//end ebook

//BLog
$route['blogs'] = "blog/blogs";
$route['blogs/(:any)'] = "blog/blogs/$1";
//End blog


//Custom page
$route['page/(:any)'] = "page/index/$1";
//End Custom page

$route['admin/affiliates_manual'] = 'admin/affiliates_manual';
$route['admin/affiliates_approval'] = 'admin/affiliates_approval';
$route['admin/affiliates/delete/(:num)'] = 'admin/delete_affiliate/$1';

$route['user/affiliates'] = 'user/affiliates';
$route['user/affiliates_manual'] = 'user/affiliates_manual';
$route['user/affiliates_approval'] = 'user/affiliates_approval';
$route['user/affiliates/delete/(:num)'] = 'user/delete_affiliate/$1';
$route['user/manage_affiliates'] = 'user/manage_affiliates';
$route['user/create_campaign'] = 'user/create_campaign';
$route['user/groups'] = 'user/groups';
$route['user/contact'] = 'user/contact';
/* $route['user/affiliate_user_dashboard'] = 'user/affiliate_user_dashboard'; */
$route['home/affiliate_dashboard'] = 'home/affiliate_user_dashboard';

/* $route['affiliate/click/(:num)'] = 'user/track_affiliate_click/$1';  */

$route['home/course/(:any)/(:num)'] = 'home/course/$1/$2';

$route['sign_up_instructor'] = 'home/sign_up_instructor';

$route['elevant/login'] = 'home/elevant_login';
$route['elevant/register'] = 'home/elevant_register';
$route['elevant/multi_step_register'] = 'home/elevant_multi_step_register';

$route['elevant/courses'] = 'user/elevant_user_courses';
$route['user/elevant/courses'] = 'user/elevant_user_courses';
$route['user/elevant/course_add'] = 'user/elevant_course_add';
$route['user/elevant/course_add_submit'] = 'user/elevant_course_add_submit';
$route['user/elevant/course_manager'] = 'user/elevant_course_manager';
$route['user/elevant/course_config/(:num)'] = 'user/elevant_course_config/$1';
$route['user/elevant/section_add/(:num)'] = 'user/elevant_section_add/$1';
$route['elevant/home'] = 'home/elevant_home';
$route['translate_uri_dashes'] = FALSE;
