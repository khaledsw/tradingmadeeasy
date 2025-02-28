<?php
// Heading
$_['heading_title']       		= 'Abandoned Cart Reminder Pro';

// Tab
$_['tab_overview']        		= 'Overview';
$_['tab_setting']         		= 'General Settings';
$_['tab_coupon']          		= 'Coupon Settings';
$_['tab_email']           		= 'Email Template';
$_['tab_abandoned_cart']  		= 'Abandoned Carts';
$_['tab_history']         		= 'Reminders History';
$_['tab_help']            		= 'Help';

// Column
$_['column_customer']     		= 'Customer';
$_['column_cart_content'] 		= 'Cart Content';
$_['column_last_visit']   		= 'Last Action';
$_['column_reminder_sent']		= 'Reminders sent';
$_['column_reward_sent']  		= 'Rewards sent';
$_['column_coupon_code']  		= 'Coupon code';
$_['column_coupon_used']  		= 'Used?';
$_['column_email']        		= 'Reminder';
$_['column_date_sent']   		= 'Date sent';
$_['column_action']       		= 'Action';

// Button
$_['button_preview']      		= 'Preview';
$_['button_send']         		= 'Send now';
$_['button_view_reminder']		= 'View reminder';
$_['button_send_all']     		= 'Send to all';
$_['button_refresh']     		= 'Refresh List';

// Text
$_['text_module']               = 'Modules';
$_['text_success']              = 'Success: You have modified module Abandoned Cart Reminder Pro!';
$_['text_edit']                 = 'Edit Abandoned Cart Reminder Pro';

$_['text_total_recovered']      = 'Until now Abandoned Cart Reminder recovered <strong>%s</strong> from your customers';
$_['text_hours']                = 'hours';
$_['text_days']                 = 'days';
$_['text_fixed']         		= 'Fixed Amount';
$_['text_percent']       		= 'Percentage';
$_['text_all_products']         = 'Any product';
$_['text_cart_products']        = 'ONLY for products from abandoned cart';
$_['text_special_keyword']      = '<strong>{firstname}</strong> = customer firstname<br /><strong>{lastname}</strong> = customer lastname<br /><strong>{shopping_cart_content}</strong> = content of customer shopping cart<br /><strong>{coupon_code}</strong> = coupon code generated for customer<br /><strong>{discount}</strong> = value of coupon (EX: $10 or 10%)<br /><strong>{total_amount}</strong> = required order value before coupon is valid<br /><strong>{validity_days}</strong> = how many days coupon is valid<br /><strong>{store_name}</strong> = your store name';
$_['text_send_all']             = 'To send reminders (manually) to all customer you can use button "<i class="fa fa-mail-forward"></i>" from right side';

$_['text_reminder_preview']     = 'Reminder Preview';
$_['text_reminder_send']        = 'Reminder Send';
$_['text_reminder_message']     = 'Reminder Message';

// Entry
$_['entry_secret_code']       	= 'Secret code';
$_['entry_delay']             	= 'Delay';
$_['entry_max_reminders']     	= 'Max reminders';
$_['entry_hide_out_stock']    	= 'Hide Out of stock product';
$_['entry_use_html_email']   	= 'Send Reminder with <a href="http://www.oc-extensions.com/HTML-Email">HTML Email Extension</a>';
$_['entry_log_admin']         	= 'Send Log to admin';
$_['entry_add_coupon']        	= 'Add coupon';
$_['entry_coupon_type']       	= 'Coupon type';
$_['entry_coupon_amount']    	= 'Discount amount'; 
$_['entry_coupon_total']      	= 'Required order total'; 
$_['entry_coupon_expire']     	= 'Coupon expire after';
$_['entry_coupon_usage']      	= 'Coupon usage';
$_['entry_reward_limit']      	= 'Reward max times';
$_['entry_subject']           	= 'Subject';
$_['entry_special_keyword']   	= 'Special Keywords';
$_['entry_message_reward']    	= 'Message (with discount)';
$_['entry_message_no_reward']	= 'Message (without discount)';

// Entry History List
$_['entry_customer']     		= 'Customer';
$_['entry_coupon_code']  		= 'Coupon code';
$_['entry_email']        		= 'Email';
$_['entry_date_sent']   		= 'Date sent';

// Help
$_['help_secret_code']        	= 'At least 5 characters! ( a-z, A-Z, 0-9 ).<br />Required for Cron Job';
$_['help_delay']              	= 'Number of hours after cart is considered inactive and can be sent an reminder';
$_['help_max_reminders']     	= 'Maximum number of reminders that can be sent if customer don\'t read/react.<br /> Recommended max = 3';
$_['help_hide_out_stock'] 	    = 'Hide in reminder (email) products with stock (quantity) = 0';
$_['help_use_html_email']     	= 'If HTML Email Extension is not installed on your store then is used default html mail (like in old versions of this extension)';
$_['help_log_admin']          	= 'Admin receive an email with list of customers informed about abandoned cart';
$_['help_add_coupon']         	= 'Add coupon to encourage customer to buy';
$_['help_coupon_total']       	= 'Order total amount that must reached before the coupon is valid.<br />Leave blank to ignore this option'; 
$_['help_reward_limit']       	= 'How many times customer can be rewarded with coupons?<br />Leave blank = unlimited';
$_['help_special_keyword']   	= 'For email message you can use special keywords';
$_['help_message_reward']    	= 'Message used when coupon is attached';
$_['help_message_no_reward'] 	= 'Message used when customer is just notified about his cart (Add coupon = Disabled OR customer already received max number of rewards)';
 
 
// Error
$_['error_permission']        	= 'Warning: You do not have permission to modify module Abandoned Cart Reminder Pro!';
$_['error_in_tab']              = 'Abandoned Cart Reminder Pro detected errors in tab %s. Please check again!';
$_['error_secret_code']       	= 'Secret code: at least 5 characters! ( a-z, A-Z, 0-9 )';
$_['error_delay']             	= 'Delay - required';
$_['error_html_email_not_installed'] = 'Review Invitation Emails can\'t be sent with <a href="http://www.oc-extensions.com/HTML-Email">HTML Email Extension</a> because this extension is not available on your store. Please set option to Disabled!';
$_['error_max_reminders']     	= 'Max reminder - required';
$_['error_coupon_amount']     	= 'Coupon amount - required';
$_['error_coupon_expire']     	= 'Coupon expire - required';
$_['error_subject']          	= 'Email subject - required';
$_['error_message']           	= 'Email message - required (at least 20 chars)';
?>