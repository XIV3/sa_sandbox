# Logs

Get a list of log files.

### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/logs
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/logs" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Server Logs List
- __200__ (Ok)

``` json
{
  "logFiles": {
    "auth.log": "Authentication log",
    "php7.0-fpm.log": "PHP7.0-FPM log",
    "php7.1-fpm.log": "PHP7.1-FPM log",
    "php7.2-fpm.log": "PHP7.2-FPM log",
    "php7.3-fpm.log": "PHP7.3-FPM log",
    "php7.4-fpm.log": "PHP7.4-FPM log",
    "php8.0-fpm.log": "PHP8.0-FPM log",
    "php8.1-fpm.log": "PHP8.1-FPM log",
    "php8.2-fpm.log": "PHP8.2-FPM log",
    "mysql\/error.log": "MySQL Error log",
    "kern.log": "Kernel log",
    "mail.log": "Mail log",
    "letsencrypt.log": "Letsencrypt log",
    "nginx\/access.log": "Nginx access log",
    "nginx\/error.log": "Nginx error log"
  }
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
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

## Fetch Logs

Fetch the logs of the particular files.

### HTTP Request:

```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/logs
```

### Parameter:

| parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| log | Yes | String | Select from a list of logs. |
| selectTailLines | Yes | Boolean | `true`, If you want to select latest few logs. |
| numberOfTailLines | Yes | Numeric | Number of lines from a log files. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/logs" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
        "log": "PHP7.4-FPM.log",
        "selectTailLines": true,
        "numberOfTailLines": 3
  }'
```

### Response:

#### Server Logs List
- __200__ (Ok)

``` json
{
  "output": "[28-Feb-2023 10:23:04] NOTICE: fpm is running, pid 103295\n[28-Feb-2023 10:23:04] NOTICE: ready to handle connections\n[28-Feb-2023 10:23:04] NOTICE: systemd monitor interval set to 10000ms\n",
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Log Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong while log!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```