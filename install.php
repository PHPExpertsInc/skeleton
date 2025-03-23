#!/usr/bin/env php
<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
echo __DIR__ . '/vendor/autoload.php' . "\n";
/*************************************************
 *      ●●● ●●● ●●● ●●● ●●● ●●● ●●● ●●● ●●●      *
 *     ●●●                               ●●●     *
 *    ● PHP Experts, Inc's Skeleton Install ●    *
 *   ●●● ●●●                           ●●● ●●●   *
 *  ●   ●   ●            ●            ●   ●   ●  *
 * ●●● ●●● ●●●          ●●●          ●●● ●●● ●●● *
 *  ●   ●   ●●●     ●●●     ●●●     ●●●   ●   ●  *
 *   ●●● ●●●   ●     ●   ●   ●     ●   ●●● ●●●   *
 *    ●   ●●● ●●●   ●●●     ●●●   ●●● ●●●   ●    *
 *     ●●●   ●   ●      ●●●      ●   ●   ●●●     *
 *      ●●● ●●● ●●●      ●      ●●● ●●● ●●●      *
 *       ●   ●   ●●●           ●●●   ●   ●       *
 *        ●●● ●●●   ●         ●   ●●● ●●●        *
 *         ●   ●   ●●●       ●●●   ●   ●         *
 *          ●●● ●●●   ●     ●   ●●● ●●●          *
 *           ●   ●   ●●●   ●●●   ●   ●           *
 *            ●●● ●●●   ●●●   ●●● ●●●            *
 *             ●   ●     ●     ●   ●             *
 *       ●      ● ●●●   ●●●   ●●● ●      ●       *
 *      ●●●      ●   ●●●   ●●●   ●      ●●●      *
 *  ●●●     ●●●   ●   ●     ●   ●   ●●●     ●●●  *
 *   ●   ●   ●     ● ●●●   ●●● ●     ●   ●   ●   *
 *  ●●●     ●●●     ●   ●●●   ●     ●●●     ●●●  *
 *      ●●●          ●   ●   ●          ●●●      *
 *       ●            ●●● ●●●            ●       *
 *************************************************/

function getProjectFiles(): array
{
    return [
        './composer.json',
        './tests/TestCase.php',
    ];
}

function replaceProjectName(string $filename, string $newName): void
{
//    dd([$filename, $newName]);
    $origText = file_get_contents($filename);
    $newText = str_replace('Skeleton', $newName, $origText);
//    dd([$origText, $newText]);
    if ($newText !== $origText) {
//        dd($newText);
        file_put_contents($filename, $newText);
    }
}

function installGitAttributes()
{
    if (file_exists('_gitattributes')) {
        rename('_gitattributes', '.gitattributes');
    }
}

function main()
{
    // Get the project name from the CWD.
    $project = basename(__DIR__);

    installGitAttributes();

    // Replace "Skeleton" with $project in every PHP file.
    $files = getProjectFiles();
    foreach ($files as $filename) {
        dump([$filename, $project]);
        replaceProjectName($filename, $project);
    }

    echo "\nYou must edit the following files:\n\n";
    foreach (['README.md', 'composer.json',  'The .php_cs header'] as $file) {
        echo " - $file\n";
    }

    echo "\nDelete every LICENSE you do not want.\n";

    echo "\bNote: This install.php file has deleted itself.\n";
    if (file_exists('./src/.gitkeey')) {
        unlink('src/.gitkeep');
    }
    if (file_exists('/install.php')) {
        unlink('install.php');
    }
}

main();
