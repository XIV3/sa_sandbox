# List

## Server's Application List

Get a list of all applications present on the server.

### HTTP Request:
```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application Lists:

- __200__ (Ok)

```json
{
  "applications": {
    "current_page": 1,
    "data": [
      {
        "id": 93,
        "name": "TestClone",
        "primary_domain": "hrtv0g.serveravatarfm.host",
        "framework": "wordpress",
        "active": 1,
        "size": 0,
        "ssl": "custom",
        "created_at": "2023-02-28 23:23:22",
        "updated_at": "2023-02-28 23:23:27",
        "server_id": 15,
        "created_by_humans": "1 hour ago",
        ....
      },
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications?page=1",
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "https://api.serveravatar.com/organizations/5/servers/15/applications?page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/servers/15/applications",
    "per_page": 10,
    "prev_page_url": null,
    "to": 3,
    "total": 3
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


## Organization's Application List

Get a list of all application present on the Organization.

### HTTP Request:
```js
GET https://api.serveravatar.com/organizations/{organization}/applications
```

### Curl Request:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/applications" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application Lists:

- __200__ (Ok)

```json
{
  "applications": {
    "current_page": 1,
    "data": [
      {
        "id": 93,
        "size": 0,
        "name": "TestClone",
        "primary_domain": "hrtv0g.serveravatarfm.host",
        "framework": "wordpress",
        "ssl_type": "custom",
        "active": 1,
        "php_version": 8,
        .....
      }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/applications?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/applications?page=1",
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "https://api.serveravatar.com/organizations/5/applications?page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/applications",
    "per_page": 10,
    "prev_page_url": null,
    "to": 3,
    "total": 3
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

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```