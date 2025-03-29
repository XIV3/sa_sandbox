# List

Use this method to get a list of backups.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/backups
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/backups" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Backups List

- __200__ (Ok)

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 14,
            "backup_config_id": 13,
            "organization_id": 5,
            "server_id": null,
            "cloud_storage_provider_id": 1,
            "application_id": 92,
            "database_id": 51,
            "backup_hash": "F50SZjCYlWPBKuhOuvLnDu5RrHraK0VE",
            "application_extension": ".tar.gz",
            "database_extension": ".sql.gz",
            "price": 0,
            "application_size": 73.81,
            "database_size": 0.13,
            "total_application_size": 337.07,
            "total_database_size": 10,
            "status": "Completed",
            "application_file_id": null,
            "database_file_id": null,
            "application_available_in_cloudstorage": 1,
            "database_available_in_cloudstorage": 1,
            "expires_at": "2025-02-18 11:12:22",
            "created_at": "2025-02-11 11:12:22",
            "updated_at": "2025-02-11 11:12:46",
            "deleted_at": null,
            "provider": "gdrive",
            "totalSize": 73.94,
            "database": {
                "id": 51,
                "server_id": 36,
                "name": "ServeravatarDb"
            },
            "application": {
                "id": 92,
                "system_user_id": 42,
                "name": "ServerAvatar"
            },
            "backup_configuration": {
                "id": 13,
                "name": null
            }
        }
    ],
    "first_page_url": "https://api.serveravatar.com/organizations/5/backups?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://api.serveravatar.com/organizations/5/backups?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://api.serveravatar.com/organizations/5/backups?page=1",
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
    "path": "https://api.serveravatar.com/organizations/5/backups",
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

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```