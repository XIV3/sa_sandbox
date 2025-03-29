# Update

Update tha password of the application user or toggle the SSH key.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| type | Yes | String | Select any type: `password`, or `key` |
| password | No | String | Random string, Minimum 8 characters, If type is `password` |
| password_confirmation | No | String | Same as password. |
| public_key | No | String | Your public key, If type is `key` |

### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "type": "password",
    "password": "m7m5DcqIUsNOor4t",
    "password_confirmation": "m7m5DcqIUsNOor4t"
  }'
```

#### Application User Update Password
- __200__ (Ok)

``` json
{
  "systemUser": {
    "id": 5511,
    "server_id": 2721,
    "username": "testApplicationUser",
    "password": "m7m5DcqIUsNOor4t",
    "group": "system_users",
    "created_at": "2020-02-17 12:49:47",
    "updated_at": "2020-02-17 12:49:47"
  },
  "message": "testApplicationUser has been updated successfully!"
}
```

#### System User Not Found
- __404__ (Not Found)

```json
{
    "message": "Application user not found!"
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