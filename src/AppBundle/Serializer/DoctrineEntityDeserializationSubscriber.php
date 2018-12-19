<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 2018-12-19
 * Time: 23:21
 */

namespace AppBundle\Serializer;


use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

class DoctrineEntityDeserializationSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserialize',
                'format' => 'json',
            ],
            [
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserialize',
                'format' => 'json',
            ],
        ];
    }

    public function onPreDeserialize(PreDeserializeEvent $event) 
    {
        
    }

    public function onPostDeserialize(ObjectEvent $event)
    {
        
    }
}