## packagist.org 配置 Github Hook让包自动更新
- Github Webhooks
	- https://github.com/kitlabs-cn/KitFormBundle/settings/hooks
- add webhook
- https://packagist.org/about#how-to-update-packages
	- Payload URL: https://packagist.org/api/github?username=kitlabs
	- Content Type: application/json
	- Secret: your [Packagist API Token, https://packagist.org/profile/](https://packagist.org/profile/)