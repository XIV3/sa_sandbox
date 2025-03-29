# Enable

To enable a control panel access user.

### HTTP Request:

```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/hosting-user
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| username | Yes | String | Username for the control panel access user. |
| password | Yes | String | Password for the control panel access user. |
| allowed_applications | No | Numeric | Number of allowed applications. |
| allowed_databases | No | Numeric | Number of allowed databases. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/hosting-user" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "username": "newusername",
    "password": "newpassword",
    "allowed_applications": 10,
    "allowed_databases": 10
  }'
```

### Response:

#### Created:
- __200__ (Ok)

```json
{
  "message": "Control panel user created successfully"
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