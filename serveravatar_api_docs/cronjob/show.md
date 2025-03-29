# Show

Get the detail of the particular cronjob.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/cronjobs/{cronjob}
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs/63" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Cronjob Show
- __200__ (Ok)

``` json
{
  "cronjob": {
    "id": 63,
    "server_id": 15,
    "name": "TestCronjob",
    "system_user": "q9mStIMWR3r5HAzU",
    "schedule": "0 0 * * *",
    "command": "apt-get upgrade",
    "custom_scheduling": "0",
    "enabled": 1,
    "created_at": "2023-03-01 01:53:15",
    "updated_at": "2023-03-01 01:53:15",
    "minute": "0",
    "hour": "0",
    "month": "*",
    "day_of_week": "*",
    "day_of_month": "*",
  }
}
```

#### Cronjob Not Found
- __404__ (Not Found)

```json
{
    "message": "Cronjob not found!"
}
```

#### Organization not found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
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
