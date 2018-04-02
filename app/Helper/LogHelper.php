<?php
namespace App\Helper;

use Carbon\Carbon;

class LogHelper{
    //错误回调日志
    static public function logError($data, $error_msg, $from=null, $type=null)
    {
        $log = "[error] [" . $from . '] [' .$type . "] [" . Carbon::now() . "] \n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        $log .= "Error Message: " . $error_msg . "\n";
        $date = date('Y_m_d');
        $file_path = storage_path('logs/api_error_'. $date .'.log');
        file_put_contents($file_path, $log, FILE_APPEND);
    }

    //成功回掉日志
    static public function logSuccess($data, $from=null, $type=null)
    {
        $log = "[ SUCCESS ] [" . $from . '] [' .$type . "] [" . Carbon::now() . "] \n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        $date = date('Y_m_d');
        $file_path = storage_path('logs/api_success_'. $date .'.log');
        file_put_contents($file_path, $log, FILE_APPEND);
    }
    //渠道成功访问日志
    static public function logChannelSuccess($data, $from=null, $type=null)
    {
        $log = "[ SUCCESS ] [" . $from . '] [' .$type . "] [" . Carbon::now() . "] \n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        $date = date('Y_m_d');
        $file_path = storage_path('logs/channel_success_'. $date .'.log');
        file_put_contents($file_path, $log, FILE_APPEND);
    }
    //渠道失败访问日志
    static public function logChannelError($data, $from=null, $type=null)
    {
        $log = "[ SUCCESS ] [" . $from . '] [' .$type . "] [" . Carbon::now() . "] \n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        $date = date('Y_m_d');
        $file_path = storage_path('logs/channel_error_'. $date .'.log');
        file_put_contents($file_path, $log, FILE_APPEND);
    }
    //yunda访问日志
    static public function logInsure($data, $from=null, $type=null)
    {
        $log = "[ Insure_info ] [" . $from . '] [' .$type . "] [" . Carbon::now() . "] \n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        $date = date('Y_m_d');
        $file_path = storage_path('logs/yunda/channel_error_'. $date .'.log');
        file_put_contents($file_path, $log, FILE_APPEND);
    }
    //渠道失败访问日志
    static public function logPay($data, $from=null, $type=null)
    {
        $log = "[ YD_PAY ] [" . $from . '] [' .$type . "] [" . Carbon::now() . "] \n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        $date = date('Y_m_d');
        $file_path = storage_path('logs/yunda_pay_'. $date .'.log');
        file_put_contents($file_path, $log, FILE_APPEND);
    }
    static public function logs($data, $from=null, $type=null,$file_name='laravel_logs')
    {
        $log = "[ ".$file_name." ] [" . $from . '] [' .$type . "] [" . Carbon::now() . "] \n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        $date = date('Y_m_d');
        $file_path = storage_path('logs/'.$file_name.'_'. $date .'.log');
        file_put_contents($file_path, $log, FILE_APPEND);
    }

}









