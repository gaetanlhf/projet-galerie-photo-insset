<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerG7C71OH\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerG7C71OH/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerG7C71OH.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerG7C71OH\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerG7C71OH\App_KernelDevDebugContainer([
    'container.build_hash' => 'G7C71OH',
    'container.build_id' => '545799b7',
    'container.build_time' => 1635150209,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerG7C71OH');
