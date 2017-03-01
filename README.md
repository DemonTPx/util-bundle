# DemonTPx util bundle

These are some utils I use often in my Symfony projects

## Installation

Install the bundle in your project by running:

``` bash
$ composer require demontpx/util-bundle
```

Enable the bundle in your kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = [
        // ...
        new Demontpx\UtilBundle\DemontpxUtilBundle(),
    ];
}
```
