# Absolute Path Maker

[![Build Status](https://travis-ci.org/kote-components/kote-absolute-path.svg?branch=master)](https://travis-ci.org/kote-components/kote-absolute-path)
[![Code Climate](https://codeclimate.com/repos/57ee17221047b14e10003121/badges/dd6531d384325c17ebbb/gpa.svg)](https://codeclimate.com/repos/57ee17221047b14e10003121/feed)
[![Test Coverage](https://codeclimate.com/repos/57ee17221047b14e10003121/badges/dd6531d384325c17ebbb/coverage.svg)](https://codeclimate.com/repos/57ee17221047b14e10003121/coverage)

## Usage

```php
use function Kote\Utils\AbsolutePath\absolutePathMaker;

$make = absolutePathMaker('/some/root');

echo $make('file'); 		// /some/root/file
echo $make('../foo.txt'); 	// /some/foo.txt
echo $make('./other.txt');	// /some/root/other.txt
```
