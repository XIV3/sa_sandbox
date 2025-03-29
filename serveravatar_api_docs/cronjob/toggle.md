# Toggle

Enable or disable the cronjob schedule for the server.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/cronjobs/{cronjob}/toggle
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs/63/toggle" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Cronjob Enable/Disable
- __200__ (Ok)

``` json
{
  "cronjobs": {
    "id": 63,
    "server_id": 15,
    "name": "TestCronjob",
    "schedule": "0 0 * * *",
    "command": "sudo apt-get update",
    "custom_scheduling": "0",
    "system_user": "q9mStIMWR3r5HAzU",
    "enabled": 1,
    "created_at": "2023-02-17 10:56:36",
    "updated_at": "2023-02-17 10:56:36"
  },
  "message": "Cronjob successfully enabled."
}
```

#### Cronjob Not Found
- __404__ (Not Found)

```json
{
    "message": "Cronjob not found!"
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
```