<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerMQtrapz\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerMQtrapz/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerMQtrapz.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerMQtrapz\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerMQtrapz\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'MQtrapz',
    'container.build_id' => '6520a9ad',
    'container.build_time' => 1627600829,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerMQtrapz');
