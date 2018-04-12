<?php

namespace App\Http\Controllers\ChannelsApiControllers;

use Illuminate\Http\Request;
use App\Helper\DoChannelsSignHelp;
use App\Helper\RsaSignHelp;
use App\Helper\AesEncrypt;
use Ixudra\Curl\Facades\Curl;
use Validator, DB, Image, Schema;
use App\Models\Channel;
use App\Models\UserChannel;
use App\Models\User;
use App\Models\UserContact;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session,Cache;
use App\Models\Order;
use App\Models\OrderParameter;
use App\Models\WarrantyPolicy;
use App\Models\WarrantyRecognizee;
use App\Models\WarrantyRule;
use \Illuminate\Support\Facades\Redis;
use App\Models\ChannelPrepareInfo;
use App\Models\ChannelOperate;
use App\Models\ChannelContract;
use App\Models\TimedTask;
use App\Helper\LogHelper;
use App\Helper\IdentityCardHelp;
use App\Helper\Issue;
use App\Jobs\YunDaPrepare;

class ChannelInfosController extends BaseController
{
    /**
     * 初始化
     *
     */
    public function __construct(Request $request)
    {
        $this->sign_help = new DoChannelsSignHelp();
        $this->signhelp = new RsaSignHelp();
        $this->request = $request;
    }

    /**
     * 
     * 获取预投保信息，存入redis队列
     * @param $this->request->all()
     * @return json
     * todo 接受信息(入队)
     */
    public function getPrepare()
    {
        set_time_limit(0);//永不超时
        $params = $this->request->all();
        $biz_content = $params['biz_content'];
        Redis::rPush("prepare_info",$biz_content);//入队操作
        //dispatch(new YunDaPrepare());
        return json_encode(['status' => '200', 'content' => '预订单信息已收到'],JSON_UNESCAPED_UNICODE);
    }

    /**
     *
     * 预投保信息处理
     * 出队，变形，投保，入库
     * todo  定时任务，处理信息（出队，变形，投保，入库）
     */
    public function insertPrepare()
   {

        $count = Redis::Llen('prepare_info');
		LogHelper::logChannelSuccess($count, 'YD_prepara_count');
        if($count<1){
            // TimedTask::insert([
                    // 'task_name'=>'yd_insure',
                    // 'task_type'=>'minutes',
                    // 'service_ip'=>'10.1.210.13',
                    // 'start_time'=>time(),
                    // 'task_time'=>'60',
                    // 'end_time'=>time(),
                    // 'timestamp'=>time(),
                    // 'status'=>'0',//执行结束
                // ]);
            die;
        }
        set_time_limit(0);//永不超时
        echo '处理开始时间'.date('Y-m-d H:i:s', time()).'<br/>';
        // LogHelper::logChannelSuccess(date('Y-m-d H:i:s', time()), 'YD_check_insure_start_time');
        $file_area = "/var/www/html/yunda.inschos.com/public/Tk_area.json";
        $file_bank = "/var/www/html/yunda.inschos.com/public/Tk_bank.json";
        $json_area = file_get_contents($file_area);
        $json_bank = file_get_contents($file_bank);
        $area = json_decode($json_area,true);
        $bank = json_decode($json_bank,true);
        for($i=0;$i<$count;$i++) {
            $value = json_decode(base64_decode(Redis::lpop('prepare_info')),true);
            foreach($value as $key=>$item){//每次1000条数据
                if(key_exists($item['channel_provinces'],$area)) {
                    $item['channel_provinces'] = $area[$item['channel_provinces']];
                }
                if(key_exists($item['channel_city'],$area)){
                    $item['channel_city'] = $area[$item['channel_city']];
                }
                if(key_exists($item['channel_county'],$area)){
                    $item['channel_county'] = $area[$item['channel_county']];
                }
                if(key_exists($item['channel_bank_name'],$bank)){
                    $item['channel_bank_name'] = $bank[$item['channel_bank_name']];
                }
                $item['operate_time'] = date('Y-m-d',time());
                //预投保操作，批量操作（定时任务）
                $idCard_status = IdentityCardHelp::getIDCardInfo($item['channel_user_code']);
                if($idCard_status['status']=='2') {
                    //TODO 判断是否已经投保
                    $channel_insure_res = ChannelOperate::where('channel_user_code',$item['channel_user_code'])
                        ->where('operate_time',$item['operate_time'])
                        ->where('prepare_status','200')
                        ->select('proposal_num')
                        ->first();
                    //已经投保的，不再投保
                    if(!empty($channel_insure_res)){
                        return 'end';
                    }
                    $insure_status = $this->doInsurePrepare($item);
					$item['operate_code'] = '实名信息正确,预投保成功';
                    // ChannelPrepareInfo::insert($item);
                }else{
					$item['operate_code'] = '实名信息出错:身份证号';	
				}
					ChannelPrepareInfo::insert($item);	
            }
        }
//        TimedTask::where('task_name','yd_insure')->update([
//            'service_ip'=>$_SERVER['SERVER_ADDR'],
//            'end_time'=>time(),
//            'status'=>'0',//执行结束
//        ]);
        echo '<br/>处理结束<br/>';
        echo '<br/>处理结束时间'.date('Y-m-d H:i:s', time());
        // LogHelper::logChannelSuccess(date('Y-m-d H:i:s', time()), 'YD_check_insure_end_time');
        return 'end';
//        }elseif($timed_task_res->status=='1'){
//            TimedTask::where('task_name','yd_insure')->update([
//                'timestamp'=>time(),
//            ]);
//            $time = $timed_task_res->timestamp;
//            if($time>time()){
//                TimedTask::where('task_name','yd_insure')->update([
//                    'end_time'=>time(),
//                    'status'=>'0',//执行结束
//                ]);
//                return 'end';
//            }
//        }
    }

    /**
     * 预投保操作
     *
     */
    public function doInsurePrepare($prepare){
		set_time_limit(0);//永不超时
        $data = [];
        $insurance_attributes = [];
        $base = [];
        $base['ty_start_date'] = $prepare['operate_time'];
        $toubaoren = [];
        $toubaoren['ty_toubaoren_name'] = $prepare['channel_user_name'];//投保人姓名
        $toubaoren['ty_toubaoren_id_type'] = $prepare['channel_user_type']??"01";//证件类型
        $toubaoren['ty_toubaoren_id_number'] = $prepare['channel_user_code'];;//证件号
        $toubaoren['ty_toubaoren_birthday'] = substr($toubaoren['ty_toubaoren_id_number'],6,4).'-'.substr($toubaoren['ty_toubaoren_id_number'],10,2).'-'.substr($toubaoren['ty_toubaoren_id_number'],12,2);
        if(substr($toubaoren['ty_toubaoren_id_number'],16,1)%2=='0'){
            $toubaoren['ty_toubaoren_sex'] = '女';
        }else{
            $toubaoren['ty_toubaoren_sex'] = '男';
        }
        $toubaoren['ty_toubaoren_phone'] = $prepare['channel_user_phone'];
        $toubaoren['ty_toubaoren_email'] = $prepare['channel_user_email'];
        $toubaoren['ty_toubaoren_provinces'] = $prepare['channel_provinces'];
        $toubaoren['ty_toubaoren_city'] = $prepare['channel_city'];
        $toubaoren['ty_toubaoren_county'] = $prepare['channel_county'];
        $toubaoren['channel_user_address'] = $prepare['channel_user_address'];
        $toubaoren['courier_state'] = $prepare['courier_state'];
        $toubaoren['courier_start_time'] = $prepare['courier_start_time'];
        $beibaoren = [];
        $beibaoren[0]['ty_beibaoren_name'] = $prepare['channel_user_name'];
        $beibaoren[0]['ty_relation'] = '1';//必须为本人
        $beibaoren[0]['ty_beibaoren_id_type'] = $prepare['channel_user_type']??"01";
        $beibaoren[0]['ty_beibaoren_id_number'] = $prepare['channel_user_code'];
        $beibaoren[0]['ty_beibaoren_birthday'] = substr($toubaoren['ty_toubaoren_id_number'],6,4).'-'.substr($toubaoren['ty_toubaoren_id_number'],10,2).'-'.substr($toubaoren['ty_toubaoren_id_number'],12,2);
        if(substr($toubaoren['ty_toubaoren_id_number'],16,1)%2=='0'){
            $beibaoren[0]['ty_beibaoren_sex'] = '女';
        }else{
            $beibaoren[0]['ty_beibaoren_sex'] = '男';
        }
        $beibaoren[0]['ty_beibaoren_phone'] = $prepare['channel_user_phone'];
        $insurance_attributes['ty_base'] = $base;
        $insurance_attributes['ty_toubaoren'] = $toubaoren;
        $insurance_attributes['ty_beibaoren'] = $beibaoren;
        $data['price'] = '2';
        $data['private_p_code'] = 'VGstMTEyMkEwMUcwMQ';
        $data['quote_selected'] = '';
        $data['insurance_attributes'] = $insurance_attributes;
        $data = $this->signhelp->tySign($data);
        //发送请求
        $response = Curl::to(env('TY_API_SERVICE_URL') . '/ins_curl/buy_ins')
            ->returnResponseObject()
            ->withData($data)
            ->withTimeout(60)
            ->post();
        if($response->status != 200){
            ChannelOperate::insert([
                'channel_user_code'=>$prepare['channel_user_code'],
                'prepare_status'=>'500',
                'prepare_content'=>$response->content,
                'operate_time'=>date('Y-m-d',time()),
                'created_at'=>date('Y-m-d H:i:s',time()),
                'updated_at'=>date('Y-m-d H:i:s',time())
            ]);
            $content = $response->content;
            $return_data =  json_encode(['status'=>'501','content'=>$content],JSON_UNESCAPED_UNICODE);
            return $return_data;
        }
        $prepare['parameter'] = '0';
        $prepare['private_p_code'] = 'VGstMTEyMkEwMUcwMQ';
        $prepare['ty_product_id'] = 'VGstMTEyMkEwMUcwMQ';
        $prepare['agent_id'] = '0';
        $prepare['ditch_id'] = '0';
        $prepare['user_id'] = $prepare['channel_user_code'];
        $prepare['identification'] = '0';
        $prepare['union_order_code'] = '0';
        $return_data = json_decode($response->content, true);
        //todo  本地订单录入
        $add_res = $this->addOrder($return_data, $prepare,$toubaoren);
        if($add_res){
            $return_data =  json_encode(['status'=>'200','content'=>'投保完成'],JSON_UNESCAPED_UNICODE);
            return $return_data;
        }
    }

    /**
     * 对象转化数组
     *
     */
    public function object2array($object) {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        }
        else {
            $array = $object;
        }
        return $array;
    }

    /**
     * 添加投保返回信息
     *
     */
    protected function addOrder($return_data, $prepare, $policy_res)
    {
        try{
            //查询是否在竞赛方案中
            $private_p_code = $prepare['private_p_code'];
            $competition_id = 0;
            $is_settlement = 0;
            $ditch_id = $prepare['ditch_id'];
            $agent_id = $prepare['agent_id'];
            //订单信息录入
            foreach ($return_data['order_list'] as $order_value){
                $order = new Order();
                $order->order_code = $order_value['union_order_code']; //订单编号
                $order->user_id = isset($_COOKIE['user_id'])?$_COOKIE['user_id']:' ';//用户id
                $order->agent_id = $agent_id;
                $order->competition_id = $competition_id;//竞赛方案id，没有则为0
                $order->private_p_code = $private_p_code??"VGstMTEyMkEwMUcwMQ";
                $order->ty_product_id = $prepare['ty_product_id']??"15";
                $order->start_time = isset($order_value['start_time'])?$order_value['start_time']: ' ';
                $order->claim_type = 'online';
                $order->deal_type = 0;
                $order->is_settlement = $is_settlement;
                $order->premium = $order_value['premium'];
                $order->status = config('attribute_status.order.unpayed');
                $order->pay_way = json_encode($return_data['pay_way']);
                $order->save();
            }
            //投保人信息录入
            $warrantyPolicy = new WarrantyPolicy();
            $warrantyPolicy->name = isset($policy_res['ty_toubaoren_name'])?$policy_res['ty_toubaoren_name']:'';
            $warrantyPolicy->card_type = isset($policy_res['ty_toubaoren_id_type'])?$policy_res['ty_toubaoren_id_type']:'';
            $warrantyPolicy->occupation = isset($policy_res['ty_toubaoren_occupation'])?$policy_res['ty_toubaoren_occupation']:'';//投保人职业？？
            $warrantyPolicy->code = isset($policy_res['ty_toubaoren_id_number'])?$policy_res['ty_toubaoren_id_number']:'';
            $warrantyPolicy->phone =  isset($policy_res['ty_toubaoren_phone'])?$policy_res['ty_toubaoren_phone']:'';
            $warrantyPolicy->email =  isset($policy_res['ty_toubaoren_email'])?$policy_res['ty_toubaoren_email']:'';
            $warrantyPolicy->area =  isset($policy_res['ty_toubaoren_area'])?$policy_res['ty_toubaoren_area']:'';
            $warrantyPolicy->status = config('attribute_status.order.check_ing');
            $warrantyPolicy->save();
            //用户信息录入
            $user_check_res  = User::where('code',$policy_res['ty_toubaoren_id_number'])
                ->where('phone',$policy_res['ty_toubaoren_phone'])
                ->first();
            if(empty($user_check_res)){
                $user_res = new User();
                $user_res->name = isset($policy_res['ty_toubaoren_name'])?$policy_res['ty_toubaoren_name']:'';
                $user_res->real_name = isset($policy_res['ty_toubaoren_name'])?$policy_res['ty_toubaoren_name']:'';
                $user_res->phone = isset($policy_res['ty_toubaoren_phone'])?$policy_res['ty_toubaoren_phone']:'';
                $user_res->code = isset($policy_res['ty_toubaoren_id_number'])?$policy_res['ty_toubaoren_id_number']:'';
                $user_res->email =  isset($policy_res['ty_toubaoren_email'])?$policy_res['ty_toubaoren_email']:'';
                $user_res->occupation = isset($policy_res['ty_toubaoren_occupation'])?$policy_res['ty_toubaoren_occupation']:'';
                $user_res->address = isset($policy_res['ty_toubaoren_area'])?$policy_res['ty_toubaoren_area']:'';
                $user_res->type = 'user';
                $user_res->password = bcrypt('123qwe');
            }

            //被保人信息录入
            foreach ($return_data['order_list'] as $recognizee_value){
                $warrantyRecognizee = new WarrantyRecognizee();
                $warrantyRecognizee->name = $recognizee_value['name'];
                $warrantyRecognizee->order_id = $order->id;
                $warrantyRecognizee->order_code = $recognizee_value['out_order_no'];
                $warrantyRecognizee->relation = $recognizee_value['relation'];
                $warrantyRecognizee->occupation =isset($recognizee_value['occupation'])?$recognizee_value['occupation']: '';
                $warrantyRecognizee->card_type = isset($recognizee_value['card_type'])?$recognizee_value['card_type']: '';
                $warrantyRecognizee->code = isset($recognizee_value['card_id'])?$recognizee_value['card_id']: '';
                $warrantyRecognizee->phone = isset($recognizee_value['phone'])?$recognizee_value['phone']: '';
                $warrantyRecognizee->email = isset($recognizee_value['email'])?$recognizee_value['email']: '';
                $warrantyRecognizee->start_time = isset($recognizee_value['start_time'])?$recognizee_value['start_time']: '';
                $warrantyRecognizee->end_time = isset($recognizee_value['end_time'])?$recognizee_value['end_time']: '';
                $warrantyRecognizee->status = config('attribute_status.order.unpayed');
                $warrantyRecognizee->save();
                //用户信息录入
                $user_check_res  = User::where('code',$recognizee_value['card_id'])
                    ->where('real_name',$recognizee_value['name'])
                    ->first();
                if(empty($user_check_res)){
                    $user_res = new User();
                    $user_res->name = $recognizee_value['name'];
                    $user_res->real_name = $recognizee_value['name'];
                    $user_res->phone = isset($recognizee_value['phone'])?$recognizee_value['phone']: '';
                    $user_res->code = isset($recognizee_value['card_id'])?$recognizee_value['card_id']: '';
                    $user_res->email =  isset($recognizee_value['email'])?$recognizee_value['email']: '';
                    $user_res->occupation = isset($recognizee_value['occupation'])?$recognizee_value['occupation']: '';
                    $user_res->address =isset($recognizee_value['address'])?$recognizee_value['address']: '';
                    $user_res->type = 'user';
                    $user_res->password = bcrypt('123qwe');
                }
            }
            //添加投保参数到参数表
            $orderParameter = new OrderParameter();
            $orderParameter->parameter = $prepare['parameter'];
            $orderParameter->order_id = $order->id;
            $orderParameter->ty_product_id = $order->ty_product_id;
            $orderParameter->private_p_code = $private_p_code;
            $orderParameter->save();
            //添加到关联表记录
            $WarrantyRule = new WarrantyRule();
            $WarrantyRule->agent_id = $agent_id;
            $WarrantyRule->ditch_id = $ditch_id;
            $WarrantyRule->order_id = $order->id;
            $WarrantyRule->ty_product_id = "15";
            $WarrantyRule->private_p_code = "VGstMTEyMkEwMUcwMQ";
            $WarrantyRule->premium = $order->premium;
            $WarrantyRule->union_order_code = $return_data['union_order_code'];//总订单号
            $WarrantyRule->parameter_id = $orderParameter->id;
            $WarrantyRule->policy_id = $warrantyPolicy->id;
            $WarrantyRule->private_p_code = $private_p_code;   //预留
            $WarrantyRule->save();
            //添加到渠道用户操作表
            $ChannelOperate = new ChannelOperate();
            $ChannelOperate->channel_user_code = $policy_res['ty_toubaoren_id_number'];
            $ChannelOperate->order_id = $order->id;
            $ChannelOperate->proposal_num = $return_data['union_order_code'];
            $ChannelOperate->prepare_status = '200';
            $ChannelOperate->operate_time = date('Y-m-d',time());
            $ChannelOperate->save();
            DB::commit();
            return true;
        }catch (\Exception $e)
        {
            DB::rollBack();
            LogHelper::logChannelError([$return_data, $prepare], $e->getMessage(), 'addOrder');
            return false;
        }
    }

    /**
     * 测试处理预投保信息
     *
     */
    public  function testPrepare(){
        $res = ChannelPrepareInfo::where('channel_user_name','林敏丽')->first();
        $res = json_encode($res);
        print_r($res);
    }

    /**
     * 微信代扣支付
     * 定时任务，跑支付
     */
    public function insureWechatPay(){
        set_time_limit(0);//永不超时
        $channel_contract_info = ChannelContract::where('is_valid','0')//有效签约
            ->where('is_auto_pay','0')
            ->select('openid','contract_id','contract_expired_time','channel_user_code')
            //openid,签约协议号,签约过期时间,签约人身份证号
            ->get();
        //循环请求，免密支付
        foreach ($channel_contract_info as $value){
            $person_code  = $value['channel_user_code'];
            $channel_res = ChannelOperate::where('channel_user_code',$person_code)
                ->where('prepare_status','200')//预投保成功
                ->where('operate_time',date('Y-m-d',time()-24*3600))//前一天的订单
                ->where('is_work','1')//已上工
                ->select('proposal_num')
                ->first();
            $union_order_code = $channel_res['proposal_num'];
            $data = [];
            $data['price'] = '2';
            $data['private_p_code'] = 'VGstMTEyMkEwMUcwMQ';
            $data['quote_selected'] = '';
            $data['insurance_attributes'] = '';
            $data['union_order_code'] = $union_order_code;
            $data['pay_account'] = $value['openid'];
            $data['contract_id'] = $value['contract_id'];
            $data = $this->signhelp->tySign($data);
            //发送请求
            $response = Curl::to(env('TY_API_SERVICE_URL') . '/ins_curl/wechat_pay_ins')
                ->returnResponseObject()
                ->withData($data)
                ->withTimeout(60)
                ->post();
            // print_r($response);die;
            if($response->status != 200){
                ChannelOperate::where('channel_user_code',$person_code)
                    ->where('proposal_num',$union_order_code)
                    ->update(['pay_status'=>'500','pay_content'=>$response->content]);
                //TODO 签约链接失效（业务员自己取消签约了）
                //TODO 网络延迟等错误，没有判断
//                ChannelContract::where('channel_user_code',$person_code)
//                     ->update([
//                         'is_valid'=>1,//签约失败
//                     ]);
            }
            $return_data =  json_decode($response->content,true);//返回数据
            //TODO  可以改变订单表的状态
            ChannelOperate::where('channel_user_code',$person_code)
                ->where('proposal_num',$union_order_code)
                ->update(['pay_status'=>'200']);
            WarrantyRule::where('union_order_code',$union_order_code)
                ->update(['status'=>'1']);
            Order::where('order_code',$union_order_code)
                ->update(['status'=>'1']);
        }
    }

    /**
     * 微信代扣支付
     * 定时任务，跑支付
     */
    public function doInsureWechatPay(){
        set_time_limit(0);//永不超时
        $channel_contract_info = ChannelContract::where('is_valid','0')//有效签约
        ->where('is_auto_pay','0')
            ->select('openid','contract_id','contract_expired_time','channel_user_code')
            //openid,签约协议号,签约过期时间,签约人身份证号
            ->groupBy('openid')
            ->get();
        //循环请求，免密支付
        foreach ($channel_contract_info as $value){
            $person_code  = $value['channel_user_code'];
            $channel_res = ChannelOperate::where('channel_user_code',$person_code)
                ->where('prepare_status','200')//预投保成功
                ->where('operate_time',date('Y-m-d',time()-24*3600))//前一天的订单
                ->where('is_work','1')//已上工
                ->select('proposal_num')
                ->first();
            $union_order_code = $channel_res['proposal_num'];
            $data = [];
            $data['price'] = '2';
            $data['private_p_code'] = 'VGstMTEyMkEwMUcwMQ';
            $data['quote_selected'] = '';
            $data['insurance_attributes'] = '';
            $data['union_order_code'] = $union_order_code;
            $data['pay_account'] = $value['openid'];
            $data['contract_id'] = $value['contract_id'];
            $data = $this->signhelp->tySign($data);
            //发送请求
            $response = Curl::to(env('TY_API_SERVICE_URL') . '/ins_curl/wechat_pay_ins')
                ->returnResponseObject()
                ->withData($data)
                ->withTimeout(60)
                ->post();
            // print_r($response);die;
            if($response->status != 200){
                ChannelOperate::where('channel_user_code',$person_code)
                    ->where('proposal_num',$union_order_code)
                    ->update(['pay_status'=>'500','pay_content'=>$response->content]);
                //TODO 签约链接失效（业务员自己取消签约了）
                //TODO 网络延迟等错误，没有判断
//                ChannelContract::where('channel_user_code',$person_code)
//                     ->update([
//                         'is_valid'=>1,//签约失败
//                     ]);
            }
            $return_data =  json_decode($response->content,true);//返回数据
            //TODO  可以改变订单表的状态
            ChannelOperate::where('channel_user_code',$person_code)
                ->where('proposal_num',$union_order_code)
                ->update(['pay_status'=>'200']);
            WarrantyRule::where('union_order_code',$union_order_code)
                ->update(['status'=>'1']);
            Order::where('order_code',$union_order_code)
                ->update(['status'=>'1']);
        }
    }

    /**
     * 查询签约客户详情
     * 根据签约信息表和预订单表查询谁签约了
     * 并查询预订单是否成功
     */
    public function selContractInfo(){
        $sql = "select channel_user_code,contract_id,openid,contract_code, count(distinct openid) from com_channel_contract_info group by openid";
        $res = ChannelContract::where('is_valid','<>','1')//有效签约
        ->where('is_auto_pay','<>','1')//同意自动扣费
        ->with([
            'channelOperateInfo'=>function($a){//前一日有预投保信息，投保信息是OK的
                $a->where('operate_time',date('Y-m-d',time()-24*3600))
                    ->where('prepare_status','200');
            },
            'channel_user_info'=>function($a){
                $a->select('channel_user_name','channel_user_phone','channel_user_code');
            },
        ])
            ->distinct('openid')
            ->groupBy('openid')
            ->select('openid','contract_id','contract_code','contract_expired_time','channel_user_code')
            ->get();
        dump(count($res));
        dump($res);
    }

    /**
     *
     * 定时出单
     *
     */
    public function issueAuto(){
        //        保单入库
        $data = Order::join('warranty_rule', 'order.id', 'warranty_rule.order_id')
            ->where('order.status', 1)
            ->where('warranty_rule.warranty_id', null)
            ->select('warranty_rule.*')
            ->get();
        foreach ($data as $v) {
            $insure = new Issue();
            $res = $insure->issue($v);
        }
    }

    /**
     *
     * 轮询出单
     *
     */
    public function insureIssue($person_code){
        $channel_operate_res = ChannelOperate::where('channel_user_code',$person_code)
            ->where('operate_time',date('Y-m-d',time()))
            ->select('proposal_num')
            ->first();
        if(empty($channel_operate_res)){
            return false;
        }
        $union_order_code = $channel_operate_res['proposal_num'];
        \Redis::rPush("issue_data",json_encode($union_order_code));//入队操作
        $count = \Redis::Llen('issue_data');
        for($i=0;$i<$count;$i++) {+
        $insure_data = json_decode(\Redis::lpop('issue_data'),true);//出队
            $issue_status = $this->doInsureIssue($insure_data);
            if(!$issue_status){
                LogHelper::logChannelError($insure_data, 'YD_TK_Insure_issue_'.$insure_data);//记录日志
            }
        }
    }
    /**
     *
     * 出单操作
     *
     */
    public function doInsureIssue($union_order_code){
        $warranty_rule = WarrantyRule::where('union_order_code', $union_order_code)->first();
        if(empty($warranty_rule)){
        return false;
        }
        $i = new Issue();
        $result = $i->issue($warranty_rule);
        if(!$result){
            $respose =  json_encode(['status'=>'503','content'=>'出单失败'],JSON_UNESCAPED_UNICODE);
            return false;
        }
        ChannelOperate::where('proposal_num',$union_order_code)
            ->update(['issue_status'=>'200']);
        $respose =  json_encode(['status'=>'200','content'=>'出单完成'],JSON_UNESCAPED_UNICODE);
        return true;
    }

    public function testWechatPre(){
        $contract_res = ChannelContract::with(['channel_user_info'=>function($a){
            $a->select('channel_user_name','channel_user_code','channel_user_phone','courier_start_time','courier_state','channel_user_address','channel_provinces','channel_city','channel_county');
        }])
            ->select('is_auto_pay','openid','contract_id','contract_expired_time')
            ->get();//查询所有已签约的客户
        dump($contract_res);
    }
}


