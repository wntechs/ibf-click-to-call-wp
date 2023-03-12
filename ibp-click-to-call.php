<?php
/**
 * @package If By Phone Click to Call
 * @version 1.0
 */
/*
Plugin Name: If By Phone Click to Call
Plugin URI: https://github.com/wntechs/ibf-click-to-call-wp
Description: Configure the If By Phone Click to Call function and display it on any pages using Shortcode or Widget
Author: Ram Kumar Kuril
Version: 1.0
Author URI: https://github.com/wntechs
*/

function ibp_admin()
{
    if ($_POST['ibp_c2c_hidden'] == 'Y') {
        //Form data sent
        update_option('ibp_api_key', $_POST['ibp_api_key']);
        update_option('ibp_type', $_POST['ibp_type']);
        update_option('ibp_id', $_POST['ibp_id']);
        update_option('ibp_first_caller_id', $_POST['ibp_first_caller_id']);
        update_option('ibp_second_caller_id', $_POST['ibp_second_caller_id']);
        update_option('ibp_heading', $_POST['ibp_heading']);
        update_option('ibp_btn_text', $_POST['ibp_btn_text']);



        ?>
        <div class="updated"><p><strong><?php _e('Options saved.'); ?></strong></p></div>
        <?php
    }
    $ibp_api_key = get_option('ibp_api_key');
    $ibp_type = get_option('ibp_type');
    $ibp_id = get_option('ibp_id');
    $ibp_first_caller_id = get_option('ibp_first_caller_id');
    $ibp_second_caller_id = get_option('ibp_second_caller_id');
    $ibp_heading = get_option('ibp_heading');
    $ibp_btn_text = get_option('ibp_btn_text');

    ?>

    <div class="wrap">
        <?php    echo "<h2>" . __('If By Phone Click2Call Options', 'ibp_c2c') . "</h2>"; ?>

        <form name="ibp_c2c_form" method="post"
              action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="ibp_c2c_hidden" value="Y">
            <table cellspacing="5" cellpadding="5" class="widefat" width="600">
                <thead>
                <tr>
                    <th colspan="2"><?php    echo __('API Settings', 'oscimp_trdom'); ?></th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    <td><?php _e("API Key: "); ?></td>
                    <td><input type="text" name="ibp_api_key" value="<?php echo $ibp_api_key; ?>" size="100">
                        <br>
                        <span style="color:#666;">
                                <small><?php _e(" Use Public key if 'id' is a registered number. Use API key if both 'id' and 'phone_to_call' are unregistered numbers. Remember, your API key is as important as your account ID and password so don't expose it on your site."); ?></small>
                            </span>
                    </td>
                </tr>

                <tr>
                    <td><?php _e("Type: "); ?></td>
                    <td>
                        <select name="ibp_type">
                            <option <?php echo $ibp_type == '1' ? 'selected' : ''; ?> value="1">Call Customer Number
                                first
                            </option>
                            <option <?php echo $ibp_type == '2' ? 'selected' : ''; ?> value="2">Call Agent Number
                                first
                            </option>
                        </select>

                    </td>
                </tr>

                <tr>
                    <td><?php _e("ID: "); ?></td>
                    <td>
                        <input type="text" name="ibp_id" value="<?php echo $ibp_id ?>" size="20">
                        <br>
                        <span style="color:#666;">
                                <small><?php _e(" A registered number or the main number of the account if using Public key, any number if using API key."); ?></small>
                            </span>
                    </td>
                </tr>

                <tr>
                    <td><?php _e("First Caller ID : "); ?></td>
                    <td>
                        <input type="text" name="ibp_first_caller_id" value="<?php echo $ibp_first_caller_id; ?>"
                               size="20">
                        <br>
                        <span style="color:#666;">
                                <small><?php _e(" caller ID for the first leg of the call. The number must be one of the numbers in your account, a registered number or one of the two numbers being called."); ?></small>
                            </span>
                    </td>
                </tr>

                <tr>
                    <td><?php _e("Second Caller ID : "); ?></td>
                    <td>
                        <input type="text" name="ibp_second_caller_id" value="<?php echo $ibp_second_caller_id; ?>"
                               size="20">
                        <br>
                        <span style="color:#666;">
                                <small><?php _e(" caller ID for the second leg of the call. The number must be one of the numbers in your account, a registered number or one of the two numbers being called."); ?></small>
                            </span>
                    </td>
                </tr>

                <tr>
                    <td><?php _e("Click to Call Heading : "); ?></td>
                    <td>
                        <input type="text" name="ibp_heading" value="<?php echo $ibp_heading; ?>"
                               size="100">
                        <br>
                        <span style="color:#666;">
                                <small><?php _e(" Displayed on the heading text on the click to call box"); ?></small>
                            </span>
                    </td>
                </tr>
                <tr>
                    <td><?php _e("Click to Call Button Text : "); ?></td>
                    <td>
                        <input type="text" name="ibp_btn_text" value="<?php echo $ibp_btn_text; ?>"
                               size="100">
                        <br>
                        <span style="color:#666;">
                                <small><?php _e(" Display the button text on the click to call box"); ?></small>
                            </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="button-primary" name="Submit"
                               value="<?php _e('Update Options', 'ibp_submit') ?>"/>
                    </td>
                </tr>
                </tbody>


            </table>
        </form>
        <br />
        <table cellspacing="5" cellpadding="5" class="widefat" width="600">
            <thead>
            <tr>
                <th colspan="2"><?php    echo __('How to use', 'oscimp_trdom'); ?></th>
            </tr>

            </thead>
            <tbody>
            <tr>
                <td>

                    Use the  shortcode <span style="color:#666;">
                        <strong>[ibpc2c]</strong></span> on any page or sidebar to display the Click to Call Box

                </td>

            </tr>

    </div>
    <?php
}

function ibp_admin_actions()
{
    add_options_page("IBP Click2Call", "IBP Click2Call", 1, "IBPClick2Call", "ibp_admin");
}

add_action('admin_menu', 'ibp_admin_actions');

function display_c2c()
{
    ob_start();
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <style>
        .phone_input_3{

            width: 30px;
        }
        .phone_input_4{

            width: 50px;
        }
    </style>
    <form action="#" id="click_to_call" class="form-inline" name="click_to_call">
        <div style="font-weight:bold; font-size:14px; margin-top:0px; margin-left:10px">
            <?php echo get_option('ibp_heading');  ?>
        </div>

        <div style="padding-top:6px; width: 350px; height:128px ">
            <div
                style="float:left; margin-left:10px; background-position-y:-30px; background-image:url(<?php echo plugins_url('img/phone.png', __FILE__) ?>); height:128px; width:128px"></div>
            <div  class="form-group"> &nbsp;1-
                <input type="text" name="npa" id="npa" size="2" maxlength="3" class="form-control phone_input_3"/>
                -
                <input type="text" name="nnx" id="nnx" size="2" maxlength="3" class="form-control phone_input_3"/>
                -
                <input type="text" name="line" id="line" size="4" maxlength="4" class="form-control phone_input_4"/>
            </div>
            <div style="text-align:center; margin-top:10px;"><a class="btn btn-primary" href="javascript:request_call_local()">
                    <?php echo get_option('ibp_btn_text'); ?></a>
            </div>




        </div>
    </form>

    <?php

    return ob_get_clean();
}

add_shortcode('ibpc2c', 'display_c2c');
add_action( 'wp_ajax_nopriv_ibp_c2c_action', 'ibp_c2c_action_callback' );
add_action( 'wp_ajax_ibp_c2c_action', 'ibp_c2c_action_callback' );

function ibp_c2c_action_callback() {


    $phone_to_call=$_POST['data'];
    $ibp_api_key = get_option('ibp_api_key');
    $ibp_type = get_option('ibp_type');
    $ibp_id = get_option('ibp_id');
    $ibp_first_caller_id = $ibp_type==1 ? $ibp_id: $phone_to_call;
    $ibp_second_caller_id = $ibp_type==1 ? $phone_to_call:$ibp_id;

    $params=array(
        'app' =>'ctc',
        'id'=> $ibp_id,
        'phone_to_call'=> $phone_to_call,
        'type'=> $ibp_type,
        'key'=> $ibp_api_key,
        'page' => $_SERVER['HTTP_REFERER'],
        'first_callerid'=> $ibp_first_caller_id,
        'second_callerid' =>$ibp_second_caller_id
    );
    $response=wp_remote_get( 'https://secure.ifbyphone.com/click_to_xyz.php?' . http_build_query($params),
        array( 'timeout' => 120, 'sslverify' => false ) );

    //echo 'https://secure.ifbyphone.com/click_to_xyz.php?' . http_build_query($params);die;
    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo "Something went wrong: $error_message";
    } else {

        echo $response['body'];

    }

    //echo "Request Succeeded. Please wait while we are connecting you to our agent";

    die(); // this is required to return a proper result
}

add_action( 'wp_enqueue_scripts', 'ibp_enqueue_scripts' );

function ibp_enqueue_scripts()
{
    wp_enqueue_script( 'script-name', plugins_url('js/clicktocall.js', __FILE__), array(), '1.0.0', true );
}
