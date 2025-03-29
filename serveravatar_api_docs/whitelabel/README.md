# Show

Get the control panel access user detail.


### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/hosting-user
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/hosting-user" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Supervisor List:

- __200__ (Ok)

```json
{
    "hostingUser": {
        "id": 4,
        "server_id": 21191,
        "username": "sdsfgdfg",
        "password": "@0g3dA90Y5*GC",
        "email": null,
        "timezone": "Etc\/UTC",
        "expires_in": "2024-06-12 12:36:10",
        "remember_token": null,
        "created_at": "2024-06-11 17:55:58",
        "updated_at": "2024-06-11 18:06:10"
    },
    "domain": "app.serveravatar.cloud",
    "key": "eyJpdiI6InBXYzFWbWJzTzg3THZyUk5rd3FzVGc9PSIsInZhbHVlIjoia0pOY1VXY1N2bUZ1Tk1FZnJwMEE2UGdEQWU1ZitNWmJ3aTRrL05hbTVyQWxucDN6ZnEwLvgsdfgdfg05Vc3R3Qk9aaFRuOWtOd2paQVE0ZTl2WGdrVU9xcisxZVUwNVRsSEk4dmFqdEU2UUV2RUxva2svN2huaUdBSFNNZ01XbGJKVU53ZlEiLCJtYWMiOiJkMmVjYm"
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