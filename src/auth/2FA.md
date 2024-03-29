## 2FA（双因子认证）
- https://www.ibm.com/cn-zh/topics/2fa
### 什么是 2FA？
- 双因子认证 (2FA) 是一种身份验证方法，要求用户提供密码和另一个认证因子或者至少提供两个认证因子（代替密码），才能访问网站、应用程序或网络。 例如，网上银行应用程序要求用户输入密码和通过短信发送到手机上的验证码时，就使用了 2FA。
- 由于破解第二个认证因子需要付出更多，并且其他类型的因子更难以窃取或伪造，因此 2FA 可提高帐户安全性，并更好地保护组织及其用户免遭未经授权的访问。
- 2FA 是一种最常用多因子认证 (MFA) – 要求用户提供密码和至少一个认证因子或至少提供两个认证因子来代替密码。
### 2FA 中使用的认证因子类型
- 双因子认证通过两种方式来降低未经授权访问的风险。 第一种，黑客需要破解的不仅是一个而是两个因子。 第二种，2FA 需要的至少一个因子比密码更难破解。
- 任何 2FA 方案的强度最终取决于它要求用户提供的认证因子类型。

##### 知识因子：用户知道的信息

- 在绝大多数 2FA 实现中，知识因子是第一个认证因子。 从理论上说，知识因子是只有用户知道的一些信息。 密码是最常见的知识因子；其他知识因子还包括个人身份识别码 (PIN) 和回答安全问题。

- 尽管它们被广泛使用，但一般来说，知识因子是最容易受到攻击的认证因子，尤其是密码。 黑客可以通过以下方式获取密码和其他知识因子：网络钓鱼攻击；在用户设备上安装击键记录器或间谍软件；或者运行脚本或机器人来生成和测试潜在密码，直至找到适用的密码。

- 破解其他知识因子的难度并不大。 一些安全问题的答案，例如，“你母亲的娘家姓是什么？”， 可以通过基础研究或社会工程攻击轻松破解，方法是黑客诱骗用户泄露个人信息。 其他安全问题 — 例如，“你的蜜月在哪里度过？”， 可能相对容易被猜到。 泄露的凭据是 2021 年最常被利用的初始攻击媒介，在所有数据泄露中占 20%，这也就不足为奇了。

- 需要注意的是，输入密码和回答安全问题的仍然是普遍做法 ，这是知识因子，而不是2FA；属于两步认证。 真正的 2FA 要求两种不同的类型的认证因子。

##### 占有因子：用户拥有的东西

- 占有因子是用户随身携带的包含认证所需信息的物理对象。 占有因子分为两种：软件令牌和硬件令牌。

- 如今，大多数软件令牌都是一次性密码 (OTP)  — 通过 SMS 文本消息（或电子邮件或语音消息）发送到用户手机的有时效的 4 到 8 位数密码，或者由手机上安装的认证应用程序生成。 认证应用程序可在没有互联网或手机网络连接的情况下生成令牌。 用户通过扫描服务提供商显示的二维码将应用程序与帐户配对；然后，应用程序会为每个帐户持续生成基于时间的一次性密码 OTP (TOTP) 或其他软件令牌，通常每 30-60 秒生成一次。 最常用的认证应用程序包括 Google Authenticator、Authy、Microsoft Authenticator、LastPass Authenticator 和 Duo，这些都使用推送通知而不是 TOTP。

- 硬件令牌是将密钥卡、身份证、硬件加密锁等专用设备作为安全密钥使用 。 一些硬件令牌插入计算机的 USB 端口，并将认证信息传输到登录页面；还有一些会生成安全代码，供用户在出现提示时手动输入。

- 与知识因子相比，占有因子具有多项优势。 黑客为了冒充用户，在登录时，需要拥有物理设备或拦截对设备的传输，才能在 OTP 或 TOTP 过期之前获取。

- 但占有因子并非不可破解。 物理令牌和智能手机可能会被盗或放错位置。 虽然 OTP 和 TOTP 比传统密码更难窃取，但它们仍然容易受到复杂的网络钓鱼或中间人攻击。 OTP 容易受到"SIM 克隆"的影响，这种攻击会创建受害者智能手机 SIM 卡的功能副本。

##### 固有因子：用户作为人所独有的特征

- 固有因子（也称为生物特征）是用户独有的物理特征，例如指纹、声音、面部特征或虹膜和视网膜图案。 如今，许多移动设备都可以使用指纹或面部识别来解锁；而一些计算机可以使用指纹将密码输入到网站或应用程序中。

- 固有因子是最难破解的因子：因为它们不会被遗忘、丢失或放错地方，而且非常难以复制。 但这并不意味着它们是万无一失的。 如果将固有因子存储在数据库中，那么它们就可能会被窃取。 例如，在 2019 年，一个包含 100 万用户指纹的生物特征数据库遭到了攻击。 从理论上讲，黑客可以窃取这些指纹，也可以将他们自己的指纹与数据库中另一个用户的个人资料链接在一起。

- 当生物特征数据遭到攻击时，无法快速或轻松地对这些数据进行更改，因此受害者难以阻止正在进行的攻击。

##### 行为因子：用户所做的事情

- 行为因子是根据行为模式验证用户身份的数字工件。 行为因子的例子包括 IP 地址范围或用户通常用于登录到应用程序的位置数据。

- 行为认证解决方案使用人工智能来确定用户正常行为模式的基线，然后标记异常活动，例如使用新的设备、电话号码、网络浏览器或位置进行登录。 一些 2FA 实现利用行为因子，允许用户将可信设备注册为认证因子。 虽然用户可能需要在第一次登录时手动提供两个因子，但使用的可信设备将在未来自动成为第二个因子。

- 行为因子通常用于自适应认证，也称为“基于风险认证”。 在此系统中，当风险发生变化时，例如，用户尝试从不受信任的设备登录，首次尝试访问应用程序或尝试访问特别敏感的数据时，认证要求会发生变化。 自适应认证方案通常允许系统管理员为每种类型的用户或角色设置单独的认证策略。 低风险用户可能只需要两个因子即可登录，而高风险用户（或高度敏感的应用程序）可能需要三个或更多因子。

- 虽然行为因子可以提供复杂的用户认证方式，但它们需要大量资源和专业知识才能进行部署。 此外，如果黑客获得对可信设备的访问权限，他们可以将其用作认证因子。

### 无密码 2FA
- 由于被泄露的知识因子是网络安全漏洞中最常见的初始攻击媒介，因此许多组织都在探索无密码 认证，即依靠占有因子、固有因子和行为因子来验证身份。 无密码认证可减少网络钓鱼攻击和凭证填充攻击的漏洞，在这些攻击中，黑客使用从一个系统窃取的凭证来访问另一个系统。

- 虽然目前大多数 2FA 方法都使用密码，但行业专家预计，随着越来越多的组织摆脱被普遍认为是认证链中最薄弱的环节，无密码的未来将越来越清晰。 这会推动无密码 2FA 系统的采用，用户在使用时必须提供两种不同类型的非知识因子认证凭证。 例如，让用户提供指纹和物理令牌便可以构成无密码 MFA。

### 2FA 与合规性
- 为了应对日益激增的网络攻击，许多政府和行业法规目前要求对处理敏感数据的系统使用 MFA。 例如：

	- 2020 年，美国国税局 (IRS) 强制要求网上报税系统提供商使用 MFA。
	- 美国总统拜登关于改善国家网络安全的 2021 年行政命令要求所有联邦机构都必须使用 MFA。 后续备忘录要求国家安全部门、国防部和情报机构的所有系统在 2022 年 8 月 18 日之前都实施 MFA。
	- 支付卡行业数据安全标准 (PCI-DSS) 明确要求对处理信用卡和支付卡数据的系统使用 MFA。
- 双因子认证符合这些法规和其他法规的最低要求。 许多其他法规，包括萨班斯法案 (SOX) 和 HIPAA，也强烈建议使用 2FA 来确保合规性。
### 2FA、单点登录和零信任
- 单点登录 (SSO) 是一种认证方法，允许用户通过一组登录凭证访问多个相关的应用程序和服务。 用户只需登录一次，SSO 解决方案就会对其身份进行认证并生成会话认证令牌。 此令牌将充当各种互连应用程序和数据库的用户安全密钥。

- 为了降低多个应用程序依赖于同一组凭证的风险，组织通常需要对 SSO 使用 2FA。 这提供了额外的安全层，会要求用户在访问 SSO 会话之前使用两个不同的认证因子。

- 组织可为 SSO 实施自适应认证，将 2FA 结合起来进行初始登录并访问不太敏感的应用程序和内容，并在用户尝试访问更敏感的数据或有出异常行为（例如尝试通过无法识别的 VPN 进行连接）时要求提供额外的认证因子。 这在零信任网络安全架构中尤为常见，这种架构从不信任用户的身份，并且总是在他们在网络中活动时进行身份验证。