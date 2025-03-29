# Logs

## Log Size

Get sizes of the particular log file.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/log-sizes
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/log-sizes" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Application Log
- __200__ (Ok)

``` json
{
    "sizeType": "MB",
    "output": {
        "access.log": {
            "title": "access.log (Access logs)",
            "size": "0.004"
        },
        "error.log": {
            "title": "error.log (Error logs)",
            "size": "0.000"
        },
        "access-ssl.log": {
            "title": "access-ssl.log (Access logs for HTTPS version)",
            "size": "0.000"
        },
        "error-ssl.log": {
            "title": "error-ssl.log (Error logs for HTTPS version)",
            "size": "0.000"
        }
    }
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
    "message": "Application not found!"
}
```

#### Server not found
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

Fetch application log.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/logs
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| log | Yes | String | The name of a log: access.log, error.log, error-ssl.log or access-ssl.log. |
| selectTailLines | Yes | Boolean | True, If you want to select latest few logs. |
| numberOfTailLines | Yes | Numeric | Number of lines from a log files. |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/logs" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "log": "access.log",
    "selectTailLines": 1,
    "numberOfTailLines": 5
  }'
```

### Response:

#### Application Log
- __200__ (Ok)

``` json
{
  "output": "192.158.236.78 - - [20\/Feb\/2020:04:09:18 +0000] \"GET \/ HTTP\/1.1\" 200 26389 \"-\" \"-\"\n207.246.95.118 - - [20\/Feb\/2020:04:15:17 +0000] \"POST \/wp-cron.php?doing_wp_cron=1582172116.9849410057067871093750 HTTP\/1.1\" 200 339 \"http:\/\/siteexample.tk\/wp-cron.php?doing_wp_cron=1582172116.9849410057067871093750\" \"WordPress\/5.3.2; http:\/\/siteexample.tk\"\n192.158.236.78 - - [20\/Feb\/2020:04:15:16 +0000] \"GET \/ HTTP\/1.1\" 200 26389 \"-\" \"-\"\n192.158.236.78 - - [20\/Feb\/2020:04:21:28 +0000] \"GET \/ HTTP\/1.1\" 200 26389 \"-\" \"-\"\n192.158.236.78 - - [20\/Feb\/2020:04:27:37 +0000] \"GET \/ HTTP\/1.1\" 200 26389 \"-\" \"-\"\n"
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
    "message": "Application not found!"
}
```

#### Server not found
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

## Truncate Logs

Truncate/erase Application Logs.


### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/truncate-logs
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| log | Yes | String | The name of a log: access.log, error.log, error-ssl.log or access-ssl.log. |


### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/truncate-logs" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "log": "access.log"
  }'
```

### Response:

#### Application Log
- __200__ (Ok)

``` json
{
  "message": "access.log{Your selected log} file successfully truncate."
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
    "message": "Application not found!"
}
```

#### Server not found
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