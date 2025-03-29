# Create

Create an application user for the application.

### HTTP Request:
```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| username | Yes | Alphabet Numeric | Alpha-Numeric string, Minimum 5 characters. |
| password | Yes | String | Random string, Minimum 8 characters. |
| password_confirmation | Yes | String | Same as password. |
| public_key | No | String | Your public key. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "username": "testApplicationUser",
    "password": "789456qwerty",
    "password_confirmation": "789456qwerty",
    "public_key": "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCA2WK+H/WAYo4k4o7QxoZ3Eg5JQZ8UIbydEtNtTREmEqXY2ZU5lJibVZCeRxbNkvgDBQnOQZsGpoRq3SV8zxEqI2qVM2Se2+6x8QcmxsBoXPOjO+tDAFvspX2Jo1XgHQWf6HFcgkkLv8lhts6t7jIH3Xhz39JmEH3XJYSUQ3N6Im1fti2Txtb+OalmIPJz/EW5R+ochr5R1RKNKP0isly4Nop8kFr9bTss1msJdwLlywfPXOa983EkMb1mHu3L8H3MXZPweeipxjN/smTdLs9XfMjB6S/KIKdMDZLfzPA2z8566DD+sUHQat5UT/9nGHLbXMwSfHhonkRpkHagX8IB"
  }'
```

### Response:

#### Application User Create:

- __200__ (Ok)

```json
{
  "message": "Application user has been created successfully!",
  "systemUser": {
    "id": 5511,
    "server_id": 2721,
    "username": "testApplicationUser",
    "password": "789456qwerty",
    "group": "system_users",
    "public_key":"ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCA2WK+H/WAYo4k4o7QxoZ3Eg5JQZ8UIbydEtNtTREmEqXY2ZU5lJibVZCeRxbNkvgDBQnOQZsGpoRq3SV8zxEqI2qVM2Se2+6x8QcmxsBoXPOjO+tDAFvspX2Jo1XgHQWf6HFcgkkLv8lhts6t7jIH3Xhz39JmEH3XJYSUQ3N6Im1fti2Txtb+OalmIPJz/EW5R+ochr5R1RKNKP0isly4Nop8kFr9bTss1msJdwLlywfPXOa983EkMb1mHu3L8H3MXZPweeipxjN/smTdLs9XfMjB6S/KIKdMDZLfzPA2z8566DD+sUHQat5UT/9nGHLbXMwSfHhonkRpkHagX8IB",
    "deleted_at": null,
    "created_at": "2023-02-17 12:49:47",
    "updated_at": "2023-02-17 12:49:47"
  }
}
```

#### Duplicate Username
- __500__ (Internal Server Error)

```json
{
    "message": "Username has already been taken!"
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