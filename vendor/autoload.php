<?php

// autoload.php @generated by Composer

use Doctrine\Common\Annotations\AnnotationRegistry;

require_once __DIR__ . '/composer' . '/autoload_real.php';

$loader = ComposerAutoloaderInit9477dd7c48485d8bae68ebbda8e6d473::getLoader();

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
