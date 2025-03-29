# Create

To create database user for the database.

### HTTP Request:
```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/databases/{database}/database-users
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| username | Yes | String | Alpha-Numeric string, Minimum 5 characters. |
| password | Yes | String | Random string, Minimum 8 characters. |
| connection_preference | No | String | Select any one connection preference: `localhost`, `everywhere`, `specific_ip_addresses` | 
| hostname | No | Array | IPv4 address. Required if hostname is `specific_ip_addresses` and you want to enable remote access. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/databases/48/database-users" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "username": "YOECsqhTv7iIpN7V",
    "password": "g5AzhOvzDP4uWQrS",
    "connection_preference": "localhost"
  }'
```

### Response:

#### Database User Create:

- __200__ (Ok)

```json
{
  "message": "Database user has been created successfully!"
}
```

#### Duplicate Username
- __302__ (Found)

```json
{
    "message": "Duplicate username detected!"
}
```

#### Database Not Found
- __404__ (Not Found)

```json
{
    "message": "Database not found!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message":"Organization not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message":"Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while creating database user!"
}