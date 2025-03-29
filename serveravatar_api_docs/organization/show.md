# Show

Get an organization.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Organization
- __200__ (Ok)

``` json
{
    "organization": {
        "id": 5,
        "user_id": 3,
        "name": "ServerAvatar",
        "description": "ServerAvatar",
        "logo": "https://api.serveravatar.com/storage/organizations/logo/791c1b39-3c5b-4b4f-a523-83ec3c1939bc.png",
        "main": 0,
        "created_at": "2023-02-13 18:29:40",
        "updated_at": "2023-02-28 21:36:40",
        "deleted_at": null,
        "admin": true
    }
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```