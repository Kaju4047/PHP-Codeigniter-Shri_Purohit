<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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


#3-02-2020
#Front

$route['get-language'] = 'Cn_Default/get_language';


$route['front-about-us'] = 'front/aboutus/Cn_aboutus';

#contact us
$route['front-contact-us'] = 'front/contactus/Cn_contact_us';
$route['front-contact-send-email'] = 'front/contactus/Cn_contact_us/contact_send_email';


$route['front-services'] = 'front/services/Cn_services/services';
$route['front-get-cat-puja-list'] = 'front/services/Cn_services/get_cat_puja_list';
$route['front-services-view/(:any)'] = 'front/services/Cn_services/view_services/$1';
$route['front-services-view/(:any)/(:any)'] = 'front/services/Cn_services/view_services/$1/$2';
$route['front-services-view/(:any)/(:any)/(:any)'] = 'front/services/Cn_services/view_services/$1/$2/$3';



$route['front-customer-login'] = 'front/login/Cn_customer_login';
$route['front-customer-login-action'] = 'front/login/Cn_customer_login/customer_login';
$route['front-customer-logout'] = 'front/login/Cn_customer_login/customer_logout';
#Customer Registartion
$route['front-customer-register'] = 'front/customer_register/Cn_customer_register';
$route['customer-reg-action'] = 'front/customer_register/Cn_customer_register/registration_action';
$route['customer-check-email'] = 'front/customer_register/Cn_customer_register/check_email';

#forgot password
$route['front-forgot-password'] = 'front/forgotpassword/Cn_forgot_password';
$route['front-forgot-password-action'] = 'front/forgotpassword/Cn_forgot_password/forget_password_action';

#Customer profile
$route['front-customer-profile'] = 'front/customer_profile/Cn_customer_profile';
$route['front-customer-profile-action'] = 'front/customer_profile/Cn_customer_profile/customer_profile_action';


#My booking

$route['front-my-booking'] = 'front/customer_booking/Cn_my_booking';
$route['get-booking-listing'] = 'front/customer_booking/Cn_my_booking/get_booking_listing';
$route['front-order-view/(:any)'] = 'front/customer_booking/Cn_my_booking/order_view/$1';
$route['front-pooja-update-action'] = 'front/customer_booking/Cn_my_booking/pooja_update_action';
$route['front-chat-msg-action'] = 'front/customer_booking/Cn_my_booking/chat_msg_action';
$route['get-chat'] = 'front/customer_booking/Cn_my_booking/get_chat';
$route['new-messages'] = 'front/customer_booking/Cn_my_booking/new_messages';
$route['rating-action'] = 'front/customer_booking/Cn_my_booking/rating_action';
$route['customer-cancel-pooja'] = 'front/customer_booking/Cn_my_booking/customer_cancel_pooja_order';
$route['customer-refund-request'] = 'front/customer_booking/Cn_my_booking/customer_refund_request';
$route['get-purohit-lat-long'] = 'front/customer_booking/Cn_my_booking/purohit_lat_long';
#customer setting
$route['front-my-setting'] = 'front/setting/Cn_setting';
$route['front-my-setting-action'] = 'front/setting/Cn_setting/front_setting_action';

#view package
$route['front-view-packages/(:any)'] = 'front/packages/Cn_package/view_package/$1';
$route['pooja-create-action'] = 'front/packages/Cn_package/pooja_create_action';


$route['front-how-we-work'] = 'front/how_we_work/Cn_how_we_work';
$route['front-how-we-work-details'] = 'front/how_we_work/Cn_how_we_work/how_we_work_details';
$route['front-refund-policy'] = 'front/cancellation_refund_policy/Cn_refund_policy';
$route['front-privacy-policy'] = 'front/privacy_policy/Cn_privacy_policy';
$route['front-privacy-policy'] = 'front/privacy_policy/Cn_privacy_policy';
$route['front-terms-of-use'] = 'front/terms_of_use/Cn_terms_condition';
$route['front-faq'] = 'front/faq/Cn_faq';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
