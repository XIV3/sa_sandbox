# Update

To update a supervisor.

### HTTP Request:

```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| name | Yes | String | Name of the supervisor. |
| command | Yes | Alpha-Numeric | Alpha-Numeric string |
| autostart | Yes | Boolean | `true`, or `false` |
| autorestart | Yes | Boolean | `true`, or `false` |
| numprocs | Yes | Numeric | Number Of Processes |
| user | Yes | String | Application's User Username |
| logfile | Yes | String | Log File Name |
| loglevel | Yes | String | Log Level: `critical`, `error`, `warn`, `info`, `debug`, `trace`, or `blather` |
| extra_config | No | String | Extra configuration like: stopwaitsecs, startsecs and etc.  |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "EmailDefault",
    "user": "x5Ov6RGvBOEKVjay",
    "command": "php /home/x5Ov6RGvBOEKVjay/myapp/public_html/artisan queue:work --queue=email-worker",
    "autostart": 1,
    "autorestart": 1,
    "numprocs": 5,
    "logfile": "email-worker.log",
    "loglevel": "trace"
  }'
```

### Response:

#### Supervisor Updated:
- __200__ (Ok)

```json
{
  "message": "Supervisor process has been updated successfully!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
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