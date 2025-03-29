# List

## Server's Database List

Use this endpoint to get a list of databases of the server.
### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/databases?pagination=1&search={search by database name}
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/databases?pagination=1&search=" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Database List
- __200__ (Ok)

``` json
{
    "databases": {
        "current_page": 1,
        "data": [
            {
                "server_name": "ubutnu",
                "country_code": "FR",
                "agent_status": "1",
                "database_type": "mysql",
                "id": 644,
                "server_id": 307,
                "name": "laraveltest",
                "size": 0,
                "automatic_backup": 0,
                "created_at": "2024-07-11 13:50:13",
                "updated_at": "2024-07-11 13:50:13",
                "deleted_at": null,
                "usersCount": 1,
                "host": "172.233.26.25",
                "remoteAccess": false,
                "created_by_humans": "1 day ago"
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/databases?pagination=1&page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/databases?pagination=1&page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/servers/15/databases?pagination=1&page=1",
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
        "path": "https://api.serveravatar.com/organizations/5/servers/15/databases",
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


## Organization's Database List

Database list within organization. 

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/databases?pagination=1&search=
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/databases?pagination=1&search=" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Database List
- __200__ (Ok)

``` json
{
    "databases": {
        "current_page": 1,
        "data": [
            {
                "id": 641,
                "server_id": 323,
                "name": "fddsfgdfg",
                "size": 0,
                "automatic_backup": 0,
                "created_at": "2024-07-11T08:04:37.000000Z",
                "updated_at": "2024-07-13T05:00:14.000000Z",
                "deleted_at": null,
                "database_type": "mongodb",
                "remoteAccess": false,
                "host": "167.99.219.44",
                "server_name": "test-mern-dbuser",
                "country_code": "NL",
                "agent_status": "1",
                "created_by_humans": "1 day ago"
            }
        ],
        "first_page_url": "https://api.serveravatar.com/organizations/5/databases?pagination=1&page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://api.serveravatar.com/organizations/5/databases?pagination=1&page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "https://api.serveravatar.com/organizations/5/databases?pagination=1&page=1",
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
        "path": "https://api.serveravatar.com/organizations/5/databases",
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

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```