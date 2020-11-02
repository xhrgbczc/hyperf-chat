<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use PhpAmqpLib\Message\AMQPMessage;
use Hyperf\Amqp\Message\Type;
use Hyperf\Amqp\Builder\QueueBuilder;
use Hyperf\Server\Server;
use Hyperf\Server\ServerFactory;

/**
 * @Consumer()
 */
class DemoConsumer extends ConsumerMessage
{
    /**
     * 交换机名称
     *
     * @var string
     */
    public $exchange = 'im.message.fanout';

    /**
     * 交换机类型
     *
     * @var string
     */
    public $type = Type::FANOUT;

    /**
     * 绑定的队列名称
     *
     * @var string
     */
    public $queue = 'im.message.queue';

    /**
     * 路由key
     *
     * @var string
     */
    public $routingKey = 'consumer:im:message';

    /**
     * 重写创建队列生成类
     *
     * 注释：设置自动删除队列
     *
     * @return QueueBuilder
     */
    public function getQueueBuilder(): QueueBuilder
    {
        return parent::getQueueBuilder()->setAutoDelete(true);
    }

    /**
     * 消费队列消息
     *
     * @param $data
     * @param AMQPMessage $message
     * @return string
     */
    public function consumeMessage($data, AMQPMessage $message): string
    {
        echo $data;
        echo PHP_EOL;

        return Result::ACK;
    }

    public function isEnable(): bool
    {
        return true; // TODO: Change the autogenerated stub
    }
}
