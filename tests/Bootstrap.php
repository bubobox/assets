<?php

/*
 * Set error reporting to the level to which Mockery code must comply.
 */
error_reporting(E_ALL);

/*
 * Determine the root, library, and tests directories of the framework
 * distribution.
 */
$root    = realpath(dirname(dirname(__FILE__)));
$library = "$root/library";
$tests   = "$root/tests";

/**
 * Check that --dev composer installation was done
 */
if (!file_exists($root . '/vendor/autoload.php')) {
    exit(
        'Please run "php composer.phar install --dev" in root directory '
        . 'to setup unit test dependencies before running the tests'
    );
}

/*
 * Prepend the Mutateme library/ and tests/ directories to the
 * include_path. This allows the tests to run out of the box and helps prevent
 * loading other copies of the code and tests that would supercede
 * this copy.
 */
$path = array(
    $library,
    $tests,
    get_include_path(),
);
set_include_path(implode(PATH_SEPARATOR, $path));

require __DIR__.'/../vendor/autoload.php';

/*
 * Unset global variables that are no longer needed.
 */
unset($root, $library, $tests, $path);

