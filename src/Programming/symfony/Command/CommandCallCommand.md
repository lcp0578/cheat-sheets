## Command call Command
- 示例1

		protected function execute(InputInterface $input, OutputInterface $output)
        {
            $output->writeln([
                'start backup database',
                '---------------'
            ]);
            $command = $this->getApplication()->find('backup-manager:backup');
            $fileName = 'backup/'.date('YmdHis'). '_'. mt_rand(10, 99) .'.sql';
            $args = [
                'command' => 'backup-manager:backup',
                'database' => 'production',
                'destinations' => ['local'],
                '-c' => 'gzip',
                '--filename' => $fileName
            ];
            $commandInput = new ArrayInput($args);
            try {
                $returnCode = $command->run($commandInput, $output);
                if($returnCode == 0){
                    $this->flushDb($fileName);
                }
                $output->writeln([
                    'backup-manager:',
                    'code:' . $returnCode
                ]);
            } catch (\Exception $e) {
                $output->writeln([
                    'exception:',
                    '   code' . $e->getCode(),
                    '   msg' . $e->getMessage()

                ]);
            }
            $output->writeln([
                'end backup database',
                '--------------'
            ]);
        }
- 示例2

		<?php
		namespace KitAdminBundle\Command;
		
		use Symfony\Component\Console\Input\InputInterface;
		use Symfony\Component\Console\Output\OutputInterface;
		use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
		use Symfony\Component\Console\Input\ArrayInput;
		use Symfony\Component\Console\Input\InputOption;
		
		class CallotherCommand extends ContainerAwareCommand
		{
		
		    protected function configure()
		    {
		        $this->setName('call:other')
		            ->addOption('start', 's', InputOption::VALUE_OPTIONAL, 'start date, YYYYMMDD')
		            ->addOption('end', 'd', InputOption::VALUE_OPTIONAL, 'end date, YYYYMMDD')
		            ->setDescription('Pull all 110 data.')
		            ->setHelp("This command pull all 110 data....");
		    }
		
		    protected function execute(InputInterface $input, OutputInterface $output)
		    {
		        $command = $this->getApplication()->find('pull:data');
		        $startDate = $input->getOption('start');
		        $endDate = $input->getOption('end');
		        
		        $test1Args = array(
		            '--type' => 'test1',
		            '--start' => $startDate,
		            '--end' => $endDate
		        );
		        
		        $test2Args = array(
		            '--type' => 'test2',
		            '--start' => $startDate,
		            '--end' => $endDate
		        );
		        
		        $test1Input = new ArrayInput($test1Args);
		        $test2Input = new ArrayInput($test2Args);
		        try {
		            $returnCode = $command->run($test1Input, $output);
		            $output->writeln([
		                'receive:',
		                'code:' . $returnCode
		            ]);
		            $returnCode = $command->run($test2Input, $output);
		            $output->writeln([
		                'treat:',
		                'code:' . $returnCode
		            ]);
		           
		        } catch (\Exception $e) {
		            $output->writeln([
		                'exception:',
		                '   code' . $e->getCode(),
		                '   msg' . $e->getMessage()
		            
		            ]);
		        }
		    }
		}