# List

Use this method to get a list of created cronjobs.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/cronjobs?pagination=1
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs?pagination=1" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Cronjob Lists
- __200__ (Ok)

``` json
{
    "cronjobs": {
        "current_page": 1,
        "data": [
            {
                "id": 2,
                "server_id": 15,
                "system_user": "q9mStIMWR3r5HAzU",
                "name": "TestCronjob",
                "schedule": "0 0 * * *",
                "command": "apt-get update",
                "custom_scheduling": "0",
                "enabled": 1,
                "created_at": "2023-03-01 01:53:15",
                "updated_at": "2023-03-01 01:53:15"
            }
        ],
        "first_page_url": "/organizations/5/servers/15/cronjobs?pagination=1&page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/cronjobs?pagination=1&page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/servers/15/cronjobs?pagination=1&page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "https://api.serveravatar.com/organizations/5/servers/15/cronjobs",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1,
        "total": 1
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