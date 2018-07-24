## DoctrineFixturesBundle
- 使用DoctrineFixturesBundle
	- install
		
			composer require --dev doctrine/doctrine-fixtures-bundle
	- enable
	
			class AppKernel extends Kernel
			{
			    public function registerBundles()
			    {
			        // ...
			        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
			            // ...
			            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
			        }
			
			        return $bundles;
			    }
			
			    // ...
			}
- command
	清除数据库数据后，加载fixtures的数据（此时数据删除的时，使用DELETE语句）

		$ php bin/console doctrine:fixtures:load
		Careful, database will be purged. Do you want to continue y/N ?y
  		> purging database
  		> loading Doctrine\Bundle\FixturesBundle\EmptyFixture
  		> loading KitAdminBundle\DataFixtures\ORM\Fixtures
  	
	清除数据库数据后，加载fixtures的数据（此时数据删除的时，使用truncate语句）

		$ php bin/console doctrine:fixtures:load --purge-with-truncate 
	不想清除数据库的数据，加载fixtures的数据

		$ php bin/console doctrine:fixtures:load --append
	默认加载所有fixtures，可以指定，目录加载部分，--fixtures允许有多个值 
		
		php bin/console doctrine:fixtures:load --fixtures=/path/to/fixtures1 --fixtures=/path/to/fixtures2
        php bin/console doctrine:fixtures:load --fixtures=src/AdminBundle/DataFixtures/Water
		
- 简单fixtures定义demo

		<?php
		namespace KitAdminBundle\DataFixtures\ORM;
		
		use Doctrine\Bundle\FixturesBundle\Fixture;
		use Doctrine\Common\Persistence\ObjectManager;
		use KitAdminBundle\Entity\ConfigCategory;
		
		class ConfigCategoryFixtures extends Fixture
		{
		    /**
		     *
		     * {@inheritdoc}
		     *
		     * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
		     */
		    public function load(ObjectManager $manager)
		    {
		        $createAt = new \DateTime();
		        foreach ($this->getConfigCategoryList() as $val){
		            $configCategory = new ConfigCategory();
		            $configCategory->setName($val);
		            $configCategory->setStatus(1);
		            $configCategory->setIp('127.0.0.1');
		            $configCategory->setCreateAt($createAt);
		            $configCategory->setUpdateAt($createAt);
		            $manager->persist($configCategory);
		        }
		        $manager->flush();
		    }
		    /**
		     * 
		     * @return string[]
		     */
		    private function getConfigCategoryList()
		    {
		        return [
		            'class1',
		            'class2'
		        ];
		    }
		}
        
- 新版本需要定义service配置tag

        system.menu_datafixtures:
            class: SystemBundle\DataFixtures\MenuFixtures
            tags: ['doctrine.fixture.orm']
        system.ridset_datafixtures:
            class: SystemBundle\DataFixtures\RidsetFixtures
            tags: ['doctrine.fixture.orm']
- 使用Container 
- Fixtures之间调用
- 设置Fixtures的顺序或优先级
