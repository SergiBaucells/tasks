# Supervisos Que worker
## PATH

```
/etc/supervisor/conf.d/tasks.sergibaucells.scool.cat.conf
```

## CONTINGUT

### LOCAL
```
[program:laravel-worker-tasks-sergibaucells-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/sergi/Code/baucells/tasks/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=sergi
numprocs=8
redirect_stderr=true
stdout_logfile=/home/sergi/Code/baucells/tasks/storage/logs/worker.log
```

### EXPLOTACIÓ
```
[program:laravel-worker-tasks-sergibaucells-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/tasks.sergibaucells.scool.cat/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/tasks.sergibaucells.scool.cat/storage/logs/worker.log
```

# Supervisor Horizon
## PATH
```
/etc/supervisor/conf.d/horizon-tasks-sergibaucells-scool-cat.conf
```

## CONTINGUT

### LOCAL
```
[program:horizon-tasks-sergibaucells-scool-cat]
process_name=%(program_name)s
command=php /home/sergi/Code/baucells/tasks/artisan horizon
autostart=true
autorestart=true
user=sergi
redirect_stderr=true
stdout_logfile=/home/sergi/Code/baucells/tasks/storage/logs/horizon.log
```

### EXPLOTACIÓ
```
[program:horizon-tasks-sergibaucells-scool-cat]
process_name=%(program_name)s
command=php /home/forge/tasks.sergibaucells.scool.cat/artisan horizon
autostart=true
autorestart=true
user=forge
redirect_stderr=true
stdout_logfile=/home/forge/tasks.sergibaucells.scool.cat/storage/logs/horizon.log
```