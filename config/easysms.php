
3.2. 短信提供商
6.x
6.x
5.8
5.7
5.5

L03 Laravel 教程 - 实战构架 API 服务器 ( Laravel 6.x ) /
服务商注册

短信的服务商有很多，这里选择比较常用的 阿里云。

根据相关政策的要求，各个短信服务商提供的短信短信服务大都分为两个部分：『签名』以及『模板』，签名通常是项目或者企业的名称，模板是短信的内容。只有通过审核的签名和模板才能够正常发送短信，所以我们先进入阿里云的 管理后台 。
添加签名

选择国内消息 》签名管理 》添加签名：

短信提供商

内容可以参照截图，个人用户场景只能选择验证码。

短信提供商

提交并等待模板审核通过。

短信提供商
添加模板

选择国内消息 》模板管理 》添加模板：

短信提供商

提交并等待模板审核通过。
2. 安装 easy-sms

easy-sms 是安正超写的一个短信发送组件，利用这个组件，我们可以快速的实现短信发送功能。

$ composer require "overtrue/easy-sms"

短信提供商

由于该组件还没有 Laravel 的 ServiceProvider，为了方便使用，我们可以自己封装一下。
首先在 config 目录中增加 easysms.php 文件，

$ touch config/easysms.php

填入如下内容。

config/easysms.php

<?php

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 10.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'aliyun',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'aliyun' => [
            'access_key_id' => env('SMS_ALIYUN_ACCESS_KEY_ID'),
            'access_key_secret' => env('SMS_ALIYUN_ACCESS_KEY_SECRET'),
            'sign_name' => 'Larabbs',
        ],
    ],
];
