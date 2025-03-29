# List

List of organizations.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Organization lists
- __200__ (Ok)

``` json
{
    "organizations": [
        {
            "id": 5,
            "name": "ServerAvatar",
            "created_at": "2023-02-13 18:29:40",
            "members": [
                {
                    "name": "Admin",
                    "avatar": "https://www.gravatar.com/avatar/b73d2a454846317ff56274f7c509eac8?d=&s=200",
                    "email": "admin@serveravatar.com",
                    "roles": [
                        {
                            "id": 29,
                            "role": "87GWyfqW"
                        }
                    ]
                }
            ]
        }
    ]
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```