# PHP Settings

Update the PHP settings of the application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/php-settings
```

### Parameter:

| Parameter    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| php_version | Yes | String | Select any one PHP version for your application: `7.2`,`7.3`,`7.4`,`8.0`,`8.1`, `8.2`, `8.3` or `8.4`. |
| open_basedir | No | String | Your open_basedir. |
| disabled_functions | Yes | String | List of disabled functions, Seprated by commas. |
| max_execution_time | Yes | Numeric | max_execution_time directive for your application. |
| max_input_time | Yes | Numeric | max_input_time directive for your application. |
| max_input_vars | Yes | Numeric | max_input_vars directive for your application. |
| memory_limit | Yes | String | memory_limit directive for your application. |
| post_max_size | Yes | String | post_max_size directive for your application. |
| upload_max_filesize | Yes | String | upload_max_filesize directive for your application. |
| auto_prepend_file | No | String | Enter your prepend file path. |
| php_timezone | No | String | Timezone for application. |
| pm_type | Yes | String | Select any one `ondemand`, `static`, or `dynamic` |
| pm_max_children | Yes | Numeric | pm_max_children for your application. |
| pm_max_requests | No | Numeric | Required if, pm_type is `ondemand`, or `dynamic` |
| pm_max_spare_servers | No | Numeric | Required if, pm_type is `dynamic` |
| pm_min_spare_servers | No | Numeric | Required if, pm_type is `dynamic` |
| pm_process_idle_timeout | No | Numeric | Required if, pm_type is `ondemand` |
| pm_start_servers | No | Numeric | Required if, pm_type is `dynamic` |
| pm_max_spawn_rate | No | Numeric | Required if, pm_type is `dynamic` and PHP version is `8.1`, `8.2`, `8.3` or `8.4`. |

### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/php-settings" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "php_version": 7.4,
    "open_basedir": null,
    "disabled_functions": "getmyuid,passthru,leak,listen,diskfreespace,tmpfile,link,ignore_user_abort,shell_exec,dl,set_time_limit,exec,system,highlight_file,source,show_source,fpassthru,virtual,posix_ctermid,posix_getcwd,posix_getegid,posix_geteuid,posix_getgid,posix_getgrgid,posix_getgrnam,posix_getgroups,posix_getlogin,posix_getpgid,posix_getpgrp,posix_getpid,posix,_getppid,posix_getpwuid,posix_getrlimit,posix_getsid,posix_getuid,posix_isatty,posix_kill,posix_mkfifo,posix_setegid,posix_seteuid,posix_setgid,posix_setpgid,posix_setsid,posix_setuid,posix_times,posix_ttyname,posix_uname,proc_open,proc_close,proc_nice,proc_terminate,escapeshellcmd,ini_alter,popen,pcntl_exec,socket_accept,socket_bind,socket_clear_error",
    "max_execution_time": 60,
    "max_input_time": 60,
    "max_input_vars": 1600,
    "memory_limit": "256M",
    "post_max_size": "128M",
    "upload_max_filesize": "128M",
    "auto_prepend_file": null,
    "php_timezone": "Pacific/Rarotonga",
    "pm_type": "ondemand",
    "pm_max_spare_servers": null,
    "pm_min_spare_servers": null,
    "pm_process_idle_timeout": 30,
    "pm_start_servers": null
   }'
```

#### Update PHP Settings
- __200__ (Ok)

```json
{
  "application": {
    "id": 4326,
    "system_user_id": 5581,
    "framework": "custom",
    "name": "ExampleSite",
    "primary_domain": "test.uselaravel.com",
    "php_version": 7.2,
    "max_execution_time": 60,
    "max_input_time": 60,
    "max_input_vars": 1600,
    "memory_limit": "256M",
    "post_max_size": "128M",
    "upload_max_filesize": "128M",
    "disabled_functions": "getmyuid,passthru,leak,listen,diskfreespace,tmpfile,link,ignore_user_abort,shell_exec,dl,set_time_limit,exec,system,highlight_file,source,show_source,fpassthru,virtual,posix_ctermid,posix_getcwd,posix_getegid,posix_geteuid,posix_getgid,posix_getgrgid,posix_getgrnam,posix_getgroups,posix_getlogin,posix_getpgid,posix_getpgrp,posix_getpid,posix,_getppid,posix_getpwuid,posix_getrlimit,posix_getsid,posix_getuid,posix_isatty,posix_kill,posix_mkfifo,posix_setegid,posix_seteuid,posix_setgid,posix_setpgid,posix_setsid,posix_setuid,posix_times,posix_ttyname,posix_uname,proc_open,proc_close,proc_nice,proc_terminate,escapeshellcmd,ini_alter,popen,pcntl_exec,socket_accept,socket_bind,socket_clear_error,socket_close,socket_connect,symlink,posix_geteuid,ini_alter,socket_listen,socket_create_listen,socket_read,socket_create_pair,stream_socket_server",
    "ssl": null,
    "size": 00.04,
    ....
  },
  "message": "New PHP configuration has been applied successfully!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message":"Application not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```