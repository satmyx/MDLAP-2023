<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerDCxMU0Q\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerDCxMU0Q/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerDCxMU0Q.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerDCxMU0Q\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerDCxMU0Q\App_KernelDevDebugContainer([
    'container.build_hash' => 'DCxMU0Q',
    'container.build_id' => 'aaadc7f9',
    'container.build_time' => 1677230786,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerDCxMU0Q');
