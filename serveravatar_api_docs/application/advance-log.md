# Advance Logs

Fetch Advance Logs

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/advance-logs
```

### Parameter:

| Parameter    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| log | Yes | String | The name of a log: access.log, error.log, error-ssl.log or access-ssl.log. |
| type | Yes | String | Filter Type: fullLogs, selectTailLines, specificLines or findLogs. |
| numberOfTailLines | No | Numeric | Pass this parameter if type is selectTailLines. |
| startLine | No | Numeric | Pass this parameter if type is specificLines. |
| endLine | No | Numeric | Pass this parameter if type is selectTailLines. |
| ip | No | String | Must be an IP Address, Pass this parameter if type is findLogs. |
| status | No | String | HTTP Status Code, Pass this parameter if type is findLogs. |
| time | No | String | Date and Time, Pass this parameter if type is findLogs. |
| bytes | No | Numeric | Bytes, Pass this parameter if type is findLogs. |
| referer | No | string | Referer, Pass this parameter if type is findLogs. |
| url | No | string | URL, Pass this parameter if type is findLogs. |
| method | No | string | Method, Pass this parameter if type is findLogs. |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/advance-logs" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
  --data '{
    "log": "access.log",
    "type": "fullLogs",
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