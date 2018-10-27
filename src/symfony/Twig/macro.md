## macro
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