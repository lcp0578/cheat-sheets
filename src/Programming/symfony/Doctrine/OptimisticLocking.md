## Optimistic Locking 乐观锁
- Entity中增加版本号字段

        /**
         * @ORM\Version
         * @ORM\Column(type="integer")
         */
        private $version;
        
        /**
         * Set version.
         *
         * @param int $version
         *
         * @return User
         */
        public function setVersion($version)
        {
            $this->version = $version;

            return $this;
        }

        /**
         * Get version.
         *
         * @return int
         */
        public function getVersion()
        {
            return $this->version;
        }
- 使用

        use Doctrine\ORM\OptimisticLockException;
        use AclBundle\Entity\User;
        use Doctrine\DBAL\LockMode;
        use Doctrine\ORM\ORMInvalidArgumentException;
        use Doctrine\ORM\TransactionRequiredException;
        
        ...
        	$user = $em->getRepository(User::class)->find($userId);
            try{
                $em->lock($user, LockMode::OPTIMISTIC, $user->getVersion());
                // Save the Entity
                $em->persist($user);
                $em->flush();
                $output->writeln([
                    'success: ',
                    'user id:' . $user->getId(),
                    '$$$$$$$$$$$$$$$$$$$$$$$$$$$$$'
                ]);
            }catch(ORMInvalidArgumentException $e){
                $em = $doctrine->resetManager();
                $output->writeln([
                    'optimistic lock exception[ORMInvalidArgumentException]: ',
                    'user id:' . $user->getId(),
                    '******',
                    $e->getMessage()
                ]);
            }catch(TransactionRequiredException $e){
                $em = $doctrine->resetManager();
                $output->writeln([
                    'optimistic lock exception[TransactionRequiredException]: ',
                    'user id:' . $user->getId(),
                    '******',
                    $e->getMessage()
                ]);
            }catch (OptimisticLockException $e) {
                $em = $doctrine->resetManager();
                $output->writeln([
                    'optimistic lock exception: ',
                    'user id:' . $user->getId(),
                    '******',
                    $e->getMessage()
                ]);
            }

        }