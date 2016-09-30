# Absolute Path Maker

[![Build Status](https://travis-ci.org/kote-components/kote-absolute-path.svg?branch=master)](https://travis-ci.org/kote-components/kote-absolute-path)
[![Coverage Status](https://coveralls.io/repos/github/kote-components/kote-absolute-path/badge.svg?branch=master)](https://coveralls.io/github/kote-components/kote-absolute-path?branch=master)
[![StyleCI](https://styleci.io/repos/69555566/shield?branch=master)](https://styleci.io/repos/69555566)

## Usage

```php
use function Kote\Utils\AbsolutePath\absolutePathMaker;

$make = absolutePathMaker('/some/root');

echo $make('file'); 		// /some/root/file
echo $make('../foo.txt'); 	// /some/foo.txt
echo $make('./other.txt');	// /some/root/other.txt
```
