# composer 配置parameters.yml不默认生成
- 第一种办法

		"incenteev-parameters": {
            "file": "app/config/parameters.yml",
            "keep-outdated": true //add this option
        },
- 第二种办法(移除相关引用)

		"Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
        "incenteev/composer-parameter-handler": "~2.0",
        ...

        "incenteev-parameters": {
            "file": "app/config/parameters.yml"
        },