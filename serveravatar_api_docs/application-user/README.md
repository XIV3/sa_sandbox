# List

Get a list of created application user.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users?pagination=1
```

### Curl Request example: 

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users?pagination=1" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application User List
- __200__ (Ok)

``` json
{
    "systemUsers": {
        "current_page": 1,
        "data": [
            {
                "id": 66,
                "server_id": 15,
                "username": "0CGgPDK1NxUkTFMc",
                "password": "itj9WUV4tE2WW0jh",
                "public_key": null,
                "group": "system_users",
                "created_at": "2023-02-28 23:14:17",
                "updated_at": "2023-02-28 23:14:17",
                "deleted_at": null,
                "ssh_access": false,
                "applications": []
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/system-users?pagination=1&page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/system-users?pagination=1&page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/servers/15/system-users?pagination=1&page=1",
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
        "path": "https://api.serveravatar.com/organizations/5/servers/15/system-users",
        "per_page": 10,
        "prev_page_url": null,
        "to": 3,
        "total": 3
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