<?php

/*
----------------------------------
 ------  Created: 101124   ------
 ------  Austin Best	   ------
----------------------------------
*/

function getFile($file)
{
    logger(SYSTEM_LOG, ['text' => 'getFile() ' . $file]);

    if (!$file) {
        logger(SYSTEM_LOG, ['text' => '$file is empty']);
        return [];
    }

    if (!file_exists($file)) {
        file_put_contents($file, '[]');
    }

    return json_decode(file_get_contents($file), true);
}

function setFile($file, $contents)
{
    logger(SYSTEM_LOG, ['text' => 'setFile() ' . $file]);

    if (is_array($contents)) {
        $contents = json_encode($contents, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    } else {
        $contents = json_encode(json_decode($contents, true), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    if (!empty(json_decode($contents, true))) {
        file_put_contents($file, $contents);
    }
}

function deleteFile($file)
{
    logger(SYSTEM_LOG, ['text' => 'deleteFile() ' . $file]);
    unlink($file);
}
