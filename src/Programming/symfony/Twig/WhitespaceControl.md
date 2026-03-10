## Whitespace Control 空格控制
## 给标签添加 -

    <td>{% if item.status ==1 %}   启用   {% else %}   禁用   {% endif %}</td>
    <td>{%- if item.status ==1 -%}   启用   {%- else -%}   禁用   {%- endif -%}</td>
    <td>{%- if item.status ==1 -%}   启用   {%- else -%}   禁用   {% endif %}</td>
    <td>{% if item.status ==1 %}   启用   {%- else -%}   禁用   {%- endif -%}</td>
    <td>{% if item.status ==1 %}   启用   {%- else %}   禁用   {%- endif %}</td>
    <td>{% if item.status ==1 %}   启用   {% else -%}   禁用   {% endif -%}</td>
    <td>{%- if item.status ==1 %}   启用   {%- else %}   禁用   {% endif %}</td>
    <td>{% if item.status ==1 -%}   启用   {% else -%}   禁用   {% endif %}</td>

    // status == 1, output
    <td>   启用   </td>
    <td>启用</td>
    <td>启用</td>
    <td>   启用</td>
    <td>   启用</td>
    <td>   启用   </td>
    <td>   启用</td>
    <td>启用   </td>
    // status == 0, output
    <td>   禁用   </td>
    <td>禁用</td>
    <td>禁用   </td>
    <td>禁用</td>
    <td>   禁用</td>
    <td>禁用   </td>
    <td>   禁用   </td>
    <td>禁用   </td>