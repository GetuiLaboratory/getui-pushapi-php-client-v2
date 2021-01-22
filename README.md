欢迎使用[个推**PUSH** SDK For PHP](https://docs.getui.com/getui/server/rest_v2/introduction/)。

`个推PUSH SDK For PHP`的主要目标是提升开发者在**服务端**集成个推推送服务的开发效率。
开发者不需要进行复杂编程即可使用个推推送服务的各项常用功能，SDK可以自动帮您满足调用过程中所需的鉴权、组装参数、发送HTTP请求等非功能性要求。

下面向您介绍`个推PUSH SDK For PHP`的使用方法。


## 环境要求
1. 需要配合`PHP 5.5`或其以上版本。

2. 使用`个推PUSH SDK`前，您需要先前往[个推开发者中心](https://dev.getui.com) 完成开发者接入的一些准备工作，创建应用。详细见[操作步骤](https://docs.getui.com/getui/start/devcenter/#1)

3. 准备工作完成后，前往[个推开发者中心](https://dev.getui.com)获取应用配置，后续将作为使用SDK的输入。详细见[操作步骤](https://docs.getui.com/getui/start/devcenter/#11)


## 快速开始
### 普通调用
下列代码示例向您展示了使用`个推Push SDK For PHP`调用一个API的3个主要步骤：

1. 设置参数，创建API。
2. 发起API调用。
3. 处理响应。

##### 使用示例：**推送API**_根据cid进行单推

```php
function pushToSingleByCid(){
	//创建API，APPID等配置参考 环境要求 进行获取
    $api = new GTClient("https://restapi.getui.com","APPKEY", "APPID","MASTERSECRET");
    //设置推送参数
    $push = new GTPushRequest();
    $push->setRequestId("请求唯一标识号");
    $message = new GTPushMessage();
    $notify = new GTNotification();
    $notify->setTitle("设置通知标题");
    $notify->setBody("设置通知内容");
    //点击通知后续动作，目前支持以下后续动作:
    //1、intent：打开应用内特定页面url：打开网页地址。2、payload：自定义消息内容启动应用。3、payload_custom：自定义消息内容不启动应用。4、startapp：打开应用首页。5、none：纯通知，无后续动作
    $notify->setClickType("none");
    $message->setNotification($notify);
    $push->setPushMessage($message);
    $push->setCid("CID");
    //处理返回结果
    $result = $api->pushApi()->pushToSingleByCid($push);
}
```

##### 使用示例：**统计API**_获取单日推送数据
```php
function queryPushResultByDate(){
    //创建API，APPID等配置参考 环境要求 进行获取
    $api = new GTClient("https://restapi.getui.com","APPKEY", "APPID","MASTERSECRET");
    //处理返回结果
    $result = $api->statisticsApi()->queryPushResultByDate("年-月-日");
}
```


##### 使用示例：**用户API**_查询用户状态
```php
function queryUserStatus(){
    //创建API，APPID等配置参考 环境要求 进行获取
    $api = new GTClient("https://restapi.getui.com","APPKEY", "APPID","MASTERSECRET");
    $array = array(CID1);
    //处理返回结果
    $result = $api->userApi()->queryUserStatus($array);
}
```
> 其余功能[可参考该链接](https://github.com/GetuiLaboratory/getui-pushapi-php-client-v2/tree/master/test)


### 设置代理
> 我们提供系统环境变量的方式进行代理配置，当需要使用代理进行http访问时，配置以下环境变量

```php
        "getui_http_proxy_ip" ： 代理ip
        "getui_http_proxy_port" ： 代理端口
        "getui_http_proxy_username" ： 鉴权用户名
        "getui_http_proxy_passwd" ： 鉴权密码
```


## 已支持的API列表
以下是消息推送功能与推送API的对应关系

| API类别      |      功能       | 调用的API名称                                              |
|-----------|-----------------|-----------------------------------------------------------|
| 鉴权API | [鉴权](https://docs.getui.com/getui/server/rest_v2/token/#0)              | 初始化GTClient会自动鉴权                                  |
| 鉴权API | [删除鉴权](https://docs.getui.com/getui/server/rest_v2/token/#1)           | GTUserApi.closeAuth                                 |
| 推送API | [cid单推](https://docs.getui.com/getui/server/rest_v2/push/#1)            | GTUserApi.pushToSingleByCid                     |
| 推送API | [别名单推](https://docs.getui.com/getui/server/rest_v2/push/#2)            | GTUserApi.pushToSingleByAlias                   |
| 推送API | [cid批量单推](https://docs.getui.com/getui/server/rest_v2/push/#3)         | GTUserApi.pushBatchByCid                        |
| 推送API | [别名批量单推](https://docs.getui.com/getui/server/rest_v2/push/#4)         | GTUserApi.pushBatchByAlias                      |
| 推送API | [tolist创建消息](https://docs.getui.com/getui/server/rest_v2/push/#5)      | GTUserApi.createListMsg                             |
| 推送API | [cid批量推](https://docs.getui.com/getui/server/rest_v2/push/#6)           | GTUserApi.pushListByCid                         |                  
| 推送API | [别名批量推](https://docs.getui.com/getui/server/rest_v2/push/#7)           | GTUserApi.pushListByAlias                       |                    
| 推送API | [群推](https://docs.getui.com/getui/server/rest_v2/push/#8)                | GTUserApi.pushAll                               |                                
| 推送API | [条件筛选用户推送](https://docs.getui.com/getui/server/rest_v2/push/#9)      | GTUserApi.pushByTag                             |                               
| 推送API | [标签快速推送](https://docs.getui.com/getui/server/rest_v2/push/#10)        | GTUserApi.pushByFastCustomTag                    |                                
| 推送API | [停止任务](https://docs.getui.com/getui/server/rest_v2/push/#11)            | GTUserApi.stopPush                              |            
| 推送API | [查询定时任务](https://docs.getui.com/getui/server/rest_v2/push/#12)        | GTUserApi.queryScheduleTask                      |     
| 推送API | [删除定时任务](https://docs.getui.com/getui/server/rest_v2/push/#13)        | GTUserApi.deleteScheduleTask                     |
| 统计API | [获取推送结果](https://docs.getui.com/getui/server/rest_v2/report/#1)       | GTStatisticsApi.queryPushResultByTaskIds          |                                    
| 统计API | [任务组名查报表](https://docs.getui.com/getui/server/rest_v2/report/#2)      | GTStatisticsApi.queryPushResultByGroupName        |
| 统计API | [单日推送数据](https://docs.getui.com/getui/server/rest_v2/report/#3)       | GTStatisticsApi.queryPushResultByDate             |
| 统计API | [单日用户数据接口](https://docs.getui.com/getui/server/rest_v2/report/#4)    | GTStatisticsApi.queryUserDataByDate               |
| 统计API | [24小时在线用户数](https://docs.getui.com/getui/server/rest_v2/report/#5)    | GTStatisticsApi.queryOnlineUserData              |
| 用户API | [绑定别名](https://docs.getui.com/getui/server/rest_v2/user/#1)             | GTUserApi.bindAlias                             |
| 用户API | [根据cid查询别名](https://docs.getui.com/getui/server/rest_v2/user/#2)       | GTUserApi.queryAliasByCid                       |
| 用户API | [根据别名查询cid](https://docs.getui.com/getui/server/rest_v2/user/#3)       | GTUserApi.queryCidByAlias                       |
| 用户API | [批量解绑别名](https://docs.getui.com/getui/server/rest_v2/user/#4)          | GTUserApi.unbindAlias                      |
| 用户API | [解绑所有别名](https://docs.getui.com/getui/server/rest_v2/user/#5)          | GTUserApi.unbindAllAlias                        |
| 用户API | [一个用户绑定一批标签](https://docs.getui.com/getui/server/rest_v2/user/#6)    | GTUserApi.setTagForCid                         |
| 用户API | [一批用户绑定一个标签](https://docs.getui.com/getui/server/rest_v2/user/#7)    | GTUserApi.batchModifyTagForBatchCid                         |
| 用户API | [一批用户解绑一个标签](https://docs.getui.com/getui/server/rest_v2/user/#8)    | GTUserApi.unbindTag                       |
| 用户API | [查询标签](https://docs.getui.com/getui/server/rest_v2/user/#9)              | GTUserApi.queryUserTag                        |
| 用户API | [添加黑名单用户](https://docs.getui.com/getui/server/rest_v2/user/#10)        | GTUserApi.addBlackUser                         |
| 用户API | [移除黑名单用户](https://docs.getui.com/getui/server/rest_v2/user/#11)        | GTUserApi.removeBlackUser                      |
| 用户API | [查询用户状态](https://docs.getui.com/getui/server/rest_v2/user/#12)          | GTUserApi.queryUserStatus                     |
| 用户API | [设置角标(仅支持IOS)](https://docs.getui.com/getui/server/rest_v2/user/#13)   | GTUserApi.setBadge                             |
| 用户API | [查询用户总量](https://docs.getui.com/getui/server/rest_v2/user/#14)          | GTUserApi.queryUserCount                            |

> 注：更多API持续更新中，敬请期待。


## 其他链接
[个推开发者平台](https://docs.getui.com/)
