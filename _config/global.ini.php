;<?php exit("<h1>Access Denied</h1>");?>

;�Ƿ���ԣ�1/true���ã�0/false����
debug = false

;ѹ��������1/true���ã�0/false����
gzip = true

;����ģʽ��1/true���ã�0/false����
develop = false

;ȡ�ÿ�������ID
ctrl_id = c

;ȡ��Ӧ�÷�����ID
func_id = f

;��̨���
admin_file = admin.php

;��վ��ҳ������һ�㲻�޸ģ�������ҳҪ�����������Ÿ���
www_file = index.php

;API�ӿ�
api_file = api.php

;��֤����ʾ��1/true���ã�0/false����
is_vcode = true

;ÿҳ��ʾ����
psize = 20

;��ҳID
pageid = pageid

;ʱ������
timezone = Asia/Shanghai

;ʱ����ڣ���λ����
timetuning = 0

;����Token������ʹ�� session ��ʱ�����ʹ�ô������
token_id = token

;����SQLԶ��ִ�У�������ã�1/true���ã�0/false����
api_remote_sql = false

;����ʱ�䣬��ε�¼�����ϵͳ������ʱ�䣬��λ��Сʱ�����ջ�δ����������2Сʱ
lock_time = 2

;��������ﵽ���ٴκ�ִ��������¼
lock_error_count = 6

;��Ա��¼��֤��1/true���ã�0/false���ã����Ҫʵ�ֻ�Ա��¼���ܲ鿴���뽫��ֵ��Ϊ true �� 1
is_login = false

;����JS�����࣬��� js ��Ӣ�Ķ��Ÿ�����������·�������ȶ�ȡ framework/js/ Ŀ¼����ζ�ȡ js/ Ŀ¼
;��ģ���У���Ҫ���� {url ctrl=js /}����Ȼ������Ч��Ĭ�ϼ� js/ Ŀ¼�µ� jquery.js �ļ���������ָ��ģ�� js Ŀ¼�з� jquery.js �ļ����Ƕ�ȡ
autoload_js = "jquery.md5.js,jquery.phpok.js,global.js,jquery.form.min.js,jquery.json.min.js"

;��ȡ������ʽ��Apache �û�����ʹ�� SERVER_NAME��Nginx �û�����ʹ�� HTTP_HOST
get_domain_method = SERVER_NAME

;�Ƿ������ѡ��
multiple_language = false

;�Ƿ����� opcache������ debug Ϊ false ʱ��Ч
opcache = true

;�Ƿ�ǿ������ HTTPS��Ĭ�ϲ�ǿ�ƣ������ʹ�� nginx+apache ��ģʽ��ϣ����ܼ�� https ʧ�ܣ���������������ǿ��
force_https = 0

;[www]
;��ҳ���Ƿ���Ҫ��Ա��֤��1/true���ã�0/false����
;is_login = false

;[api]
;�ӿ��Ƿ���Ҫ��Ա��֤��1/true���ã�0/false����
;is_login = false


[mobile]
;���û�����ֻ��ˣ�1/true���ã�0/false����
status = true

;�Զ�����Ƿ��ֻ��ˣ�1/true���ã�0/false����
autocheck = true

;Ĭ��Ϊ�ֻ��棬Ϊ���㿪����Ա��ʽ������ΪĬ�Ϻ�����ҳ��Ҳ��չʾ�ֻ��棬1/true���ã�0/false����
default = false

;�ֻ����Զ����ص� js����� autoload_js �����������Ӳ���
includejs = "jquery.touchslide.js"

;�ֻ���Ҫȥ�� js����� autoload_js �������н��ü��ز���
excludejs = "jquery.superslide.js"

[pc]
;���Զ��Զ����ص� js����� autoload_js �����������Ӳ���
includejs = ""

;���Զ�Ҫȥ�� js����� autoload_js �������н��ü��ز���
excludejs = ""

[seo]
; SEO�ָ��ߣ�ע��ո�
line = " - "

;SEO�Ż�ģʽ��{title}�����������ı���ֵ��{seo} �����õ� SEO ���⣬{sitename} ������վ����
format = "{title}-{sitename}-{seo}"

[order]
price = "product,shipping,fee,discount"

[cart]
;���ﳵ���ͼƬ����ϵͳ���ĸ��ֶ�
thumb_id = "thumb"
;Ҫ����ĵ����ﳵ���ͼƬ���ĸ� GD ���������մ�ԭͼ
gd_id = ""

[fav]
;�ղؼ����ͼƬ��ȡ�����ղ�����ʱ�������⵽������ָ����ͼƬ�ֶΣ���ͼƬ�浽�ղؼе�����ͼ����
thumb_id = "thumb"

;�ղؼ��л�ȡ��ժҪ�������������ȡ
note_id = "content"

[async]
;��PHP������ִ���첽�ƻ�����
;������Ŀռ䲻֧�ִ����Ҫ���ã�������Ӧ��HTMLģ����д�붨ʱ�ƻ������������ӣ������˴���Ϊ false
status = false

;���Ƶ�ʣ���λ�Ƿ��ӣ�����С��1
interval_times = 5

[jsonp]
;Զ�̿����ȡ����
;Get���Ĳ���ID
getid = callback

;�������δ���� getid �� ����Ϊ�գ���ʹ��Ĭ�Ϻ���
default = callback