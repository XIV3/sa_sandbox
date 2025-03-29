# Archive Backup

## Deleted Server List

Get the list of deleted servers.


### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/backups/deleted-server
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/backups/deleted-server" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Server Lists:

- __200__ (Ok)

```json
{
    "servers": [
        {
            "id": 11,
            "name": "test-server",
            "ip": "54.85.119.83",
            "deleted_at": "2023-02-19T00:00:00.000000Z"
        }
    ]
}
```

## Archive Backup List

Get the list of archive backups.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/backups/archive/{type:['filesystem','database', 'application']}
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/backups/archive/application" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Archive Backup Lists:

- __200__ (Ok)

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 11,
            "backup_config_id": 11,
            "organization_id": 5,
            "cloud_storage_provider_id": 1,
            "application_id": 74,
            "database_id": 24,
            "backup_hash": "MWlLKX8LCT30nylsDR4iL7QLoUJNC1yR",
            "application_extension": ".tar.gz",
            "database_extension": ".sql.gz",
            "price": 0,
            "application_size": 0,
            "database_size": 0,
            "total_application_size": 505.28,
            "total_database_size": 0,
            "status": "Completed",
            "application_file_id": null,
            "database_file_id": null,
            "application_available_in_cloudstorage": 1,
            "database_available_in_cloudstorage": 1,
            "expires_at": null,
            "created_at": "2023-02-15 20:48:39",
            "updated_at": "2023-02-15 20:48:39",
            "deleted_at": null,
            "application_name": "testGitApp",
            "primary_domain": "fghfhgf.serveravatarfm.host",
            "database_name": "testMigrateDB",
            "provider": "Google Drive",
            "totalSize": 0,
            "next_backup_at": "2023-03-01 01:44:43"
        }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/backups/archive/application?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/backups/archive/application?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://api.serveravatar.com/organizations/5/backups/archive/application?page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/backups/archive/application",
    "per_page": 9,
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

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```