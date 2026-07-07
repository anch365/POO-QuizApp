<?php
spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/../src/';

    switch (true) {
        case substr($className, -10) === 'Repository':
            $directory = 'Repositories';
            break;
        default:
            $directory = 'Entities';
            break;
    }

    $file = $baseDir . $directory . '/' . $className . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
