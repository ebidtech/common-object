Common Objects
==============

Repository to store/share simple objects that can be reuse across projects.

[![Latest Stable Version](https://poser.pugx.org/ebidtech/common-object/v/stable.png)](https://packagist.org/packages/ebidtech/common-object) [![Build Status](https://travis-ci.org/ebidtech/common-object.png?branch=master)](https://travis-ci.org/ebidtech/common-object) [![Coverage Status](https://coveralls.io/repos/ebidtech/common-object/badge.png?branch=master)](https://coveralls.io/r/ebidtech/common-object?branch=master) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/ebidtech/common-object/badges/quality-score.png?s=d02365dc27dbeb4cc2618035ccfb996a669e8f14)](https://scrutinizer-ci.com/g/ebidtech/common-object/) [![Dependency Status](https://www.versioneye.com/user/projects/52e3942cec1375b900000105/badge.png)](https://www.versioneye.com/user/projects/52e3942cec1375b900000105)

## Requirements ##

* PHP >= 5.4

## Installation ##

The recommended way to install is through composer.

Just create a `composer.json` file for your project:

``` json
{
    "require": {
        "ebidtech/common-object": "@stable"
    }
}
```

**Tip:** browse [`ebidtech/common-object`](https://packagist.org/packages/ebidtech/common-object) page to choose a stable version to use, avoid the `@stable` meta constraint.

And run these two commands to install it:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ composer install
```

Now you can add the autoloader, and you will have access to the library:

```php
<?php

require 'vendor/autoload.php';
```

## Usage ##

For now for usage example look on [tests code](tests/EBT/CommonObject/Tests)

## Contributing ##

See CONTRIBUTING file.

## Credits ##

* Ebidtech developer team, common object Lead developer [Eduardo Oliveira](https://github.com/entering) (eduardo.oliveira@ebidtech.com).
* [All contributors](https://github.com/ebidtech/common-object/contributors)

## License ##

Common object library is released under the MIT License. See the bundled LICENSE file for details.

