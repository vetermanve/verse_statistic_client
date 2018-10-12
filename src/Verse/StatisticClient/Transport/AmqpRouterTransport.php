<?php


namespace Verse\StatisticClient\Transport;


use Psr\Log\LoggerInterface;
use Verse\Di\Env;
use Verse\Router\Router;

class AmqpRouterTransport implements StatisticWriteClientTransportInterface
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var string
     */
    protected $queueName;
    
    public function send(string $payload) : bool 
    {
        $result = false;
        
        try {
            $result = $this->router->publish($payload, $this->queueName);
        } catch (\Throwable $exception) {
            $message = __METHOD__.' cant send stats event because: '.$exception->getMessage();
            
            if ($logger = Env::getContainer()->bootstrap(LoggerInterface::class, false)) {
                /* @var $logger LoggerInterface */
                $logger->error($message, [
                    'ex' => $exception,
                ]);
            } else {
                trigger_error($message, E_USER_WARNING);
            }
        }
        
        return $result;
    }

    /**
     * @return Router
     */
    public function getRouter() : Router
    {
        return $this->router;
    }

    /**
     * @param Router $router
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @return string
     */
    public function getQueueName() : string
    {
        return $this->queueName;
    }

    /**
     * @param string $queueName
     */
    public function setQueueName(string $queueName)
    {
        $this->queueName = $queueName;
    }
}