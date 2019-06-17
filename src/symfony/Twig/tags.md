## Twig tags
- include

		{# 向引入的模板中传递变量 #}
		{% include 'tpl_name.html.twig' with {'number': number} %}
- embed
- set
	- Note that loops are scoped in Twig; therefore a variable declared inside a for loop is not accessible outside the loop itself:

            {% for item in list %}
                {% set foo = item %}
            {% endfor %}

            {# foo is NOT available #}
	- If you want to access the variable, just declare it before the loop:

            {% set foo = "" %}
            {% for item in list %}
                {% set foo = item %}
            {% endfor %}

            {# foo is available #}