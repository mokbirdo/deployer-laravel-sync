<?php

namespace Deployer;

desc('Sync Remote to Local');
task('sync:down', ['sync:down:storage', 'sync:down:db']);

//db:backup
desc('Download DB');
task('sync:down:db', function () {
    cd('{{deploy_path}}/current/');
    $dump_path = parse('{{deploy_path}}/shared/storage/dbdump');
    run('php artisan db:backup --path=' . $dump_path);
    download($dump_path, 'storage');
    run('rm -r ' . $dump_path);


});

desc('storage/app rsync');
task('sync:down:storage', function () {
    download("{{deploy_path}}/shared/storage/app", 'storage');
});