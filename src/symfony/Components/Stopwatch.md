##  Stopwatch
> The Stopwatch component provides a way to profile code.

- 在symfony中使用

		$ php bin/console debug:container stopwatch
		 Select one of the following services to display its information [debug.stopwatch]:
		  [0] debug.stopwatch
		 > 0
		 Information for Service "debug.stopwatch"
		 =========================================
		
		 ------------------ ---------------------------------------
		  Option             Value
		 ------------------ ---------------------------------------
		  Service ID         debug.stopwatch
		  Class              Symfony\Component\Stopwatch\Stopwatch
		  Tags               -
		  Public             yes
		  Synthetic          no
		  Lazy               no
		  Shared             yes
		  Abstract           no
		  Autowired          no
		  Autowiring Types   -
		 ------------------ ---------------------------------------
	DefaultController.php

		<?php

		namespace KitWebBundle\Controller;
		
		class DefaultController extends BaseController
		{
		    public function indexAction()
		    {
		        /**
		         * 
		         * @var \Symfony\Component\Stopwatch\Stopwatch $stopwatch
		         */
		        $stopwatch = $this->get('debug.stopwatch');
		        $stopwatch->start('news', 'cate1');
		        /**
		         * @var $repository \KitNewsBundle\Repository\NewsRepository
		         */
		        $repository = $this->getDoctrine()->getRepository('KitNewsBundle:News');
		        $top1 = $repository->getListPage(2, 0, 10);
		        $top2 = $repository->getListPage(3, 0, 10);
		        $stopwatch->lap('news');
		        
		        $bottom1 = $repository->getListPage(4, 0, 10);
		        $bottom2 = $repository->getListPage(5, 0, 10);
		        $stopwatch->lap('news');
		        
		        $notice = $repository->getListPage(6, 0, 10);
		        $images = $repository->getListPage(null, 0, 12);
		        $toutiao = $repository->getToutiao(1);
		        $event = $stopwatch->stop('news');
		        dump($event);
				dump($event->getPeriods()); // 获取各个节点之间的时间信息
		        dump($event->getCategory());   // Returns the category the event was started in
		        dump($event->getOrigin());     // Returns the event start time in milliseconds
		        dump($event->ensureStopped()); // Stops all periods not already stopped
		        dump($event->getStartTime());  // Returns the start time of the very first period
		        dump($event->getEndTime());    // Returns the end time of the very last period
		        dump($event->getDuration());   // Returns the event duration, including all periods
		        dump($event->getMemory());     // Returns the max memory usage of all periods
		        
		        return $this->render('KitWebBundle:Default:index.html.twig', [
		            'nav' => 1,
		            'toutiao' => $toutiao,
		            'top1' => $top1,
		            'top2' => $top2,
		            'bottom1' => $bottom1,
		            'bottom2' => $bottom2,
		            'notice' => $notice,
		            'images' => $images
		        ]);
		    }
		}
	Dump contents

		In DefaultController.php line 31:
		StopwatchEvent {#671 ▼
		  -periods: array:3 [▼
		    0 => StopwatchPeriod {#625 ▼
		      -start: 207
		      -end: 638
		      -memory: 2097152
		    }
		    1 => StopwatchPeriod {#626 ▼
		      -start: 638
		      -end: 639
		      -memory: 2097152
		    }
		    2 => StopwatchPeriod {#544 ▼
		      -start: 639
		      -end: 641
		      -memory: 2097152
		    }
		  ]
		  -origin: 1504143123626.9
		  -category: "cate1"
		  -started: []
		}
		In DefaultController.php line 32:
		"cate1"
		In DefaultController.php line 33:
		1504143123626.9
		In DefaultController.php line 34:
		null
		In DefaultController.php line 35:
		207
		In DefaultController.php line 36:
		641
		In DefaultController.php line 37:
		434
		In DefaultController.php line 38:
		2097152
	Sections

		$stopwatch->openSection();
		$stopwatch->start('parsing_config_file', 'filesystem_operations');
		$stopwatch->stopSection('routing');
		
		$events = $stopwatch->getSectionEvents('routing');
		// reopen
		$stopwatch->openSection('routing');
		$stopwatch->start('building_config_tree');
		$stopwatch->stopSection('routing');
