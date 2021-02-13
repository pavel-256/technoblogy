<?php
require_once 'db_config.php';

if (!function_exists('old')) {
    /**
     *
     * Return last input vlaue a field
     *
     * @param    string  $fn The field name
     * @return   string
     *
     */

    function old($fn)
    {
        return $_REQUEST[$fn] ?? '';
    }
}

if (!function_exists('csrf')) {
    /**
     *
     * Generate random string for security
     *
     *
     * @return      string
     *
     */
    function csrf()
    {
        $token = sha1(rand(1, 1000) . '$$' . rand(1, 1000) . 'tecnoblogy');
        $_SESSION['csrf_token'] = $token;
        return $token;
    }
}

if (!function_exists('user_auth')) {

    /**
     *
     *Compares the IP address and AGENT created by the SESSION with IP and AGENT
     * from the server to be sure it is the same user
     *
     *  @return     boolean
     *
     */
    function user_auth()
    {

        $auth = false;
        if (isset($_SESSION['user_id'])) {
            if (isset($_SESSION['user_ip']) && $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) {
                if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {
                    return true;
                }
            }
        }

        return $auth;
    }
}

if (!function_exists('email_exist')) {

    /**
     *
     * Sends a query that  Checks if user ditail already exist
     *
     *  @param    string  $link  conection to the MYSQLI
     *  @param    string  $email user input
     *  @return    boolean
     *
     */

    function email_exist($link, $email)
    {

        $exist = false;
        $sql = "SELECT email FROM users WHERE email  = '$email'";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $exist = true;
        }

        return $exist;
    }
}
