## macro（注意：Twig >=2.x时，引入的macro在继承的模板无效）
- 定义macro

		{% macro no_content(num) %}
            <tr>
                <td colspan="{{ num }}" align="center">
                    <img src="{{ asset('public/img/no_content.gif') }}"/>
                </td>
            </tr>
        {% endmacro %}
- 引入

		{% import "common_macro.html.twig" as macro %}
- 使用

		{{ macro.no_content(7) }}