<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Image;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class RemoveImageFromFileSystem implements EventSubscriber
{

    private $filesystem;
    private $param;

    public function __construct(Filesystem $filesystem, ContainerBagInterface $param)
    {
        $this->filesystem = $filesystem;
        $this->param = $param;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::preRemove,
        ];
    }

    public function preRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Image) {
            return;
        } else {
            $file = $entity->getfileLocalisation();
            $folderImg = $this->param->get('img_path_internal');
            $folderThumb = $this->param->get('img_path_thumb_internal');
            $this->filesystem->remove($folderImg.$file);
            $this->filesystem->remove($folderThumb.$file);
        }
    }
}
