<?php
if ( is_page( 'donate' ) ) :
    add_filter( 'forminator_custom_form_submit_field_data', 'dutchtown_paypal_redirect', 10, 2);
endif;

function dutchtown_paypal_redirect( $field_data_array, $form_id )
{
    $data = $field_data_array;
    $newdata = array();
    foreach ( $data as $d ) :
        $newdata[$d['name']] = $d['value'];
    endforeach;

    if ( array_key_exists( 'checkbox-1', $newdata ) ) :
        $recur = 'yes';
    else :
        $recur = 'no';
    endif;

    if ( array_key_exists( 'calculation-2', $newdata ) ) :
        $amt = $newdata['calculation-2']['result'];
    else :
        if ( $newdata['radio-1'] == 'other' ) :
            $amt = $newdata['currency-1'];
        else :
            $amt = $newdata['radio-1'];
        endif;
    endif;

    $action = 'https://www.paypal.com/cgi-bin/webscr?';
    $action .= 'return=https://www.dutchtownstl.org/donate/thanks/';
    $action .= '&tax=0';
    $action .= '&amp;currency=USD';
    $action .= '&item_name=Donation&quantity=1';
    $action .= '&amount=' . $amt;
    if ( $recur == 'yes' ) :
        $action .= '&src=1&t3=M&p3=1&a3=' . $amt;
        $action .= '&cmd=_xclick-subscriptions';
    else : 
        $action .= '&cmd=_xclick';
    endif;
    $action .='&business=' . $newdata['hidden-1'];
    header( 'Location: ' . $action );
    // echo urlencode( $action );
    // echo '<br>' . $action;
    // echo '<pre>' . print_r( $newdata );
    return $field_data_array;
}