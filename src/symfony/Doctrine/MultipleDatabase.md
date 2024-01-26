## Multiple Entity Managers and Connections
- 使用代码示例

		$customerEntityManager = $doctrine->getManager('customer');

		$customers = $doctrine->getRepository(Customer::class, 'customer')->findAll();