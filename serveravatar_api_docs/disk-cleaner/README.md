# List

Get the details of disk-cleaner.


### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/disk-cleaner
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/14/disk-cleaner" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Disk Cleaner Detail:

- __200__ (Ok)

```json
{
    "disk_cleaner": {
        "id": 3,
        "server_id": 14,
        "auto_clean": 0,
        "tmp": 0,
        "access_log": 0,
        "error_log": 0,
        "logs": 0,
        "journal_logs": 0,
        "created_at": "2023-02-24 08:59:08",
        "updated_at": "2023-02-28 22:35:57"
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