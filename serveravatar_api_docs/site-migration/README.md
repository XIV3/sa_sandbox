# List

Get the list of server site-migration.


### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/site-migrations
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/site-migrations" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Site-migration List:

- __200__ (Ok)

```json
{
  "current_page": 1,
  "data": [
    {
      "id": 298,
      "server_id": 15,
      "migration_server_id": 547,
      "application_id": 602,
      "database_id": 413,
      "migration_application_id": null,
      "migration_database_id": 424,
      "site_type": "migration",
      "type": "database",
      "size": 0.7,
      "key": "iMGkEseGvoUEfsdsGuFgZztYhzSYg1xGktT",
      "status": "Completed",
      "created_at": "2022-04-14 18:13:35",
      "updated_at": "2022-04-14 18:13:43",
      "migrate_server_ip": "206.189.190.121",
      "application_name": "wordpressite_clone",
      "database_name": "wordpressite"
    },
    {
      "id": 297,
      "server_id": 15,
      "migration_server_id": 547,
      "application_id": 602,
      "database_id": 413,
      "migration_application_id": 610,
      "migration_database_id": 423,
      "site_type": "migration",
      "type": "application",
      "size": 64.88,
      "key": "u4Cf5pQNoaYe8AsddLw553RwZTjUc0QUqaO",
      "status": "Completed",
      "created_at": "2022-04-14 18:12:53",
      "updated_at": "2022-04-14 18:13:20",
      "migrate_server_ip": "206.189.190.121",
      "application_name": "wordpressite_clone",
      "database_name": "wordpressite"
    },
    {
      "id": 296,
      "server_id": 15,
      "migration_server_id": 547,
      "application_id": 599,
      "database_id": null,
      "migration_application_id": 609,
      "migration_database_id": null,
      "site_type": "migration",
      "type": "filesystem",
      "size": 64.01,
      "key": "TKaRTtH4uSWssd3tT9zyB3zFMhuvUd5S6nb",
      "status": "Completed",
      "created_at": "2022-04-14 18:12:16",
      "updated_at": "2022-04-14 18:12:37",
      "migrate_server_ip": "206.189.190.121",
      "application_name": "wordpressite",
      "database_name": null
    }
  ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/servers/15/site-migrations?page=1",
    "from": null,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/servers/15/site-migrations?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://api.serveravatar.com/organizations/5/servers/15/site-migrations?page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/servers/15/site-migrations",
    "per_page": 10,
    "prev_page_url": null,
    "to": null,
    "total": 0
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