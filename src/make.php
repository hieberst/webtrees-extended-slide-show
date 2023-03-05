<?php

/**
 * webtrees-extended-slide-show: add a person's lifespan to the slide show
 * Copyright (C) 2023 Steffen Hieber
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

match ($argv[1])
{
    'build' => do_build(),
    'clean' => do_clean()
};

function rmtree($directory)
{
    if (is_dir($directory))
    {
        $files = glob($directory . '/*');
        foreach ($files as $file)
        {
            is_dir($file) ? rmtree($file) : unlink($file);
        }
        rmdir($directory);
    }
}

function do_build()
{
    rmtree('build');
    mkdir('build/resources/views', 0755, true);
    foreach (glob('*.md') as $f)
    {
        copy($f, 'build/' . basename($f));
    }
    foreach (glob('src/module/*.php') as $f)
    {
        copy($f, 'build/' . basename($f));
    }
    foreach(glob('src/module/resources/lang/*/*.po') as $f)
    {
        $lang = basename(dirname($f, 1));
        $dir = "build/resources/lang/$lang/";
        mkdir($dir, 0755, true);
        copy($f, $dir . basename($f));
    }

    $errors = xdiff_file_patch(
        'vendor/fisharebest/webtrees/resources/views/modules/random_media/slide-show.phtml',
        'src/patches/slide-show.patch',
        'build/resources/views/slide-show-ext.phtml',
        XDIFF_PATCH_NORMAL);

    if (is_string($errors))
    {
        exit("Failed applying the patch. Rejects:\n $errors");
    }

    $zip = new ZipArchive();
    if ($zip->open('extended-slide-show.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE))
    {
        $options = array(
            'remove_path' => 'build/',
            'add_path' => 'modules_v4/extended-slide-show/');
        $zip->addGlob('build/*.{md,php}', GLOB_BRACE, $options);
        $zip->addGlob('build/resources/lang/*/*.po', 0, $options);
        $zip->addGlob('build/resources/views/*.phtml', 0, $options);
        $zip->close();
    }
}

function do_clean()
{
    rmtree('build');
    array_map('unlink', glob('*.zip'));
}

?>
