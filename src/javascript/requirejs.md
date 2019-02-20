## requirejs
- [requirejs](https://github.com/requirejs/requirejs)
- [text](https://github.com/requirejs/text)
- [require css](https://github.com/guybedford/require-css)

		requirejs.config({
          baseUrl: '../../',
          paths: {
            'art-template': 'js/art/template-web',
            'text': 'js/requirejs/lib/text',
            'css': 'js/requirejs/lib/css',
            'mui': 'css/mui.min',
            'header': 'js/tpl/header.tpl',
            'footer': 'js/tpl/footer.tpl'
          }
        });
         var data = {
            menu_id: 2,
            title: '基本例子',
            isAdmin: true,
            list: ['文艺', '博客', '摄影', '电影', '民谣', '旅行', '吉他']
          };
        requirejs(['text!header','text!footer','art-template','css!mui'],function(header,footer,artTemplate, mui){

          var header = artTemplate.render(header, data);
          document.getElementById('header').innerHTML = header;
           var footer = artTemplate.render(footer, data);
          document.getElementById('footer').innerHTML = footer;
        });