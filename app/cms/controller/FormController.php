<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | LeoXie <380019813@qq.com>
// +----------------------------------------------------------------------
namespace app\cms\controller;

use cmf\controller\HomeBaseController;
use app\cms\service\PostService;

class FormController extends HomeBaseController
{

    public function index()
	{
		if (request()->isPost() && request()->isAjax()) {
			$data = $_POST;
			$insert=array();
			if(!empty($data['name'])){
				$insert['name']=$data['name'];//姓名
			}
			if(!empty($data['phone'])){
				$insert['phone']=$data['phone'];//手机号
			}
			if(!empty($data['email'])){
				$insert['email']=$data['email'];//email
			}
			if(!empty($data['content'])){
				$insert['content']=$data['content'];//内容
			}
			if(!empty($data['mark'])){
				$insert['mark']=$data['mark'];//备注
			}
			
			$insert['create_time'] = time();
			$res = model('cms_form')->insert($insert);
			if(!empty($res)){
				$this->emill($insert);//发送电子邮件
			}
			$id = model('cms_form')->getLastInsID();

			if ($id) {
				$data = ['status' => 1, 'msg' => "留言成功"];
			} else {
				$data = ['status' => 0, 'msg' => "留言失败"];
			}

			return json($data);
		}
	}


    
    /**
	 * 反馈
	 */
	public function feedback()
	{
		$captcha = request()->param('code');

		$data = $_POST;
		$insert = array();
		if (!empty($data['username'])) {
			$insert['username'] = $data['username']; //姓名
		}
		if (!empty($data['tel'])) {
			$insert['tel'] = $data['tel']; //手机号
		}
		if (!empty($data['email'])) {
			$insert['email'] = $data['email']; //email
		}
		if (!empty($data['content'])) {
			$insert['content'] = $data['content']; //内容
		}
		if (!empty($data['tsby'])) {
			$insert['tsby'] = $data['tsby']; //0 表扬  1投诉
		}

		$insert['create_time'] = time();
		$res = model('cms_feedback')->insert($insert);
		if (!empty($res)) {
			$this->emill($insert); //发送电子邮件
		}
		$id = model('cms_feedback')->getLastInsID();
		if ($id) {
			$data = ['status' => 1, 'msg' => "反馈成功"];
		} else {
			$data = ['status' => 0, 'msg' => "反馈失败"];
		}

		return json($data);
	}
	/**
	 * 发送Emil
	 */
	Private function emill($data)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//服务器配置
			$mail->CharSet = "UTF-8";                     //设定邮件编码
			$mail->SMTPDebug = 0;                        // 调试模式输出
			$mail->isSMTP();                             // 使用SMTP
			$mail->Host = 'smtp.163.com';                // SMTP服务器
			$mail->SMTPAuth = true;                      // 允许 SMTP 认证
			$mail->Username = '15231180133@163.com';                // SMTP 用户名  即邮箱的用户名
			$mail->Password = 'UKILGPFXCEAINMAH';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
			$mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
			$mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
			$mail->setFrom('15231180133@163.com', 'Mailer');  //发件人
			$mail->addAddress('zhaojing@kaoersi.com', 'Joe');  // 收件人
			//$mail->addAddress('ellen@example.com');  // 可添加多个收件人
			// $mail->addReplyTo('15231180133@163.com', 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
			//$mail->addCC('cc@example.com');                    //抄送
			//$mail->addBCC('bcc@example.com');                    //密送

			//发送附件
			// $mail->addAttachment('../xy.zip');         // 添加附件
			// $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名
			//Content
			$mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
			$mail->Subject =  $data['name'].'的留言(孰樱)';
			$mail->Body    = '姓名：'.$data['name'].'<br>电话：'.$data['phone'].'<br>email:'.$data['email'].'<br>内容:'.$data['content'].'<br>备注:'.$data['mark'].'<br>'. date('Y-m-d H:i:s');
			$mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';
			$mail->send();
			echo '邮件发送成功';
		} catch (Exception $e) {
			echo '邮件发送失败: ', $mail->ErrorInfo;
		}
	}

}
