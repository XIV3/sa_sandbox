# Update

## General Settings

### HTTP Request:

```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/settings/general
```

### Parameters:

| parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| name | Yes | String | Update name of the Server |
| hostname | Yes | Alphabet Numeric | Update hostname of your server |
| php_cli_version | No | Float | If your web server is `apache2` , `nginx`, or `openlitespeed` then Select any one PHP Cli Version: `7.0`, `7.1`, `7.2`, `7.3`, `7.4`, `8.0`, `8.1`, `8.2`, `8.3` or `8.4` |
| ols_automatically_restart | Yes | Boolean | If your web server is openlitespeed then `true` or `false`. otherwise `false` |
| timezone | Yes | String | Timezone For Example: `UTC` or `Asia/Kolkata` |

### Curl Request example:

#### General Settings Curl Request

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/settings/general" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <Your API Token>' \
  --data '{
    "name": "alex-client-server",
    "hostname": "alex-client-server",
    "php_cli_version": "7.4",
    "ols_automatically_restart": false,
    "timezone": "Asia/Kolkata"
  }'
```

#### Updated General Settings
- __200__ (Ok)

``` json
{
  "message": "General Settings Updated Successfully."
}
```

<!-- ## PHP Settings

```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/settings/default-php
```

### Parameters:
| parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| default_php_version | Yes | Float | Select any one PHP Default Version: `7.0`, `7.1`, `7.2`, `7.3`, `7.4`, `8.0`, `8.1`, `8.2` or `8.3`. |
| max_execution_time | Yes | Numeric | Update maximum execution time in seconds for PHP. |
| max_input_time | Yes | Numeric | Update maximum input time in seconds for PHP. |
| max_input_vars | Yes | Numeric | Update maximum input vars in seconds for PHP. |
| memory_limit | Yes | String | Update memory in MB for PHP. |
| post_max_size | Yes | String | Update post maximum size in MB for PHP. |
| upload_max_filesize | Yes | String | Update upload maximum file in MB for PHP. |

#### PHP Settings Curl Request

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/settings/default-php" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <Your API Token>' \
  --data '{
        "default_php_version": "7.4",
        "max_execution_time": 30,
        "max_input_time": 60,
        "max_input_vars": 1000,
        "memory_limit": "128M",
        "post_max_size": "8M",
        "upload_max_filesize": "2M"
  }'
```

#### PHP Settings Update
- __200__ (Ok)

``` json
{
  "message": "PHP Settings Updated Successfully!"
}
``` -->


## Security Settings

### HTTP Request
```http
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/settings/security
```

### Parameters

| Parameter                       | Required | Type          | Description                                                                                        |
|:---------------------------------|:----------|:---------------|:----------------------------------------------------------------------------------------------------|
| redis_password                  | Yes      | String        | Password for Redis (must be alphanumeric with dashes/underscores, max length: 254).               |
| redis_maxmemory                 | No       | String        | Maximum memory limit for Redis (must be in a valid format such as 256mb or 1gb, ending with mb or gb).               |
| maxmemory_policy                | No       | String        | Redis max memory policy. Select any one policy from:`volatile-lru`, `allkeys-lru`, `volatile-lfu`, `allkeys-lfu`, `volatile-random`, `allkeys-random`, `volatile-ttl`, `noeviction`.              |
| ssh_port                        | Yes      | Numeric       | The port number for SSH access.                                                                    |
| is_enabled_security_updates     | No       | Boolean       | Enable or disable automatic security updates.                                                      |
| schedule                        | No       | String        | Scheduling type: options include `every12Hours`, `everyDay`, `everyWeek`, `everyMonth`, or `custom` for a custom schedule.                                          |
| minute                          | No       | Numeric       | Minute component of the schedule (required if `schedule` is `custom`).                           |
| hour                            | No       | Numeric       | Hour component of the schedule (required if `schedule` is `custom`).                             |
| month                           | No       | Numeric       | Month component of the schedule (required if `schedule` is `custom`).                            |
| day_of_week                    | No       | Numeric       | Day of the week component of the schedule (required if `schedule` is `custom`).                  |
| day_of_month                   | No       | Numeric       | Day of the month component of the schedule (required if `schedule` is `custom`).                 |
| permit_root_login               | Yes      | String        | Allow root login (must be `yes` or `no`).                                                         |
| root_password_authentication    | Yes      | String        | Require password authentication for root login (must be `yes` or `no`).                           |

#### cURL Request Example

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/settings/security" \
  --header 'Content-Type: application/json' \
  --header 'Accept: application/json' \
  --header 'Authorization: <Your API Token>' \
  --data '{
    "redis_password": "your_redis_password",
    "redis_maxmemory": "256mb",
    "maxmemory_policy": "volatile-lru",
    "ssh_port": 22,
    "is_enabled_security_updates": 1,
    "schedule": "custom",
    "minute": 0,
    "hour": 2,
    "month": "*",
    "day_of_week": "*",
    "day_of_month": "*",
    "permit_root_login": "no",
    "root_password_authentication": "yes"
  }'
```

#### Response

- Success (200 OK)
```json
{
  "message": "Settings has been updated successfully."
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
  "message": "Organization not found."
}
```

#### Server Not Found
- __404__ (Not Found)

```json
"message": "Server not found."
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went wrong."
}