<?php 
    session_start();
    $connection = mysqli_connect("localhost","root","","vrdb");
    // database
    // =========================================================
    // Declare
    
    $url = 'http://localhost/virtual_tour/home/html';

// Define Date
date_default_timezone_set("Asia/Manila");
$date = new DateTime();
$dateResult = $date->format('Y-m-d H:i:s');
$dateOnlyResult = $date->format('Y-m-d');
$dateOnlyResultYear = $date->format('Y');
$dateOnlyResultMonth = $date->format('m');
$dateOnlyResultDay = $date->format('d');

function TMP_HEAD($params = [])
{
    $printItems = '';
    
    if( isset($params['style']) )
        $printItems .= $params['style'];

    if( isset($params['link']) ) 
    {
        if( is_array($params['link']) ){
            foreach($params['link'] as $key) {
                $printItems .= "<link href='{$key}' rel='stylesheet'>";
            }
        }else{
            $printItems .= "<link href='{$params['link']}' rel='stylesheet'>";
        }
            
    }

    if( isset($params['script']) ) 
    {
        if( is_array($params['script']) ){
            foreach($params['script'] as $key) {
                $printItems .= "<script src='{$key}'> </script>";
            }
        }else{
            $printItems .= "<script src='{$params['script']}'> </script>";
        }
            
    }
    return include_once('inc/header.php');
}


function TMP_FOOTER()
{
    return include_once('inc/footer.php');
}

function TMP_CLOSE()
{
    echo <<<EOF
        </body>
    </html>
    EOF;
}


function TMP_MSG($type = 'success' , $message ='Update Success.')
{
    if( !empty($message) )
    {
        if( $type == 'succes' ){
            TMP_MSG_OK($message);
        }else{
            TMP_MSG_ERR($message);
        }
    }
    
}

function TMP_MSG_OK($message = 'Update Success.')
{
    print <<<EOF
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-success text-light">
                        <h2>{$message}</h2>
                    </div>
                </div>
            </div>
        </div>
    EOF;
}

function TMP_MSG_ERR($message = 'Update Error')
{
    print <<<EOF
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-danger text-light">
                        <h2>{$message}</h2>
                    </div>
                </div>
            </div>
        </div>
    EOF;
}

function dump($data)
{
    echo '<pre>';
    var_dump($data);
    die();
}


function cleanParams(&$params)
{   
    if( !is_array($params) ){
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $params);
    }
    
    foreach($params as $key => $row)
    {
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

        $params[$key] = str_replace($search, $replace, $row);
    }
}

function userIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function getLocation($user_ip)
{
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$user_ip));
    return $query;
}

function genRandomString( $length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $length ; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}