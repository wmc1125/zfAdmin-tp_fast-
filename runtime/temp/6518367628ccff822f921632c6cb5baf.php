<?php /*a:1:{s:33:"./template/admin/login/index.html";i:1569476572;}*/ ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>用户登陆</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/static/style/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/public/static/system/style/admin.css" media="all">
  <link rel="stylesheet" href="/public/static/system/style/login.css" media="all">
  <link rel="stylesheet" href="/public/static/system/style/lrtk.css" media="all">
</head>
<body style="background-image: url(https://mctool.wangmingchang.com/api/api/rand_pic)">
  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;" style="margin-top:-10px">
    <div class="layui-row layui-col-space15" style="margin:0;margin-top: -70px" >
      <div class="layui-col-sm3"></div>
      <div class="layui-col-sm6" style="height:358px; ">
          
          <!-- 代码 开始 -->
          <div id="login">
            <div class="wrapper">
                <div class="login">
                    <form class="container offset1 loginform" onclick="return false">
                        <div id="owl-login">
                            <div class="hand"></div>
                            <div class="hand hand-r"></div>
                            <div class="arms">
                                <div class="arm"></div>
                                <div class="arm arm-r"></div>
                            </div>
                        </div>
                        <div class="pad">
                            <div class="control-group">
                                <div class="controls">
                                    <label for="email" class=" "></label>
                                    <input id="email" type="text" name="email" placeholder="账号" tabindex="1" autofocus="autofocus" class="form-control input-medium form_name">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <label for="password" class=""></label>
                                    <input id="password" type="password" name="password" placeholder="Password" tabindex="2" class="form-control input-medium form_pwd">
                                </div>
                            </div>
                            <div class="control-group">
                              <div class="controls">
                                  <label for="email" class=""></label>
                                  <input id="google_code" type="text" name="google_code" placeholder="谷歌验证码,未开启可省略" tabindex="1" autofocus="autofocus" class="form-control input-medium form_name">
                              </div>
                            </div>
                        </div>
                        <button class="layui-btn layui-btn-fluid" id="login_r" >登 入</button>
                    </form>
                </div>
            </div>
            <script src="/public/static/style/jquery-1.8.3.min.js"></script>
            <script>
            $(function() {
                $('#login #password').focus(function() {
                    $('#owl-login').addClass('password');
                }).blur(function() {
                    $('#owl-login').removeClass('password');
                });
            });
            </script>
          </div>
          <!-- 代码 结束 -->

          <!--  -->
      </div>
      <div class="layui-col-sm3"></div>
      
    </div>

    
    <div class="layui-trans layadmin-user-login-footer">
      <p>© 2018 <a href="http://demo.zf.90ckm.com" target="_blank">demo.zf.90ckm.com</a></p>
      <p>
          <span><a href="https://www.wangmingchang.com" target="_blank">王明昌博客</a></span>
          <span><a href="http://bbs.wangmingchang.com" target="_blank">王明昌论坛</a></span>
      </p>
    </div>
    
  </div>

  <script src="/public/static/style/layer/layer.js"></script>  
  <script>
     $("#login_r").on("click",function(){
        var name = $(".form_name").val();
        var pwd = $(".form_pwd").val();
        var google_code = $("#google_code").val();

      //异步获取信息
        var url = "<?php echo url('login/login'); ?>";
        var data = {name:name,pwd:pwd,google_code:google_code};
        $.ajax({
          url:url,
          data:data,
          dataType:'json',
          type:"POST",
          success:function(res){
            if(res.result==1){
              layer.msg('登入成功', {
                offset: '15px'
                ,icon: 1
                ,time: 1000
              }, function(){
                location.href = "<?php echo url('index/index'); ?>"; //后台主页
              });
            }else{
              layer.msg(res.msg)

            }
            
          }
        })
      })
  </script>
</body>
</html>