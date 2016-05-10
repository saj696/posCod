<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//public pages
$config['PUBLIC_CONTROLLERS']=array('home');
/////// Pagination Config
$config['page_size']=100;
$config['page_size_option']="['100', '200', '300', '500', '1000', '1500']";
///// report language folder
$config['GET_LANGUAGE']="english";
//// upload directories
$config['file_upload']['employees']='assets/images/employees';
$config['file_upload']['store_setup']='assets/images/store_setup';
$config['file_upload']['item_pictures']='assets/images/item_pictures';

//////// USER LEVEL
$config['SUPER_ADMIN_GROUP_ID'] = 1;

///// USER TYPE
$config['USER_TYPE_GENERAL'] = 1;
$config['USER_TYPE_COUNTER'] = 2;

///// USER DATA ACCESS
$config['USER_DATA_ACCESS_ALL'] = 1;
$config['USER_DATA_ACCESS_OWN'] = 2;
$config['USER_DATA_ACCESS_GROUP'] = 3;

///////// SYSTEM STATUS VALUE
$config['STATUS_INACTIVE']=0; // TICKET PENDING
$config['STATUS_ACTIVE']=1; //
$config['STATUS_DELETE']=99;

//////// GENDER CONFIG
$config['GENDER'][1] = 'Male';
$config['GENDER'][0] = 'Female';

////// DATE FORMATION
$config['DATE_DISPLAY_FORMAT'] = 'Y-m-d';

// Equipment Status
$config['product_condition'][0] = 'ভাল';
$config['product_condition'][1] = 'ত্রুটিপূর্ণ';

// Month
$config['month']['01'] = 'জানুয়ারি';
$config['month']['02'] = 'ফেব্রুয়ারি';
$config['month']['03'] = 'মার্চ';
$config['month']['04'] = 'এপ্রিল';
$config['month']['05'] = 'মে';
$config['month']['06'] = 'জুন';
$config['month']['07'] = 'জুলাই';
$config['month']['08'] = 'আগস্ট';
$config['month']['09'] = 'সেপ্টেম্বর';
$config['month']['10'] = 'অক্টোবর';
$config['month']['11'] = 'নভেম্বর';
$config['month']['12'] = 'ডিসেম্বর';

/// Custom Page Title
$config['LOGIN_PAGE_TITLE'] = "::. Soft BD Ltd POS .::";
$config['ADMIN_PAGE_TITLE'] = "::. Soft BD Ltd POS .::";

// data_access
$config['DATA_ACCESS_OWN'] = '1';
$config['DATA_ACCESS_GROUP'] = '2';
$config['DATA_ACCESS_ALL'] = '3';

//account type
$config['ACCOUNT_TYPE_NORMAL'] = '1';
$config['ACCOUNT_TYPE_CONTRA'] = '2';

//Employee type
$config['EMPLOYEE_TYPE_EMPLOYEE'] = '1';
$config['EMPLOYEE_TYPE_SUPPLIER'] = '2';
$config['EMPLOYEE_TYPE_CUSTOMER'] = '3';

//Item type
$config['NORMAL'] = '1';
$config['ITEM_KITS'] = '2';

//unit_type
$config['ML'] = '1';
$config['L'] = '2';
$config['KG'] = '3';
$config['FEET'] = '4';

//unit_size
$config['L']='1';
$config['M']='2';
$config['S']='3';

//Track type
$config['Test'] = '1';
$config['Test2'] = '2';

//Payment Method
$config['PAYMENT_METHOD_CASH'] = '1';
$config['PAYMENT_METHOD_PERSONAL_ACCOUNT'] = '2';

//Discount Type
$config['DISCOUNT_PERCENTAGE']='1';
$config['DISCOUNT_AMOUNT']='2';




//Chart of account
$config['INCOME']='1';
$config['EXPANSE']='2';
$config['PRODUCT_PURCHASE']='201';
$config['PRODUCT_TRANSPORT_COST']='202';
$config['PRODUCT_OTHERS_COST']='203';
$config['ASSET']='3';
$config['CASH']='301';
$config['ACCOUNT_RECEIVABLE']='302';
$config['LIABILITIES']='4';
$config['ACCOUNT_PAYABLE']='401';
$config['']='';
$config['']='';

//Purchase transaction type
$config['PURCHASE']='10';
$config['PURCHASE_RETURN,']='20';
$config['PURCHASE_REPLACEMENT']='30';
$config['PURCHASE_DUE_PAYMENT']='40';
$config['PURCHASE_DUE_PAYMENT']='50';

//dr_cr_indicator
$config['CR']='1';
$config['DR']='2';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';
$config['']='';



