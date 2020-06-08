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

#default URLS
$route['default_controller'] = 'Cn_Default';
$route['index'] = 'Cn_Default';
$route['sessionExpire'] = 'Cn_Default/sessionExpire';

# URLS
$route['admin'] = 'admin/login/Cn_login';
$route['admin/login'] = 'admin/login/Cn_login';

#Login
$route['admin/login-action'] = 'admin/login/Cn_login/login_action';
$route['admin/logout'] = 'admin/login/Cn_login/logout';

#Forgot Passowrds
$route['admin/forgot'] = 'admin/forgot/Cn_forgotpsw';
$route['admin/forget-password-action'] = 'admin/forgot/Cn_forgotpsw/forget_password_action';

#organisation
$route['admin/organisation'] = 'admin/organisation/Cn_organisation';
$route['organisation-master-action'] = 'admin/organisation/Cn_organisation/organization_master_action';

#dashboard
$route['admin/dashboard'] = 'admin/dashboard/Cn_dashboard';

#sub-user
$route['admin/sub-user'] = 'admin/subuser/Cn_subuser';
$route['admin/sub-user/(:num)'] = 'admin/subuser/Cn_subuser';
$route['admin/view-sub-user/(:any)'] = 'admin/subuser/Cn_subuser/subuser/$1';
$route['admin/add-sub-user'] = 'admin/subuser/Cn_subuser/addSubUser';
$route['admin/edit-sub-user/(:num)'] = 'admin/subuser/Cn_subuser/addSubUser/$1';
$route['admin/add-sub-user-action'] = 'admin/subuser/Cn_subuser/action';
$route['admin/sub-user-delete/(:any)'] = 'admin/subuser/Cn_subuser/delete/$1';
$route['admin/sub-user-delete/(:any)/(:num)'] = 'admin/subuser/Cn_subuser/delete/$1/$2';
$route['admin/sub-user-changeStatus/(:any)/(:any)'] = 'admin/subuser/Cn_subuser/changeStatus/$1/$2';

#setting URLS
$route['admin/setting'] = 'admin/setting/Cn_setting';
$route['user-administration-setting-action'] = 'admin/setting/Cn_setting/setting_action';

#cms
$route['admin/cms'] = 'admin/cms/Cn_cms/cms';

#master language
$route['admin/language'] = 'admin/master/Cn_master/language';
$route['admin/language/(:any)'] = 'admin/master/Cn_master/language/$1';
$route['admin/add-language'] = 'admin/master/Cn_master/addLanguage';
$route['admin/language-status/(:any)/(:any)'] = 'admin/master/Cn_master/languageStatusChange/$1/$2';
$route['admin/delete-language/(:any)'] = 'admin/master/Cn_master/deleteLanguage/$1';

#master state
$route['admin/state'] = 'admin/master/Cn_master/state';
$route['admin/state/(:any)'] = 'admin/master/Cn_master/state/$1';
$route['admin/add-state'] = 'admin/master/Cn_master/addstate';
$route['admin/state-status/(:any)/(:any)'] = 'admin/master/Cn_master/stateStatusChange/$1/$2';
$route['admin/delete-state/(:any)'] = 'admin/master/Cn_master/deletestate/$1';
# master city
$route['admin/city'] = 'admin/master/Cn_master/city';
$route['admin/city/(:any)'] = 'admin/master/Cn_master/city/$1';
$route['admin/add-city'] = 'admin/master/Cn_master/addCity';
$route['admin/city-status/(:any)/(:any)'] = 'admin/master/Cn_master/cityStatusChange/$1/$2';
$route['admin/delete-city/(:any)'] = 'admin/master/Cn_master/deleteCity/$1';
#master citywise language
$route['admin/citywise-language'] = 'admin/master/Cn_master/citywiseLanguage';
$route['admin/citywise-language/(:any)'] = 'admin/master/Cn_master/citywiseLanguage/$1';
$route['admin/add-citywise-language'] = 'admin/master/Cn_master/addCitywiseLanguage';
$route['admin/citywise-language-status/(:any)/(:any)'] = 'admin/master/Cn_master/citywiseLanguageStatusChange/$1/$2';
$route['admin/delete-citywise-language/(:any)'] = 'admin/master/Cn_master/deleteCitywiseLanguage/$1';
#category
$route['admin/category'] = 'admin/master/Cn_master/category';
$route['admin/category/(:any)'] = 'admin/master/Cn_master/category/$1';
$route['admin/add-category'] = 'admin/master/Cn_master/addCategory';
$route['admin/category-status/(:any)/(:any)'] = 'admin/master/Cn_master/categoryStatusChange/$1/$2';
$route['admin/delete-category/(:any)'] = 'admin/master/Cn_master/deleteCategory/$1';
#advanced payment
$route['admin/advance-payment'] = 'admin/master/Cn_master/advancePayment';
$route['admin/advance-payment/(:any)'] = 'admin/master/Cn_master/advancePayment/$1';
$route['admin/add-advanced-payment'] = 'admin/master/Cn_master/addAdvancePayment';
$route['admin/advance-payment-status/(:any)'] = 'admin/master/Cn_master/paymentStatusChange/$1';
#incentives
$route['admin/incentives'] = 'admin/master/Cn_master/incentives';
$route['admin/incentives/(:any)'] = 'admin/master/Cn_master/incentives/$1';
$route['admin/add-incentives'] = 'admin/master/Cn_master/addIncentives';
$route['admin/incentives-status/(:any)'] = 'admin/master/Cn_master/incentiveStatusChange/$1';
#cancellation charges
$route['admin/cancellation-charges'] = 'admin/master/Cn_master/cancellationCharges';
$route['admin/cancellation-charges/(:any)'] = 'admin/master/Cn_master/cancellationCharges/$1';
$route['admin/add-cancellation-charges'] = 'admin/master/Cn_master/addcancellationCharges';
$route['admin/cancellation-charges-status/(:any)'] = 'admin/master/Cn_master/cancellationChargesStatusChange/$1';
#tax
$route['admin/tax'] = 'admin/master/Cn_master/tax';
$route['admin/tax/(:any)'] = 'admin/master/Cn_master/tax/$1';
$route['admin/add-tax'] = 'admin/master/Cn_master/addTax';
$route['admin/tax-status/(:any)'] = 'admin/master/Cn_master/taxStatusChange/$1';
#Additional Services
$route['admin/additional-services'] = 'admin/master/Cn_master/additionalServices';
$route['admin/additional-services/(:any)'] = 'admin/master/Cn_master/additionalServices/$1';
$route['admin/add-additional-services'] = 'admin/master/Cn_master/addAdditionalServices';
$route['admin/additional-service-status/(:any)/(:any)'] = 'admin/master/Cn_master/additionalServiceStatusChange/$1/$2';
$route['admin/delete-additinal-service/(:any)'] = 'admin/master/Cn_master/deleteAdditionalService/$1';
#cancellation % for purohit
$route['admin/cancellation-percentage-for-purohit'] = 'admin/master/Cn_master/cancellation_percentage_for_purohit';
$route['admin/cancellation-percentage-for-purohit/(:any)'] = 'admin/master/Cn_master/cancellation_percentage_for_purohit/$1';
$route['admin/add-cancellation-percentage-for-purohit'] = 'admin/master/Cn_master/add_cancellation_percentage_for_purohit';
#fine for purohit
$route['admin/fine-for-purohit'] = 'admin/master/Cn_master/fine_for_purohit';
$route['admin/fine-for-purohit/(:any)'] = 'admin/master/Cn_master/fine_for_purohit/$1';
$route['admin/add-fine-for-purohit'] = 'admin/master/Cn_master/add_fine_for_purohit';

#pooja
$route['admin/pooja-list'] = 'admin/pooja/Cn_pooja/poojaList';
$route['admin/pooja-list/(:any)'] = 'admin/pooja/Cn_pooja/poojaList/$1';
$route['admin/add-pooja'] = 'admin/pooja/Cn_pooja/addPooja';
$route['admin/add-pooja/(:any)'] = 'admin/pooja/Cn_pooja/addPooja/$1';
$route['admin/add-pooja-action'] = 'admin/pooja/Cn_pooja/addPoojaAction';
$route['admin/view-pooja/(:any)'] = 'admin/pooja/Cn_pooja/viewPooja/$1';
$route['admin/pooja-status/(:any)/(:any)'] = 'admin/pooja/Cn_pooja/poojaeStatusChange/$1/$2';
$route['admin/delete-pooja/(:any)'] = 'admin/pooja/Cn_pooja/deletePooja/$1';

#package
$route['admin/package-list'] = 'admin/package/Cn_package/packageList';
$route['admin/package-list/(:any)'] = 'admin/package/Cn_package/packageList/$1';
$route['admin/add-package'] = 'admin/package/Cn_package/addPackage';
$route['admin/add-package/(:any)'] = 'admin/package/Cn_package/addPackage/$1';
$route['admin/add-package-action'] = 'admin/package/Cn_package/addPackageAction';
$route['admin/view-package/(:any)'] = 'admin/package/Cn_package/viewPackage/$1';
$route['admin/delete-package/(:any)'] = 'admin/package/Cn_package/deletePackage/$1';
$route['admin/package-status/(:any)/(:any)'] = 'admin/package/Cn_package/packageeStatusChange/$1/$2';

// #registered-purohit
// $route['admin/registered-purohit-list'] = 'admin/registered_purohit/Cn_registered_purohit/registered_purohit_list';
// $route['admin/registered-purohit-list/(:any)'] = 'admin/registered_purohit/Cn_registered_purohit/registered_purohit_list/$1';
// $route['admin/add-registered-purohit'] = 'admin/registered_purohit/Cn_registered_purohit/add_registered_purohit';
// $route['admin/view-registered-purohit'] = 'admin/registered_purohit/Cn_registered_purohit/view_registered_purohit';

#registered-purohit
$route['admin/registered-purohit-list'] = 'admin/registered_purohit/Cn_registered_purohit/registered_purohit_list';
$route['admin/registered-purohit-list/(:any)'] = 'admin/registered_purohit/Cn_registered_purohit/registered_purohit_list/$1';
$route['admin/registered-purohit-status-change/(:any)/(:any)'] = 'admin/registered_purohit/Cn_registered_purohit/registeredPurohitStatusChange/$1/$2';
$route['admin/add-registered-purohit'] = 'admin/registered_purohit/Cn_registered_purohit/addRegisteredPurohit';
$route['admin/add-registered-purohit/(:any)/(:any)'] = 'admin/registered_purohit/Cn_registered_purohit/addRegisteredPurohit/$1/$2';
$route['admin/add-registered-purohit-action'] = 'admin/registered_purohit/Cn_registered_purohit/addRegisteredPurohitAction';
$route['admin/view-registered-purohit/(:any)'] = 'admin/registered_purohit/Cn_registered_purohit/viewRegisteredPurohit/$1';
$route['admin/delete-registered-purohit/(:any)'] = 'admin/registered_purohit/Cn_registered_purohit/deleteRegisteredPurohit/$1';

#customers
$route['admin/export-to-excel-customer']    = 'admin/customers/Cn_customers/export_to_excel_customer';
$route['admin/customers-list']              = 'admin/customers/Cn_customers/customers_list';
$route['admin/customers-list/(:any)']       = 'admin/customers/Cn_customers/customers_list/$1';
$route['admin/view-customers/(:any)']       = 'admin/customers/Cn_customers/view_customers/$1';
$route['admin/registered-customer-status-change/(:any)/(:any)'] = 'admin/customers/Cn_customers/registeredCustomerStatusChange/$1/$2';
$route['admin/delete-registered-customer/(:any)'] = 'admin/customers/Cn_customers/deleteRegisteredCustomer/$1';

#pooja-booking
$route['admin/pooja-booking-export-to-excel/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/pooja_booking_export_to_excel/$1';

$route['admin/pending-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/pending_pooja_booking_list';
$route['admin/admin-assign-purohit'] = 'admin/pooja_booking/Cn_pooja_booking/admin_assign_purohit';
$route['admin/pending-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/pending_pooja_booking_list/$1';
$route['admin/view-pending-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_pending_pooja_booking/$1';
$route['admin/delete-pending-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/delete_pending_booking/$1';

$route['admin/todays-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/todays_pooja_booking_list';
$route['admin/todays-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/todays_pooja_booking_list/$1';
$route['admin/view-todays-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_todays_pooja_booking/$1';
$route['admin/delete-todays-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/delete_todays_pooja_booking/$1';

$route['admin/upcoming-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/upcoming_pooja_booking_list';
$route['admin/upcoming-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/upcoming_pooja_booking_list/$1';
$route['admin/view-upcoming-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_upcoming_pooja_booking/$1';
$route['admin/delete-upcoming-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/delete_upcoming_pooja_booking_list/$1';

$route['admin/completed-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/completed_pooja_booking_list';
$route['admin/completed-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/completed_pooja_booking_list/$1';
$route['admin/view-completed-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_completed_pooja_booking/$1';
$route['admin/delete-completed-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/delete_completed_pooja_booking/$1';

$route['admin/cancelled-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/cancelled_pooja_booking_list';
$route['admin/cancelled-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/cancelled_pooja_booking_list/$1';
$route['admin/view-cancelled-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_cancelled_pooja_booking/$1';
$route['admin/delete-cancelled-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/delete_cancelled_pooja_booking/$1';

$route['admin/reject-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/rejected_pooja_booking_list';
$route['admin/reject-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/rejected_pooja_booking_list/$1';
$route['admin/view-rejected-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_rejected_pooja_booking/$1';
$route['admin/delete-rejected-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/delete_rejected_pooja_booking/$1';

$route['admin/refund-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/refund_pooja_booking_list';
$route['admin/refund-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/refund_pooja_booking_list/$1';
$route['admin/view-refund-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_refund_pooja_booking/$1';
$route['admin/add-refund/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/add_refund/$1';

$route['admin/missed-pooja-booking-list'] = 'admin/pooja_booking/Cn_pooja_booking/missed_pooja_booking_list';
$route['admin/missed-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/missed_pooja_booking_list/$1';
$route['admin/view-missing-pooja-booking/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/view_missed_pooja_booking/$1';
$route['admin/delete-missing-pooja-booking-list/(:any)'] = 'admin/pooja_booking/Cn_pooja_booking/delete_missed_pooja_booking/$1';

#payment-history
$route['admin/payment-history'] = 'admin/payment_history/Cn_payment_history/payment_history';
$route['admin/payment-history-export-to-excel'] = 'admin/payment_history/Cn_payment_history/payment_history_export_to_excel';
$route['admin/payment-history/(:any)'] = 'admin/payment_history/Cn_payment_history/payment_history/$1';

#enquiry-support-requests
$route['admin/enquiry-support-requests'] = 'admin/enquiry_support_requests/Cn_enquiry_support_requests/enquiry_support_requests';
$route['admin/export-to-excel-enquiry'] = 'admin/enquiry_support_requests/Cn_enquiry_support_requests/export_to_excel_enquiry';
$route['admin/enquiry-support-requests/(:any)'] = 'admin/enquiry_support_requests/Cn_enquiry_support_requests/enquiry_support_requests/$1';
$route['admin/delete-enquiry-support-requests/(:any)'] = 'admin/enquiry_support_requests/Cn_enquiry_support_requests/delete_enquiry_support_requests/$1';
$route['admin/get-enquiry-support-data'] = 'admin/enquiry_support_requests/Cn_enquiry_support_requests/get_enquiry_support_data';
$route['admin/update-status-in-enquiry-support'] = 'admin/enquiry_support_requests/Cn_enquiry_support_requests/update_status_enquiry';

#purohit-transaction-history
$route['admin/purohit-transaction-history-list'] = 'admin/purohit_transaction_history/Cn_purohit_transaction_history/purohit_transaction_history_list';
$route['admin/purohit-transaction-history-list/(:any)'] = 'admin/purohit_transaction_history/Cn_purohit_transaction_history/purohit_transaction_history_list/$1';
$route['admin/add-purohit-transaction-history'] = 'admin/purohit_transaction_history/Cn_purohit_transaction_history/add_purohit_transaction_history';
$route['admin/add-purohit-transaction-action'] = 'admin/purohit_transaction_history/Cn_purohit_transaction_history/add_purohit_transaction_history_action';

$route['admin/pooja-booking-report'] = 'admin/report/Cn_report/pooja_booking_report';

$route['admin/customers-report'] = 'admin/report/Cn_report/report_customers';

$route['admin/enquiry-report'] = 'admin/report/Cn_report/report_enquiry';

$route['admin/payment-history-report'] = 'admin/report/Cn_report/report_payment_history';

$route['admin/transaction-history-report'] = 'admin/report/Cn_report/report_transaction_history';

# Customer Reviews 
$route['admin/customer-reviews'] = 'admin/customers/Cn_customer_review/index';
$route['admin/status-customer-reviews/(:num)/(:num)'] = 'admin/customers/Cn_customer_review/status/$1/$2';
$route['admin/delete-customer-reviews/(:num)'] = 'admin/customers/Cn_customer_review/delete/$1';

# front_routes
include FCPATH.'application/config/front_routes.php';
#android Route
include FCPATH.'application/config/android_routes.php';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
