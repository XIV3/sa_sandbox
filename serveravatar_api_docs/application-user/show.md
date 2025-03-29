# Show

Show the detail of the particular application user of the application.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application User Show
- __200__ (Ok)

``` json
{
    "systemUser": {
        "id": 66,
        "server_id": 15,
        "username": "0CGgPDK1NxUkTFMc",
        "password": "itj9WUV4tE2WW0jh",
        "public_key": null,
        "group": "system_users",
        "created_at": "2023-02-28 23:14:17",
        "updated_at": "2023-02-28 23:14:17",
        "deleted_at": null,
        "ssh_access": false
    }
}
```

#### Application User Not Found
- __404__ (Not Found)

```json
{
    "message": "Application User not found!"
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