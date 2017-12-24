<?php
/**
 * Created by PhpStorm.
 * User: chenxiaowang
 * Date: 12/20/17
 * Time: 12:36 AM
 */
/** * * 后台权限拦截钩子   */
class ManageAuth {
    private $CI;
    public function __construct() {   $this->CI = &get_instance(); }
    /**     * 权限认证     */

    public function auth() {
        $this->CI->load->helper('url');
        if ( preg_match("/back.*/i", uri_string()) ) {        // 需要进行权限检查的URL
                       $this->CI->load->library('session');
                       if( !$this->CI->session->userdata('#2017WoW$') ) {
                           redirect('nimda');
                           return;
                       }        }
                            }
                    }
?>