## key
- 生成key
        keytool -genkey -v -keystore ~/.android/debug.keystore -alias androiddebugkey -keyalg RSA -validity 10000
        输入密钥库口令:
        再次输入新口令:
        您的名字与姓氏是什么?
          [Unknown]:  xxx
        您的组织单位名称是什么?
          [Unknown]:  xxxx
        您的组织名称是什么?
          [Unknown]:  xxx
        您所在的城市或区域名称是什么?
          [Unknown]:  xxx
        您所在的省/市/自治区名称是什么?
          [Unknown]:  xxx
        该单位的双字母国家/地区代码是什么?
          [Unknown]:  china
        CN=li, OU=xx, O=xx, L=xx, ST=xx, C=china是否正确?
          [否]:  是
    
- 查看sha1的值

		keytool -list -v -keystore ~/.android/debug.keystore
        输入密钥库口令:
        密钥库类型: PKCS12
        密钥库提供方: SUN

        您的密钥库包含 1 个条目

        别名: androiddebugkey
        创建日期: May 11, 2018
        条目类型: PrivateKeyEntry
        证书链长度: 1
        证书[1]:
        所有者: CN=xx, OU=xxx, O=xx, L=taiyuan, ST=xxx, C=china
        发布者: CN=xxx, OU=xxx, O=xx, L=xxx, ST=xx, C=china
        序列号: 36dc7bfa
        生效时间: Fri May 11 15:34:48 CST 2018, 失效时间: Tue Sep 26 15:34:48 CST 2045
        证书指纹:
             SHA1: A2:00:83:xxxx:B4:4F:B6:83:29:B4:AC:70:72:42:FB:26:D9
             SHA256: 09:60:FA:EA:D2:58:6C:FD:42:5xxxxx:0A:01:2B:5B:80:EB:7B:7E:A7:60:F0:50:46:F7:66:1D:5D:E5:22
        签名算法名称: SHA256withRSA
        主体公共密钥算法: 2048 位 RSA 密钥
        版本: 3