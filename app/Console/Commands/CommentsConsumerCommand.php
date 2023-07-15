<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;

class CommentsConsumerCommand extends Command
{
    protected $signature = 'consume:comments';

    protected $description = 'Command description';

    public function handle(): void
    {
        logger('Executed by supervisord');
        $consumer = Kafka::createConsumer()
            ->withHandler(function(KafkaConsumerMessage $message) {
                logger('Caught Comment message');
                logger($message->getHeaders());
                logger($message->getBody());
            })
            ->subscribe('comments')
            ->build();

        $consumer->consume();
    }
}
