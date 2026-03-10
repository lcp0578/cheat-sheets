## Guzzle Event Listener
- 定义事件监听

        api.guzzle_post_listener:
            class: ApiBundle\EventListener\GuzzlePostListener
            arguments: ["@logger"]
            tags:
                - { name: kernel.event_listener, event: eight_points_guzzle.post_transaction, method: onPostTransaction, service: 'eight_points_guzzle.client.api_department' }
        api.guzzle_pre_listener:
            class: ApiBundle\EventListener\GuzzlePreListener
            arguments: ["@logger"]
            tags:
                - { name: kernel.event_listener, event: eight_points_guzzle.pre_transaction, method: onPreTransaction, service: 'eight_points_guzzle.client.api_department' }
- 实现事件监听

		<?php
        namespace ApiBundle\EventListener;

        use EightPoints\Bundle\GuzzleBundle\Events\GuzzleEventListenerInterface;
        use EightPoints\Bundle\GuzzleBundle\Events\PostTransactionEvent;
        use Psr\Log\LoggerInterface;

        class GuzzlePostListener implements GuzzleEventListenerInterface
        {
            private $client;

            private $logger;

            public function __construct(LoggerInterface $logger)
            {
                $this->logger = $logger;
            }
            public function setServiceName($serviceName)
            {
                $this->client = $serviceName;
            }

            public function onPostTransaction(PostTransactionEvent $event)
            {
                if ($event->getServiceName() === 'api_department') {
                    $body = $event->getTransaction()->getBody()->getContents();
                    $this->logger->emergency( $body, ['8p_guzzle_post' => 'post']);
                }
            }
        }
        
        <?php
        namespace ApiBundle\EventListener;

        use EightPoints\Bundle\GuzzleBundle\Events\GuzzleEventListenerInterface;
        use EightPoints\Bundle\GuzzleBundle\Events\PreTransactionEvent;
        use Psr\Log\LoggerInterface;

        class GuzzlePreListener implements GuzzleEventListenerInterface
        {
            private $client;
            private $logger;

            public function __construct(LoggerInterface $logger)
            {
                $this->logger = $logger;
            }
            public function setServiceName($serviceName)
            {
                $this->client = $serviceName;
            }

            public function onPreTransaction(PreTransactionEvent $event)
            {
                if ($event->getServiceName() === 'api_department') {
                    $body = $event->getTransaction()->getBody()->getContents();
                    $this->logger->emergency($body, ['8p_guzzle_pre' => 'pre']);
                }
            }
        }