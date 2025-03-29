# Prestashop

Install a prestashop in your application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/servers/{server_id}/applications/{application_id}/auto-installer/prestashop
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| firstname | Yes | String | The firstname of your prestashop site. |
| lastname | Yes | String | The lastname of your prestashop site. |
| email | No | String | The email of your prestashop site. |
| password | Yes | String | The password of your prestashop site. |
| database_server | No | Numeric | Database server ID, if you want to remote database server. |
| database_name | Yes | Alpha-Numeric | Name of the database. |
| php_version | Yes | String | Supported php version, 7.2, 7.3, 7.4 |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/servers/623/applications/724/auto-installer/prestashop" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "firstname":"firstname",
    "lastname":"lastname",
    "password":"username@123",
    "php_version":"7.3",
    "database_name":"prestashop"
}'
```

### Response:

#### Install prestashop

- __200__ (Ok)

```json
{
  "message":"Application has been deployed in prestashop successfully!"
}
```

#### Forbidden
- __403__ (Forbidden)

```json
{
    "message": "You can not perform this action!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
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