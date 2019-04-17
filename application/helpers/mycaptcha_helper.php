<?php

function generateCaptcha($form_name)
{
    $ci = & get_instance();

    $ci->load->helper('captcha');

    $config = array(
        'img_path'      => './captcha/',
        'img_url'       => base_url() . 'captcha/',
        'font_path'     => './assets/fonts/Roboto-Regular.ttf',
        'img_width'     => '250',
        'img_height'    => 80,
        'expiration'    => 7200,
        'word_length'   => 2,
        'font_size'     => 26,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
            'background' => array(255, 255, 255),
            'border' => array(255, 255, 255),
            'text' => array(0, 0, 0),
            'grid' => array(255, 40, 40)
        )
    );

    $captcha = create_captcha($config);

    $captcha_word = $captcha['word'];

    // store in session

    $session_key = $form_name . '_captcha'; // produce create_ticket_captcha

    $ci->session->set_userdata($session_key, $captcha_word);

    return $captcha;
}