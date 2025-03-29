# Status

Get a status of the application staging area.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/status
```
### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/88/status" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Site Migration Status
- __200__ (Ok)

``` json
{
    "configurationInPercentage": 0,
    "displayText": "Staging area failed",
    "siteMigration": {
        "id": 42,
        "server_id": 15,
        "migration_server_id": 15,
        "application_id": 88,
        "database_id": 48,
        "migration_application_id": 89,
        "migration_database_id": null,
        "site_type": "staging_area",
        "type": "application",
        "size": 0,
        "key": "gpG8WerMOMy0lQpUjcTjCjkduEvBUzCf",
        "status": "staging_area_failed",
        "created_at": "2023-02-28 23:09:33",
        "updated_at": "2023-02-28 23:09:35"
    }
}
```

#### Permission Error
- __404__ (Not Found)
```json
{
    "message": "You can not perform this action!"
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