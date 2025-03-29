# List

Get the list of server site-clone.


### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/site-clone
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/site-clone" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Site-clone List:

- __200__ (Ok)

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 45,
            "site_type": "clone",
            "type": "application",
            "size": 70.3,
            "key": "Zlrmj52fJBrMxtvzK8euI0yYewmWDhHQ",
            "status": "Completed",
            "created_at": "2023-02-28 23:23:22",
            "updated_at": "2023-02-28 23:23:37",
            "migration_application": {
                "id": 93,
                "name": "TestClone"
            },
            "migration_server": {
                "id": 15,
                "ip": "54.173.31.189",
                "name": "api-doc"
            },
            "migration_database": {
                "id": 52,
                "name": "ServeravatarDb1"
            }
        }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/site-clone?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/site-clone?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/site-clone?page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/servers/15/applications/92/site-clone",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
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