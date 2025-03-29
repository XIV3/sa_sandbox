# Disable

To disable a control panel access user.

### HTTP Request:

```
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/hosting-user/{hosting_user}
```

### Curl Request Example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/hosting-user/{hosting_user}" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Disable:
- __200__ (Ok)

```json
{
  "message": "Control panel user removed from the server."
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