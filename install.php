#!/usr/bin/env php
<?php

function getProjectFiles(): array
{
    return [
        './composer.json',
        './tests/TestCase.php',
    ];
}

function replaceProjectName(string $filename, string $newName): void
{
    $origText = file_get_contents($filename);
    $newText = str_replace('Skeleton', $newName, $origText);

    if ($newText !== $origText) {
        file_put_contents($filename, $newText);
    }
}

function installGitAttributes()
{
    rename('_gitattributes', '.gitattributes');
}

function main()
{
    // Get the project name from the CWD.
    $project = basename(__DIR__);

    installGitAttributes();

    // Replace "Skeleton" with $project in every PHP file.
    $files = getProjectFiles();
    foreach ($files as $filename) {
        replaceProjectName($filename, $project);
    }

    echo "\nYou must edit the following files:\n\n";
    foreach (['README.md', 'LICENSE', 'composer.json',  'The .php_cs header'] as $file) {
        echo " - $file\n";
    }

    echo "\bNote: This install.php file has deleted itself.\n";
    unlink('src/empty.php');
    unlink('install.php');
}

main();
