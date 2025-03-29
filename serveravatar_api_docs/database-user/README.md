# List

To get a list of database user.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/databases/{database}/database-users?pagination=1
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/databases/48/database-users?pagination=1" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Database User List
- __200__ (Ok)

``` json
{
    "databaseUsers": {
        "current_page": 1,
        "data": [
            {
                "id": 53,
                "database_id": 48,
                "username": "HedgHs3vfsMwdsUv",
                "password": "8QhFbnpLL8CJsEQK",
                "remote_ip": null,
                "mongodb_remote_ip": null,
                "connection_preference": "localhost",
                "hostname": [
                    "localhost"
                ],
                "created_at": "2024-07-13 09:43:25",
                "updated_at": "2024-07-13 09:43:25",
                "remoteAccess": false
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/databases/48/database-users?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/databases/48/database-users?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/servers/15/databases/48/database-users?page=1",
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
        "path": "https://api.serveravatar.com/organizations/5/servers/15/databases/48/database-users",
        "per_page": 8,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    },
    "databaseName": "ServerAvatar"
}
```

#### Database Not Found
- __404__ (Not Found)

```json
{
    "message": "Database not found!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message":"Organization not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message":"Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```