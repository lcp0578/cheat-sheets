## Twig
- 三目运算符
	
		{{ create_at is empty ? "" : create_at|date("m/d/Y") }}
- concatenate strings in twig

		{{ 'info_' ~ val.id }}
		{{ 'info_' ~ val.id ~ '_suffix' }}
		{{ "brief_#{val.id}" }} //Notice: double quote

- Echo raw variable and disable html escaping

    	{{ content|raw }}

- 获取当前时间：

    	{{ 'now' | date('Y-m-d H:i:s') }}

- 字符截断：

		composer require "twig/extensions"  // 加载twig扩展包
	
		// services.yml注册服务
		twig.extension.text:
	        class: Twig_Extensions_Extension_Text
	        tags:
	            - { name: twig.extension }
	
	    {{ item.address|default('暂无')| truncate(12, false, '...') }}

- twig 中获取GET参数

	    app.request.query.get('keyword')
		//获取所有GET参数
		app.request.query.all
		//搜索或者翻页需要带参数
		{{ path('kit_wap_home', {'num':istr.number}|merge(app.request.query.all)) }}
- 获取route name

		app.request.get('_route')

- 获取登录用户信息

		{% if app.user %}{{ app.user.username }}{% else %}游客{% endif %}
- twig中调用服务

		#app/config/config.yml
		twig:
		    globals:
		        your_service_name: "@your_service_id"
	
	twig中调用
	
		{{ 	your_service_name.methodName(param) }}
- include 函数 
- twig中使用js模板引擎，渲染数据，解决 `{{ }}` 冲突，使用verbatim。

	    {% verbatim %}
		    <ul>
		    {% for item in seq %}
		    <li>{{ item }}</li>
		    {% endfor %}
		    </ul>
	    {% endverbatim %}
- Whitespace Control

		{% spaceless %}
		    <div>
		        <strong>foo bar</strong>
		    </div>
		{% endspaceless %}
		
		{# output will be <div><strong>foo bar</strong></div> #}
或者

		{% set value = 'no spaces' %}
		{#- No leading/trailing whitespace -#}
		{%- if true -%}
		    {{- value -}}
		{%- endif -%}
		
		{# output 'no spaces' #}
- 获取session 

	`{{app.session}}` refers to the Session object and not the `$_SESSION` array.

		{{ app.session.get('session_key') }}
- 获取cookie

		{{ dump(app.request.cookies) }}
		{{ app.request.cookies.get('cookie_key') }}
- 获取头部信息

		{{ app.request.headers.get('User-Agent') }}
- 获取当前运行环境

		{{ app.environment }} {# dev、prod、test #}