## Command call Command
- demo

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