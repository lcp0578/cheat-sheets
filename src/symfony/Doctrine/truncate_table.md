## tuncate table 截断表

	namespace MenuBundle\Service;

    use Doctrine\ORM\EntityManager;

    class TruncateTableService
    {
        private $em;

        public function __construct(EntityManager $em)
        {
            $this->em = $em;
        }

        public function execute($className)
        {
            $classMetaData = $this->em->getClassMetadata($className);
            $connection = $this->em->getConnection();
            $dbPlatform = $connection->getDatabasePlatform();
            $connection->beginTransaction();
            try {
                $connection->query('SET FOREIGN_KEY_CHECKS=0');
                $q = $dbPlatform->getTruncateTableSql($classMetaData->getTableName());
                $connection->executeUpdate($q);
                $connection->query('SET FOREIGN_KEY_CHECKS=1');
                $connection->commit();
                return [
                    'code' => 1,
                    'msg' => '执行成功'
                ];
            }catch (\Exception $e) {
                $connection->rollback();
                return [
                    'code' => 0,
                    'msg' => '执行失败'
                ];
            }    
        }
    }