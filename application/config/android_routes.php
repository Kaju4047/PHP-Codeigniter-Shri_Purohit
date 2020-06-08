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

//Android Web services
#Registration and Login
$route['android/purohit-registration'] = 'android/registration/Cn_registration/purohit_registration';
$route['android/purohit-forgot-password'] = 'android/registration/Cn_registration/forgot_password';
$route['android/reset-password-setting'] = 'android/registration/Cn_registration/reset_password_setting';
$route['android/language-list'] = 'android/registration/Cn_registration/language_list';
$route['android/state-list'] = 'android/registration/Cn_registration/state_list';
$route['android/city-list'] = 'android/registration/Cn_registration/city_list';
$route['android/check-email'] = 'android/registration/Cn_registration/check_email';
$route['android/check-mobile'] = 'android/registration/Cn_registration/check_mobile';

$route['android/login'] = 'android/registration/Cn_registration/login';
#profile Details
$route['android/get-profile-details'] = 'android/profile/Cn_profile_details/profile_details';
$route['android/get-qualification-details'] = 'android/profile/Cn_profile_details/qualification_details';

####Dashboard
$route['android/request-list'] = 'android/dashboard/Cn_dashboard/request_list';
$route['android/request-list-view'] = 'android/dashboard/Cn_dashboard/request_list_view';
$route['android/request-accept-reject'] = 'android/dashboard/Cn_dashboard/request_accept_reject';
#Today
$route['android/today-list'] = 'android/dashboard/Cn_dashboard/today_list';
$route['android/today-list-view'] = 'android/dashboard/Cn_dashboard/today_list_view';
$route['android/today-list-view-cancel'] = 'android/dashboard/Cn_dashboard/today_list_view_cancel';
$route['android/reached-location-otp'] = 'android/dashboard/Cn_dashboard/reached_location_otp';
$route['android/reached-otp-verified'] = 'android/dashboard/Cn_dashboard/check_reached_otp';
$route['android/pooja-completed-otp'] = 'android/dashboard/Cn_dashboard/pooja_completed_otp';
$route['android/puja-completed-otp-verified'] = 'android/dashboard/Cn_dashboard/check_pooja_completed_otp';
#Upcoming
$route['android/upcoming-list'] = 'android/dashboard/Cn_dashboard/upcoming_list';
$route['android/upcoming-list-view'] = 'android/dashboard/Cn_dashboard/upcoming_list_view';
$route['android/upcoming-list-view-cancel'] = 'android/dashboard/Cn_dashboard/upcoming_list_view_cancel';

#pooja History
$route['android/completed-list'] = 'android/puja_history/Cn_pooja_history/completed_list';
$route['android/completed-list-view'] = 'android/puja_history/Cn_pooja_history/completed_list_view';
$route['android/cancelled-list'] = 'android/puja_history/Cn_pooja_history/cancelled_list';
$route['android/cancelled-list-view'] = 'android/puja_history/Cn_pooja_history/cancelled_list_view';
#Rejected List
$route['android/reject-list'] = 'android/rejectlist/Cn_reject_list/reject_list';
$route['android/reject-list-view'] = 'android/rejectlist/Cn_reject_list/reject_list_view';
$route['android/transaction-history-list'] = 'android/transaction_history/Cn_transaction_history/transaction_history_list';

#Remainder message to user & Purohit 2 days before the puja event
$route['android/puja-reminder-msg'] = 'android/puja_history/Cn_pooja_history/puja_reminder_msg';
#Remainder message to user on the day of puja event and 2hrs before the puja
$route['android/remind-msg-on-puja-day'] = 'android/puja_history/Cn_pooja_history/remind_msg_pujaday';
#Purohit’s Current Location & Track him (It will be enabled before 2 hours of puja time and this option will be disable when the service is complete & cancelled
$route['android/purohit-lat-long'] = 'android/tracking/Cn_tracking/purohit_lat_long';
#CMS Data
$route['android/cms-data'] = 'android/cms/Cn_cms/cms_data';

#####Notifications
$route['android/notifications-view'] = 'android/notifications/Cn_notifications/view_notification';
$route['android/delete-notifications'] = 'android/notifications/Cn_notifications/delete_notification';
$route['android/check-read-unread'] = 'android/notifications/Cn_notifications/check_read_unread';
#Chat
$route['android/chat-list'] = 'android/chat/Cn_chat/chat_list';
$route['android/chat-list-details'] = 'android/chat/Cn_chat/chat_list_details';
$route['android/chat-insert-action'] = 'android/chat/Cn_chat/chat_insert_action';
$route['android/chat-clear'] = 'android/chat/Cn_chat/chat_clear';

#Enquiry 
$route['android/send-enquiry'] = 'android/enquiry/Cn_enquiry/send_enquiry';
$route['android/enquiry-list'] = 'android/enquiry/Cn_enquiry/enquiry_list';

#incentive List
$route['android/incentive-list'] = 'android/enquiry/Cn_enquiry/incentive_list';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
