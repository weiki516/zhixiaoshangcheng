<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <meta name="apple-mobile-web-app-capable" content="yes"/>

        <meta name="apple-touch-fullscreen" content="yes"/>

        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

        <title>会员注册</title>

        <meta name="copyright" content="<?php echo $this->_var['ecmall_version']; ?>" />

        <link href="<?php echo $this->res_base . "/" . 'css/global.css'; ?>" type="text/css" rel="stylesheet" />

        <link href="<?php echo $this->res_base . "/" . 'css/main.css'; ?>" type="text/css" rel="stylesheet" />

        <script type="text/javascript" src="index.php?act=jslang"></script>

        <script type="text/javascript" src="<?php echo $this->lib_base . "/" . 'jquery.js'; ?>" charset="utf-8"></script>

        <script type="text/javascript" src="<?php echo $this->lib_base . "/" . 'ecmall.js'; ?>" charset="utf-8"></script>

        <?php echo $this->_var['_head_tags']; ?>

        <script type="text/javascript">

            //<!CDATA[

            var SITE_URL = "<?php echo $this->_var['site_url']; ?>";

            var REAL_SITE_URL = "<?php echo $this->_var['real_site_url']; ?>";

            var PRICE_FORMAT = '<?php echo $this->_var['price_format']; ?>';

            //]]>

        </script>

    </head>



<div class="mb-head" style=" margin-bottom:2em;">


    <div class="tit">好友<?php echo $this->_var['g']['u']; ?>推荐注册</div>


</div>



<script type="text/javascript">

//注册表单验证

    $(function() {
	

        $('#register_form').validate({

            errorPlacement: function(error, element) {

                var error_td = element.parent('td');

                error_td.find('.field_notice').hide();

                error_td.append(error);

            },

            success: function(label) {

                label.addClass('validate_right').text('OK!');

            },

            onkeyup: false,

            rules: {

                user_name: {

                    required: true,

                    byteRange: [3, 15, '<?php echo $this->_var['charset']; ?>'],

                    remote: {

                        url: 'index.php?app=member&act=check_user&ajax=1',

                        type: 'get',

                        data: {

                            user_name: function() {

                                return $('#user_name').val();

                            }

                        },

                        beforeSend: function() {

                            var _checking = $('#checking_user');

                            _checking.prev('.field_notice').hide();

                            _checking.next('label').hide();

                            $(_checking).show();

                        },

                        complete: function() {

                            $('#checking_user').hide();

                        }

                    }

                },

                phone_mob: {

                    required: true,

                    number: true,

                    byteRange: [11, 11, '<?php echo $this->_var['charset']; ?>'],

                    remote: {

                        url: 'index.php?app=member&act=check_mobile&type=register',

                        type: 'get',

                        data: {

                            phone_mob: function() {

                                return $('#phone_mob').val();

                            }

                        },

                        beforeSend: function() {

                            var _checking = $('#checking_mobile');

                            _checking.prev('.field_notice').hide();

                            _checking.next('label').hide();

                            $(_checking).show();



                        },

                        complete: function() {



                            $('#checking_mobile').hide();

                        }

                    }

                },

               confirm_code: {

                    required: true,

                    number: true,

                    byteRange: [6, 6, '<?php echo $this->_var['charset']; ?>'],

                    remote: {

                        url: 'index.php?app=member&act=cmc&ajax=1',

                        type: 'get',

                        data: {

                            confirm_code: function() {

                                return $('#confirm_code').val();

                            },

							   email: function() {

                                return $('#email').val();

                            }

                        },

                        beforeSend: function() {

                            var _checking = $('#checking_code');

                            _checking.next('label').hide();

                            $(_checking).show();



                        },

                        complete: function() {

                            $('#checking_code').hide();

                        }

                    }

                },

                password: {

                    required: true,

                    minlength: 6

                },
                real_name: {

                    required: true,

                    rangelength:[1,10]

                },
                identity_card: {

                    required: true,

                    minlength: 18,
                    
                    maxlength:18

                },
                telephone: {

                    required: true,
					
					digits:true,

                    minlength: 11,
                    
                    maxlength:18

                },

                password_confirm: {

                    required: true,

                    equalTo: '#password'

                },

                 email: {

                required : true,

                email    : true,

				remote   : {

                    url :'index.php?app=member&act=check_email_info&ajax=1',

                    type:'get',

                    data:{

                        email : function(){

                            return $('#email').val();

                        }

                    },

                    beforeSend:function(){

                        var _checking = $('#checking_email');

                        _checking.prev('.field_notice').hide();

                        _checking.next('label').hide();

                        $(_checking).show();

                    },

                    complete :function(){

                        $('#checking_email').hide();

                    }

                }

                },

                captcha: {

                    required: true,

                    remote: {

                        url: 'index.php?app=captcha&act=check_captcha',

                        type: 'get',

                        data: {

                            captcha: function() {

                                return $('#captcha1').val();

                            }

                        }

                    }

                },

                agree: {

                    required: true

                }

            },

            messages: {

                user_name: {

                    required: '请输入用户名',

                    byteRange: '用户名必须在3-15个字符之间',

                    remote: '该用户名已经被占用'

                },

                phone_mob: {

                    required: '手机号码必须输入',

                    number: '手机号码必须是数字',

                    byteRange: '手机号码长度必须为11位',

                    remote: '手机号码已存在'

                },

                confirm_code: {

                    required: 'mobile_code_required',

                    number: 'mobile_code_must_be_number',

                    byteRange: 'mobile_code_limit',

                    remote: 'mobile_code_error'

                },
                real_name: {

                    required: '您必须输入真实姓名',

                    minlength: '真实姓名最少3个字符'

                },
                identity_card: {

                    required: 'identity_card_required',

                    minlength: 'identity_card_length_limit'

                },
                telephone: {

                    required: '手机号码必须输入',

                    minlength: '手机号码长度必须为11位'

                },

                password: {

                    required: '清输入登陆密码',

                    minlength: '密码长度应在6-20个字符之间'

                },

                password_confirm: {

                    required: '您必须再次确认您的密码',

                    equalTo: '两次输入的密码不一致'

                },

                   email : {

                required : 'email_required',

                email    : 'email_invalid',

				remote   : 'email_already_taken'

            },

                captcha: {

                    required: 'captcha_required',

                    remote: 'captcha_error'

                },

                agree: {

                    required: 'agree_required'

                }

            }

        });

        

        

     var canSend = true;

        var time = 60;

        var dtime = 60;

        $("#sendsms").bind('click', function() {

            var btn = $(this);

            if (!canSend)

                return;

            var sendaddress = $('#email').val();

            

            canSend = false;

            $.ajax({

                type: "get",

                url: "index.php?app=member&act=send_code&type=register",

                data: {

                    mobile: function() {

                        return sendaddress;

                    }

                },

                success: function(msg) {

                   

                    if (msg) {

						

						 var hander = setInterval(function() {

                        if (time <= 0) {

                            canSend = true;

                            clearInterval(hander);

                            btn.val("重新发送验证码");

                            btn.removeAttr("disabled");

                            time = dtime;

                        } else {

                            canSend = false;

                            btn.attr({

                                "disabled": "disabled"

                            });

                            btn.val(time + "秒后可重新发送");

                            time--;

                        }

                    }, 1000);

						

                        alert("邮件已发送至:" + sendaddress + " 请注意查收！");

                    } else {

                        canSend = true;

                        alert("邮件发送失败，请检查邮箱是否正确！");

                    }

                }

            });

        });

    



     

        

        

        

        

        

        

    });

</script>







<div class="login_panel" >

    <form class="login_box" id="register_form" method="post">

        <h2>填写注册信息</h2>

        <table  width="100%">

            <tr>

                <td> <input placeholder="用户名" type="text" name="user_name" id="user_name" class="text">

                    <label class="field_notice"></label></td>

            </tr>
            
            <input type="hidden" name="tname" id="tname" value="<?php echo $this->_var['g']['u']; ?>">
                        
            
            <tr>

                <td> <input placeholder="真实姓名" type="text" name="real_name" id="real_name" class="text">

                    <label class="field_notice"></label></td>

            </tr>
            <tr>

                <td> <input placeholder="手机号码" type="text" name="telephone" id="telephone" class="text">

                    <label class="field_notice"></label></td>

            </tr>
            

            <tr>  

                <td> <input placeholder="登陆密码"  id="password" name="password" type="password"  class="text">  

                    <label class="field_notice"></label></td>

            </tr>

            <tr> 

                <td>  

                    <input placeholder="确认密码"   name="password_confirm" type="password"  class="text">  

                    <label class="field_notice"></label>

                </td>

            </tr>

            <?php if ($this->_var['msg_enabled']): ?>

            <tr> 

                <td>  

                    <input placeholder="手机号码" id="phone_mob"  name="phone_mob" type="text"  class="text">  

                    <label class="field_notice"></label>

                </td>

            </tr>

            <tr> 

                <td>  

                    <input type="button" id="sendsms" value="send_code"/>

                </td>

            </tr>

            <tr> 

                <td>  

                    <input placeholder="confirm_code" id="confirm_code"  name="confirm_code" type="text"  class="text">  

                    <label class="field_notice"></label>

                </td>

            </tr>

            <?php endif; ?>

          

            <tr>

                <td>

                    <input  value="立即注册"  type="submit" class="red_btn">

                </td>

            </tr>

        </table>

        <input type="hidden" name="ret_url" value="<?php echo $this->_var['ret_url']; ?>" />

        <input type="hidden"  checked name="agree" value="1" > 

    </form>

</div>