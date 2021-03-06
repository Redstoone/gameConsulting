;<?php exit("<h1>Access Denied</h1>");?>

; 支持 mysqli pdo_mysql http，PHP大于5.3版的用户建议使用mysqli或pdo_mysql
; http 模式需要调用 libs/curl.php 和 libs/token.php 文件，此模式需要 Server 端配合，功能比较弱
; 请注意 http 模式还在试验阶段
file = "mysqli"

; 数据库服务器，本地请填写localhost或127.0.0.1
; 当使用 http 时，这里填写服务器的 IP，可用于解决无法认别域名问题
host = "127.0.0.1"

; 数据库服务器的端口号，默认是3306
; 使用 http 模式此项无效
port = "3306"

; 连接数据库的账号
; 使用 http 模式时，这里是认证账号，不需要请留空
user = "root"

; 连接数据库的密码
; 使用 http 模式时的基本验证，不需要请留空
pass = "123456"

; 数据库名称
; 使用 http 模式时，请填写访问地址，如 http://127.0.0.1/index.php 或 https://127.0.0.1/index.php 等完整链接地址
; 使用 sqlite 或 pdo_sqlite 时，请填写数据库相对地址，要确保文件存在
; 使用 mysqli 或 pdo_mysql 时，请填写数据库名称
data = "consult"

; 数据表前缀，实现同一个数据库安装不同版本程序，默认使用 qinggan_
; 使用 http 模式时，注意生成的 SQL 文件会补上前缀
prefix = "zx_"

; 使用通道连接（即不走网卡，Mysql在Linux下一般是/tmp/mysql.sock，建议有独立主机的用户使用）
socket = ""

; 是否调试，配合系统的debug为true时，会打印出整个页面执行的SQL语句
debug = false

; 即时缓存，适应用大量的小查询（重复查询，一般不用开启）
cache = false

; 密钥，仅限在 http 模式时有效
; 请注意密钥与服务端必须一致
keycode = ""

