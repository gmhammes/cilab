<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * Uma estrutura de desenvolvimento de aplicações de código aberto para PHP 5.1.6 ou mais recente
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright           Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Form Declaration
 *
 * Creates the opening portion of the form.
 *
 * @access	public
 * @param	string	the URI segments of the form destination
 * @param	array	a key/value pair of attributes
 * @param	array	a key/value pair hidden data
 * @return	string
 */
// ------------------------------------------------------------------------

/**
 * Date my_form_date Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 * 
 * C:\xampp\htdocs\cilab\v1\cilab\application\helpers\my_form_helper.php
 */
if (!function_exists('my_form_date')) {

    function my_form_date($data = '', $value = '', $extra = '') {
        $defaults = array('type' => 'date', 'name' => ((!is_array($data)) ? $data : ''), 'value' => $value);
        return "<input " . _parse_form_attributes($data, $defaults) . $extra . " />";
    }

}
// ------------------------------------------------------------------------

/**
 * Date my_convert_date Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if (!function_exists('my_convert_date')) {

    function my_convert_date($data = NULL) {
        if ($data !== NULL) {
            $data = implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
        } else {
            $data = NULL;
        }
        return($data);
    }

}
// ------------------------------------------------------------------------

/**
 * Date my_form_session Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if (!function_exists('my_form_session_admin')) {

    function my_form_session_admin() {
        $_SESSION['bol_admin'] = TRUE;
        $my_form_session = $_SESSION['bol_admin'];
        return($my_form_session);
    }

}
// ------------------------------------------------------------------------

/* End of file form_helper.php */
/* Location: ./system/helpers/form_helper.php */
