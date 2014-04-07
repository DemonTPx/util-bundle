# DemonTPx util bundle

These are some utils I use often in my Symfony2 projects

## Installation

Add the util bundle to your `composer.json`:

``` js
{
    "require": {
        "demontpx/util-bundle": "dev-master"
    }
}
```

Then tell composer to download the bundle:

``` bash
$ composer update demontpx/util-bundle
```

Enable the bundle in your kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new DemonTPx\UtilBundle\DemonTPxUtilBundle(),
    );
}
```
