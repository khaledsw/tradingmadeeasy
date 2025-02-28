<?php
// Heading
$_['heading_title']       		  = 'Shipment Order Tracking';

// Tab
$_['tab_setting']         		  = 'Settings';
$_['tab_carrier']         		  = 'Carriers';
$_['tab_order_comment']           = 'Order Comment Template';
$_['tab_help']           		  = 'Help';

// Text
$_['text_module']         		  = 'Modules';
$_['text_success']        		  = 'Success: You have modified module Order Tracking!';
$_['text_edit']         		  = 'Edit Order Tracking!';

// Entry
$_['entry_status']				  = 'Extension Status';
$_['entry_order_status_shipped']  = 'Shipped order status';
$_['entry_carrier_name']          = 'Carrier Company Name';
$_['entry_tracking_url']          = 'Tracking URL';
$_['entry_comment_template']      = 'Comment Template';

// Help
$_['help_shipped_order_status']   = 'Choose order status Shipped';
$_['help_tracking_url']           = 'Ex: http://www.trackingcompany.com/search&track_no={tracking_number}';
$_['help_keywords']        		  = 'In comment you can use custom keywords: {carrier_name} {tracking_number} {tracking_url}';
$_['help_comment']        		  = 'Package was delivered using {carier_name}<br /><br />Details below:<br />Carrier: {carrier_name}<br />Tracking Number: {tracking_number}<br /><br />Find more details on {tracking_url}';

// Button
$_['button_add_carrier']          = 'Add Carrier';
$_['button_remove_carrier']       = 'Remove Carrier';

// Error
$_['error_permission']    		  = 'Warning: You do not have permission to modify module Shipment Order Tracking!';
$_['error_in_tab']                = 'Found errors in tab %s. Please check again!';
$_['error_order_status_shipped']  = 'Error: Please choose order status \'Shipped\'!';
$_['error_carrier_name']   		  = 'Error: Please add carrier name!';
$_['error_tracking_url']   		  = 'Error: Tracking URL is required!';
$_['error_tracking_url_no_number']= 'Error: Parameter {tracking_number} can\'t be found in Tracking URL!';
$_['error_order_comment']         = 'Error: Order comment is required!';
$_['error_general']               = 'Errors founded. Please check all tabs to find details!';
$_['error_carriers']              = 'No carriers added';
?>