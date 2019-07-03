## Twig Extension
- ThemeExtension示例

		<?php
		//src/KitWebBundle/Twig/ThemeExtension.php
		namespace KitWebBundle\Twig;
		
		use Symfony\Component\DependencyInjection\ContainerInterface;
		
		class ThemeExtension extends \Twig\Extension\AbstractExtension implements \Twig\Extension\GlobalsInterface
		{
		    private $container;
		    
		    public function __construct(ContainerInterface $container)
		    {
		        $this->container = $container;
		    }
		    // 注册一个全局变量
		    public function getGlobals()
		    {
		        return array(
		            'theme_name' => $this->getThemeName()
		        );
		    }
			// 注册一个名为theme的过滤器
		    public function getFilters()
		    {
		        return array(
		            new \Twig_SimpleFilter('theme', array($this, 'themeFilter')),
		        );
		    }
		    // 注册一个theme的函数
		    public function getFunctions()
		    {
		        return array(
		            new \Twig_SimpleFunction('theme', array($this, 'themeFunction')),
		        );
		    }
		    
		    public function themeFilter($resource, $default = 'Default')
		    {
		        
		        return 'theme/'. $this->getThemeName($default) . '/' . $resource;
		    }
		    
		    public function themeFunction($resource, $default = 'Default')
		    {
		        return 'theme/'. $this->getThemeName($default) . '/' . $resource;
		    }
		    
		    private function getThemeName($default = 'Default')
		    {
		        /**
		         * @var \KitAdminBundle\Service\ThemeService $themeService
		         */
		        $themeService = $this->container->get('kit_admin.theme_service');
		        return $themeService->get($default);
		    }
		}
- 注册服务

		# app/config/services.yml
		services:
			twig.extension.theme_extension:
        		class: KitWebBundle\Twig\ThemeExtension
        		arguments: ["@service_container"]
        		tags:
         		   - { name: twig.extension } // tag表明为twig的扩展，非常重要
         		 
- 使用
		
		{# in twig #}
		{{ theme_name }} //使用注册的全局变量
		{{ asset(theme('style.css')) }} // 使用扩展函数
		{{ asset('style.css' | theme )}} //使用扩展过滤器
- 高级参数
	- is_safe
	
            class MacroExtension extends \Twig_Extension
            {

                public function getFunctions()
                {
                    return array(
                        new \Twig_SimpleFunction('macro_no_content', [
                            $this,
                            'noContent'
                        ], [
                            'is_safe' => [
                                'html'
                            ]
                        ])
                    );
                }

                public function noContent($num)
                {
                    return <<<EOF
                    <tr>
                    <td colspan="$num" align="center">
                    <img src="/public/img/no_content.gif"/>
                    </td>
                    </tr>
            EOF;
                }
            }
	- needs_context
	- needs_environment
- [官方Extension仓库:github.com/twigphp/Twig-extensions](https://github.com/twigphp/Twig-extensions)